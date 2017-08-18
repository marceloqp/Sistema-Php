<html>
<head>
    <meta charset="utf-8">
	<title>Sistema de Cadastro</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/custom.css">
</head>
<body>
	<div class='container box-mensagem-crud'>
	<?php 
		require '../conexao.php';

		// Atribui uma conexão PDO
		$conexao = conexao::getInstance();

		// Recebe os dados enviados pela submissão
		$acao  = (isset($_POST['acao'])) ? $_POST['acao'] : '';
		$id    = (isset($_POST['id'])) ? $_POST['id'] : '';
		$nome  = (isset($_POST['nome'])) ? $_POST['nome'] : '';
		$quantidade   = (isset($_POST['quantidade'])) ? $_POST['quantidade']: '';
		$preco = (isset($_POST['preco'])) ? $_POST['preco'] : '';
        
        // Valida os dados recebidos
		$mensagem = '';
		if ($acao == 'editar' && $id == ''):
		    $mensagem .= '<li>ID do registros desconhecido.</li>';
	    endif;
            // Se for ação diferente de excluir valida os dados obrigatórios
	    if ($acao != 'excluir'):
			if ($nome == '' || strlen($nome) < 3):
				$mensagem .= '<li>Favor preencher o Nome.</li>';
		    endif;

			if ($quantidade == NULL):
			   $mensagem .= '<li>Favor preencher a quantidade.</li>';
		    elseif(!(($quantidade)>0) ):
				  $mensagem .= '<li>Quantidade Invalida.</li>';
		    endif;

			if ($preco == ''):
				$mensagem .= '<li>Favor informar o preço.</li>';
			endif;

			

			if ($mensagem != ''):
				$mensagem = '<ul>' . $mensagem . '</ul>';
				echo "<div class='alert alert-danger' role='alert'>".$mensagem."</div> ";
				exit;
			endif;

		endif;



		// Verifica se foi solicitada a inclusão de dados
		if ($acao == 'incluir'):

 
			     
                	$sql = 'INSERT INTO tab_produtos (nome, quantidade, preco)
							   VALUES(:nome, :quantidade, :preco)';

			$stm = $conexao->prepare($sql);
			$stm->bindValue(':nome', $nome);
			$stm->bindValue(':quantidade', $quantidade);
			$stm->bindValue(':preco', $preco);
			
			$retorno = $stm->execute();

			if ($retorno):
				echo "<div class='alert alert-success' role='alert'>Registro inserido com sucesso, aguarde você está sendo redirecionado ...</div> ";
		    else:
		    	echo "<div class='alert alert-danger' role='alert'>Erro ao inserir registro!</div> ";
			endif;

			echo "<meta http-equiv=refresh content='3;URL=index_produtos.php'>";
		endif;


		// Verifica se foi solicitada a edição de dados
		if ($acao == 'editar'):

			

			$sql = 'UPDATE tab_produtos SET nome=:nome, quantidade=:quantidade, preco=:preco ';
			$sql .= 'WHERE id = :id';

			$stm = $conexao->prepare($sql);
                       
			$stm->bindValue(':nome', $nome);
			$stm->bindValue(':quantidade', $quantidade);
			$stm->bindValue(':preco', $preco);
                        $stm->bindValue(':id', $id);
                        //echo ($id.$nome.$preco.$quantidade.$acao);
                        //echo(var_dump($stm));
                        //exit();
			$retorno = $stm->execute();

			if ($retorno):
				echo "<div class='alert alert-success' role='alert'>Registro editado com sucesso, aguarde você está sendo redirecionado ...</div> ";
		    else:
		    	echo "<div class='alert alert-danger' role='alert'>Erro ao editar registro!</div> ";
			endif;

			echo "<meta http-equiv=refresh content='3;URL=index_produtos.php'>";
		endif;


		// Verifica se foi solicitada a exclusão dos dados
		if ($acao == 'excluir'):

			// Exclui o registro do banco de dados
			$sql = 'DELETE FROM tab_produtos WHERE id = :id';
			$stm = $conexao->prepare($sql);
			$stm->bindValue(':id', $id);
			$retorno = $stm->execute();

			if ($retorno):
				echo "<div class='alert alert-success' role='alert'>Registro excluído com sucesso, aguarde você está sendo redirecionado ...</div> ";
		    else:
		    	echo "<div class='alert alert-danger' role='alert'>Erro ao excluir registro!</div> ";
			endif;

			echo "<meta http-equiv=refresh content='3;URL=index_produtos.php'>";
		endif;
		?>