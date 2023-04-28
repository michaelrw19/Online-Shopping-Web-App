<?php

include_once "submitQuery.php";

interface Database
{
    /**
     * Can be called if the object is made from user input (id == null). No effect if called by object that is made from database (id != null).
     */
    public function insert();
    /**
     * Can be called if the object is made from database (id != null). No effect if called by object that is made from user input (id == null).
     */
    public function update();
    /**
     * Can be called if the object is made from database (id != null). No effect if called by object that is made from user input (id == null).
     */
    public function delete();
}

class Table {
    /**
     * Return a string of HTML code for row of properties name (column name)
     */
    public function printColumn() {
        $str = "<tr>";
        foreach ($this as $key => $value) {
            $str = $str."<th>$key</th>";
        }
        return $str."</tr>";
    }

    /**
     * Return a string of HTML code for row of properties values 
     */
    public function printRow() {
        $str = "<tr>";
        foreach ($this as $key => $value) {
            $str = $str."<th>$value</th>";
        }
        return $str."</tr>";
    }
}

class Shopping extends Table implements Database
{
    public $receipt_id;
    public $store_code;
    public $total_price;

    /**
     * Enter 2 parameter ($store_code, $total_price) for creating the object from user input.
     * Enter 3 parameter ($receipt_id, $store_code, $total_price) for creating the object from database.
     */
    public function __construct()
    {
        $arguments = func_get_args();
        $numberOfArguments = func_num_args();

        if (method_exists($this, $function = '__construct' . $numberOfArguments)) {
            call_user_func_array(array($this, $function), $arguments);
        }
    }

    public function __construct2($store_code, $total_price)
    {
        $this->store_code = $store_code;
        $this->total_price = $total_price;
    }

    public function __construct3($receipt_id, $store_code, $total_price)
    {
        $this->receipt_id = $receipt_id;
        $this->store_code = $store_code;
        $this->total_price = $total_price;
    }

    public function insert()
    {
        if ($this->receipt_id == null) {
            $insertShopping = "INSERT INTO shoppingTable (store_code, total_price) VALUES ($this->store_code, $this->total_price)";
            return submitQuery($insertShopping);
        }
    }

    public function update()
    {
        if ($this->receipt_id != null) {
            $updateShopping = "UPDATE shoppingTable SET store_code=$this->store_code, total_price=$this->total_price WHERE receipt_id=$this->receipt_id";
            return submitQuery($updateShopping);
        }
    }

    public function delete()
    {
        if ($this->receipt_id != null) {
            $deleteShopping = "DELETE FROM shoppingTable WHERE receipt_id=$this->receipt_id";
            return submitQuery($deleteShopping);
        }
    }

    public function getReceipt_id()
    {
        return $this->receipt_id;
    }

    public function getStore_code()
    {
        return $this->store_code;
    }

    public function setStore_code($store_code)
    {
        $this->store_code = $store_code;
    }

    public function getTotal_price()
    {
        return $this->total_price;
    }

    public function setTotal_price($total_price)
    {
        $this->total_price = $total_price;
    }
}

class Truck extends Table implements Database
{
    public $truck_id;
    public $truck_code;
    public $availability_code;

    /**
     * Enter 2 parameter ($truck_code, $availability_code) for creating the object from user input.
     * Enter 3 parameter ($truck_id, $truck_code, $availability_code) for creating the object from database.
     */
    public function __construct()
    {
        $arguments = func_get_args();
        $numberOfArguments = func_num_args();

        if (method_exists($this, $function = '__construct' . $numberOfArguments)) {
            call_user_func_array(array($this, $function), $arguments);
        }
    }

    public function __construct2($truck_code, $availability_code)
    {
        $this->truck_code = $truck_code;
        $this->availability_code = $availability_code;
    }

    public function __construct3($truck_id, $truck_code, $availability_code)
    {
        $this->truck_id = $truck_id;
        $this->truck_code = $truck_code;
        $this->availability_code = $availability_code;
    }

    public function insert()
    {
        if ($this->truck_id == null) {
            $insertTruck = "INSERT INTO truckTable (truck_code, availability_code) VALUES ($this->truck_code, $this->availability_code)";
            return submitQuery($insertTruck);
        }
    }

    public function update()
    {
        if ($this->truck_id != null) {
            $updateTruck = "UPDATE truckTable SET truck_code=$this->truck_code, availability_code=$this->availability_code WHERE truck_id=$this->truck_id";
            return submitQuery($updateTruck);
        }
    }

