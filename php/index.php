<!doctype html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
  </head>
  <body>
    <?php
        $nome = "Flavia";
        echo "Hello world PHP, $nome<br>";
        
        $idade= 18;

        if($idade < 18){
            echo "$nome é de menor";
        } else {
            echo "$nome é de maior<br>";
        }

        $notas = [7,6,5,8,9];
        for($i = 0; $i < count($notas); $i++){
            if ($notas[$i]>6){
                echo "<br>$notas[$i]";
            }
        }
        $alunos= ["flavia", "vitorya", "jackson5", "Sagaz", "Angelo"];
        for($i = 0; $i < count($alunos); $i++){
            if ($i==0 || $i==4){
                echo "<br>$alunos[$i]";
            }
        }
    ?>

</body>
</html>