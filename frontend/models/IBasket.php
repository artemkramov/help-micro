<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 8/23/2016
 * Time: 12:45 PM
 */

namespace frontend\models;
use yii\web\HttpException;

/**
 * Interface IBasket
 * @package frontend\models
 */
interface IBasket
{

    /**
     * Check if the product is in the user basket
     * @param $hash - unique product hash
     * @return boolean
     */
    public function isProductInBasket($hash);

    /**
     * Add product to the cart
     * @param $hash - unique product hash
     * @param $pid - product ID
     * @param $price - product price
     * @param $characteristicID - product characteristic
     * @param $params - additional product parameters
     * @param $count - count
     * @return array
     * @throws HttpException
     */
    public function insertProduct($hash, $pid, $price, $characteristicID, $params, $count = 1);

    /**
     * Returns the list of products in the cart
     * @return array
     */
    public function getBasketProducts();

    /**
     * Returns the count of unique products
     * @return int
     */
    public function getBasketCount();

    /**
     * Returns the total count of the products
     * @return int
     */
    public function getBasketTotal();

    /**
     * Returns the total sum in the basket
     * @return float
     */
    public function getBasketCost();

}