    public function delete()
    {
        if ($this->truck_id != null) {
            $deleteTruck = "DELETE FROM truckTable WHERE truck_id=$this->truck_id";
            return submitQuery($deleteTruck);
        }
    }

    public function getTruck_id()
    {
        return $this->truck_id;
    }

    public function getTruck_code()
    {
        return $this->truck_code;
    }

    public function setTruck_code($truck_code)
    {
        $this->truck_code = $truck_code;
    }

    public function getAvailability_code()
    {
        return $this->availability_code;
    }

    public function setAvailability_code($availability_code)
    {
        $this->availability_code = $availability_code;
    }
}

class Trip extends Table implements Database
{
    public $trip_id;
    public $source_code;
    public $destination_code;
    public $distance;
    public $truck_id;
    public $price;

    /**
     * Enter 5 parameter ($source_code, $destination_code, $distance, $truck_id, $price) for creating the object from user input.
     * Enter 6 parameter ($trip_id, $source_code, $destination_code, $distance, $truck_id, $price) for creating the object from database.
     */
    public function __construct()
    {
        $arguments = func_get_args();
        $numberOfArguments = func_num_args();

        if (method_exists($this, $function = '__construct' . $numberOfArguments)) {
            call_user_func_array(array($this, $function), $arguments);
        }
    }

    public function __construct5($source_code, $destination_code, $distance, $truck_id, $price)
    {
        $this->source_code = $source_code;
        $this->destination_code = $destination_code;
        $this->distance = $distance;
        $this->truck_id = $truck_id;
        $this->price = $price;
    }

    public function __construct6($trip_id, $source_code, $destination_code, $distance, $truck_id, $price)
    {
        $this->trip_id = $trip_id;
        $this->source_code = $source_code;
        $this->destination_code = $destination_code;
        $this->distance = $distance;
        $this->truck_id = $truck_id;
        $this->price = $price;
    }

    public function insert()
    {
        if ($this->trip_id == null) {
            $insertTrip = "INSERT INTO tripTable (source_code, destination_code, distance, truck_id, price) VALUES ('$this->source_code', '$this->destination_code', $this->distance, $this->truck_id, $this->price)";
            return submitQuery($insertTrip);
        }
    }

    public function update()
    {
        if ($this->trip_id != null) {
            $updateTrip = "UPDATE tripTable SET source_code='$this->source_code', destination_code='$this->destination_code', distance=$this->distance, truck_id=$this->truck_id, price=$this->price WHERE trip_id=$this->trip_id";
            return submitQuery($updateTrip);
        }
    }

    public function delete()
    {
        if ($this->trip_id != null) {
            $deleteTrip = "DELETE FROM tripTable WHERE trip_id=$this->trip_id";
            return submitQuery($deleteTrip);
        }
    }

    public function getTrip_id()
    {
        return $this->trip_id;
    }

    public function getSource_code()
    {
        return $this->source_code;
    }
    public function setSource_code($source_code)
    {
        $this->source_code = $source_code;
    }

    public function getDestination_code()
    {
        return $this->destination_code;
    }
    public function setDestination_code($destination_code)
    {
        $this->destination_code = $destination_code;
    }

    public function getDistance()
    {
        return $this->distance;
    }
    public function setDistance($distance)
    {
        $this->distance = $distance;
    }

    public function getTruck_id()
    {
        return $this->truck_id;
    }
    public function setTruck_id($truck_id)
    {
        $this->truck_id = $truck_id;
    }

    public function getPrice()
    {
        return $this->price;
    }
    public function setPrice($price)
    {
        $this->price = $price;
    }
}

class User extends Table implements Database
{
    public $user_id;
    public $full_name;
    public $telephone;
    public $email;
    public $home_address;
    public $city_code;
    public $login_id;
    public $salt;
    public $user_password;
    public $balance;

    /**
     * Enter 9 parameter ($full_name, $telephone, $email, $home_address, $city_code, $login_id, $user_password, $balance) for creating the object from user input.
     * Enter 10 parameter ($user_id, $full_name, $telephone, $email, $home_address, $city_code, $login_id, $user_password, $balance) for creating the object from database.
     */
    public function __construct()
    {
        $arguments = func_get_args();
        $numberOfArguments = func_num_args();

        if (method_exists($this, $function = '__construct' . $numberOfArguments)) {
            call_user_func_array(array($this, $function), $arguments);
        }
    }

