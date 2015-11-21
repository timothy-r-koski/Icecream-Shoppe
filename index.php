<?php
include 'IceCream.php';
include 'Container.php';
include 'Milk.php';
include 'Soda.php';
include 'IceCreamCone.php';
include 'IceCreamFloat.php';
include 'Milkshake.php';
/**
 * Main app/page for Ice Cream Shoppe
 *
 * @since 1.0.0
 *
 * Created by PhpStorm.
 * @author Tim K.
 * Date: 11/17/2015
 * Time: 11:05 PM
 */
session_start();
if (!isset($_SESSION)) {
    $_SESSION["order"] = array();
    $_SESSION["shakeDiscount"] = 1;
    $_SESSION["floatDiscount"] = 1;
}

$items = array("Ice Cream", "Milkshake", "Float");
$orderTotal = 0;
$dropdownDefault = '-----------------';
$orderSuccess = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect ice cream inputs
    if (!empty($_POST['iceCream-submit'])) {
        $icflavor1 = $_REQUEST['IceCreamScoop1'];
        $icflavor2 = $_REQUEST['IceCreamScoop2'];
        $iccontainer = $_REQUEST['Container'];
        if (strcmp($icflavor1, '') !== 0 && strcmp($iccontainer, '') !== 0) {
            $scoops;
            if (strcmp($icflavor2, '') !== 0) {
                $scoops = array(IceCream::$flavours[$icflavor1], IceCream::$flavours[$icflavor2]);
            } else {
                $scoops = array(IceCream::$flavours[$icflavor1]);
            }

            $iceCream = new IceCreamCone($scoops, Container::$types[$iccontainer]);
            $_SESSION["order"][] = $iceCream;
        }
    }
    // collect milkshake inputs
    if (!empty($_POST['milkshake-submit'])) {
        $icflavor = $_REQUEST['ShakeFlavour'];
        $milk = $_REQUEST['Milk'];
        if (strcmp($icflavor, '') !== 0 && strcmp($milk, '') !== 0) {
            $shake = new Milkshake(IceCream::$flavours[$icflavor], Milk::$types[$milk]);
            $_SESSION["order"][] = $shake;
        }
    }
    // collect float inputs
    if (!empty($_POST['iceCreamFloat-submit'])) {
        $scoops = array();
        $soda = Soda::$flavours[$_REQUEST['Soda']];
        for ($icflavors = 0; $icflavors < count(IceCream::$flavours); $icflavors++) {
            for ($numScoops = 0; $numScoops < $_REQUEST['Scoop' . $icflavors]; $numScoops++) {
                array_push($scoops, IceCream::$flavours[$icflavors]);
            }
        }
        $icFloat = new IceCreamFloat($scoops, $soda);
        $_SESSION["order"][] = $icFloat;
    }
    // collect discounts inputs
    if (!empty($_POST['discount-submit'])) {
        $discountCode = $_REQUEST['discount'];
        if (strcmp($discountCode, 'BASHAKE') == 0) {
            $_SESSION["shakeDiscount"] = .85;
        }
        if (strcmp($discountCode, 'BAFLOAT') == 0) {
            $_SESSION["floatDiscount"] = .90;
        }
    }
    //Submit order (doesn't really do anything right now)
    if (!empty($_POST['order-submit'])) {
        session_unset();
        $_SESSION["order"] = array();
        $_SESSION["shakeDiscount"] = 1;
        $_SESSION["floatDiscount"] = 1;
        $orderSuccess = true;
    }
}

?>
<html>
<head>
    <title>Tim's Ice Cream Shoppe</title>
</head>
<body>
<h1>Tim's Ice Cream Shoppe</h1>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <h2>Ice Cream</h2>
    Ice Cream Flavour 1:
    <select name="IceCreamScoop1">
        <option value=""><?php echo $dropdownDefault; ?></option>
        <?php
        foreach (IceCream::$flavours as $key => $value):
            echo '<option value="' . $key . '">' . $value . '</option>';
        endforeach;
        ?>
    </select>
    <br/>
    Ice Cream Flavour 2:
    <select name="IceCreamScoop2">
        <option value=""><?php echo $dropdownDefault; ?></option>
        <?php
        foreach (IceCream::$flavours as $key => $value):
            echo '<option value="' . $key . '">' . $value . '</option>';
        endforeach;
        ?>
    </select>
    <br/>
    Cone/Container:
    <select name="Container">
        <option value=""><?php echo $dropdownDefault; ?></option>
        <?php
        foreach (Container::$types as $key => $value):
            echo '<option value="' . $key . '">' . $value . '</option>';
        endforeach;
        ?>
    </select>
    <br/>
    <br/>
    <input type="submit" name="iceCream-submit" value="Add to Order"/>
    <br/>
</form>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <h2>Shake</h2>
    Ice Cream Flavour:
    <select name="ShakeFlavour">
        <option value=""><?php echo $dropdownDefault; ?></option>
        <?php
        foreach (IceCream::$flavours as $key => $value):
            echo '<option value="' . $key . '">' . $value . '</option>';
        endforeach;
        ?>
    </select>
    <br/>
    Milk:
    <select name="Milk">
        <option value=""><?php echo $dropdownDefault; ?></option>
        <?php
        foreach (Milk::$types as $key => $value):
            echo '<option value="' . $key . '">' . $value . '</option>';
        endforeach;
        ?>
    </select>
    <br/>
    <br/>
    <input type="submit" name="milkshake-submit" value="Add to Order">
    <br/>
</form>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <h2>Float</h2>
    Ice Cream Flavour(s):
    <br/>
    <?php
    foreach (IceCream::$flavours as $key => $value):
        echo $value . ':  <input id="' . $key . '" name="Scoop' . $key . '" type="number" value="0"/><br/>';
    endforeach;
    ?>
    <br/>
    Soda:
    <select name="Soda">
        <option value=""><?php echo $dropdownDefault; ?></option>
        <?php
        foreach (Soda::$flavours as $key => $value):
            echo '<option value="' . $key . '">' . $value . '</option>';
        endforeach;
        ?>
    </select>
    <br/>
    <br/>
    <input type="submit" name="iceCreamFloat-submit" value="Add to Order">
</form>

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
</body>
</html>


