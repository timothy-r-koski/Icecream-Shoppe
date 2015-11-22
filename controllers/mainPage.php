<?php
include $_SERVER['DOCUMENT_ROOT']."/models/IceCream.php";
include $_SERVER['DOCUMENT_ROOT']."/models/Container.php";
include $_SERVER['DOCUMENT_ROOT']."/models/Milk.php";
include $_SERVER['DOCUMENT_ROOT']."/models/Soda.php";
include $_SERVER['DOCUMENT_ROOT']."/models/IceCreamCone.php";
include $_SERVER['DOCUMENT_ROOT']."/models/IceCreamFloat.php";
include $_SERVER['DOCUMENT_ROOT']."/models/Milkshake.php";
/**
 * Main app/page for Ice Cream Shoppe
 *
 * @since 1.0.1
 *
 * Created by PhpStorm.
 * @author Tim K.
 * Date: 11/22/2015
 * Time: 1:31 PM
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
