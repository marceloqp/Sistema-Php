<?php
    require '../conexao.php';
    $termo = (isset($_GET['termo'])) ? $_GET['termo'] : '';
    
    if (empty($termo)):
    $conexao = conexao::getInstance();
	$sql = 'SELECT id, cliente, produto,quantidade, status, data  FROM tab_vendas';
	$stm = $conexao->prepare($sql);
	$stm->execute();
	$venda = $stm->fetchAll(PDO::FETCH_OBJ);
    else: 
        // Executa uma consulta baseada no termo de pesquisa passado como parâmetro
	$conexao = conexao::getInstance();
	$sql = 'SELECT id, cliente, produto,quantidade, status, data  FROM tab_vendas WHERE cliente LIKE :cliente OR data LIKE :data';
	$stm = $conexao->prepare($sql);
	$stm->bindValue(':cliente', $termo.'%');
	$stm->bindValue(':data', $termo.'%');
	$stm->execute();
	$venda = $stm->fetchAll(PDO::FETCH_OBJ);
    endif;
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
                <a class="navbar-brand" href="../index.php">Home</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="../clientes/index_cliente.php">Clientes <span class="sr-only">(current)</span></a></li>
                    <li><a href="../produtos/index_produtos.php">Produtos</a></li>
                    <li><a href="../pdv/venda.php"> Vendas</a></li>
                    <li><a href="../relatorios/index_relatorios">Relatórios</a></li>
                </ul>
      
    </div>
  </div>
  
</nav>
      <div class='container'>
		<fieldset>

			<!-- Cabeçalho da Listagem -->
			<legend><h1>Listagem de Vendas</h1></legend>

			<!-- Formulário de Pesquisa -->
			<form action="" method="get" id='form-contato' class="form-horizontal col-md-10">
				<label class="col-md-2 control-label" for="termo">Pesquisar</label>
				<div class='col-md-7'>
			    	<input type="text" class="form-control" id="termo" name="termo" placeholder="Infome o Cliente ou o produto">
				</div>
			    <button type="submit" class="btn btn-primary">Pesquisar</button>
                            <a href='venda.php' class="btn btn-primary">Ver Todas</a>
			</form>

			<!-- Link para página de cadastro -->
                        <a href='cadastro_venda.php' class="btn btn-success pull-right">Cadastrar Vendas</a>
                        <br></br>
                        
			<div class='clearfix'></div>

			<?php if(!empty($venda)):?>

				<!-- Tabela de Venda -->
				<table class="table table-striped">
					<tr class='active'>
                                                <th>Num. Venda</th>
						<th>Cliente</th>
						<th>Produto</th>
						<th>Quantidade</th>
                                                <th>Data</th>
						<th>Status</th>
						<th>Ação</th>
					</tr>
					<?php foreach($venda as $venda):?>
						<tr>
                                                        <td><?=$venda->id?></td>
							<td><?=$venda->cliente?></td>
							<td><?=$venda->produto?></td>
							<td><?=$venda->quantidade?></td>
                                                        <td><?=$venda->data?></td>
							<td><?=$venda->status?></td>
							<td>
								
								<a href='javascript:void(0)' class="btn btn-danger linkEstorno_venda" rel="<?=$venda->id?>">Estornar</a>
							</td>
						</tr>	
					<?php endforeach;?>
				</table>

			<?php else: ?>

				
				<h3 class="text-center text-primary">Não existem vendas cadastradas!</h3>
			<?php endif; ?>
		</fieldset>
	</div>
	<script type="text/javascript" src="../js/custom_venda.js"></script>
    </body>    
</html>
