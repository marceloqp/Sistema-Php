<?php
require '../conexao.php';

$conexao = conexao::getInstance();
$sql = "SELECT * from tab_clientes";
$stm = $conexao->prepare($sql);
$stm->execute();
$clientes = $stm->fetchAll(PDO::FETCH_OBJ);

$conexao = conexao::getInstance();
$sql = "SELECT * from tab_produtos";
$stm = $conexao->prepare($sql);
$stm->execute();
$produtos = $stm->fetchAll(PDO::FETCH_OBJ);

?>
<!DOCTYPE html>
<html>
<head>
	<title>PDV</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/custom.css">	
</head>
<body>
    <div class="container">
	<h1>PDV - Ponto de Venda</h1>
	<form  action="action_venda.php" method="post" id='form-venda' enctype='multipart/form-data'>
		<div class="form-group" >
	      <label for="cliente">Cliente</label>
	      <select class="form-control" name="cliente" id="cliente">
			<?php foreach($clientes as $cliente):?>
				<option value=<?=$cliente->id?>><?=$cliente->nome?></option>
			<?php endforeach;?>
		  </select>
		  <span class='msg-erro msg-status'></span>
	    </div>
		
		<div class="form-group">
	      <label for="produto">Produto</label>
	      <select class="form-control" name="produto" id="produto">
			<?php foreach($produtos as $produto):?>
				<option value=<?=$produto->id?>><?=$produto->nome?></option>
			<?php endforeach;?>
		  </select>
		  <span class='msg-erro msg-status'></span>
	    </div>

	    <div class="form-group">
	      <label for="qtde">Quantidade</label>
	      <input type="numeric" class="form-control" id="qtde" maxlength="3" name="qtde" placeholder="Informe a Quantidade">
              <span class='msg-erro msg-quantidade'></span>
	    </div>

	    <input type="hidden" name="acao" value="venda">
	    <button type="submit" class="btn btn-primary" id='botao'> 
	      Efetuar Venda
	    </button>

	</form>    

	<script type="text/javascript" src="js/custom_venda.js"></script>
    </div>
</body>
</html>