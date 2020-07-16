<?php
    // session_start();
    deleteAllCookies();
    function deleteAllCookies(){
        setcookie("user_name", "", time() - 3600);
        header("location: index.php");
        session_abort();
        exit();
    }
?>