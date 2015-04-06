$(document).ready(function(){

	$(function() {
	    $( "#sortable" ).sortable({
	      placeholder: "ui-state-default"
	    });
	    $( "#sortable" ).disableSelection();
	  });
	
	$("#salvar").click(function(){addModulo()});

});

function addModulo(){

	if( $("#salvar").val() === true){

		replaceModulo();

		$("#salvar").val(false);

		return ;

	}else if ( !validaNovoModulo()){
		return;
	}

	incremmentElement("cargaCurso","cargaModulo");

	addElements("sortable","modulo","nomeModulo","cargaModulo");

	fechaModal("addModulo");
}

function listaByClass(nomeDaClasse){

		var lista = document.getElementsByClassName(nomeDaClasse);

		return lista;	
}

function countClassElements(nomeDaClasse){

	var lista = listaByClass(nomeDaClasse);
	
	return lista.length;
}
function validaNovoModulo(){

	if(isEmpty(getValue("nomeModulo"))) {
		if(isEmpty($("#msg-m").html())){
			$("#msg-m").append("Nome do modulo é obrigatório!");
		}		
		return false;
	}else{
		removeId("msg-m");
	}
	if (isEmpty(getValue("cargaModulo"))) {
		if(isEmpty($("#msg-c").html())){
			$("#msg-c").append("Carga do modulo é obrigatório!");
		}
		return false;
	}else{
		removeId("msg-c");
	}

	var modulos = listaByClass("nomeMod");

	var  teste = true;

	var novo = getValue("nomeModulo");

	var re = new RegExp(novo);

	for(i = 0 ; i < modulos.length - 1 ; i++){
		teste = teste &&  (!(re.test(modulos[i].value)));
	}
	return teste;
	
}
function incremmentElement(idElement,idFontOfValue){

	var curVal	 		= getValue(idElement);

	var increment 		= getValue(idFontOfValue);

	var somaVal 		= soma(curVal , increment);

	var cargaCurso  	= document.getElementById(idElement);

	cargaCurso.value 	= somaVal;

}
function decrementElement(idElement,idFontOfValue){

	var curVal	 		= getValue(idElement);

	var increment 		= getValue(idFontOfValue);

	var dif 			= less(curVal , increment);

	var cargaCurso  	= document.getElementById(idElement);

	cargaCurso.value 	= dif;

}

function addElements(idContainer,classOfElements,fontOfValue,fontOfCarga){
		
		var numero 		= countClassElements(classOfElements);
			
		var valor 		= getValue(fontOfValue);

		var nameId 		= classOfElements+"_"+numero;

		var nameCarga	= "carga_"+numero;

		var cargaModuloVal	= getValue(fontOfCarga);

		var nomeModulo 	= $("<input/>")
							.addClass("btn")
							.addClass("nomeMod")
							.attr("name",nameId)
							.attr("id",nameId+"mod")
							.attr("readonly","readonly")
							.attr("required","required")
							.attr("value",valor);

		var cargaModulo = $("<input/>")
							.addClass("btn")
							.addClass("cargaMod")
							.attr("readonly","readonly")
							.attr("name",nameCarga)
							.attr("id",nameCarga)
							.attr("required","required")
							.attr("value",cargaModuloVal);

		var excluir		= $("<a/>")
							.append($("<span/>")
								.addClass("glyphicon")
								.addClass("glyphicon-trash"))
							.click(function (){removeModulo(nameId,nameCarga)});

		var dados 		= $("<div/>")
							.append(nomeModulo)
							.append(cargaModulo)
							.click(function(){editModulo(nameId+"mod",nameCarga)});


		$(idParse(idContainer))
			.append($("<li/>")
//				.append($("<div/>")
					.addClass(classOfElements)
					.attr("id",nameId)
					.append(dados)
					.append(excluir));//);

		var fontOfValue = document.getElementById(fontOfValue);

		fontOfValue.value = "";

		fontOfValue = document.getElementById(fontOfCarga);

		fontOfValue.value = "";
}

function removeModulo(IdModulo,IdCarga){

	decrementElement("cargaCurso",IdCarga);

	removeId(IdModulo);

}
function replaceValue(idContainer,idFontOfValue){

	var aux = getValue(idFontOfValue);

	setValue(idContainer,aux);

	return;

}
function replaceModulo(){

	var modAux = getValue("modAux");

	var cargaAux = getValue("cargaAux");

	replaceValue(modAux,"nomeModulo");

	replaceValue(cargaAux,"cargaModulo");

	incremmentElement("cargaCurso","cargaModulo");

	replaceValue("nomeModulo","");

	replaceValue("cargaModulo","");

	removeId("modAux");

	removeId("cargaAux");

	$("#addModulo").modal("hide");
}
function editModulo( modulo , carga ){

	var moduloVal 	= getValue(modulo);

	var cargaVal 	= getValue(carga);

	$("#addModulo").modal("show");

	$("#salvar").val(true);

	$("#nomeModulo").val(moduloVal);

	$("#cargaModulo").val(cargaVal);

	$("#body-modal")
		.append($("<input/>")
			.attr("id","modAux")
			.attr("value",modulo)
			.attr("type","hidden"));

	$("#body-modal")
		.append($("<input/>")
			.attr("id","cargaAux")
			.attr("value",carga)
			.attr("type","hidden"));

	decrementElement("cargaCurso",carga);

}

function getValue(idElement){

	var idParsed = idParse(idElement);

	return $(idParsed).val();
}

function setValue(idElement,value){

	var idParsed = idParse(idElement);

	$(idParsed).val(value);

	return
}

function soma( A , B ){
	return new Number( A ) + new Number(B);
}
function less( A , B){
	return new Number(A) -  new Number(B);
}
function idParse(text){
	return "#" + text;
}
function classParse(text){
	return "." + text;
}
function removeClass(selector){
	selector = classPrse(selector);
	return remover(selector);
}
function removeId(selector){
	selector = idParse(selector);
	return remover(selector);
}
function remover(selector){
	$(selector).remove();
}
function isEmpty(input){
	//alert("isEmpty  \n" + input + "\n" + (!testeRegExp("(([a-zA-Z0-9á-ź]+[\s]*)+([\.]*))",input)));
	return (!testeRegExp("(([a-zA-Z0-9á-źÁ-Ź]+[\s]*)+([\.]*))",input));
}
function testeRegExp(padrao,text){
	var pattern = new RegExp(padrao);
	return pattern.test(text);
}
function fechaModal(idModal){

	idModal = idParse(idModal);

	$(idModal).modal('hide');
}
function teste(){

	for(i = 0 ; i < 10 ; i ++){
	
	$("#sortable").append(
			$("<li/>")
				.append("teste")
				.addClass("ui-state-default"));
	
	}

}

