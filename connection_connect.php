<?php

     try {
        $con = new PDO("mysql:dbname=shop;charset=utf8;host=localhost","root","");
        } catch (PDOException $e) {
        echo "Error : " . $e->getMessage() . "<br/>";
        die();
        }

?>