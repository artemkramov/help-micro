<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 9/6/2016
 * Time: 6:19 PM
 */

namespace frontend\modules\website\controllers;


use common\models\Magazine;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Class MagazineController
 * @package frontend\modules\website\controllers
 */
class MagazineController extends Controller
{

    /**
     * @param $magazineID
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($magazineID)
    {
        $getData = \Yii::$app->request->get();
        $page = array_key_exists('page', $getData) ? $getData['page'] : 1;
        $this->layout = 'magazine';
        $magazine = Magazine::findOne($magazineID);
        if (empty($magazine)) {
            throw new NotFoundHttpException();
        }
        return $this->render('view', [
            'magazine' => $magazine,
            'page'     => $page,
        ]);
    }

}