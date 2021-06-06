<?php
require_once("DBconnectie.php");
$conn = new DBconnectie;
$mysql = $conn->getConnection();
$code = uniqid();
$stmt = $mysql->query("SELECT * FROM datums WHERE id = $code");
if($stmt->num_rows > 0){
    die("er is iets mis gegaan");
}else{
    $stmt2 = $mysql->prepare("INSERT INTO `datums`(`id`, `datums`) VALUES (?,0)");
    $stmt2->bind_param("s", $code);
    if($stmt2->execute()){
        header("Location:datums.php?id=$code");
    }
    echo $conn->getError();
}