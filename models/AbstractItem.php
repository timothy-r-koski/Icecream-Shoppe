<?php

/**
 * Abstract representation of order-able objects
 *
 * Created by PhpStorm.
 * @author Tim K.
 * Date: 11/19/2015
 * Time: 8:58 PM
 */
abstract class AbstractItem
{
    /**
     * Returns the price for this IceCreamCone object.
     *
     * @since 1.0.0
     */
    abstract function getPrice();
}