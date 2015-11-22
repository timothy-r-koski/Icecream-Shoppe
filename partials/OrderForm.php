<?php
/**
 * Form for displaying and submitting discounts and current order.
 *
 * Created by PhpStorm.
 * @author Tim K.
 * Date: 11/22/2015
 * Time: 1:59 PM
 */
?>
<h2>Current Order:</h2>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <input type="text" name="discount"> <input type="submit" name="discount-submit" value="Add Discount">
</form>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <?php
    if ($_SESSION["shakeDiscount"] != 1) {
        echo 'All Shakes 15% OFF!<br/>';
    }
    if ($_SESSION["floatDiscount"] != 1) {
        echo 'All Floats 10% OFF!<br/>';
    }
    if (count($_SESSION["order"]) == 0) {
        if ($orderSuccess) {
            echo 'Items Successfully Ordered!';
        } else {
            echo 'No Items';
        }

    } else {
        foreach ($_SESSION["order"] as $item) {
            switch (get_class($item)) {
                case 'IceCreamCone':
                    echo '<b>Ice Cream Cone</b>';
                    foreach ($item->iceCreamFlavours as $flavor) {
                        echo '<br/>';
                        echo '---' . $flavor;
                    }
                    echo '<br/>';
                    echo '---' . $item->container;
                    echo '<br/>';
                    echo '..............................';
                    echo number_format(round($item->getPrice(), 2), 2, '.','');
                    $orderTotal += round($item->getPrice(), 2);
                    break;
                case 'Milkshake':
                    echo '<b>Milkshake</b>';
                    echo '<br/>';
                    echo '---' . $item->iceCreamFlavour;
                    echo '<br/>';
                    echo '---' . $item->milk;
                    echo '<br/>';
                    echo '..............................';
                    echo number_format(round($item->getPrice() * $_SESSION["shakeDiscount"], 2), 2, '.','');
                    $orderTotal += round($item->getPrice() * $_SESSION["shakeDiscount"], 2);
                    break;
                case 'IceCreamFloat':
                    echo '<b>Float</b>';
                    foreach ($item->iceCreamFlavours as $icflavor) {
                        echo '<br/>';
                        echo '---' . $icflavor;
                    }
                    echo '<br/>';
                    echo '---' . $item->sodaFlavour;
                    echo '<br/>';
                    echo '..............................';
                    echo number_format(round($item->getPrice() * $_SESSION["floatDiscount"], 2), 2, '.','');
                    $orderTotal += round($item->getPrice() * $_SESSION["floatDiscount"], 2);
                    break;
            }
            echo '<br/>';
            echo '<br/>';
        }
        echo '<b>Total</b>';
        echo '<br/>';
        echo '..............................';
        echo number_format(round($orderTotal, 2), 2, '.', '');
        echo '<br/><input type="submit" name="order-submit" value="Submit Order">';
    }
    ?>
</form>
