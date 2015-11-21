<?php
include_once 'AbstractItem.php';
/**
 * Representation of an ice cream cone item to be ordered.
 *
 * @since 1.0.0
 *
 * Created by PhpStorm.
 * @author Tim K.
 * Date: 11/17/2015
 * Time: 11:27 PM
 */
class Milkshake extends AbstractItem
{
    public $iceCreamFlavour; //One flavour
    public $milk; //One milk

    /**
     * Constructs an Milkshake.
     *
     * @since 1.0.0
     *
     * @see IceCream
     * @see Milk
     *
     * @param array $iceCreamFlavour {
     *     An array of IceCream::$flavours objects.
     *
     *     @type string Flavours from IceCream::$flavours.
     * }
     * @param string $milkType One Milk::$types object representing the container this ice cream is in.
     */
    public function __construct($iceCreamFlavour, $milkType)
    {
        $this->iceCreamFlavour = $iceCreamFlavour;
        $this->milk = $milkType;
    }

    /**
     * Returns the price for this IceCreamCone object.
     *
     * @since 1.0.0
     *
     * @see AbstractItem
     *
     * @return int Price of this ice cream cone
     */
    function getPrice()
    {
        return 2.25;
    }
}