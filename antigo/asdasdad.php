<?php

$Enviar = $_POST["Enviar"];

if(strlen($Enviar) > 0) { // o formulário foi enviado
	$nome = $_POST["nome"];
	$email = $_POST["email"];
	$telefone = $_POST["telefone"];
	$departamento = $_POST["departamento"];
	$mensagem = $_POST["mensagem"];

	if((strlen($nome) > 0) && (strlen($email) > 0) && (strlen($telefone) > 0) &&
		(strlen($departamento) > 0) && (strlen($mensagem) > 0)) { // todos os dados preenchidos
		print("<strong>Dados do Formulário:<strong><BR>");
		print("<strong>Nome:</strong>".$nome."<BR>");
		print("<strong>Email:</strong>".$email."<BR>");
		print("<strong>Telefone:</strong>".$telefone."<BR>");
		print("<strong>Departamento:</strong>".$departamento."<BR>");
		print("<strong>Mensagem:</strong>".$mensagem."<BR>");
	}
	else { // nem todos os dados preenchidos, voltar para o formulário
		// dizer em msg de erro o que falta no formulário
		if(strlen($nome) == 0)
			$erro_nome = "<span class=\"msg_erro\">O campo Nome deve ser preenchido</span>";
		if(strlen($email) == 0)
			$erro_email = "<span class=\"msg_erro\">O campo Email deve ser preenchido</span>";
		if(strlen($telefone) == 0)
			$erro_telefone = "<span class=\"msg_erro\">O campo Telefone deve ser preenchido</span>";
		if(strlen($departamento) == 0)
			$erro_departamento = "<span class=\"msg_erro\">O campo Departamento deve ser preenchido</span>";
		if(strlen($mensagem) == 0)
			$erro_mensagem = "<span class=\"msg_erro\">O campo Mensagem deve ser preenchido</span>";

		// colocando o departamento selecionado como selecionado
		$$departamento = "selected=\"true\"";

		require("contatoform.php");
	}
}
else { // o formulário não foi enviado
	require("contatoform.php");
}

?>