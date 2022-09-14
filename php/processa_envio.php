<?php
    //Importando scripts do PHPMailer
    require "./bibliotecas/PHPMailer/Exception.php";
    require "./bibliotecas/PHPMailer/OAuth.php";
    require "./bibliotecas/PHPMailer/PHPMailer.php";
    require "./bibliotecas/PHPMailer/POP3.php";
    require "./bibliotecas/PHPMailer/SMTP.php";

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;

    class Mensagem {
        private $para = 'exemplo@gmail.com';
        private $nome = null;
        private $assunto = null;
        private $mensagem = null;
        private $emailUsuario = null;
        
        public function __get($atributo){
            return $this->$atributo;
        }

        public function __set($atributo, $valor){
            $this->$atributo = $valor;
        }

        
        public function mensagemValida(){
            if($this->nome == null || $this->assunto == null || $this->mensagem == null || $this->emailUsuario == null){
                return false;
            }

            return true;
        }
    }

    $mensagem = new Mensagem();

    $mensagem->__set('nome', $_POST['nome']);
    $mensagem->__set('emailUsuario', $_POST['email']);
    $mensagem->__set('assunto', $_POST['assunto']);
    $mensagem->__set('mensagem', $_POST['mensagem']);

    if(!$mensagem->mensagemValida()){
?>

    <?php ob_start() ?>
        <script>
            alert('Por favor preencha todos os campos!')
            window.location.replace("../contato.html")
        </script>
    <?php 
    $buffer_js = ob_get_clean();
        var_dump($buffer_js);
    ?>

<?php

    }else {
    
        $mail = new PHPMailer(true);

        try {
            $mail->SMTPDebug = SMTP::DEBUG_OFF;                      
            $mail->isSMTP();                                            
            $mail->Host       = 'smtp.gmail.com';                    
            $mail->SMTPAuth   = true;                                  
            $mail->Username   = 'exemplo@gmail.com';                    
            $mail->Password   = 'senhaexemplo';                               
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         
            $mail->Port       = 587;                                    

            $mail->setFrom('mensagem', 'Mensagem vinda do meu site');
            $mail->addAddress($mensagem->__get('para'));     
            $mail->isHTML(true);                                  
            $mail->Subject = $mensagem->__get('assunto');
            $mail->Body    = '<html><p><b>Enviado por:</b> ' . $mensagem->__get('nome') . '<p><b>Email dele:</b> ' . $mensagem->__get('emailUsuario') . '<p><b>Assunto:</b> ' . $mensagem->__get('assunto') . '</p><p><b>Mensagem:</b> ' . $mensagem->__get('mensagem') . '</p></html>';           

            $mail->send();
?>
            <?php ob_start() ?>
            <script>
                alert("Mensagem recebida")
                window.location.replace("../contato.html")
            </script>
            
            <?php 
            $buffer_js = ob_get_clean();
                var_dump($buffer_js);
            ?>
<?php
            
        }catch (Exception $e) {
            
        }
    }
?>

