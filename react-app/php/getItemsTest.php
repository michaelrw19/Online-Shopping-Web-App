<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");

include_once "submitQuery.php";
$query = "SELECT item_name, item_price FROM itemTable";
$items = submitSelectQuery($query);
for ($i = 0; $i <= count($items) - 1; $i++) {
    $item = $items[$i];
    $name = $item['item_name'];
    $price = $item['item_price'];

    if ($i % 3 == 0 and $i <> 0) {
        echo '<div class="row mt-4">';
    }
    echo '<div class="col">';
    echo '<div class="card">';
    echo '<img id="' . $i . '" src="../static/img/shirt.jpg" draggable="true" ondragstart="drag(event)">';
    echo '<hr>';
    echo '<div class="card_container">';
    echo '<p id="item_' . $i . '" class="shopping_item">' . $name . '</p>';
    echo '<p id="price_' . $i . '">' . $price . '</p>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    if ($i % 3 == 2 and $i <> 0) {
        echo '</div>';
    }
}
?>
