<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>overzicht</title>
</head>
<body>
    <a href="beschikbaarheid.php?id=<?php echo $_GET["id"] ?>"><button>beschikbaarheid invullen</button></a>
    <br>
    <br>
    <table>
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
                foreach($datums as $x => $x_value){
                    echo $x . "<br>";
                    foreach($x_value as $y => $y_value){
                        echo $y . " " . $y_value . "<br>";
                    }
                }
            }   
        }
    ?>
    </table>
</body>
</html>
