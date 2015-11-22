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
 * Time: 11:25 PM
 */
class IceCreamCone extends AbstractItem
{
    public $iceCreamFlavours; //Up to 2 flavours
    public $container; //One container

    /**
     * Constructs an IceCreamConeObject.
     *
     * @since 1.0.0
     *
     * @see IceCream
     * @see Container
     *
     * @param array $flavours {
     *     An array of IceCream::$flavours objects.
     *
     *     @type string Flavours from IceCream::$flavours.
     * }
     * @param string $container One Container::$types object representing the container this ice cream is in.
     */
    public function __construct($flavours, $container){
        $this->iceCreamFlavours = $flavours;
        $this->container = $container;
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
    function getPrice() {
        $numFlavours = 0;
        if(is_array($this->iceCreamFlavours)){
            $numFlavours = count($this->iceCreamFlavours);
        } else if (!is_null($this->iceCreamFlavours)) {
            $numFlavours = 1;
        }
        return 1.25 * $numFlavours;
    }
}