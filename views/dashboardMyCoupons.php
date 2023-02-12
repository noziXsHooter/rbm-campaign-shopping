<?php


include '../layouts/dashboardHeader.php';

require_once '../controllers/indexController.php';

include '../inc/config.php';

$p = new Index($dbname, $host, $user, $password);

$result = array();

if(!isset($_SESSION['logged'])){

  header('Location: ../index.php');

}

if(isset($_SESSION['id'])){

  $id = $_SESSION['id'];

  $result = $p->listUserCoupons($id);

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

echo "<h1 style='text-align: center;color:white'> Lista de Cupons </h1>";
echo "<table style='text-align: center;color:white' width='100%'><tr>";
echo "<tr><th>Código</th><th>Valor</th><th>Loja</th><th>Data-Hora</th><th>Status</th></tr>";
foreach ($result as $key => $value) {
    echo '<tr>';
    foreach ($value as $key2 => $value2) {
        if($key2 === 'id'){
          echo "<td><a onclick='getUserCoupons($value2)'>$value2</a></td>";
        }else{
          echo "<td>$value2</td>";
        }
    }
echo '</tr>'; 
}
echo '</table>';

?>

</body>
<style>
      
body{
  margin: 0;
  background-color: #1f2937
}

</style>
</html>