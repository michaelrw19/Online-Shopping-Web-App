<?php
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: *");

    include_once "browserDetection.php";
    include_once "Models.php";
    include_once "databaseFunctions.php";

    $item_id = $_POST["item_id"];
    $user_id = $_POST["user_id"];
    $RN = $_POST["RN"];
    $review = $_POST["review"];

    $reviewObj = new Review($item_id, $user_id, $RN, $review);
    $reviewObj->insert();

    print("
        <h4>Thank you for reviewing our product. Your feedback matters to improve our services and products</h4>
        
        <form method='' action='http://localhost:3000/reviews'>
            <button type='submit'/>Return to review page</button>
        </form>"
    );
?>