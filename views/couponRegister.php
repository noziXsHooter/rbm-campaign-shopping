<?php

require_once '../controllers/indexController.php';
require_once '../inc/config.php';

$p = new Index($dbname, $host, $user, $password);

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

      $response = $p->couponRegister($_POST['code'], $_SESSION['id'],  $_POST['cpf'], $_POST['valor'], $_POST['store'], $_POST['date_time'], $_POST['status'], $_SESSION['cpf']);


      if(isset($response['success']) and $response['success']){

        $isValid = true; 
        $message = 'Cupom cadastrado com sucesso!';
  
      }elseif(empty($response['success'])){

        $isValid = false; 
        $message = $response['message'];

      }
    }
}

?>

<html>
<body>

  <div class="container">
  <form id="coupon_register" name="coupon_register" class="form" action="couponRegister.php" method="post">
    <h1>Registrar Cupom</h1>
   
    <label>Código: </label>
    <input name="code" id="code" type="number" size="20" maxlength="100">

    <label>CPF: </label>
    <input name="cpf" id="cpf" type="text" size="20" maxlength="11">
    
    <label>Valor: </label>
    <input name="valor" id="valor" type="number" step="0.01"  maxlength="100">
    
    <label>Loja: </label>
    <input name="store" id="store" type="text" size="20" maxlength="100">
    
    <label>Data-Hora da Compra: </label>
    <input name="date_time" id="date_time" type="text" size="20" maxlength="100">

    <label>Status: </label>
    <select name="status" id="status">
      <option value="1">Ativo</option>
      <option value="0">Desativado</option>
    </select>

    <?php if(!empty($message) and !$isValid) echo "<div id='error-message'>".$message."</div>" ?>
    
    <?php if(!empty($message) and $isValid) echo "<div id='registered-message'>".$message."</div>" ?>
    
    <input type="submit" id="coupon_register" name="coupon_register" value="Registrar">
  </form>
</div>

</body>
<style>
      
      .container {
          display: flex;
          justify-content: center;
          align-items: center;
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
        margin-top: 10px;
        width: 220px;
        height: 700px;
        padding: 20px;
        background-color: #6b7280;
        border-radius: 5px;
        background-color: #6b7280;
        padding: 20px;
      }
      h1{
        color: #1f2937;
        text-align: center;
      }
</style>


</html>
