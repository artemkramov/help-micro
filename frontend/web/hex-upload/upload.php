<?php

require_once 'auth.php';

$serverName = 'localhost';
$username = 'root';
$password = '';
$dbName = 'tutartem_dwl';

$connection = new PDO("mysql:host=$serverName;dbname=$dbName", $username, $password);

$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$allowedExtensions = array('hex');

$info = pathinfo($_FILES['file-hex']['name']);

/** Mapping between headers in file and DB fields */
$fieldMapping = array(
    'VERS'  => 'version',
    'GUID'  => 'firmware_guid',
    'DESCR' => 'description'
);

try {
    $extension = $info['extension'];
    if (!in_array($extension, $allowedExtensions)) {
        throw new Exception("Неверное расширение файла");
    }
    $baseDirectory = '../hex/cz/';
    $fileName = 'chech' . time() . '.' . $extension;
    $filePath = $baseDirectory . $fileName;

    if (move_uploaded_file($_FILES['file-hex']['tmp_name'], $filePath)) {
        $insertData = array(
            'firmware_id' => 'd5d7c1ce53f74b6a8bb9e9264a34102d',
            'path'        => substr($filePath, 2, strlen($filePath))
        );
        $handle = fopen($filePath, "r");
        $contents = fread($handle, filesize($filePath));
        fclose($handle);

        /**
         * Read 3 lines from the top of the file
         * Parse it and prepare data for DB insert
         */
        $headerLines = array_slice(explode("\r\n", $contents), 0, 3);
        foreach ($headerLines as $line) {
            $line = substr($line, 2, strlen($line));
            $parts = explode(' ', $line);
            if (array_key_exists($parts[0], $fieldMapping)) {
                $key = $fieldMapping[$parts[0]];
                unset($parts[0]);
                $insertData[$key] = implode(' ', $parts);
            }
        }
        if ($insertData['firmware_guid'] !== 'x22809AEBC7C140008EE38A4336B443C4') {
            $insertData['firmware_id'] = $insertData['firmware_guid'];
        }
        $fields = array_keys($insertData); // here you have to trust your field names!
        $values = array_values($insertData);
        $fieldList = implode(',', $fields);
        $qs = str_repeat("?,", count($fields) - 1);
        $sql = "INSERT INTO hexes($fieldList) VALUES (${qs}?)";
        $query = $connection->prepare($sql);
        $insertResult = $query->execute($values);
        if ($insertResult) {
            pushResponse("Прошивка успешно добавлена на сервер");
        } else {
            throw new Exception("Не удалось обновить ДБ");
        }
    } else {
        throw new Exception("Не удалось загрузить файл");
    }
} catch (Exception $e) {
    pushResponse($e->getMessage(), true);
}


function pushResponse($text, $isError = false)
{
    header('Content-Type: application/json');
    $response = array(
        'isError' => $isError,
        'text'    => $text
    );
    echo json_encode($response);
    exit;
}

?>