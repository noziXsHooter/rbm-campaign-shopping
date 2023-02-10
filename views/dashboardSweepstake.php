<?php

include '../layouts/dashboardHeader.php';

require_once '../controllers/indexController.php';

include '../inc/config.php';

$p = new Index($dbname, $host, $user, $password);


$sweepstakeErrorMessage = '';

if(!isset($_SESSION['logged']) and !$_SESSION['logged']){

  header( 'Location: login.php');

}

if(isset($_POST['raffle'])){

  $raffleResult = $p->raffle();

}

if(isset($_POST['end-raffle'])){

  $p->endRaffle();

}

if(isset($_POST['enable-raffle'])){

  $p->enableSweepstake();

}

$sweepstakeStatus = $p->verifySweepstakeStatus();

$sweepstakeMessage = $sweepstakeStatus ? "Sorteio realizado!" : "O sorteio ainda não foi realizado!";

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
  echo "<h1>". $sweepstakeMessage ."</h1>";
  if(isset($raffleResult['winnerNumber'])) echo "<h3> O número sorteado é: ". $raffleResult['winnerNumber'] ."<br> E o nome do ganhador é: ". $raffleResult['winnerName'] ." </h3>";
  if(isset($raffleResult['message'])) echo "<h3>". $raffleResult['message'] . "</h3>";
?>
<div class="container">
  <form id="raffle" name="raffle" action="dashboardSweepstake.php" method="post">

    <input type="submit" id="raffle" name="raffle" value="Sortear"><br>
    <input type="submit" id="end-raffle" name="end-raffle" value="Finalizar Sorteio"><br>
    <input type="submit" id="enable-raffle" name="enable-raffle" value="Habilitar Novo Sorteio">
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
  margin: 5px;
  width: 200px;
  padding: 10px;
}

</style>
</html>