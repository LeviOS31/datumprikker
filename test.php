<?php

// $mysql = new mysqli("mysql", "root", "root", "datumprikker");
// $stmt = $mysql->prepare("SELECT * FROM datums");
// $stmt->execute();
// $result = $stmt->get_result();
// while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
//     $test[] = $row;
// }
// var_dump($test);
// echo "<br><br>";
// var_dump(unserialize($test[0]["array"]));

// echo uniqid();

var_dump($_POST);
echo "<br><br>";
$naam = ["jan" => "ja"];
$naam2 = ["piet" => "nee"];
$replace = $_POST["date"];
$send = array_flip($replace);
var_dump($send);
echo "<br><br>";
for($i = 0; $i <= count($_POST["date"]); $i++){
    // $replace[$i] = $_POST["date"][$i]
    $send[$replace[$i]] = $naam;
    array_push($send[$replace[$i]], $naam2);

    // $test = 
}

var_dump($send);