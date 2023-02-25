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

            echo 'Erro ao registrar log de registro de usuário: ',  $e->getMessage(), "\n";

        }
    }

    public function couponRegisterSuccessLog($indentifiers)
    {

        try{

            $logdate = date('d-m-Y H:i:s');
            $logfile = fopen('../logs.txt','a+', false);
            $text = 'data: ' . $logdate . ' o cupom: ' . $indentifiers[0] . ' foi registrado ' . 'pelo cpf: '. $indentifiers[1] . "\n";
            fwrite($logfile, $text);
            fclose($logfile);

        }catch(Exception $e){

            echo 'Erro ao registrar log de registro de cupom: ',  $e->getMessage(), "\n";

        }
    }

    public function  enableRaffleSuccessLog($indentifiers)
    {

        try{

            $logdate = date('d-m-Y H:i:s');
            $logfile = fopen('../logs.txt','a+', false);
            $text = 'data: ' . $logdate . ' Sorteio teórico realizado! Dados do ganhador: Nome do ganhador: ' . $indentifiers[0] . '. Número da sorte: ' . $indentifiers[1] . "\n";
            fwrite($logfile, $text);
            fclose($logfile);

        }catch(Exception $e){

            echo 'Erro ao registrar log de "Sorteio teórico realizado": ',  $e->getMessage(), "\n";

        }
    }

    public function  endRaffleSuccessLog()
    {

        try{

            $logdate = date('d-m-Y H:i:s');
            $logfile = fopen('../logs.txt','a+', false);
            $text = 'data: ' . $logdate . ' Sorteio Finalizado! Todos os números da sorte foram limpos!' . "\n";
            fwrite($logfile, $text);
            fclose($logfile);

        }catch(Exception $e){

            echo 'Erro ao registrar log de "Sorteio Finalizado": ',  $e->getMessage(), "\n";

        }
    }

    public function  enableSweepstakeSuccessLog()
    {

        try{

            $logdate = date('d-m-Y H:i:s');
            $logfile = fopen('../logs.txt','a+', false);
            $text = 'data: ' . $logdate . ' Sistema habilitado para novo Sorteio! ' . "\n";
            fwrite($logfile, $text);
            fclose($logfile);

        }catch(Exception $e){

            echo 'Erro ao registrar log de "Sistema habilitado para novo sorteio": ',  $e->getMessage(), "\n";

        }
    }

}


?>