    public function __construct9($full_name, $telephone, $email, $home_address, $city_code, $login_id, $salt, $user_password, $balance)
    {
        $this->full_name = $full_name;
        $this->telephone = $telephone;
        $this->email = $email;
        $this->home_address = $home_address;
        $this->city_code = $city_code;
        $this->login_id = $login_id;
        $this->salt = $salt;
        $this->user_password = $user_password;
        $this->balance = $balance;
    }

    public function __construct10($user_id, $full_name, $telephone, $email, $home_address, $city_code, $login_id, $salt, $user_password, $balance)
    {
        $this->user_id = $user_id;
        $this->full_name = $full_name;
        $this->telephone = $telephone;
        $this->email = $email;
        $this->home_address = $home_address;
        $this->city_code = $city_code;
        $this->login_id = $login_id;
        $this->salt = $salt;
        $this->user_password = $user_password;
        $this->balance = $balance;
    }

    public function insert()
    {
        if ($this->user_id == null) {
            $insertUser = "INSERT INTO userTable (full_name, telephone, email, home_address, city_code, login_id, salt, user_password, balance) VALUES ('$this->full_name', '$this->telephone', '$this->email', '$this->home_address', '$this->city_code', '$this->login_id', '$this->salt', '$this->user_password', $this->balance)";
            return submitQuery($insertUser);
        }
    }

    public function update()
    {
        if ($this->user_id != null) {
            $updateUser = "UPDATE userTable SET full_name='$this->full_name', telephone='$this->telephone', email='$this->email', home_address='$this->home_address', city_code='$this->city_code', login_id='$this->login_id', salt='$this->salt', user_password='$this->user_password', balance=$this->balance WHERE user_id=$this->user_id";
            return submitQuery($updateUser);
        }
    }

    public function delete()
    {
        if ($this->user_id != null) {
            $deleteUser = "DELETE FROM userTable WHERE user_id=$this->user_id";
            return submitQuery($deleteUser);
        }
    }

    public function getUser_id()
    {
        return $this->user_id;
    }

    public function getFull_name()
    {
        return $this->full_name;
    }
    public function setFull_name($full_name)
    {
        $this->full_name = $full_name;
    }

    public function getTelephone()
    {
        return $this->telephone;
    }
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }

    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getHome_address()
    {
        return $this->home_address;
    }
    public function setHome_address($home_address)
    {
        $this->home_address = $home_address;
    }

    public function getCity_code()
    {
        return $this->city_code;
    }
    public function setCity_code($city_code)
    {
        $this->city_code = $city_code;
    }

    public function getLogin_id()
    {
        return $this->login_id;
    }
    public function setLogin_id($login_id)
    {
        $this->login_id = $login_id;
    }

    public function getSalt()
    {
        return $this->salt;
    }
    public function setSalt($salt)
    {
        $this->salt = $salt;
    }

    public function getUser_password()
    {
        return $this->user_password;
    }
    public function setUser_password($user_password)
    {
        $this->user_password = $user_password;
    }

    public function getBalance()
    {
        return $this->balance;
    }
    public function setBalance($balance)
    {
        $this->balance = $balance;
    }
}

class Item extends Table implements Database
{
    public $item_id;
    public $item_name;
    public $item_price;
    public $made_in;
    public $department_code;
    public $image_name;

    /**
     * Enter 5 parameter ($item_name, $item_price, $made_in, $department_code, $image_name) for creating the object from user input.
     * Enter 6 parameter ($item_id, $item_name, $item_price, $made_in, $department_code, $image_name) for creating the object from database.
     */
    public function __construct()
    {
        $arguments = func_get_args();
        $numberOfArguments = func_num_args();

        if (method_exists($this, $function = '__construct' . $numberOfArguments)) {
            call_user_func_array(array($this, $function), $arguments);
        }
    }

    public function __construct5($item_name, $item_price, $made_in, $department_code, $image_name)
    {
        $this->item_name = $item_name;
        $this->item_price = $item_price;
        $this->made_in = $made_in;
        $this->department_code = $department_code;
        if(empty($image_name)) {
            $this->image_name = "default.jpg";
        }
        else {
            $this->image_name = $image_name;
        }
    }

