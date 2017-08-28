/* Atribui ao evento submit do formulário a função de validação de dados */
var form = document.getElementById("form-contato");
if (form != null && form.addEventListener) {                   
    form.addEventListener("submit", validaCadastro);
} else if (form != null && form.attachEvent) {                  
    form.attachEvent("onsubmit", validaCadastro);
}

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
function validaCadastro(evt){
	var nome = document.getElementById('nome');
	var preco = document.getElementById('preco');
	var quantidade = document.getElementById('quantidade');
	var filtro = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
	var contErro = 0;


	/* Validação do campo nome */
	caixa_nome = document.querySelector('.msg-nome');
	if(nome.value == ""){
		caixa_nome.innerHTML = "Favor preencher o Nome";
		caixa_nome.style.display = 'block';
		contErro += 1;
	}else{
		caixa_nome.style.display = 'none';
	}

	/* Validação do campo preco */
	caixa_preco = document.querySelector('.msg-preco');
	if(preco.value == ""){
		caixa_preco.innerHTML = "Favor preencher o Preço";
		caixa_preco.style.display = 'block';
		contErro += 1;
	}else {
		caixa_preco.style.display = 'none';
	}

	/* Validação do campo quantidade */
	caixa_quantidade = document.querySelector('.msg-quantidade');
	if(quantidade.value == ""){
		caixa_quantidade.innerHTML = "Favor preencher a Quantidade";
		caixa_quantidade.style.display = 'block';
		contErro += 1;
	}else{
		caixa_quantidade.style.display = 'none';
	}
        
        if(contErro > 0){
		evt.preventDefault();
	}
}