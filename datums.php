<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="standart.css">
        <link rel="stylesheet" href="datums.css">
        <title>Document</title>
    </head>
    <body>
        <header>
            <h1>Welke datums wilt u voorstellen</h1>
        </header>
        <br>
        <br>
        <form action="opslaan.php?id=<?php echo $_GET["id"] ?>" method="POST">
            <input type="text" name="naam" placeholder="naam">
            <div id="flex">
                <?php
                // function getdatums()
                // {
                    $jaar = [31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
                    $maanden = ['Januari','Februari','Maart','April','Mei','Juni','Juli','Augustus','September','Oktober','November','December'];
                    for($i = 0; $i < count($jaar); $i++){
                        echo "<div>";
                        echo "<h3>$maanden[$i]<h3>";
                        echo "<div id='grid'>";
                        for($a = 0; $a <= $jaar[$i]; $a++){
                            echo '<div><input id="check" type="checkbox" id="datum" name="date[]" value="' . $maanden[$i] . ' ' . $a . '">
                            <label id="label" for="datum">' . $a . '</label></div>';
                        }
                        echo "</div></div>";
                    }
                // }
                ?>
            </div>    
            <input type="submit" value="volgende">
        </form>
    </body>
</html>

