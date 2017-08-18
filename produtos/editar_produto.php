<?php
require '../conexao.php';

// Recebe o id do cliente do cliente via GET
$id_produto = (isset($_GET['id'])) ? $_GET['id'] : '';

// Valida se existe um id e se ele é numérico
if (!empty($id_produto) && is_numeric($id_produto)):

	// Captura os dados do cliente solicitado
	$conexao = conexao::getInstance();
	$sql = 'SELECT id, nome, quantidade, preco FROM tab_produtos WHERE id = :id';
	$stm = $conexao->prepare($sql);
	$stm->bindValue(':id', $id_produto);
	$stm->execute();
	$produtos = $stm->fetch(PDO::FETCH_OBJ);

	

endif;

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<title>Edição de Produtos</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/custom.css">
</head>
<body>
	<div class='container'>
		<fieldset>
			<legend><h1>Formulário - Edição de Produtos</h1></legend>
			
			<?php if(empty($produtos)):?>
				<h3 class="text-center text-danger">Produto não encontrado!</h3>
			<?php else: ?>
				<form action="action_produto.php" method="post" id='form-contato' enctype='multipart/form-data'>
				    <div class="form-group">
				      <label for="nome">Nome</label>
				      <input type="text" class="form-control" id="nome" name="nome" value="<?=$produtos->nome?>" placeholder="Infome o Nome">
				      <span class='msg-erro msg-nome'></span>
				    </div>

				    <div class="form-group">
				      <label for="quantidade">Quantidade</label>
				      <input type="quantidade" class="form-control" id="quantidade" name="quantidade" value="<?=$produtos->quantidade?>" placeholder="Informe a quantidade">
				      <span class='msg-erro msg-quantidade'></span>
				    </div>

				    <div class="form-group">
				      <label for="preco">Preço</label>
				      <input type="preco" class="form-control" id="preco"  name="preco" value="<?=$produtos->preco?>" placeholder="Informe o Preço">
				      <span class='msg-erro msg-cpf'></span>
				    </div>
				    <input type="hidden" name="acao" value="editar">
				    <input type="hidden" name="id" value="<?=$produtos->id?>">
                                    <div>
				    <button type="submit" class="btn btn-primary" id='botao'> 
				      Gravar
				    </button>
                                    <a href='index_produtos.php' class="btn btn-danger">Cancelar</a>
                                    </div>
				</form>
			<?php endif; ?>
		</fieldset>

	</div>
	<script type="text/javascript" src="../js/custom.js"></script>
</body>
</html>