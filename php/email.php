<?php
require_once('php/class.phpmailer.php'); /*classe PHPMailer*/

/* Recebe os dados do cliente ajax jquery via POST*/
$nome = $_POST['nome'];
$email = $_POST['email'];
$msg = $_POST['mensagem'];

try {
    $mail = new PHPMailer(true); //New instance, with exceptions enabled
    /* corpo do e-mail */
    $body .= "E-mail enviado pelo Site Master Informática";
    $body .= "Nome: $nome <br>";
    $body .= "E-mail: $email <br>";
    $body .= "Mensagem:<br>";
    $body .= $mensagem;
    $body .= "<br>";
    $body .= "----------------------------";

    $mail->IsSMTP(); //dizendo para a classe usar o SMTP
    $mail->SMTPAuth = true; //habilitando a autenticação SMTP
    $mail->Host = "smtp.infomasterinformatica.com.br"; //servidor SMTP
    $mail->Username = "contato@meudominio.com";  //usuário SMTP

    $mail->IsSendmail();

    $mail->AddReplyTo($email, $nome); //responder para..
    $mail->From = $email; //e-mail fornecido pelo cliente
    $mail->FromName = $nome; //nome fornecido pelo cliente

    $to = "meuemail@meuservidor.com"; //enviar para
    $mail->AddAddress($to);
    $mail->Subject = "Assunto do E-mail"; //assunto
    $mail->WordWrap = 80; //define quebra automática

    $mail->MsgHTML($body);

    $mail->IsHTML(true); //enviando como HTML

    $mail->Send();
    echo "Mensagem enviada com sucesso."; //retorno devolvido para o ajax caso sucesso
} catch (phpmailerException $e) {
    echo $e->errorMessage(); //retorno devolvido para o ajax caso erro
}
?>
