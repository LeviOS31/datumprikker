<?php
require_once("DBconnectie.php");
$conn = new DBconnectie;
$mysql = $conn->getConnection();
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(!empty($_POST["naam"]) || !empty($_POST["date"])){
        $naam = [htmlspecialchars($_POST["naam"]) => "ik kan"];
        $replace = $_POST["date"];
        $send = array_flip($replace);
        for($i = 0; $i < count($_POST["date"]); $i++)
        {
            $send[$replace[$i]] = $naam;
        }
        $arr = serialize($send);
        $stmt = $mysql->prepare("UPDATE datums SET datums = ? WHERE id = ?");
        $stmt->bind_param("ss", $arr, $_GET["id"]);
        if($stmt->execute()){
            header("Location:overzicht.php?id=" . $_GET['id']);
        }else{
            echo $conn->getError();
        }                                           
    }else{
        header("Refresh:5;url=datums.php?id=" . $_GET['id']);
    } 
}