    public function __construct6($item_id, $item_name, $item_price, $made_in, $department_code, $image_name)
    {
        $this->item_id = $item_id;
        $this->item_name = $item_name;
        $this->item_price = $item_price;
        $this->made_in = $made_in;
        $this->department_code = $department_code;
        $this->image_name = $image_name;
    }

    public function insert()
    {
        if ($this->item_id == null) {
            $updateItem = "INSERT INTO itemTable (item_name, item_price, made_in, department_code, image_name) VALUES ('$this->item_name', $this->item_price, '$this->made_in', '$this->department_code', '$this->image_name')";
            return submitQuery($updateItem);
        }
    }

    public function update()
    {
        if ($this->item_id != null) {
            $updateItem = "UPDATE itemTable SET item_name='$this->item_name', item_price=$this->item_price, made_in='$this->made_in', department_code='$this->department_code', image_name='$this->image_name' WHERE item_id=$this->item_id";
            return submitQuery($updateItem);
        }
    }

    public function delete()
    {
        if ($this->item_id != null) {
            $deleteItem = "DELETE FROM itemTable WHERE item_id=$this->item_id";
            return submitQuery($deleteItem);
        }
    }

    public function makeSale($item_id, $sale_price, $expiration_date) {
        $addSale = "INSERT INTO itemsaletable (item_id, sale_price, expiry_time) VALUES ($item_id, $sale_price, '$expiration_date')";
        return submitQuery($addSale);
    }

    public function createReview($user_id, $rating, $review) {
        $reviewObj = new Review($this->item_id, $user_id, $rating, $review);
        $reviewObj->insert();
    }

    public function getItem_id()
    {
        return $this->item_id;
    }

    public function getItem_name()
    {
        return $this->item_name;
    }
    public function setItem_name($item_name)
    {
        $this->item_name = $item_name;
    }

    public function getItem_price()
    {
        return $this->item_price;
    }
    public function setItem_price($item_price)
    {
        $this->item_price = $item_price;
    }

    public function getMade_in()
    {
        return $this->made_in;
    }
    public function setMade_in($made_in)
    {
        $this->made_in = $made_in;
    }

    public function getDepartment_code()
    {
        return $this->department_code;
    }
    public function setDepartment_code($department_code)
    {
        $this->department_code = $department_code;
    }

    public function getImage_name()
    {
        return $this->image_name;
    }
    public function setImage_name($image_name)
    {
        $this->image_name = $image_name;
    }
}

class ItemSale extends Table implements Database
{
    public $item_sale_id;
    public $item_id;
    public $sale_price;
    public $expiry_time;

    /**
     * Enter 3 parameter ($item_id, $sale_price, $expiry_time) for creating the object from user input.
     * Enter 4 parameter ($item_sale_id, $item_id, $sale_price, $expiry_time) for creating the object from database.
     */
    public function __construct()
    {
        $arguments = func_get_args();
        $numberOfArguments = func_num_args();

        if (method_exists($this, $function = '__construct' . $numberOfArguments)) {
            call_user_func_array(array($this, $function), $arguments);
        }
    }

    public function __construct3($item_id, $sale_price, $expiry_time)
    {
        $this->item_id = $item_id;
        $this->sale_price = $sale_price;
        $this->expiry_time = $expiry_time;
    }

    public function __construct4($item_sale_id, $item_id, $sale_price, $expiry_time)
    {
        $this->item_sale_id = $item_sale_id;
        $this->item_id = $item_id;
        $this->sale_price = $sale_price;
        $this->expiry_time = $expiry_time;
    }

    public function insert()
    {
        if ($this->item_sale_id == null) {
            $insertItemSale = "INSERT INTO itemSaleTable (item_id, sale_price, expiry_time) VALUES ($this->item_id, $this->sale_price, '$this->expiry_time')";
            return submitQuery($insertItemSale);
        }
    }

    public function update()
    {
        if ($this->item_sale_id != null) {
            $updateItemSale = "UPDATE itemSaleTable SET item_id=$this->item_id, sale_price=$this->sale_price, expiry_time='$this->expiry_time' WHERE item_sale_id=$this->item_sale_id";
            return submitQuery($updateItemSale);
        }
    }

    public function delete()
    {
        if ($this->item_sale_id != null) {
            $deleteItemSale = "DELETE FROM itemSaleTable WHERE item_sale_id=$this->item_sale_id";
            return submitQuery($deleteItemSale);
        }
    }

