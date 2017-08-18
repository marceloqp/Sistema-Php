var linkExclusao_produto = document.querySelectorAll(".link_exclusao_produto");
if (linkExclusao_produto != null) { 
	for ( var i = 0; i < linkExclusao_produto.length; i++ ) {
		(function(i){
			var id_produto = linkExclusao_produto[i].getAttribute('rel');

			if (linkExclusao_produto[i].addEventListener){
		    	linkExclusao_produto[i].addEventListener("click", function(){confirmaExclusao_produto(id_produto);});
			}else if (linkExclusao_produto[i].attachEvent) { 
				linkExclusao_produto[i].attachEvent("onclick", function(){confirmaExclusao_produto(id_produto);});
			}
		})(i);
	}
}
function confirmaExclusao_produto(id){
	retorno = confirm("Deseja excluir esse Registro?");

	if (retorno){

	    //Cria um formulário
	    var formulario = document.createElement("form");
	    formulario.action = "action_produto.php";
	    formulario.method = "post";

		// Cria os inputs e adiciona ao formulário
	    var inputAcao = document.createElement("input");
	    inputAcao.type = "hidden";
	    inputAcao.value = "excluir";
	    inputAcao.name = "acao";
	    formulario.appendChild(inputAcao); 

	    var inputId = document.createElement("input");
	    inputId.type = "hidden";
	    inputId.value = id;
	    inputId.name = "id";
	    formulario.appendChild(inputId);

	    //Adiciona o formulário ao corpo do documento
	    document.body.appendChild(formulario);

	    //Envia o formulário
	    formulario.submit();
	}
}

