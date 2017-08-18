<?php

namespace backend\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $file;

    public function rules()
    {
        return [
            [['file'], 'file', 'skipOnEmpty' => false, 'extensions' => 'xls, xlsx', 'checkExtensionByMimeType' => false],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->file->saveAs('uploads/' . $this->file->baseName . '.' . $this->file->extension);
            return 'uploads/' . $this->file->baseName . '.' . $this->file->extension;
        } else {

            return false;
        }
    }

    /* Method for grouping data by the employee name 
     * @row[1] - date
     * @row[2] - time
     * @row[3] - enrty type
     * @row[5] - employee name
     *      */
    public function splitByUserName($data, $isExcel)
    {
        $response = array();
        foreach ($data as $key => $row) {
            if (!empty($row[5])) {
                if ($isExcel) {
                    //transform excel date to timestamp
                    $row[2] = 86400 * $row[2] - 7200;
                    $row[1] = ($row[1] - 25569) * 86400;
                    $row[2] = $row[1] + $row[2];
                    $row[1] = date('Y-m-d', $row[1]);
                    $row[2] = date('Y-m-d H:i:s', $row[2]);
                } else {
                    $row[2] = $row[1] . " " . $row[2];
                }

                $row[3] = (strpos($row[3], "Вход") === false) ? "out" : "in";
                $username = $row[5];
                $response[$username][] = $row;
            }
        }
        return $response;
    }

    /* Method for grouping data of the employee by the date 
     *  @row[1] - date
    */
    public function splitByDate($data)
    {
        $response = array();
        foreach ($data as $key => $row) {
            $date = $row[1];
            $response[$date][] = $row;
        }
        return $response;
    }

    /* Set in or out date (depends on the type of entry) */
    public function setData(&$date_data, $row)
    {
        $date_data[$row[3]] = $row[2];
    }

    public function getBooleanLabel($value)
    {
        return $value ? "да" : "нет";
    }

    private function getHoursFromRanges($date_data, $events)
    {
        $hours = 0;
        if (!empty($date_data['in']) && !empty($date_data['out'])) {

            $currentState = 'in';
            $pairs = [];
            $time_in = strtotime($date_data['in']);
            $time_out = strtotime($date_data['out']);
            $prev_event = array(); //previous event
            foreach ($events as $key => $event) {
                if (empty($prev_event)) $prev_event = $event;
                $time_event = strtotime($event[2]);
                if (($time_in > $time_event) || ($time_out < $time_event)) {
                    continue;
                }

                if ($currentState == 'in' && $event[3] == 'out') {
                    $pairs[] = [
                        'start_time' => $prev_event[2],
                        'end_time'   => $event[2]
                    ];
                    $currentState = 'out';
                }
                if ($currentState == 'out' && $event[3] == 'in') {
                    $currentState = 'in';
                }
                $prev_event = $event;
            }
            foreach ($pairs as $pair) {
                $hours += round((strtotime($pair['end_time']) - strtotime($pair['start_time'])) / 3600, 1);
            }
        }
        return $hours;
    }

    public function importData($data, $isExcel = true)
    {
        $groupedData = $this->splitByUserName($data, $isExcel);
        $response = [];
        foreach ($groupedData as $username => $user_data) {
            $employee = Employee::find()->where(['name' => $username])->one();
            if (empty($employee)) {
                $employee = new Employee();
                $employee->name = $username;
                $employee->save();
            }

            $data = $this->splitByDate($user_data);
            /*
             * @events - array of events per day
            */
            foreach ($data as $date => $events) {
                $date_data = array(
                    'in'         => '', //datetime when user goes in
                    'out'        => '', //datetime when user goes out
                    'error'      => false, //bool for double records checking
                    'hours'      => 4, //hours
                    'start_time' => $date . " 10:00:00", //start working datetime
                    'lateness'   => false
                );
                $date_data_simple = array(
                    'in'         => '', //datetime when user goes in
                    'out'        => '', //datetime when user goes out
                    'error'      => false, //bool for double records checking
                    'hours'      => 4, //hours
                    'start_time' => $date . " 10:00:00", //start working datetime
                    'lateness'   => false
                );
                $prev_event = array(); //previous event
                foreach ($events as $key => $event) {
                    $deny_set = false; //flag that allows/disallows to update datetime
                    /* Use simple logic to update data */
                    if (empty($date_data_simple['in'])) {
                        $new_event = $event;
                        $new_event[3] = 'in';
                        $this->setData($date_data_simple, $new_event);
                    } else {
                        $new_event = $event;
                        $new_event[3] = 'out';
                        $this->setData($date_data_simple, $new_event);
                    }


                    /* Use more complex logic */
                    if (!empty($prev_event)) {
                        if ($prev_event[3] !== $event[3]) { //if it is not the duplicate
                            $deny_set = ($event[3] == 'in' && !empty($date_data['in'])) ? true : false;
                        } else {
                            $date_data['error'] = true; //set the duplicate flag to TRUE
                            /*
                             * Don't update the "out" event
                             * Don't update the "in" event if the "out" date is already set
                             */
                            if ($event[3] !== 'in' || (($event[3] == 'in') && (!empty($date_data['out'])))) {
                                $deny_set = true;
                            }
                        }
                    }
                    if (!$deny_set) {
                        $this->setData($date_data, $event);
                    }
                    $prev_event = $event;
                }


                /* Go by range and count total data */
                $date_data['hours'] = $this->getHoursFromRanges($date_data, $events);


                /*if (!empty($date_data['in']) && !empty($date_data['out'])) {

                    $hours = round((strtotime($date_data['out']) - strtotime($date_data['in']))/3600, 1);
                    if ($hours > 0) {
                        $date_data['hours'] = $hours;
                    }
                }*/

                /*if (!empty($date_data_simple['in']) && !empty($date_data_simple['out'])) {
                    $hours_simple = round((strtotime($date_data_simple['out']) - strtotime($date_data_simple['in']))/3600, 1);
                    if ($hours_simple > 0) {
                        $date_data_simple['hours'] = $hours_simple;
                    }
                }*/
                $date_data_simple['hours'] = $this->getHoursFromRanges($date_data_simple, $events);

                if (!empty($date_data['in']) && strtotime($date_data['in']) > strtotime($date_data['start_time'])) {
                    $date_data['lateness'] = true;
                }

                if (!empty($date_data_simple['in']) && strtotime($date_data_simple['in']) > strtotime($date_data_simple['start_time'])) {
                    $date_data_simple['lateness'] = true;
                }

                $row_response = array(
                    $date, $username, $this->getBooleanLabel($date_data['lateness']),
                    $date_data['hours'], $this->getBooleanLabel($date_data['error'])
                );
                $response[] = $row_response;
                $dateRecord = DateRecord::find()->where(['employee_id' => $employee->id, 'date_log' => $date])->one();
                if (empty($dateRecord)) {
                    $dateRecord = new DateRecord();
                    $dateRecord->employee_id = $employee->id;
                    $dateRecord->date_log = $date;
                }
                $dateRecord->lateness = (int)$date_data['lateness'];
                $dateRecord->hours = $date_data['hours'];
                $dateRecord->errors = (int)$date_data['error'];
                $dateRecord->save();

                /* Save log data lines */
                //first remove all related events to that date
                DateRecordEvent::deleteAll(['date_record_id' => $dateRecord->id]);

                foreach ($events as $event) {
                    $dateEvent = new DateRecordEvent();
                    $dateEvent->date_record_id = $dateRecord->id;
                    $dateEvent->date_log = $event[2];
                    $dateEvent->event_type_id = ($event[3] == "in") ? 1 : 2;
                    $dateEvent->save();
                }

                /* Update date simple data */
                $dateRecord = DateRecordSimple::find()->where(['employee_id' => $employee->id, 'date_log' => $date])->one();
                if (empty($dateRecord)) {
                    $dateRecord = new DateRecordSimple();
                    $dateRecord->employee_id = $employee->id;
                    $dateRecord->date_log = $date;
                }
                $dateRecord->lateness = (int)$date_data_simple['lateness'];
                $dateRecord->hours = $date_data_simple['hours'];
                $dateRecord->errors = (int)$date_data_simple['error'];
                $dateRecord->save();
            }
        }
        return $response;
    }

    public function generateReport($path)
    {
        $excel = new \backend\components\Excel();
        $data = $excel->getFromFile($path);
        //remove first extra rows
        unset($data[0]);
        unset($data[1]);

        $response = array();
        $headers = array(
            'Дата', 'Сотрудник', 'Опоздание (да/нет)', 'Времени в офисе', 'Задвоения (да/нет)'
        );
        $response[] = $headers;
        $response = array_merge($response, $this->importData($data));
        $excel->generateFromArray($response, "Report", true);
    }
}
