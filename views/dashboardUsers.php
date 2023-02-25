<?php

include '../layouts/dashboardHeader.php';

require_once '../controllers/indexController.php';

include '../inc/config.php';

$p = new Index($dbname, $host, $user, $password);

if(!isset($_SESSION['logged'])){

  header('Location: ../index.php');

}

$isValid = null;
$message = '';

if(isset($_POST['coupon_register'])){

    if (!isset($_POST['code']) || !isset($_POST['cpf']) || !isset($_POST['valor']) || !isset($_POST['store']) || !isset($_POST['date_time']) || !isset($_POST['status']) ) {

        $isValid = false;
        $message = "Dados incompletos!";

    }elseif (empty($_POST['code']) || empty($_POST['cpf']) || empty($_POST['valor']) || empty($_POST['store']) || empty($_POST['date_time']) || !isset($_POST['status'])) {

        $isValid = false;
        $message = "Dados incompletos!";

    }else{

      $response = $p->couponRegister($_POST['code'], $_POST['user_id'], $_POST['cpf'], $_POST['valor'], $_POST['store'], $_POST['date_time'], $_POST['status'], $_SESSION['cpf']);

    }

    if(isset($response['success']) and $response['success']){

      $isValid = true; 
      $message = 'Cupom cadastrado com sucesso!';

    }
}

?>

<html>
<head>
    <title>
        Campanha Shopping Independência - Dashboard
    </title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../assets/style.css">
    <script type="text/javascript" src="../assets/js/funcs.js"></script>
</head>
<body>

  <div class="container">
  <form id="coupon_register" name="coupon_register" class="form" action="couponRegister.php" method="post">
  <?php
  $result = $p->listUsers();

      echo "<h1 style='text-align: center;color:white'> Lista de usuários </h1>";
      echo "<h5 style='text-align: left;color:white'> Clique no ID para ver os cupons do usuário </h5>";
      echo "<table style='text-align: center;color:white' width='100%'><tr>";
      echo "<tr><th>ID</th><th>Nome</th><th>Sexo</th><th>Nascimento</th></tr>";
      foreach ($result as $key => $value) {
          echo '<tr>';
          foreach ($value as $key2 => $value2) {
              if($key2 === 'id'){
                echo "<td><a id='id-button' onclick='getUserCoupons($value2)'>$value2</a></td>";
              }else{
                echo "<td>$value2</td>";
              }
          }
      echo '</tr>'; 
      }
      echo '</table>';

?>
  </form>
</div>

</body>
<style>
      
body{
  margin: 0;
  background-color: #1f2937
}
.container {
          display: flex;
          justify-content: center;
          /* align-items: center; */
          /* text-align: center; */
          min-height: 100vh;
          background-color: #1f2937;
      }

      #error-message{
        width: 80%;
        color: white;
        background-color: red;
        opacity: 0.5;
        color: white;
        text-align: center;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
      }

      #registered-message{
        width: 80%;
        color: white;
        background-color: green;
        opacity: 0.5;
        color: white;
        text-align: center;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
      }

      #id-button{
        background-color: white;
        color: black;
        padding: 4px;
      }
      #id-button:hover{
        background-color: black;
        color: white;
      }


      input[type=text],[type=date],[type=number], select {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
      }

      input[type=submit] {
        width: 100%;
        color: #000000;
        background-color: #1f2937;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
      }
      
      input[type=submit]:hover {
        color: #000000;
        background-color: white;
      }
      
/*       div {
        border-radius: 5px;
        background-color: #6b7280;
        padding: 20px;
      } */

      form{
/*         margin-top: 10px; */
        width: 90%;
        height: 570px;
        padding: 20px;
/*         background-color: #6b7280; */
/*         border-radius: 5px; */
/*         background-color: #6b7280; */
      }
      h1{
        color: #1f2937;
        text-align: center;
      }

</style>
</html>