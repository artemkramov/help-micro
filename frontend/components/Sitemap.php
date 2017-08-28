<?php

namespace frontend\components;

use backend\models\Product;
use common\models\Lang;
use common\models\Menu;
use common\models\Post;

/**
 * Class Sitemap
 * @package frontend\components
 */
class Sitemap
{

    const DATE_W3C = 'Y-m-d H:i:s';

    /**
     * @var array
     */
    private $items = [];

    /**
     * @var
     */
    private $languages;

    /**
     * Load items
     */
    public function loadItems()
    {
        /**
         * @var Lang $currentLanguage
         */
        $currentLanguage = Lang::getCurrent();
        $this->languages = Lang::find()->where(
            ['!=', 'id', $currentLanguage->id]
        )
            ->all();
        $post = new Post();
        $groups = $post->loadDataSitemap();
        $products = Product::find()->where([
            'enabled' => Product::STATUS_ENABLED
        ])
            ->all();
        foreach ($products as $product) {
            /**
             * @var Product $product
             */
            $this->addUrl($product->getUrl(), $product->updated_at);
        }

        foreach ($groups['data'] as $group) {
            $this->walkTree($group['items']);
        }
    }

    /**
     * @return string
     */
    public function render()
    {
        $urlStore = [];
        $dom = new \DOMDocument('1.0', 'utf-8');
        $urlset = $dom->createElement('urlset');
        $urlset->setAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');
        foreach ($this->items as $item) {
            $isEmpty = true;
            $url = $dom->createElement('url');
            foreach ($item as $key => $value) {
                if ($key == 'alternate') {
                    foreach ($value as $linkData) {
                        $link = $dom->createElement('link');
                        $link->setAttribute('rel', 'alternate');
                        $link->setAttribute('hreflang', $linkData['hreflang']);
                        $link->setAttribute('href', $linkData['href']);
                        $url->appendChild($link);
                    }

                }
                else {
                    if (!in_array($value, $urlStore) && $key == 'loc') {
                        $isEmpty = false;
                        $urlStore[] = $value;
                    }
                    $elem = $dom->createElement($key);
                    $elem->appendChild($dom->createTextNode($value));
                    $url->appendChild($elem);

                }
            }
            if (!$isEmpty) {
                $urlset->appendChild($url);
            }
        }
        $dom->appendChild($urlset);
        return $dom->saveXML();
    }

    /**
     * @param $url
     * @param int $lastMod
     */
    private function addUrl($url, $lastMod = 0)
    {
        $host = \Yii::$app->request->hostInfo;
        $item = [
            'loc'       => $host . $url,
            'alternate' => [],
        ];
        $segments = explode('/', $url);
        if (count($segments) > 1) {
            foreach ($this->languages as $language) {
                $segments[1] = $language->url;
                $item['alternate'][] = [
                    'hreflang' => $language->url,
                    'href'     => $host . implode('/', $segments)
                ];
            }
        }
        if ($lastMod) {
            $item['lastmod'] = date(self::DATE_W3C, $lastMod);
        }
        $this->items[] = $item;
    }

    /**
     * @param $items
     */
    private function walkTree($items)
    {
        foreach ($items as $item) {
            if ($item['url'] == Menu::EMPTY_LINK) {
                continue;
            }
            $this->addUrl($item['url'], array_key_exists('updated_at', $item) ? $item['updated_at'] : 0);
            if (array_key_exists('children', $item)) {
                $this->walkTree($item['children']);
            }
        }
    }

}