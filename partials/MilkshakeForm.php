<?php
/**
 * Form for ordering a milkshake.
 *
 * @since 1.0.1
 *
 * Created by PhpStorm.
 * @author Tim K.
 * Date: 11/22/2015
 * Time: 1:55 PM
 */
?>
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
