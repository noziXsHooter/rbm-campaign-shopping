<?php

require_once '../controllers/indexController.php';
require_once '../inc/config.php';

$p = new Index($dbname, $host, $user, $password);

if(isset($_GET['logout'])) $p->logout();


if(isset($_POST['raffle'])){

    

}
?>

<html>

<body>
    <div class="topnav">
      <a href="dashboardHome.php">Registro</a>

      <?php if($_SESSION['autho'] == 5) echo '<a href="dashboardUsers.php">Usuários</a>'; ?>

      <?php if($_SESSION['autho'] == 5) echo '<a href="dashboardSweepstake.php">Sorteio</a>'; ?>
      <a id='logout' href="?logout=logout">Logout</a>

      <?php if(isset($_SESSION['name'])) echo "<span>Olá! ".$_SESSION['name']."</span>" ?>
    </div>
</body>

<style>

body{
    margin: 0;
    background-color: #1f2937
}

span{
    float: right;
    color: #f2f2f2;
    text-align: center;
    padding: 17px;
    text-decoration: none;
    font-size: 10px;
}

#logout{
    float: right;
}

.topnav {
  overflow: hidden;
  background-color: #6b7280;
}

.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: white;
  color: black;
}

.topnav a.active {
  background-color: black;
  color: white;
}
</style>
</html>


