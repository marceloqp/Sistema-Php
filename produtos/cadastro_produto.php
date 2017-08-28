<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<title>Cadastro de Produtos</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/custom.css">
</head>
<body>
    <div class='container'>
        <fieldset>
			<legend><h1>CADASTRO DE PRODUTOS</h1></legend>
			
			<form action="action_produto.php" method="post" id='form-contato' enctype='multipart/form-data'>
				

			    <div class="form-group">
			      <label for="nome">Nome</label>
			      <input type="text" class="form-control" id="nome" name="nome" placeholder="Infome o Nome">
			      <span class='msg-erro msg-nome'></span>
			    </div>

			    <div class="form-group">
			      <label for="quantidade">Quantidade</label>
                              <input type="number" class="form-control" id="quantidade" name="quantidade" placeholder="Informe a quantidade">
			      <span class='msg-erro msg-quantidade'></span>
			    </div>

			    <div class="form-group">
			      <label for="preco">Preço</label>
                              <input type="float" class="form-control" id="preco" name="preco" placeholder="Informe o Preço">
			      <span class='msg-erro msg-preco'></span>
			    </div>
			   
			    

			    <input type="hidden" name="acao" value="incluir">
			    <button type="submit" class="btn btn-primary" id='botao'> 
			      Gravar
			    </button>
                            <a href='index_produtos.php' class="btn btn-danger">Cancelar</a>
			</form>
		</fieldset>
	</div>
    <script type="text/javascript" src="../js/custom_produto.js"></script>
    
    
    
    
    
    
</body>


</html>
