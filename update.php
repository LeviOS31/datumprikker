<?php
session_start();
require_once("DBconnectie.php");

$conn = new DBconnectie;
$mysql = $conn->getConnection();

$beschikbaarheid = $_SESSION["beschikbaar"];
$naam = $_SESSION["naam"];
//var_dump($beschikbaarheid);
session_destroy();
$id = htmlspecialchars($_GET["id"]);
$stmt = $mysql->prepare("SELECT * FROM datums WHERE id = ?");
$stmt->bind_param("s", $id);
if($stmt->execute()){
    $result = $stmt->get_result();
    if ($result->num_rows > 0){
        $row = $result->fetch_array(MYSQLI_ASSOC);
        $datums = unserialize($row["datums"]);
        $i = 0;
        foreach($datums as $x => $x_value){
            $array[] = [$naam => $beschikbaarheid[$i]];
            $x_value = array_merge($x_value, $array[$i]);
            $resultaat[] = $x_value;
            echo "<br><br><br>";
            $i++;
        }

        $i = 0;
        foreach($datums as $x => $x_value){
            $arr[] =  [$x => $resultaat[$i]];
            $i++;
        }
        //var_dump($arr);
        //echo "<br><br><br>";
        $send = array_merge($arr[0], $arr[1]);
        for($i = 2; $i < count($arr); $i++){
            $send = array_merge($send, $arr[$i]);
        }
        var_dump($send);
        $stmt = $mysql->prepare("UPDATE datums SET datums = ? WHERE id = ?");
        $stmt->bind_param("ss", serialize($send), $id);
        $stmt->execute();
    }   
}