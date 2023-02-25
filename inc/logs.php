<?php 

date_default_timezone_set('America/Sao_Paulo');

class Log {

    public function loginLog()
    {

        try{

            $logdate = date('d-m-Y H:i:s');
            $logfile = fopen('./logs.txt','a+', false);
            $text = 'data: ' . $logdate . ' usuário: ' . $_SESSION['name'] . ' acabou de logar.' . "\n";
            fwrite($logfile, $text);
            fclose($logfile);

        }catch(Exception $e){

            echo 'Erro ao registrar log de login: ',  $e->getMessage(), "\n";

        }
    }

    public function userRegisterSuccessLog($cpf)
    {

        try{

            $logdate = date('d-m-Y H:i:s');
            $logfile = fopen('../logs.txt','a+', false);
            $text = 'data: ' . $logdate . ' o cpf: ' . $cpf . ' foi registrado.' . "\n";
            fwrite($logfile, $text);
            fclose($logfile);

        }catch(Exception $e){

            echo 'Erro ao registrar log de login: ',  $e->getMessage(), "\n";

        }
    }

    public function couponRegisterSuccessLog($indentifiers)
    {

        try{

            $logdate = date('d-m-Y H:i:s');
            $logfile = fopen('../logs.txt','a+', false);
            $text = 'data: ' . $logdate . ' o cupom: ' . $indentifiers[0] . ' foi registrado' . 'pelo cpf: '. $indentifiers[1] . "\n";
            fwrite($logfile, $text);
            fclose($logfile);

        }catch(Exception $e){

            echo 'Erro ao registrar log de login: ',  $e->getMessage(), "\n";

        }
    }

}


?>