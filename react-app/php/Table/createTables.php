<!--Jenny Su 500962385
    Tiffany Tran 500886609
    Kevin Tran 500967982
    Michael Widianto 501033366
-->

<?php
include_once "../dbConnection.php";

$shoppingTable = "CREATE TABLE shoppingTable ( 
    receipt_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    store_code INT NOT NULL,
    total_price DECIMAL(6,2) NOT NULL
    /* DECIMAL(4,2) -> 0000.00 */
)";

if ($connect->query($shoppingTable) === TRUE) {
    echo "Shopping Table created successfully <br>";
} else {
    echo "Error creating Shopping Table: " . $connect->error . "<br>";
}

$truckTable = "CREATE TABLE truckTable ( 
    truck_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    truck_code INT NOT NULL UNIQUE,
    availability_code BOOLEAN NOT NULL
    /* 0 = false, 1 = true */
)";

if ($connect->query($truckTable) === TRUE) {
    echo "Truck Table created successfully <br>";
} else {
    echo "Error creating Truck Table: " . $connect->error."<br>";
}

$tripTable = "CREATE TABLE tripTable ( 
    trip_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    source_code VARCHAR(6) NOT NULL,
    destination_code VARCHAR(6) NOT NULL,
    distance DECIMAL(5, 2) NOT NULL,
    truck_id INT(6) UNSIGNED,
    price DECIMAL(6, 2) NOT NULL,
    FOREIGN KEY (truck_id) REFERENCES truckTable(truck_id)
    /* For source_code and destination_code, im assuming its like postal code, so i set the char to 6 */
)";

if ($connect->query($tripTable) === TRUE) {
    echo "Trip Table created successfully <br>";
} else {
    echo "Error creating Trip Table: " . $connect->error . "<br>";
}

$userTable = "CREATE TABLE userTable(
    user_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(50) NOT NULL,
    telephone VARCHAR(10) NOT NULL UNIQUE,
    email VARCHAR(50) NOT NULL UNIQUE,
    home_address VARCHAR(50) NOT NULL,
    city_code VARCHAR(3),
    login_id VARCHAR(50) NOT NULL UNIQUE,
    salt VARCHAR(16) NOT NULL,
    user_password VARCHAR(32) NOT NULL,
    balance DECIMAL(11, 2)
    /* For city_code, im assuming its area code like 416 647 437*/
)";

if ($connect->query($userTable) === TRUE) {
    echo "User Table created successfully <br>";
} else {
    echo "Error creating User Table: " . $connect->error . "<br>";
}

$itemTable = "CREATE TABLE itemTable ( 
    item_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    item_name VARCHAR(30) NOT NULL UNIQUE,
    item_price DECIMAL(6, 2) NOT NULL,
    made_in VARCHAR(30) NOT NULL,
    department_code VARCHAR(10) NOT NULL,
    image_name VARCHAR(50) NOT NULL
)";

if ($connect->query($itemTable) === TRUE) {
    echo "Item Table created successfully <br>";
} else {
    echo "Error creating Item Table: " . $connect->error . "<br>";
}

$itemSaleTable = "CREATE TABLE itemSaleTable ( 
    item_sale_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    item_id INT(6) UNSIGNED,
    sale_price DECIMAL(6, 2) NOT NULL,
    expiry_time DATE NOT NULL,
    FOREIGN KEY (item_id) REFERENCES itemTable(item_id)
)";

if ($connect->query($itemSaleTable) === TRUE) {
    echo "Item Sale Table created successfully <br>";
} else {
    echo "Error creating Item Sale Table: " . $connect->error . "<br>";
}

$reviewTable = "CREATE TABLE reviewTable (
    review_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    item_id INT(6) UNSIGNED,
    user_id INT(6) UNSIGNED,
    RN INT(1) NOT NULL,
    review VARCHAR(250),
    FOREIGN KEY (item_id) REFERENCES itemTable(item_id),
    FOREIGN KEY (user_id) REFERENCES userTable(user_id)
)";

if ($connect->query($reviewTable) === TRUE) {
    echo "Review Table created successfully <br>";
} else {
    echo "Error creating Item Table: " . $connect->error . "<br>";
}

$paymentTable = "CREATE TABLE paymentTable (
    payment_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT(6) UNSIGNED,
    cardholder_name VARCHAR(50),
    card_number VARCHAR(16) NOT NULL,
    expiration_date DATE NOT NULL,
    cvv_code VARCHAR(3) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES userTable(user_id)
)";

if ($connect->query($paymentTable) === TRUE) {
    echo "Payment Table created successfully <br>";
} else {
    echo "Error creating Item Table: " . $connect->error . "<br>";
}

/**
 * UPDATE FOR ITER III:
 *  - payment_id column removed, replaced by a refernece to paymentTable
 */
$orderTable = "CREATE TABLE orderTable ( 
    order_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    date_issued DATE NOT NULL,
    date_received DATE NOT NULL,
    total_price DECIMAL(6, 2) NOT NULL,
    payment_id INT(6) UNSIGNED,
    user_id INT(6) UNSIGNED,
    trip_id INT(6) UNSIGNED,
    receipt_id INT(6) UNSIGNED,
    FOREIGN KEY (payment_id) REFERENCES paymentTable(payment_id),
    FOREIGN KEY (user_id) REFERENCES userTable(user_id),
    FOREIGN KEY (trip_id) REFERENCES tripTable(trip_id),
    FOREIGN KEY (receipt_id) REFERENCES shoppingTable(receipt_id)
    /* Date format: YYYY-MM-DD */
)";

if ($connect->query($orderTable) === TRUE) {
    echo "Order Table created successfully <br>";
} else {
    echo "Error creating Order Table: " . $connect->error . "<br>";
}

$purchasedItemTable = "CREATE TABLE purchasedItemTable (
    purchased_item_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    item_id INT(6) UNSIGNED,
    user_id INT(6) UNSIGNED,
    order_id INT(6) UNSIGNED,
    FOREIGN KEY (item_id) REFERENCES itemTable(item_id),
    FOREIGN KEY (user_id) REFERENCES userTable(user_id),
    FOREIGN KEY (order_id) REFERENCES orderTable(order_id)
)";

if ($connect->query($purchasedItemTable) === TRUE) {
    echo "Purchased Item Table created successfully <br>";
} else {
    echo "Error creating Purchased Item Table: " . $connect->error . "<br>";
}

$connect->close();
?> 

