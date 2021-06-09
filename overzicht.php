<?php 
//header("refresh:5;");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="standart.css">
    <link rel="stylesheet" href="overzicht.css">
    <title>overzicht</title>
</head>
<body>
    <header>
        <h1>overzicht</h1>
    </header>
    <main>
            <div id="beste_datum">
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
                            ksort($beste);
                            echo "<h2>De beste datum tot nu toe: " . end($beste) . "</h2>";
                        }
                    }
                ?>
            </div>
            <br>
            <a href="beschikbaarheid.php?id=<?php echo $id; ?>"><button>beschikbaarheid invullen</button></a>
            <br><br>
            <p>wil je dat anderen ook hun beschikbaarheid kunnen invullen </p><button id="klik" onclick="copyToClipboard('localhost/datumprikker/beschikbaarheid.php?id=<? echo $id; ?>')">klik hier!</button>
            <br><br>
            <div id="datums">
                <?php
                $stmt = $mysql->prepare("SELECT * FROM datums WHERE id = ?");
                $stmt->bind_param("s", $id);
                if($stmt->execute()){
                    $result = $stmt->get_result();
                    if ($result->num_rows > 0){
                        $row = $result->fetch_array(MYSQLI_ASSOC);
                        $datums = unserialize($row["datums"]);
                        foreach($datums as $x => $x_value){
                            echo "<div id='datum'><h4>" . $x . ":</h4>";
                            foreach($x_value as $y => $y_value){
                                echo "<p>" . $y . ": " . $y_value . "</p>";
                            }
                            echo "</div><br>";
                        }
                    }   
                }
                ?>
            </div>
            <script>
            function copyToClipboard(text) {
                window.prompt("kopieer dit en stuur het naar de anderen mensen: Ctrl+C, Enter", text);
            }
            </script>
        </main>
</body>
</html>