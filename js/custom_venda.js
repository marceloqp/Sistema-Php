var form = document.getElementById("form-contato");
if (form != null && form.addEventListener) {                   
    form.addEventListener("submit", validaCadastro);
} else if (form != null && form.attachEvent) {                  
    form.attachEvent("onsubmit", validaCadastro);
}

function validaCadastro(){
    var quantidade = document.getElementById('quantidade');
    
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

