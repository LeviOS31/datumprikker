<?php
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $count = count($_POST) - 1;
    for($i = 0; $i < $count; $i++){
        $_SESSION["beschikbaar"][] = $_POST["beschikbaar" . $i];
    }
    $_SESSION["naam"] = $_POST["naam"];
    header("location:update.php?id=" . $_GET["id"]);
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Beschikbaarheid</title>
    </head>
    <body>
        <form action="" method="POST">
            <input type="text" name="naam" placeholder="naam">
            <br>  
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
                        $i = 0;
                        foreach($datums as $x => $x_value){
                            echo $x . "<br>";
                            echo "<input type='radio' name='beschikbaar" . $i . "' value='ik kan'><label>ik kan</label><br>";
                            echo "<input type='radio' name='beschikbaar" . $i . "' value='ik kan misschien'><label>ik kan misschien</label><br>";
                            echo "<input type='radio' name='beschikbaar" . $i . "' value='ik kan niet'><label>ik kan niet</label><br>";
                            $i++;
                        }
                    }   
                }


            ?>
            <input type="submit" value="doorgaan">
        </form>
    </body>
</html>