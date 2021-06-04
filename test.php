<?php

$mysql = new mysqli("mysql", "root", "root", "datumprikker");
$stmt = $mysql->prepare("SELECT * FROM datums");
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
    $test[] = $row;
}
var_dump($test);
echo "<br><br>";
var_dump(unserialize($test[0]["array"]));

echo uniqid();