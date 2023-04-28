<!--Jenny Su 500962385
    Tiffany Tran 500886609
    Kevin Tran 500967982
    Michael Widianto 501033366
-->

<?php
include_once "../dbConnection.php";
$sql = "DROP TABLE purchasedItemTable, orderTable, paymentTable, reviewTable, itemSaleTable, itemTable, userTable, tripTable, truckTable, shoppingTable";

if ($connect->query($sql) === TRUE) {
    echo "All table dropped successfully";
} else {
    echo "Error dropping table: " . $connect->error;
}
$connect->close();
?> 