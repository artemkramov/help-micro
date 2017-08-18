<?php

namespace frontend\widgets;

use common\models\Menu;
use yii\base\Widget;
use yii\helpers\Html;


/**
 * Class SitemapTreeWidget
 * @package frontend\widgets
 */
class SitemapTreeWidget extends Widget
{

    /**
     * @var array
     */
    public $tree;

    /**
     * @var string
     */
    public $fieldName;

    /**
     * @var string
     */
    public $titleField = 'title';

    /**
     * @return string
     */
    public function run()
    {
        return $this->buildHTML($this->tree);
    }

    /**
     * @param $items
     * @param int $level
     * @return string
     */
    private function buildHTML($items, $level = 0)
    {
        $html = ($level == 0) ? Html::hiddenInput($this->fieldName, '') : '';
        $listTag = ($level == 0) ? 'ul' : 'ol';
        $html .= Html::beginTag($listTag, [
            'class' => ($level == 0) ? 'auto-checkboxes' : ''
        ]);
        foreach ($items as $item) {
            if ($item['url'] == Menu::EMPTY_LINK)
                continue;
            $childHtml = Html::beginTag('li');
            $childHtml .= Html::a($item[$this->titleField], $item['url']);
            if (array_key_exists('children', $item)) {
                $childHtml .= $this->buildHTML($item['children'], ++$level);
            }
            $childHtml .= Html::endTag('li');
            $html .= $childHtml;
        }
        $html .= Html::endTag($listTag);
        return $html;
    }

}