    public function getItem_sale_id()
    {
        return $this->item_sale_id;
    }

    public function getItem_id()
    {
        return $this->item_id;
    }

    public function setItem_id($item_id)
    {
        $this->item_id = $item_id;
    }

    public function getSale_price()
    {
        return $this->sale_price;
    }

    public function setSale_price($sale_price)
    {
        $this->sale_price = $sale_price;
    }

    public function getExpiry_time()
    {
        return $this->expiry_time;
    }

    public function setExpiry_time($expiry_time)
    {
        $this->expiry_time = $expiry_time;
    }
}

class Review extends Table implements Database
{
    public $review_id;
    public $item_id;
    public $user_id;
    public $RN;
    public $review;

    /**
     * Enter 4 parameter ($item_id, $user_id, $RN, $review) for creating the object from user input.
     * Enter 5 parameter ($review_id, $item_id, $user_id, $RN, $review) for creating the object from database.
     */
    public function __construct()
    {
        $arguments = func_get_args();
        $numberOfArguments = func_num_args();

        if (method_exists($this, $function = '__construct' . $numberOfArguments)) {
            call_user_func_array(array($this, $function), $arguments);
        }
    }

    public function __construct4($item_id, $user_id, $RN, $review)
    {
        $this->item_id = $item_id;
        $this->user_id = $user_id;
        $this->RN = $RN;
        $this->review = $review;
    }

    public function __construct5($review_id, $item_id, $user_id, $RN, $review)
    {
        $this->review_id = $review_id;
        $this->item_id = $item_id;
        $this->user_id = $user_id;
        $this->RN = $RN;
        $this->review = $review;
    }

    public function insert()
    {
        if ($this->review_id == null) {
            $insertReview = "INSERT INTO reviewTable (item_id, user_id, RN, review) VALUES ($this->item_id, $this->user_id, $this->RN, '$this->review')";
            return submitQuery($insertReview);
        }
    }

    public function update()
    {
        if ($this->review_id != null) {
            $updateReview = "UPDATE reviewTable SET item_id=$this->item_id, user_id=$this->user_id, RN=$this->RN, review='$this->review' WHERE review_id=$this->review_id";
            return submitQuery($updateReview);
        }
    }

    public function delete()
    {
        if ($this->review_id != null) {
            $deleteReview = "DELETE FROM reviewTable WHERE review_id=$this->review_id";
            return submitQuery($deleteReview);
        }
    }

    public function getReview_id()
    {
        return $this->review_id;
    }

    public function getItem_id()
    {
        return $this->item_id;
    }

    public function setItem_id($item_id)
    {
        $this->item_id = $item_id;
    }

    public function getUser_id()
    {
        return $this->user_id;
    }

    public function setUser_id($user_id)
    {
        $this->user_id = $user_id;
    }

    public function getRN()
    {
        return $this->RN;
    }

    public function setRN($RN)
    {
        $this->RN = $RN;
    }

    public function getReview()
    {
        return $this->review;
    }

    public function setReview($review)
    {
        $this->review = $review;
    }
}

class Payment extends Table implements Database
{
    public $payment_id;
    public $user_id;
    public $cardholder_name;
    public $card_number;
    public $expiration_date;
    public $cvv_code;

    /**
     * Enter 5 parameter ($user_id, $cardholder_name, $card_number, $expiration_date, $cvv_code) for creating the object from user input.
     * Enter 6 parameter ($payment_id, $user_id, $cardholder_name, $card_number, $expiration_date, $cvv_code) for creating the object from database.
     */
    public function __construct()
    {
        $arguments = func_get_args();
        $numberOfArguments = func_num_args();

        if (method_exists($this, $function = '__construct' . $numberOfArguments)) {
            call_user_func_array(array($this, $function), $arguments);
        }
    }

    public function __construct5($user_id, $cardholder_name, $card_number, $expiration_date, $cvv_code)
    {
        $this->user_id = $user_id;
        $this->cardholder_name = $cardholder_name;
        $this->card_number = $card_number;
        $this->expiration_date = $expiration_date;
        $this->cvv_code = $cvv_code;
    }

    public function __construct6($payment_id, $user_id, $cardholder_name, $card_number, $expiration_date, $cvv_code)
    {
        $this->payment_id = $payment_id;
        $this->user_id = $user_id;
        $this->cardholder_name = $cardholder_name;
        $this->card_number = $card_number;
        $this->expiration_date = $expiration_date;
        $this->cvv_code = $cvv_code;
    }

