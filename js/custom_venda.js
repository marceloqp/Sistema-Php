var form = document.getElementById("form-venda");
if (form != null && form.addEventListener) {
    form.addEventListener("submit", validaCadastro);
} else if (form != null && form.attachEvent) {
    form.attachEvent("onsubmit", validaCadastro);
}

var linkEstorno_venda = document.querySelectorAll(".linkEstorno_venda");
if (linkEstorno_venda != null) {
    for (var i = 0; i < linkEstorno_venda.length; i++) {
        (function (i) {
            var id_produto = linkEstorno_venda[i].getAttribute('rel');

            if (linkEstorno_venda[i].addEventListener) {
                linkEstorno_venda[i].addEventListener("click", function () {
                    confirmaEstorno(id_produto);
                });
            } else if (linkEstorno_venda[i].attachEvent) {
                linkEstorno_venda[i].attachEvent("onclick", function () {
                    confirmaEstorno(id_produto);
                });
            }
        })(i);
    }
}

function confirmaEstorno(id) {
    retorno = confirm("Deseja estornar esta Venda?");

    if (retorno) {

        //Cria um formulário
        var formulario = document.createElement("form");
        formulario.action = "action_venda.php";
        formulario.method = "post";

        // Cria os inputs e adiciona ao formulário
        var inputAcao = document.createElement("input");
        inputAcao.type = "hidden";
        inputAcao.value = "estornar";
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
	
	var quantidade = document.getElementById('quantidade');
        
	
	var contErro = 0;


	

	
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