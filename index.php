<?php
include_once('bdconf.php');

require 'Slim/Slim.php';
Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();
$app->response->headers->set('Content-Type', 'application/json');

$sql_inicial = "CREATE TABLE IF NOT EXISTS operacao (
  `codigo` varchar(10) NOT NULL,
  `tipo_mercadoria` varchar(50) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `preco` float NOT NULL,
  `tipo_operacao` int(11) NOT NULL,
  `data_operacao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

$query_inicial = @mysql_query($sql_inicial);

$app->get("/operacao/listar", function () use ($app) {
	
	$operacoes = array();
	$sql = "SELECT * FROM operacao WHERE 1;";
	
	$query = @mysql_query($sql);
	while($r = mysql_fetch_array($query)){
		extract($r);
		$operacoes[] = array("codigo" => $codigo, "tipo_mercadoria" => $tipo_mercadoria, "nome" => $nome, "quantidade" => $quantidade, "preco" => $preco, "tipo_operacao" => $tipo_operacao, "data_operacao" => $data_operacao); 			
	}

	if($query){
		$json = array("status" => 1, "msg" => "BUSCA REALIZADA COM SUCESSO", "operacoes" => $operacoes);
	}
	else {
		$json = array("status" => 2, "msg" => "ERRO AO BUSCAR DADOS");
	}
	
	echo json_encode($json);
});

$app->post("/operacao/salvar", function () use ($app) {
	
	$json_req = $app->request->getBody();
    $data = json_decode($json_req, true);
	
	$codigo = $data["codigo"];
	$tipo_mercadoria = $data["tipo_mercadoria"];
	$nome = $data["nome"];
	$quantidade = $data["qtd"];
	$preco = $data["preco"];
	$tipo_operacao = $data["tipo_operacao"];
    
	$sql = "INSERT INTO operacao (codigo, tipo_mercadoria, nome, quantidade, preco, tipo_operacao) VALUES ('$codigo', '$tipo_mercadoria', '$nome', $quantidade, $preco, $tipo_operacao);";
	
	$query = @mysql_query($sql);
	
	if($query){
		$json = array("status" => 1, "msg" => "OPERACAO SALVA COM SUCESSO");
	}
	else {
		$json = array("status" => 2, "msg" => "ERRO AO SALVAR OPERACAO");
	}
	
	echo json_encode($json);
});

$app->run();