# Ice Cream Shoppe #
This project was created as a fun challenge from [Blue Accorn](http://www.blueacorn.com/).

This is by no means a finished website. This is just a skills test for OOP in PHP. Although all the buttons are functional 
security, performance, form validation, and styling are minimal. Consider this a proof of concept.

The main app is located in the index.php file. When the site loads up you'll see 4 sections on the page. Each section is a 
separate form (Current Order section has 2 forms, one for submitting the order and one for discounts) so clicking the submit 
button will only take into account the info in that section.

##Ice Cream:##
This section is used for ordering an ice cream cone.
User MUST select at least 1 ice cream and 1 container. If 'Ice Cream Flavour 1' or 'Cone/Container:' are left at default
the ice cream will not be added to the order.

##Shake:##
This section is used for ordering an ice cream cone.
User MUST select at least 1 ice cream and 1 milk. If 'Ice Cream Flavour' or 'Milk:' are left at default
the shake will not be added to the order.

##Float:##
This section is used for ordering an ice cream cone.
User MUST select at least 1 soda. If 'Soda' is left at default the float will not be added to the order.

##Current Order:##
This section will display the current order and any discounts being applied.

###Add Discount###
Here you can add a discount to either shakes or floats. This discount will be applied to all items of that type for the
current order. One or both discounts can be applied to the order.

Discount for shakes: BASHAKE
Discount for floats: BAFLOAT

###Submit Order###
Clicking 'Submit Order' will clear the current order and any discounts. 
