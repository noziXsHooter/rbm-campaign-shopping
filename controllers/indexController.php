<?php

session_start();

Class Index {

    private $pdo;

    //CONSTROI A CONEXÃO COM O DB
    public function __construct($dbname, $host, $user, $password)
    {
        try{

            $this->pdo = new PDO("mysql:dbname=".$dbname.";host=".$host, $user, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        }catch(PDOException $e){

            echo "Ocorreu uma falha na conexão com o banco de dados : ". $e->getMessage();
            exit();

        }
    }

    //LOGA
    public function login($cpf,$password){
        
        $result = array();
        $sql = "SELECT * FROM users WHERE cpf = '$cpf' and password = '$password'";
        $query = $this->pdo->query($sql);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        if(count($result) > 0){

                header(
                    'Location: ../views/dashboardHome.php?'
                );

                $_SESSION['logged'] = true;
                $_SESSION['name'] = $result[0]['name'];
                $_SESSION['autho'] = $result[0]['autho'];
                $_SESSION['id'] = $result[0]['id'];
                $_SESSION['cpf'] = $result[0]['cpf'];
                
        }else {

            return [
                'message'=> 'Dados inválidos!',
                'status' => false
            ];
        }
    }

    //REGISTRA USUARIO
    public function userRegister($name, $born_in, $sex, $cpf, $password){

        try {

            $sql = "INSERT INTO users (name, born_in, autho, sex, cpf, password) 
                    VALUES (:name, :born_in, :autho, :sex, :cpf, :password)";

            $result = $this->pdo->prepare($sql);
            $result->bindValue(":name", $name);
            $result->bindValue(":born_in", $born_in);
            $result->bindValue(":autho", 1);
            $result->bindValue(":sex", $sex);
            $result->bindValue(":cpf", $cpf);
            $result->bindValue(":password", $password);
            $result->execute();

        } catch (Exception $e) {
            return [
                "sucesso" => false,
                "mensagem" => $e->getMessage()
            ];
        }
    
        return [
            "sucesso" => true,
            "mensagem" => "Pessoa cadastrada com sucesso."
        ];
    }

    // REGISTRA O CUPOM
    public function couponRegister($code, $id, $cpf, $valor, $store, $date_time, $status, $session_cpf){

        $cpValidation = $this->couponValidation($code, $cpf, $session_cpf);

        if($cpValidation === 'true'){

            try {
    
                $sql = "INSERT INTO coupons (code, user_id, cpf, valor, store, date_time, status) 
                        VALUES (:code, :user_id, :cpf, :valor, :store, :date_time, :status)";
    
                $result = $this->pdo->prepare($sql);
                $result->bindValue(":code", $code);
                $result->bindValue(":user_id", $id);
                $result->bindValue(":cpf", $cpf);
                $result->bindValue(":valor", $valor);
                $result->bindValue(":store", $store);
                $result->bindValue(":date_time", $date_time);
                $result->bindValue(":status", $status);
                $result->execute();
    
            } catch (Exception $e) {

                return [
                    "success" => false,
                    "message" => $e->getMessage()
                ];
            }

            $total = (int)$this->getUserValidCoupons($id); 

            if($total >= 300){
                $numbers = floor($total/300);
                $number= 0;

                for ($i=0; $i < $numbers; $i++) { 
                    $number=$number +1;
                    $myuuid = $this->guidv4();
                    $this->createLuckNumbers($myuuid, $id);
                }

                $this->deactivateCoupons($id);
            }

            return [

                "success" => true,
                "message" => "Cupom cadastrado com sucesso!",
            ];


        }elseif($cpValidation['success'] === 'false') {

            return [
                "success" =>  false,
                "message" => $cpValidation['message']
            ];
        }

    }

    // FAZ A VALIDAÇAO DO CUPOM
    public function couponValidation($code, $cpf, $session_cpf){

        if(!$this->couponCodeValidation($code)){

            return [
                 "success" => 'false',
                 "message" => "Código do cupom já cadastrado!",
             ];

        } elseif(!$this->couponUserSessionCpfValidation($cpf, $session_cpf)){

            return [
                "success" => 'false',
                "message" => "O CPF deve ser o seu!",
            ];

        }else{

            return 'true';

        }
    }
    
    //VERIFICA SE O CUPON JÁ EXISTE
    function couponCodeValidation($code){

         $result = array();
         $sql = "SELECT * FROM coupons WHERE code = '$code'";
         $query = $this->pdo->query($sql);
         $result = $query->fetchAll(PDO::FETCH_ASSOC);
 
         if(count($result) > 0){
             return false;
         }else {
             return true;
         }
     
    }

    //VERIFICA SE O CPF DO CUPOM É O MESMO DO USUARIO LOGADO
    public function couponUserSessionCpfValidation($cpf, $session_cpf){
        
        if($cpf == $session_cpf) {
            return true;
        }else{
            return false;
        }
    }

    // LISTA USUARIOS
    public function listUsers(){

        $result = array();
        $sql = "SELECT id, name, sex, born_in FROM users";
        $query = $this->pdo->query($sql);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
    //LISTA OS COUPONS DO USUARIO
    public function listUserCoupons($id){

        $result = array();
        $sql = "SELECT code, valor, store, date_time, status FROM coupons WHERE user_id = $id ORDER BY status DESC";
        $query = $this->pdo->query($sql);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    //LISTA OS NUMEROS DA SORTE
    public function listLuckNumbers($id){

        $result = array();
        $sql = "SELECT code, valor, store, date_time, status FROM coupons WHERE user_id = $id";
        $query = $this->pdo->query($sql);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    //PEGA OS CUPONS VALIDOS
    public function getUserValidCoupons($id){

        $result = array();
        $sql = "SELECT SUM(valor) AS total FROM coupons WHERE user_id = $id and status = '1'";
        $query = $this->pdo->query($sql);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        return $result[0]['total'];
    }

    //CRIA OS NUMEROS DA SORTE
    public function createLuckNumbers($guid, $id){

        $sql = "INSERT INTO luck_numbers (hash, user_id) VALUES (:hash, :user_id)";
        $result = $this->pdo->prepare($sql);
        $result->bindValue(":hash", $guid);
        $result->bindValue(":user_id", $id);
        $result->execute();

    }

    //DESATIVA OS CUPONS QUE JA FORAM PROCESSADOS
    public function deactivateCoupons($id){

        $sql = "UPDATE coupons SET status = :status WHERE user_id = :id";
        $result = $this->pdo->prepare($sql);
        $result->bindValue(":status", 0);
        $result->bindValue(":id", $id);
        $result->execute();

    }

    // GERA O GUID
    function guidv4($data = null) {
        // Generate 16 bytes (128 bits) of random data or use the data passed into the function.
        $data = $data ?? random_bytes(16);
        assert(strlen($data) == 16);
    
        // Set version to 0100
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        // Set bits 6-7 to 10
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
    
        // Output the 36 character UUID.
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }

    //VERIFICA ESTADO DO SORTEIO
    public function verifySweepstakeStatus(){

        $result = array();
        $sql = "SELECT status FROM sweepstake_status";
        $query = $this->pdo->query($sql);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        return $result[0]['status'];
    }

    //REALIZA O SORTEIO
    public function raffle(){

        $result = array();
        $sql = "SELECT hash FROM luck_numbers";
        $query = $this->pdo->query($sql);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);


        if(!empty($result)){
            
            $hashList = array();
            foreach($result as $key=>$value){
                foreach ($value as $key2 => $value2) {
                    array_push($hashList, $value2);
                }
            }
            $raffled = array_rand($hashList, 2);
    
            $winnerName = $this->searchForHashOwner($hashList[$raffled[0]]);
    
            //MUDA O STATUS DO SORTEIO
            $query = $this->pdo->query("UPDATE sweepstake_status SET status = 1");
            
            return [
                "winnerNumber" => $hashList[$raffled[0]],
                "winnerName" => $winnerName[0]['name'],
            ];

        }else{
            return [
                "success" =>  false,
                "message" => 'Não há números a serem sorteados!'
            ];
        }


    }

    //MUDA STATUS DO SORTEIO PARA FALSE NO DB PARA HABILITAR NOVO SORTEIO (SORTEIO NÂO REALIZADO)
    public function enableSweepstake(){

       //MUDA O STATUS DO SORTEIO
       $query = $this->pdo->query("UPDATE sweepstake_status SET status = 0");
    
    }

    public function searchForHashOwner($hash){

        $sql = "SELECT n.hash, u.name FROM luck_numbers AS n INNER JOIN users AS u ON n.user_id=u.id WHERE n.hash='$hash'";
        $query = $this->pdo->query($sql);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    //FINALIZA SORTEIO E LIMPA OS NUMEROS
    public function endRaffle(){

        $sql = "DELETE FROM luck_numbers";
        $result = $this->pdo->query($sql);
    }

    //DESLOGA
    public function logout(){
        
        unset($_SESSION['logged']);
        unset($_SESSION['name']);
        unset($_SESSION['autho']);
       /*  session_unset(); */
        session_destroy();

        header('Location: login.php');
    }

}



?>





