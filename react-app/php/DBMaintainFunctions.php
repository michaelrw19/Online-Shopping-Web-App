<?php

include_once "Models.php";
include_once "selectModels.php";

$shopping = new Shopping();
$truck = new Truck();
$trip = new Trip();
$user = new User();
$item = new Item();
$item_sale = new ItemSale();
$review = new Review();
$payment = new Payment();
$order = new Order();
$purhased_item = new PurchasedItem();

$shoppingList = selectShopping(); 
$truckList = selectTruck(); 
$tripList = selectTrip(); 
$userList = selectUser();
$itemList = selectItem();
$item_saleList = selectItemSale();
$reviewList = selectReview();
$paymentList = selectPayment();
$orderList = selectOrder();
$purchased_itemList = selectPurchasedItem();

$shoppingTitle = "Shopping Table"; 
$truckTitle = "Truck Table"; 
$tripTitle = "Trip Table"; 
$userTitle = "User Table";
$itemTitle = "Item Table";
$item_saleTitle = "Item Sale Table"; 
$reviewTitle = "Review Table";
$paymentTitle = "Payment Table";
$orderTitle = "Order Table";
$purchased_itemTitle = "Purchased Item Table"; 

function getObjectList($id) {
    return $GLOBALS[$id."List"];
}

/**
 * Create a table inside a div with id=$id. This method is specific for selectPage.php because this div have "display=none" property
 */
function createSelectHTMLTable($id) {
    $column = "";
    $table = $GLOBALS[$id."List"];
    $title = $GLOBALS[$id."Title"];
    if(empty($table)) {
        $column = $GLOBALS[$id];
    }
    else {
        $column = $table[array_key_first($table)];
    }
    print("<div id='$id' class='table' style='display: none'><h4 class='table'>$title</h4><table>");
    print($column->printColumn());
    foreach($table as $row) {
        print($row->printRow());
    }
    print("</table></div>");
}

/**
 * Create a table inside a div with id=$id.
 */
function createHTMLTable($id) {
    $column = "";
    $table = $GLOBALS[$id."List"];
    $title = $GLOBALS[$id."Title"];
    if(empty($table)) {
        $column = $GLOBALS[$id];
    }
    else {
        $column = $table[array_key_first($table)];
    }
    print("<div id='$id' class='table'><h2 class='table'>$title</h2><table>");
    print($column->printColumn());
    foreach($table as $row) {
        print($row->printRow());
    }
    print("</table></div>");
}

/**
 * Return html code of createHTMLTable without "display=none" property in a string variable
 */
function getHTMLTable($id) {
    $column = "";
    $table = $GLOBALS[$id."List"];
    $title = $GLOBALS[$id."Title"];
    if(empty($table)) {
        $column = $GLOBALS[$id];
    }
    else {
        $column = $table[array_key_first($table)];
    }
    $str = "";
    $str = $str."<div id='$id' class='table'><h2 class='table'>$title</h2><table>".$column->printColumn();
    foreach($table as $row) {
        $str = $str.$row->printRow();
    }
    $str = $str."</table></div>";

    return $str;
}

/*
function getHTMLForm($id) {
    $shoppingForm = "
    <form action='insertPage.php' method='POST'>
        <label for='store_code'>store_code: </label>
        <input type='number' name='store_code' min='0' max='99999' required>
        <label for='total_price'>total_price: </label>
        <input type='number' name='total_price' min='0.01' max='9999.99' step='0.01' required>
        <input type='submit'>
    </form>";
    $varName = $id."Form";
    return $$varName;
}
*/
?>
