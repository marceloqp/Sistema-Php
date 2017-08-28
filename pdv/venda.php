<?php
    require '../conexao.php';
    
    $conexao = conexao::getInstance();
	$sql = 'SELECT id, nome FROM tab_clientes';
	$stm = $conexao->prepare($sql);
	$stm->execute();
	$clientes = $stm->fetchAll(PDO::FETCH_OBJ);
    
?>
<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <title>LOJA VIRTUAL LPP</title>
       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<title>Cadastro de Vendas</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/custom.css">
</head> 
    
    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Home</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="../clientes/index_cliente.php">Clientes <span class="sr-only">(current)</span></a></li>
                    <li><a href="../produtos/index_produtos.php">Produtos</a></li>
                    <li>
                        <a href="../pdv/venda.php"> Vendas</a>
                    </li>
                </ul>
      
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
  
</nav>
      
    </body>    
</html>