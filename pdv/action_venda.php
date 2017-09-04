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
                
                $acao  = (isset($_POST['acao'])) ? $_POST['acao'] : '';
		$id    = (isset($_POST['id'])) ? $_POST['id'] : '';
		$cliente  = (isset($_POST['cliente'])) ? $_POST['cliente'] : '';
		$quantidade   = (isset($_POST['quantidade'])) ? $_POST['quantidade']: '';
		$produto = (isset($_POST['produto'])) ? $_POST['produto'] : ''; 
                $status = 'Ativa';
                $data  = date('d-m-Y H:i');
                
                
               
                $mensagem = '';
		if ($acao == 'estornar' && $id == ''):
		    $mensagem .= '<li>ID do registros desconhecido.</li>';
                endif;
                
                if ($acao != 'estornar'):
			
                $sql = 'SELECT quantidade from tab_produtos WHERE nome = :produto';
                $stm = $conexao->prepare($sql);
                $stm->bindValue(':produto', $produto);
                $stm->execute();
                $estoque = $stm->fetch(PDO::FETCH_OBJ);
                $aux = ($estoque->quantidade);
			if ($quantidade == NULL):
			   $mensagem .= '<li>Favor preencher a quantidade.</li>';
		    
                    elseif(($quantidade) > ($aux)):
                                $mensagem.= '<li> Quantidade insuficiente em Estoque.';
		    endif;

			if ($mensagem != ''):
				$mensagem = '<ul>' . $mensagem . '</ul>';
				echo "<div class='alert alert-danger' role='alert'>".$mensagem."</div> ";
				exit;
			endif;

                endif;
                if ($acao == 'incluir'):
                 
                        
                   
                $sql = 'SELECT quantidade from tab_produtos WHERE nome = :produto';
                $stm1 = $conexao->prepare($sql);
                $stm1->bindValue(':produto', $produto);
                $stm1->execute();
                $estoque = $stm1->fetch(PDO::FETCH_OBJ);
                $aux = ($estoque->quantidade);
                $aux = ($aux - $quantidade);
                
                $sql4 = 'UPDATE tab_produtos SET quantidade =:quantidade WHERE nome =:produto';
                $stm = $conexao->prepare($sql4);
                $stm->bindValue(':produto', $produto);
                $stm->bindValue(':quantidade',$aux);
                $stm->execute();
                $retorno = $stm->execute();
			     
                	$sql = 'INSERT INTO tab_vendas (cliente, quantidade, produto, data, status)
							   VALUES(:cliente, :quantidade, :produto, :data, :status)';

			$stm = $conexao->prepare($sql);
			$stm->bindValue(':cliente', $cliente);
			$stm->bindValue(':quantidade', $quantidade);
			$stm->bindValue(':produto', $produto);
                        $stm->bindValue(':data', $data);
                        $stm->bindValue(':status', $status);
			
			$retorno = $stm->execute();

			if ($retorno):
				echo "<div class='alert alert-success' role='alert'>Registro inserido com sucesso, aguarde você está sendo redirecionado ...</div> ";
		    else:
		    	echo "<div class='alert alert-danger' role='alert'>Erro ao inserir registro!</div> ";
			endif;

			echo "<meta http-equiv=refresh content='3;URL=venda.php'>";
		endif;
                
                if ($acao == 'estornar'){
                $sql = 'SELECT * FROM tab_vendas WHERE id =:id';
                $stm2 = $conexao->prepare($sql);
                $stm2->bindValue(':id', $id);
                $stm2->execute();
                $venda = $stm2->fetch(PDO::FETCH_OBJ);
                        
                $produto = $venda->produto;    
                $sql = 'SELECT quantidade from tab_produtos WHERE nome = :produto';
                $stm1 = $conexao->prepare($sql);
                $stm1->bindValue(':produto', $produto);
                $stm1->execute();
                $estoque = $stm1->fetch(PDO::FETCH_OBJ);
                $aux = ($estoque->quantidade);
                $aux = ($aux + ($venda->quantidade));
                
                $sql4 = 'UPDATE tab_produtos SET quantidade =:quantidade WHERE nome =:produto';
                $stm = $conexao->prepare($sql4);
                $stm->bindValue(':produto', $produto);
                $stm->bindValue(':quantidade',$aux);
                $stm->execute();
                $retorno = $stm->execute();
                
                
                
                $auxEst = 'Estornada';
                $sql3 = 'UPDATE tab_vendas SET status =:status WHERE id =:id';
                $stm = $conexao->prepare($sql3);
                $stm->bindValue(':id', $id);
                $stm->bindValue(':status', $auxEst);
                $stm->execute();
                $retorno = $stm->execute();

			if ($retorno):
				echo "<div class='alert alert-success' role='alert'>Registro editado com sucesso, aguarde você está sendo redirecionado ...</div> ";
                        else:
		    	echo "<div class='alert alert-danger' role='alert'>Erro ao editar registro!</div> ";
			endif;

			echo "<meta http-equiv=refresh content='3;URL=venda.php'>";

                }
        ?>

</body>
</html>