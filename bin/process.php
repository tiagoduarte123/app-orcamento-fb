<?php
mysql_connect("mysql1.000webhost.com", "a6128951_tiago", "1234567a") or die(mysql_error());
mysql_select_db("a6128951_tiago") or die(mysql_error());

//buscar dados
$nome = $_POST['nome'] ;
$telefone = $_POST['telefone'];
$empresa = $_POST['empresa'];
$mensagem = $_POST['mensagem'];
$selecao = $_POST['selecao'];
$orcamento = $_POST['dinheiro'];
//email's
$nosso_email = "tiago7a@hotmail.com";
$email_cliente = $_POST['email'];
$mensagem = wordwrap($mensagem,70);

//Est� a funcionar ( Separar as sele��es pelos "|" )
$array  = explode('|', $selecao);
//Testar se funciona
//print_r($array);


// Insert a row of information into the table "example"
mysql_query("INSERT INTO registo(nome, telefone, empresa, mail, mensagem) VALUES('".$nome."','".$telefone."','".$empresa."', '".$email_cliente."','".$mensagem."' ) ") or die(mysql_error());  

$guardar = mysql_insert_id();


//verifica os IDs' dos servicos
for ($i=0; $i < strlen($array[$i]);$i++) {
$query = sprintf("SELECT idservico from servico WHERE nome_servico like "."'$array[$i]'");
$result = mysql_query($query);
if (!$result) {
    $message  = 'Invalid query: ' . mysql_error() . "\n";
    $message .= 'Whole query: ' . $query;
    die($message);
}

while ($row = mysql_fetch_assoc($result)) {
	$dados[]=$row['idservico'];
	$servicos = sprintf("INSERT INTO registoservico(idservico,idregisto) VALUES("."'".$row['idservico']."'".","."'".$guardar."'".');');
	$result = mysql_query($servicos);
	//imprimir o array com as posi��es
	
}
}

//imprimir os dados
print_r($dados);
echo "<br>";

echo $guardar;

echo "existem:".count($dados)." posi��es.";

	
//email para n�s
mail( $email_cliente, 'Bem-Vindo � Legendary', "Recebemos o seu e-mail e brevemente entraremos em contacto consigo.");

//email para empresa
mail( $nosso_email , 'Or�amento FB:'.$empresa, "Informa��es e contacto: \n\n"."Nome do Cliente: ".$nome."\n"."Telefone: ".$telefone."\n"."E-mail: ".$email_cliente."\n\n"."Est� disposto a gastar:\n".$orcamento."\n"."Selecionou as seguintes op��es: \n".$selecao."\n \n"."Escreveu tamb�m a seguinte mensagem: \n".$mensagem);

  exit;

?>