    public function insert()
    {
        if ($this->payment_id == null) {
            $insertItem = "INSERT INTO paymentTable (user_id, cardholder_name, card_number, expiration_date, cvv_code) VALUES ($this->user_id, '$this->cardholder_name', '$this->card_number', '$this->expiration_date', '$this->cvv_code')";
            return submitQuery($insertItem);
        }
    }

    public function update()
    {
        if ($this->payment_id != null) {
            $updateItem = "UPDATE paymentTable SET user_id=$this->user_id, cardholder_name='$this->cardholder_name', card_number='$this->card_number', expiration_date='$this->expiration_date', cvv_code='$this->cvv_code' WHERE payment_id=$this->payment_id";
            return submitQuery($updateItem);
        }
    }

    public function delete()
    {
        if ($this->payment_id != null) {
            $deleteItem = "DELETE FROM paymentTable WHERE payment_id=$this->payment_id";
            return submitQuery($deleteItem);
        }
    }

    public function getPayment_id()
    {
        return $this->payment_id;
    }

    public function getUser_id()
    {
        return $this->user_id;
    }

    public function setUser_id($user_id)
    {
        $this->user_id = $user_id;
    }

    public function getCardholder_name()
    {
        return $this->cardholder_name;
    }
    public function setCardholder_name($cardholder_name)
    {
        $this->cardholder_name = $cardholder_name;
    }

    public function getCard_number()
    {
        return $this->card_number;
    }
    public function setCard_number($card_number)
    {
        $this->card_number = $card_number;
    }

    public function getExpiration_date()
    {
        return $this->expiration_date;
    }
    public function setExpiration_date($expiration_date)
    {
        $this->expiration_date = $expiration_date;
    }

    public function getCvv_code()
    {
        return $this->cvv_code;
    }
    public function setCvv_code($cvv_code)
    {
        $this->cvv_code = $cvv_code;
    }
}

class Order extends Table implements Database
{
    public $order_id;
    public $date_issued;
    public $date_received;
    public $total_price;
    public $payment_id;
    public $user_id;
    public $trip_id;
    public $receipt_id;

    /**
     * Enter 7 parameter ($date_issued, $date_received, $total_price, $payment_id, $user_id, $trip_id, $receipt_id) for creating the object from user input.
     * Enter 8 parameter ($order_id, $date_issued, $date_received, $total_price, $payment_id, $user_id, $trip_id, $receipt_id) for creating the object from database.
     */
    public function __construct()
    {
        $arguments = func_get_args();
        $numberOfArguments = func_num_args();

        if (method_exists($this, $function = '__construct' . $numberOfArguments)) {
            call_user_func_array(array($this, $function), $arguments);
        }
    }

    public function __construct7($date_issued, $date_received, $total_price, $payment_id, $user_id, $trip_id, $receipt_id)
    {
        $this->date_issued = $date_issued;
        $this->date_received = $date_received;
        $this->total_price = $total_price;
        $this->payment_id = $payment_id;
        $this->user_id = $user_id;
        $this->trip_id = $trip_id;
        $this->receipt_id = $receipt_id;
    }

    public function __construct8($order_id, $date_issued, $date_received, $total_price, $payment_id, $user_id, $trip_id, $receipt_id)
    {
        $this->order_id = $order_id;
        $this->date_issued = $date_issued;
        $this->date_received = $date_received;
        $this->total_price = $total_price;
        $this->payment_id = $payment_id;
        $this->user_id = $user_id;
        $this->trip_id = $trip_id;
        $this->receipt_id = $receipt_id;
    }

    public function insert()
    {
        if ($this->order_id == null) {
            $insertOrder = "INSERT INTO orderTable (date_issued, date_received, total_price, payment_id, user_id, trip_id, receipt_id) VALUES ('$this->date_issued', '$this->date_received', $this->total_price, '$this->payment_id', $this->user_id, $this->trip_id, $this->receipt_id)";
            return submitQuery($insertOrder);
        }
    }

    public function update()
    {
        if ($this->order_id != null) {
            $updateOrder = "UPDATE orderTable SET date_issued='$this->date_issued', date_received='$this->date_received', total_price=$this->total_price, payment_id='$this->payment_id', user_id=$this->user_id, trip_id=$this->trip_id, receipt_id=$this->receipt_id WHERE order_id=$this->order_id";
            return submitQuery($updateOrder);
        }
    }

