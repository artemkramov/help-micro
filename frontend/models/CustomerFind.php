<?php

namespace frontend\models;


use yii\base\Model;

/**
 * Class CustomerFind
 * @package frontend\models
 */
class CustomerFind extends Model
{

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $serial;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['serial'], 'required'],
            [['email'], 'email'],
            [['email', 'serial'], 'string']
        ];
    }

}