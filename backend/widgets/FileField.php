<?php

namespace backend\widgets;


use common\models\Bean;
use yii\base\Widget;
use yii\bootstrap\ActiveForm;

/**
 * Class FileField
 * @author Artem Kramov
 * @package backend\widgets
 */
class FileField extends ImageField
{

    /**
     * @return string
     */
    public function run()
    {
        return $this->render('file-field/view', [
            'form'          => $this->form,
            'model'         => $this->model,
            'fileAttribute' => $this->fileAttribute,
            'attribute'     => $this->attribute,
        ]);
    }

}