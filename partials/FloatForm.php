<?php
/**
 * Form for ordering a float.
 *
 * Created by PhpStorm.
 * @author Tim K.
 * Date: 11/22/2015
 * Time: 1:58 PM
 */
?>
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