    public function delete()
    {
        if ($this->order_id != null) {
            $deleteOrder = "DELETE FROM orderTable WHERE order_id=$this->order_id";
            return submitQuery($deleteOrder);
        }
    }

    public function getOrder_id()
    {
        return $this->order_id;
    }

    public function getDate_issued()
    {
        return $this->date_issued;
    }
    public function setDate_issued($date_issued)
    {
        $this->date_issued = $date_issued;
    }

    public function getDate_received()
    {
        return $this->date_received;
    }
    public function setDate_received($date_received)
    {
        $this->date_received = $date_received;
    }

    public function getTotal_price()
    {
        return $this->total_price;
    }
    public function setTotal_price($total_price)
    {
        $this->total_price = $total_price;
    }

    public function getPayment_id()
    {
        return $this->payment_id;
    }
    public function setPayment_id($payment_id)
    {
        $this->payment_id = $payment_id;
    }

    public function getUser_id()
    {
        return $this->user_id;
    }
    public function setUser_id($user_id)
    {
        $this->user_id = $user_id;
    }

    public function getTrip_id()
    {
        return $this->trip_id;
    }
    public function setTrip_id($trip_id)
    {
        $this->trip_id = $trip_id;
    }

    public function getReceipt_id()
    {
        return $this->receipt_id;
    }
    public function setReceipt_id($receipt_id)
    {
        $this->receipt_id = $receipt_id;
    }
}

class PurchasedItem extends Table implements Database 
{
    public $purchased_item_id;
    public $item_id;
    public $user_id;
    public $order_id;

    /**
     * Enter 3 parameter ($item_id, $user_id, $order_id) for creating the object from user input.
     * Enter 4 parameter ($purchased_item_id, $item_id, $user_id, $order_id) for creating the object from database.
     */
    public function __construct()
    {
        $arguments = func_get_args();
        $numberOfArguments = func_num_args();

        if (method_exists($this, $function = '__construct' . $numberOfArguments)) {
            call_user_func_array(array($this, $function), $arguments);
        }
    }

    public function __construct2($item_id, $user_id)
    {
        $this->item_id = $item_id;
        $this->user_id = $user_id;
    }

    public function __construct3($item_id, $user_id, $order_id)
    {
        $this->item_id = $item_id;
        $this->user_id = $user_id;
        $this->order_id = $order_id;
    }

    public function __construct4($purchased_item_id, $item_id, $user_id, $order_id)
    {
        $this->purchased_item_id = $purchased_item_id;
        $this->item_id = $item_id;
        $this->user_id = $user_id;
        $this->order_id = $order_id;
    }


    public function insert()
    {
        if ($this->purchased_item_id == null) {
            if(empty($this->order_id)) {
                $insertPurchasedItem = "INSERT INTO purchasedItemTable (item_id, user_id, order_id) VALUES ($this->item_id, $this->user_id, NULL)";
                return submitQuery($insertPurchasedItem);
            }
            $insertPurchasedItem = "INSERT INTO purchasedItemTable (item_id, user_id, order_id) VALUES ($this->item_id, $this->user_id, $this->order_id)";
            return submitQuery($insertPurchasedItem);
        }
    }

    public function update()
    {
        if ($this->purchased_item_id != null) {
            $updatePurchasedItem = "UPDATE purchasedItemTable SET item_id=$this->item_id, user_id=$this->user_id, order_id=$this->order_id WHERE purchased_item_id=$this->purchased_item_id";
            return submitQuery($updatePurchasedItem);
        }
    }

    public function delete()
    {
        if ($this->purchased_item_id != null) {
            $deletePurchasedItem = "DELETE FROM purchasedItemTable WHERE purchased_item_id=$this->purchased_item_id";
            return submitQuery($deletePurchasedItem);
        }
    }

    public function getPurchased_item_id() 
    {
        return $this->purchased_item_id;
    }

    public function getItem_id()
    {
        return $this->item_id;
    }

    public function setItem_id($item_id)
    {
        $this->item_id = $item_id;
    }

    public function getUser_id()
    {
        return $this->user_id;
    }

    public function setUser_id($user_id)
    {
        $this->user_id = $user_id;
    }

    public function getOrder_id()
    {
        return $this->order_id;
    }

    public function setOrder_id($order_id)
    {
        $this->order_id = $order_id;
    }
}