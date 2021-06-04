<?php
$mysql = new mysqli("mysql", "root", "root", "datumprikker");
$code = uniqid();
$stmt = $mysql->query("SELECT * FROM datums WHERE id = $code");
if($stmt->num_rows > 0){
    die("er is iets mis gegaan");
}else{
    $stmt = $mysql->query("INSERT INTO datums (id, array) VALUES ($code, 0)");
    header("Location:datums.php?id=$code");
}


if($_GET["ID"] == "test"){
    $array["eerste"]["a"] = "Hello";
    $array["eerste"]["b"] = "World";
    $array["eerste"]["c"] = "!";

    $array["tweede"]["a"] = "How";
    $array["tweede"]["b"] = "are";
    $array["tweede"]["c"] = "you";

    $str = serialize($array);

    $stmt = $mysql->prepare("INSERT INTO datums (id ,array) VALUES (?,?)");
    $stmt->bind_param("ss", "vjhsdjefj39w8e48ry" ,$str);
    $stmt->execute();
}