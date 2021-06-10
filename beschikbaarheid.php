<?php
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $count = count($_POST) - 1;
    for($i = 0; $i < $count; $i++){
        $_SESSION["beschikbaar"][] = $_POST["beschikbaar" . $i];
    }
    $_SESSION["naam"] = htmlspecialchars($_POST["naam"]);
    header("Location:update.php?id=" . htmlspecialchars($_GET["id"]));
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="standart.css">
        <link rel="stylesheet" href="beschikbaar.css">
        <title>Beschikbaarheid</title>
    </head>
    <body>
        <header>
            <h1>Beschikbaarheid</h1>
        </header>
        <main>
            <form action="" method="POST">
                <input type="text" name="naam" placeholder="naam">
                <br>  
                <div id="datums">
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
                                echo "<div id='datum'>" . $x . "<br><br>";
                                echo "<div><input type='radio' name='beschikbaar" . $i . "' value='ik kan'><label>ik kan</label><br>";
                                echo "<input type='radio' name='beschikbaar" . $i . "' value='ik kan misschien'><label>ik kan misschien</label><br>";
                                echo "<input type='radio' name='beschikbaar" . $i . "' value='ik kan niet'><label>ik kan niet</label></div><br></div>";
                                $i++;
                            }
                        }   
                    }


                ?>
                </div>
                <input type="submit" value="doorgaan">
            </form>
        </main>
    </body>
</html>