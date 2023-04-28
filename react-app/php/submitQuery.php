<?php
    include_once "dbConnection.php";
    function submitQuery($query) {
        global $connect; //from "dbConnection.php"
        try {
            $connect->query($query);
            return 1;
        }
        catch (Exception $e) {
            echo $e->getMessage();
            return 0;
        }
    }
    
    function submitSelectQuery($query) {
        global $connect; //from "dbConnection.php"
        $records = array();

        $result = mysqli_query($connect, $query);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($records, $row);
            }
        }         
        return $records;
    }
?>
