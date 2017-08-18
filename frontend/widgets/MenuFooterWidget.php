<?php

namespace frontend\widgets;

use backend\components\SiteHelper;
use backend\models\MenuType;
use common\models\Menu;
use common\modules\i18n\Module;
use yii\base\Widget;
use yii\db\Query;

/**
 * Class MenuFooterWidget
 * @package frontend\widgets
 */
class MenuFooterWidget extends Widget
{


    /**
     * @var string
     */
    private $viewPath;

    /**
     * Init view path
     */
    public function init()
    {
        $this->viewPath = 'menu-footer' . DIRECTORY_SEPARATOR . 'view';
        parent::init();
    }

    /**
     * @return string
     */
    public function run()
    {
        /**
         * @var MenuType $menuTopType
         */
        $menuTopType = MenuType::find()->where([
            'alias' => MenuType::TYPE_FOOTER
        ])->one();
        $menuCollection = Menu::findAllWithTitle(null, $menuTopType->id);
        $menuTree = SiteHelper::buildTreeArrayFromCollection($menuCollection, 'id');

        $menuTreeEnabled = [];
        foreach ($menuTree as $link) {
            if ($link['enabled']) {
                $menuTreeEnabled[] = $link;
            }
        }

        $blocks = [$menuTreeEnabled];


        return $this->render($this->viewPath, [
            'menuBlocks' => $blocks
        ]);
    }

}