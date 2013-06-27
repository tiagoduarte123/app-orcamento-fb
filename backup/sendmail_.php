<?php

$nome = $_POST['nome'] ;
$telefone = $_POST['telefone'];
$empresa = $_POST['empresa'];
$mensagem = $_POST['mensagem'];
$selecao = $_POST['selecao'];
$orcamento = $_POST['amount'];
//email's
$nosso_email = "tiago7a@hotmail.com";
$email_cliente = $_POST['email'];
    
//if (eregi("^[a-zA-Z0-9_]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$]", $email))
//{
//	return FALSE;
//}
//else 
//{
$mensagem = wordwrap($mensagem,70);

mail( $nosso_email , 'Orçamento FB:'.$empresa, "Informações e contacto: \n\n"."Nome do Cliente: ".$nome."\n"."Telefone: ".$telefone."\n"."E-mail: ".$email_cliente."\n"."Está disposto a gastar:\n".$orcamento."\n"."Selecionou as seguintes opções: \n".$selecao."\n \n"."Escreveu também a seguinte mensagem: \n".$mensagem);

ob_start(); // ensures anything dumped out will be caught

// do stuff here
$url = 'testee_func.php?#lastone'; // this can be set based on whatever

// clear out the output buffer
while (ob_get_status()) 
{
    ob_end_clean();
}

// no redirect
header( "Location: $url" );
//}
?>