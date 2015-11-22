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
 * Time: 11:28 PM
 */
class IceCreamFloat extends AbstractItem
{
    public $sodaFlavour; // One soda
    public $iceCreamFlavours; // N number of flavours

    /**
     * Constructs an IceCreamFloat.
     *
     * @since 1.0.0
     *
     * @see IceCream
     * @see Soda
     *
     * @param array $iceCreamFlavours {
     *     An array of IceCream::$flavours objects.
     *
     *     @type string Flavours from IceCream::$flavours.
     * }
     * @param string $soda One Soda::$flavours object representing the container this ice cream is in.
     */
    public function __construct($iceCreamFlavours, $soda)
    {
        $this->iceCreamFlavours = $iceCreamFlavours;
        $this->sodaFlavour = $soda;
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
        $numFlavours = 0;
        if (is_array($this->iceCreamFlavours)) {
            $numFlavours = count($this->iceCreamFlavours);
        } else if (!is_null($this->iceCreamFlavours)) {
            $numFlavours = 1;
        }
        return 1 + (1.25 * $numFlavours);
    }
}