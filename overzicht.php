<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>overzicht</title>
</head>
<body>
    <?php
    require_once("DBconnectie.php");

    $conn = new DBconnectie;
    $mysql = $conn->getConnection();

    $id = htmlspecialchars($_GET["id"]);
    $stmt = $mysql->prepare("SELECT * FROM datums WHERE id = ?");
    $stmt->bind_param("s", $id);
    if($stmt->execute()){
        $result = $stmt->get_result();
        if ($result->num_rows > 0){
            $row = $result->fetch_array(MYSQLI_ASSOC);
            $datums = unserialize($row["datums"]);
            $count = array_values($datums);
            $i = 0;
            foreach($datums as $z => $z_value){
                $array[] = array_count_values($count[$i]);
                $datums[$z] = $array[$i]["ik kan"];
                $i++; 
            }
            $datums = array_reverse($datums);
            $beste = array_flip($datums);
            echo "<h3>De beste datum to nu toe: " . end($beste) . "</h3>";
        }
    }

    
    ?>

    <br><br>
    <a href="beschikbaarheid.php?id=<?php echo $_GET["id"] ?>"><button>beschikbaarheid invullen</button></a>
    <br>
    <?php
    $stmt = $mysql->prepare("SELECT * FROM datums WHERE id = ?");
    $stmt->bind_param("s", $id);
    if($stmt->execute()){
        $result = $stmt->get_result();
        if ($result->num_rows > 0){
            $row = $result->fetch_array(MYSQLI_ASSOC);
            $datums = unserialize($row["datums"]);
            foreach($datums as $x => $x_value){
                echo "<h4>" . $x . "</h4>";
                foreach($x_value as $y => $y_value){
                    echo $y . ": " . $y_value . "<br>";
                }
                echo "<br>";
            }
        }   
    }
    ?>
</body>
</html>