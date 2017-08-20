<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 8/14/2016
 * Time: 4:29 PM
 */

namespace frontend\modules\shop\controllers;


use backend\models\Characteristic;
use backend\models\KitProduct;
use backend\models\Product;
use common\models\Country;
use common\models\PreOrder;
use common\models\Setting;
use common\models\User;
use common\modules\i18n\Module;
use frontend\models\PreOrderForm;
use frontend\models\ProductForm;
use yii\web\Controller;
use Yii;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * Class ProductsController
 * @package frontend\modules\shop\controllers
 */
class ProductsController extends Controller
{

    public function init()
    {
        $this->enableCsrfValidation = false;
        parent::init();
    }

    /**
     * @param $alias
     * @param $previewMode
     * @return string
     */
    public function actionView($alias, $previewMode = false)
    {
        /**
         * @var Product $product
         */
        if (!User::isAdmin()) {
            $previewMode = false;
        }
        $product = Product::getProductByAlias($alias, $previewMode);
        $sizes = $product->getProductSizesDropdown();
        $productForm = new ProductForm();
        $productForm->product = $product->id;
        $productForm->count = 1;
        $settings = Setting::find()->one();

        $product->getClosestCategory();

        $preOrderForm = new PreOrder();
        $preOrderForm->product_id = $product->id;

        return $this->render('view', [
            'product'      => $product,
            'sizes'        => $sizes,
            'productForm'  => $productForm,
            'settings'     => $settings,
            'preOrderForm' => $preOrderForm
        ]);
    }

    /**
     * @return array
     */
    public function actionValidate()
    {
        $model = new ProductForm();
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $errors = ActiveForm::validate($model);
            return $errors;
        }
    }

    /**
     * @param $productID
     * @return string
     */
    public function actionViewSize($productID)
    {
        $this->layout = 'table-size';
        $product = Product::getProductByID($productID);
        $tableSize = $product->table_size;
        if (empty($tableSize)) {
            $setting = Setting::find()->one();
            $tableSize = $setting->table_size;
        }
        return $this->render('table-size', [
            'table'   => $tableSize,
            'product' => $product,
        ]);
    }

    /**
     * Action for the preorder making
     */
    public function actionPreOrder()
    {
        $preOrderForm = new PreOrder();
        if (Yii::$app->request->post() && $preOrderForm->load(Yii::$app->request->post()) && $preOrderForm->validate()) {
            $preOrderForm->save();
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'success' => true,
                'message' => Module::t('Your request is accepted.')
            ];
        }
    }

}