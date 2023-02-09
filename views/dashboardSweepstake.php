<?php

include '../layouts/dashboardHeader.php';

require_once '../controllers/indexController.php';

$p = new Index('shopping_campaign', 'localhost', 'root', '');


if(!isset($_SESSION['logged']) and !$_SESSION['logged']){

  header( 'Location: login.php');

}

if(isset($_POST['raffle'])){

  $raffleResult = $p->raffle();

}

if(isset($_POST['end-raffle'])){

  $raffleResult = $p->endRaffle();

}

?>

<html>
<head>
    <title>
        Campanha Shopping Independência - Dashboard
    </title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<?php
  echo "<h1> O sorteio ainda não foi realizado! </h1>";
  if(!empty($raffleResult)) echo "<h3> O número sorteado é: ". $raffleResult[0] ."<br> E o nome do ganhador é: ". $raffleResult[1] ." </h3>";
?>
<div class="container">
  <form id="raffle" name="raffle" action="dashboardSweepstake.php" method="post">

    <input type="submit" id="raffle" name="raffle" value="Sortear">
    <input type="submit" id="end-raffle" name="end-raffle" value="Finalizar Sorteio">
    <?php if(!empty($message) and !$isValid) echo "<div id='error-message'>".$message."</div>" ?>
  
  </form>

</div>
</body>
<style>
      
body{
  margin: 0;
  background-color: #1f2937
}

h1{
  color: white;
  text-align: center;
}

h3{
  color: white;
  text-align: center;
}
.container {
  display: flex;
  justify-content: center;
  /* text-align: center; */
  min-height: 100vh;
  background-color: #1f2937; 
}

input[type=submit]{
  padding: 10px;
}

</style>
</html>