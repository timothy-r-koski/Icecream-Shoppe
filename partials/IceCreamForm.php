<?php
/**
 * Form for ordering a ice cream.
 *
 * @since 1.0.1
 *
 * Created by PhpStorm.
 * @author Tim K.
 * Date: 11/22/2015
 * Time: 1:52 PM
 */
?>
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