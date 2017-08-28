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
                $status = (isset($_POST['status'])) ? $_POST['status'] : '';
                $data = (isset($_POST['data'])) ? $_POST['data'] : '';
                
                $mensagem = '';
		if ($acao == 'estornar' && $id == ''):
		    $mensagem .= '<li>ID do registros desconhecido.</li>';
                endif;
                
                if ($acao != 'excluir'):
			if ($cliente == '' || strlen($cliente) < 3):
				$mensagem .= '<li>Favor preencher o Cliente.</li>';
		    endif;

			if ($quantidade == NULL):
			   $mensagem .= '<li>Favor preencher a quantidade.</li>';
		    elseif(!(($quantidade)>0) ):
				  $mensagem .= '<li>Quantidade Invalida.</li>';
		    endif;

			if ($preco == ''):
				$mensagem .= '<li>Favor informar o produto.</li>';
			endif;

			

			if ($mensagem != ''):
				$mensagem = '<ul>' . $mensagem . '</ul>';
				echo "<div class='alert alert-danger' role='alert'>".$mensagem."</div> ";
				exit;
			endif;

                endif;
                
        ?>

</body>
</html>