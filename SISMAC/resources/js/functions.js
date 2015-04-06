

$(document).ready(function () {



    $("#CPF").mask("999.999.999-99");
    $(".data").mask("99/99/9999");
    $("#cep").mask("99.999-999");
    $("#telefone").mask("(092) 99999-9999");
    $("#cnpj").mask("99.999.999/9999-99");
    $(".datetimepicker").datetimepicker({
        pickTime: false
    });
    $(".cancel").click(function () {
        fechaModal($(this).attr("data-target"));
    });
    $(".side-update").click(function () {
        setInactive($(this).attr("data-parent"), $(this).attr("data-target"), $(this).attr("value"));
    });





    $(".muda-tipo-cliente").click(function () {
        if ($(this).val() == "PF") {
            $(this)
                    .val("PJ")
                    .html("Pessoa fisica");
            $(".cliente-pf").fadeOut(500);
            setTimeout(mountFormPJ, 500);
        } else {
            $(this)
                    .val("PF")
                    .html("Pessoa Jurídica");
            $(".cliente-pj").fadeOut(500);
            setTimeout(mountFormPF, 500);
        }
    });



    $(".money").maskMoney(
            {
                prefix: 'R$ ',
                allowNegative: false,
                thousands: '.',
                decimal: ',',
                affixesStay: true
            }
    );
    $(".loader").load(function () {
        alert('teste');
    });

    $(".markAll").click(function () {
        var check = $(this).prop('checked');
        $("." + $(this).attr("data-target"))
                .each(
                        function () {
                            var atual = $("#totalagrupamento ").html();
                            var myValues = valueAsNumber($(this).val());
                            atual = valueAsNumber(atual);
                            if (check) {
                                if (!($(this).prop('checked'))) {
                                    atual += myValues;
                                } else {
                                    // alert("doing nothing");
                                }
                            } else {
                                if (($(this).prop('checked'))) {
                                    atual -= myValues;
                                } else {
                                    //  alert("doing nothing");
                                }
                            }
                            $("#totalagrupamento ").html(numberAsValue(atual));

                        }
                ).prop("checked", check);
    });
    $(".units").click(function () {
        var check = $(this).prop('checked');
        var atual = $("#totalagrupamento ").html();
        var myValues = valueAsNumber($(this).val());
        var dataToggle = $(this).attr("data-toggle");
        /*     var acrescimo = valueAsNumber($(".acrescimo_" + dataToggle).val());
         var desconto = valueAsNumber($(".desconto_" + dataToggle).val());
         myValues += acrescimo;
         myValues -= desconto;
         alert(dataToggle);/*/
        atual = valueAsNumber(atual);
        if (check) {
            atual += myValues;
        } else {
            atual -= myValues;
        }
        $("#totalagrupamento ").html(numberAsValue(atual));
        //   $("#totalagrupamento ").html( (atual));
        //  $("#totalagrupamento ").mask("000.000.000.000.000,99");
    });
    $(".baixar").click(function () {
        var id = $("#fomulario-baixar-mensalidade").attr("data-target");
        $("#fomulario-baixar-mensalidade").attr("action", "controllers/mensalidade/controller.php?r=0&m=baixar&id=" + id);
        $("#fomulario-baixar-mensalidade").submit();
    });

    $(".valor").keyup(function () {
        var valor = $(this).val();
        $("#extenso").val(valor.extenso(true));
    });

    $(".acrescimo, .desconto").keyup(function () {

        var acrescimo = $(".acrescimo").val();
        //  acrescimo = acrescimo.replace("R$", "").replace(".", "").replace(",", "");
        acrescimo = valueAsNumber(acrescimo);

        var desconto = $(".desconto").val();
        //desconto = desconto.replace("R$", "").replace(",", "").replace(".", "");
        desconto = valueAsNumber(desconto);
        var contrato = $("#valorContrato").html();
        //contrato = contrato.replace("R$", "").replace(",", "").replace(".", "");
        contrato = valueAsNumber(contrato);

        var multa = $(".valor-multa").val();
        //multa = multa.replace("R$", "").replace(",", "").replace(".", "");
        multa = valueAsNumber(multa);

        var moraDia = $(".mora-dia").val();
        // moraDia = moraDia.replace("R$", "").replace(",", "").replace(".", "");
        moraDia = valueAsNumber(moraDia);

        //var mensalidade = new String(new Number(contrato) + new Number(acrescimo) - new Number(desconto));
        // mensalidade = new String(new Number(mensalidade) + new Number(multa) + new Number(moraDia));
        // mensalidade = mensalidade.substring(0, mensalidade.length - 2) + "," + mensalidade.substring(mensalidade.length - 2, mensalidade.length);
        var mensalidade = new Number(contrato + acrescimo - desconto);
        mensalidade = new Number(mensalidade + new Number(multa) + new Number(moraDia));
        mensalidade = numberAsValue(mensalidade);
        //console.log("Mensalidade: "+ mensalidade);
        //alert(mensalidade );
        $("#valorMensalidade").html("R$ " + mensalidade);
    });
    $(".agruparAcrescimo , .agruparDesconto").keyup(function () {
        console.log("passou plo script");
        var parent = $(this).attr("data-parent");
        var target = $(this).attr("data-target");
        var acrescimo = valueAsNumber($(".acrescimo_" + target).val());
        var desconto = valueAsNumber($(".desconto_" + target).val());
        var totalParcial = valueAsNumber($("#" + target).html());
        var total = valueAsNumber($("#" + parent).html());
        var valor = valueAsNumber($(".CLASS_" + target).html());
        var multaMoraDia = new Number($("#MULTA_MORA_DIA_" + target).val());
        multaMoraDia = multaMoraDia.toFixed(2);
        multaMoraDia = valueAsNumber(multaMoraDia);
        /* alert(".c_" + target);
         alert("Valor: " + valor 
         + "\nTotal: " + total
         + "\nTotalParcial: " + totalParcial
         + "\nDesconto: " + desconto
         + "\nAcrescimo: " + acrescimo
         + "\nParent: " + parent
         + "\nTarget: " + target); */
        //alert($("input." + target).prop("checked"));
        if (desconto > valor) {
            $(".modal").modal("show");
            //    desconto = new String(desconto);
            //    desconto = desconto.substring(0, desconto.length - 1);
            //    desconto = numberAsValue(desconto);
            //    $(".desconto_" + target).val(desconto);
        }
        var check = $("input." + target).prop("checked");
        var totalAgrupamento = valueAsNumber($("#totalagrupamento").html());
        if (check) {
            totalAgrupamento -= total;
        }
        total -= totalParcial;
        totalParcial = valor + acrescimo - desconto + multaMoraDia;
        total += totalParcial;
        if (check) {
            totalAgrupamento += total;
            $("#totalagrupamento").html(numberAsValue(totalAgrupamento));
        }
        $("#" + target).html(numberAsValue(totalParcial));
        $("#" + parent).html(numberAsValue(total));
        $("." + target).val(numberAsValue(totalParcial));

    });


    $(".item").click(function () {
        showModal($(this).attr("modal"), $(this).attr("id"), $(this).attr("data-toggle"));
        //  alert($(this).attr("data-parent"));
        $("#alterar-contrato").attr("href", $(this).attr("data-parent"));
    });

    $(".titulo").click(function () {
        mudaBorderRadius($(this).attr("id"));
    });
    $("#idend").click(function () {
        if (validaEndereco()) {
            removeMessage("msg-area-end");
            addEnd($(this).val());
        }
    });
    $("#idtel").click(function () {
        if (validaTelefone($("#telefone").val())) {
            removeMessage("msg-area-tel");
            addTel($(this).val());
        }
    });
    $("#idemail").click(function () {
        if (validaEmail($("#email-cliente").val())) {
            removeMessage("msg-area-email");
            addEmail($(this).val());
        }
    });
    $("#idemb").click(function () {
        if (validaEmbarcacao()) {
            removeMessage("msg-area-emb");
            addEmb($(this).val());
        }
    });
    $("#gravar").click(function () {
        if (validaCliente()) {
            $("#cliente-salvar").submit();
        }
    });
    $(".add-novo").click(function () {

        var target = $(this).attr("data-target");

        $(target + " .btn-info").removeAttr("value");

        console.log(target);

        target = target.substring(1, target.length);

        var lista = getElementsFromContainer(target, "input");

        for (var i = lista.length - 1; i >= 0; i--)
            if (lista[i].attr("type") != "radio")
                lista[i].val("");

        $("#alterar-contrato").css("display", "none");
        var listaReadOnly = getElementsFromContainer(target, " .toReadOnly");
        for (i = 0; i < listaReadOnly.length; i++)
            listaReadOnly[i].prop('disabled', false);

        $(".dtinicio").val(dataAtualPTBR());

    });

    $("input[type=radio]").click(function () {


        var idParent = $(this).attr("class");
        var lista = getElementsFromContainer(idParent, "input[type=radio]");

        for (var i = lista.length - 1; i >= 0; i--) {
            if (!(lista[i].val().match($(this).val()))) {
                lista[i].removeAttr("checked");
            }
        }

        $(this).attr("checked", "checked");

    });

    try{
          $("#extenso").val($(".valor").val().extenso(true));
      }catch(e){
         // alert(e);
      }
  
});




function valueAsNumber(value) {
    while (/\./.test(value))
        value = value.replace(".", "");
    var v = new Number(value.replace("R$", "").replace(",", ""));
    return v;
}
function numberAsValue(number) {
    if (number === 0) {
        return "0,00";
    } else {
        number = new String(number);
        var numberAux = new String();
        for (var i = number.length - 1, j = 1; i >= 0; i--) {
            numberAux = number[i] + numberAux;
            var l = numberAux.length;
            if (l >= 2) {
                if (l == 2) {
                    numberAux = "," + numberAux;
                } else if (l > 2) {
                    j++;
                }
            }
            if (j > 3 && i > 0) {
                if (!(/-/.test(number[i - 1]))) {
                    numberAux = "." + numberAux;
                    j = 1;
                }
            }
        }
        return  numberAux;
    }
}
function dataAtualPTBR() {
    var data = new Date();
    var dataAtual = data.getFullYear();
    var mesAtual = data.getMonth();
    var diaAtual = data.getDate();
    if (mesAtual < 10)
        mesAtual = "0" + mesAtual;
    if (diaAtual < 10)
        diaAtual + "0" + diaAtual;
    dataAtual = diaAtual + "/" + mesAtual + "/" + dataAtual;
    return dataAtual;
}
function moveValue(sender, receiver) {
    var valueToSend = $(sender).val();
    $(receiver).val(valueToSend);
}
function addEmail(val) {
    if (val.length > 0) {
        update(val, "modal-email", "email");
    } else {
        add("email-area", "list-area-email", "modal-email", "quant-email", "input[name=email]", 3);
    }
}
function addTel(val) {
    if (val.length > 0) {
        update(val, "modal-tel", "telefone");
    } else {
        add("telefone-area", "list-area-tel", "modal-tel", "quant-tel", "input[name=telefone]", 1);
    }
}
function addEnd(val) {
    if (val.length > 0) {
        update(val, "modal-end", "bairro");
    } else {
        add("endereco-area", "list-area-end", "modal-end", "quant-end", "input[name=bairro]", 2);
    }
}
function addEmb(val) {
    if (val.length > 0) {
        update(val, "modal-emb", "nomeemb");
    } else {
        add("embarcacao-area", "list-area-emb", "modal-emb", "quant-emb", "input[name=nomeemb]", 4);
    }
}

function add(area, list, modal, quant, input, tipo) {
    var lnk = insertElements(area, modal, tipo);
    incrementHTML(quant);
    var toDisplay = $(idParse(modal) + " " + input).val();
    var item = $("<a/>")
            .click(function () {
                showModal(modal, lnk);
            })
            .html(toDisplay)
            .attr("id", lnk)
            .addClass("col-sm-11");
    mountDisplayList(list, item, function () {
        removeItem(idParse(area), idParse(list), lnk, quant);
    });
    fechaModal(modal);
}
function removeItem(area, lista, idElement, idCounter) {

    //alert(area + "\n" + lista + "\n" +  idElement + "\n" +  idCounter);

    idElement = idParse(idElement);

    $(area + "  " + idElement).remove();
    $(lista + "  " + idElement).parent().remove();

    decrementHTML(idCounter);
}
function setInactive(container, target, quant) {

    $("input[name=" + target + "]").val(0);

    decrementHTML(quant);

    $(container).remove();
}
function update(idContainer, idModal, toUpdate) {

    var listaDados = getElementsFromContainer(idContainer, "input");

    var listaModal = getElementsFromContainer(idModal, "input");

    for (var i = 0, j = 2; i < listaModal.length; i++, j++) {
        if (listaDados[j].hasClass("radio")) {
            if (listaModal[i++].attr("checked") == "checked") {
                listaDados[j].val(listaModal[i - 1].val());
            } else {
                listaDados[j].val(listaModal[i].val());
            }
        } else {
            if (listaModal[i].attr("name").match(toUpdate) != null) {
                $(" p " + idParse(idContainer)).html(listaModal[i].val());
            }
            listaDados[j].val(listaModal[i].val());
        }
    }
    ;

    listaDados = getElementsFromContainer(idContainer, ".select");

    listaModal = getElementsFromContainer(idModal, "select");

    for (i = 0; i < listaModal.length; i++) {
        listaDados[i].val(listaModal[i].val());
    }

    $(idParse(idModal) + " .btn-info").removeAttr("value");

    fechaModal(idModal);
}
function showModal(idModal, idDados, readOnly) {
    // console.log("dataAtual: " + dataAtualPTBR());

    if (readOnly !== undefined) {
        var listaReadOnly = getElementsFromContainer(idModal, ".toReadOnly");
        for (var i = 0; i < listaReadOnly.length; i++) {
            //listaReadOnly[i].attr("readonly","readonly");
            console.log("Bloqueando de: " + listaReadOnly[i].attr("name"));
            listaReadOnly[i].prop('disabled', true);
        }

        $("#alterar-contrato").css("display", "block");
    }


    var listaModal = getElementsFromContainer(idModal, "input");

    var listaDados = getElementsFromContainer(idDados, "input");

    $(idParse(idModal)).modal("show");

    $(idParse(idModal) + " .btn-info").val(idDados);

    for (var i = 0, j = 2; i < listaModal.length; i++, j++) {
        //alert("dados : "+listaDados[j].attr("name")+"\n"+"modal : "+listaModal[i].attr("name"));
        if (listaDados[j].hasClass("radio"))
            if (listaModal[i++].val() == listaDados[j].val())
                listaModal[i - 1].attr("checked", "checked");
            else
                listaModal[i].attr("checked", "checked");
        else
        if (!(listaDados[j].hasClass("select")))
            listaModal[i].val(listaDados[j].val());
    }


    listaDados = getElementsFromContainer(idDados, ".select");
    listaModal = getElementsFromContainer(idModal, "select");
    for (i = 0, j = 0; i < listaModal.length; i++) {
        var listaOpcoes = getElementsFromContainer(idModal, "select[name=" + listaModal[i].attr("name") + "] option");
        for (var k = 0; k < listaOpcoes.length; k++) {
            if (listaDados[i].val() === listaOpcoes[k].val()) {
                //alert("find " + listaDados[i].val() + "\n" + listaOpcoes[k].val());
                listaOpcoes[k].attr("selected", "selected");
            } else {
                //alert("searching yet " + listaDados[i].val() + "\n" + listaOpcoes[k].val());
            }
        }
    }

}

function mountDisplayList(idLista, link, func) {

    idLista = idParse(idLista);

    $(idLista)
            .append($("<p/>")
                    .append(link)
                    .append($("<span/>")
                            .addClass("glyphicon")
                            .addClass("glyphicon-trash")
                            .addClass("float align-right")
                            .click(func)));

}
function addMessageCliente(classMsg, message, title) {
    $("#msg-area").addClass();
    $("#msg-area").addClass(classMsg);
    $("#msg-area").addClass("msg");
    $("#msg-area h2").html();
    $("#msg-area h2").html(title);
    $("#msg-area h4").html();
    $("#msg-area h4").html(message);
}
function addMessage(classFooter, msg) {
    removeMessage(classFooter);
    $(classParse(classFooter))
            .append($("<h4/>").html(msg));

}
function removeMessage(classFooter) {
    $(classParse(classFooter) + " h4 ").remove();
}
function incrementHTML(idElement) {
    var val = getValue(idElement);
    val = new Number(val);
    val++;
    setHtml(idElement, val);
}
function decrementHTML(idElement) {
    var val = getValue(idElement);
    val = new Number(val);
    val--;
    setHtml(idElement, val);
}
function insertElements(idContainer, idFontValues, tipo) {

    var count = countClassElements(idContainer);

    var name = objectName(idContainer);

    var nomeDiv = objectName(idContainer) + "-container-" + count;

    $(idParse(idContainer))
            .append($("<div/>")
                    .attr("id", nomeDiv)
                    .addClass(idContainer)
                    .append($("<input/>")
                            .attr("type", "hidden")
                            .attr("name", "id" + name.substring(0, 3) + count)
                            .attr("value", 0))
                    .append($("<input/>")
                            .attr("type", "hidden")
                            .attr("name", "ativo-" + tipo + "-" + count)
                            .attr("value", 1)));


    var listaDados = getElementsFromContainer(idFontValues, "input");

    var listaSelect = getElementsFromContainer(idFontValues, "select");

    for (var i = 0; i < listaDados.length; i++) {
        name = listaDados[i].attr("name");
        if (listaDados[i].attr("type").match("radio") != null) {
            if (listaDados[i].attr("checked") != "checked") {
                continue;
            }
        }
        name = name + count;
        $(idParse(nomeDiv))
                .append($("<input/>")
                        .attr("type", "hidden")
                        .attr("name", name)
                        .addClass(listaDados[i].attr("type"))
                        .attr("value", listaDados[i].val()));
    }


    for (var i = 0; i < listaSelect.length; i++) {
        name = listaSelect[i].attr("name");
        name = name + count;
        $(idParse(nomeDiv))
                .append($("<input/>")
                        .attr("type", "hidden")
                        .attr("name", name)
                        .addClass("select")
                        .attr("value", listaSelect[i].val()));

    }
    return nomeDiv;
}
function getElementsFromContainer(idContainer, elemenType) {
    var exp = idParse(idContainer) + " " + elemenType;
    return getElementsByType(exp);
}
function getElementsByType(typeOfElements) {
    //alert("onGetElementsByType: "+typeOfElements);
    var lista = new Array();
    $(typeOfElements).each(
            function (index) {
                lista[index] = $(this);
            });

    return lista;
}

function countElementsOnContainer(idContainer, elemenType) {
    var list = getElementsFromContainer(idContainer, elemenType);
    return list.length;
}
function objectName(nameMasked) {
    var whereCut = nameMasked.indexOf("-");

    var newName = nameMasked.substring(0, whereCut);

    return newName;
}
function listaByClass(nomeDaClasse) {

    var lista = document.getElementsByClassName(nomeDaClasse);

    return lista;
}
function countClassElements(nomeDaClasse) {

    var lista = listaByClass(nomeDaClasse);

    return lista.length;
}
function incremmentElement(idElement, idFontOfValue) {

    var curVal = getValue(idElement);

    var increment = getValue(idFontOfValue);

    var somaVal = soma(curVal, increment);

    var cargaCurso = document.getElementById(idElement);

    cargaCurso.value = somaVal;
}
function decrementElement(idElement, idFontOfValue) {

    var curVal = getValue(idElement);

    var increment = getValue(idFontOfValue);

    var dif = less(curVal, increment);

    var cargaCurso = document.getElementById(idElement);

    cargaCurso.value = dif;

}
function removeModulo(IdModulo, IdCarga) {

    decrementElement("cargaCurso", IdCarga);

    removeId(IdModulo);

}
function replaceValue(idContainer, idFontOfValue) {

    var aux = getValue(idFontOfValue);

    setValue(idContainer, aux);

    return;

}
function getValue(idElement) {

    var idParsed = idParse(idElement);
    var value = $(idParsed).val();
    if (value.length < 1)
        return $(idParsed).html();
    return value;
}
function setValue(idElement, value) {

    var idParsed = idParse(idElement);

    $(idParsed).val(value);

    return;
}
function setHtml(idElement, html) {
    var idParsed = idParse(idElement);
    $(idParsed).html(html);
    return;
}
function soma(A, B) {
    return new Number(A) + new Number(B);
}
function less(A, B) {
    return new Number(A) - new Number(B);
}
function idParse(text) {
    return "#" + text;
}
function classParse(text) {
    return "." + text;
}
function validaTelefone(telefone) {
    if (!testeRegExp("[\\(]?[[\\d]{3}]?[\\)]?[\\s]*[\\d]{4,5}[\\-]?[\\d]{4}", telefone))
        addMessage("msg-area-tel", "O numero de telefone não é válido.");
    else
        return true;
    return false;
}
function validaEmail(email) {

    if (isEmpty(email))
        addMessage("msg-area-email", "O e-mail não pode ser vazio.");
    else
        return true;
    return false;
}
function validaEmbarcacao() {
    if (isEmpty($("#modal-emb input[name=nomeemb]").val()))
        addMessage("msg-area-emb", "O nome da embarcação não poder ser vazio.");
    else if (isEmpty($("#modal-emb input[name=vencimento]").val()))
        addMessage("msg-area-emb", "O dia do vencimento não poder ser vazio.");
    else if ($("#modal-emb input[name=vencimento]").val() < 1 || $("#modal-emb input[name=vencimento]").val() > 31)
        addMessage("msg-area-emb", "O dia escolido para o vencimento não é valido.");
    else if (isEmpty($("#modal-emb input[name=datainicio]").val()))
        addMessage("msg-area-emb", "A data para o inicio do contrato não pode ser vazia.");
    else if (isEmpty($("#modal-emb input[name=mensalidade]").val()))
        addMessage("msg-area-emb", "O valor da mensalidade não pode ser vazio.");
    else if (new Number($("#modal-emb input[name=mensalidade]").val().replace(",", ".")) < 1)
        addMessage("msg-area-emb", "O valor da mensalidade não pode ser menor que 1.");
    else
        return true;
    return false;
}
function validaEndereco() {
    if (isEmpty($("#modal-end input[name=rua]").val()))
        addMessage("msg-area-end", "Informe ao menos a rua do cliente.");
    else if (isEmpty($("#modal-end input[name=bairro]").val()))
        addMessage("msg-area-end", "Informe ao menos o bairro do cliente");
    else
        return true;
    return false;
}
function validaCliente() {

    if (isEmpty($("#nome").val()))
        addMessageCliente("msg-erro", "O nome do cliente não pode ser vazio.", "Erro ao Validar Nome.");
    else if (!(isEmpty($("input[name=cpf]").val())))
        if (!(validaCPF($("input[name=cpf]").val())))
            addMessageCliente("msg-erro", "O CPF do cliente não na verificação de autenticidade", "Erro ao Validar CPF.");
        else
            return true;
    else
        return true;
    return false;

}
function validaCPF(cpf) {
    return true;
}
function removeClass(selector) {
    selector = classPrse(selector);
    return remover(selector);
}
function removeId(selector) {
    selector = idParse(selector);
    return remover(selector);
}
function remover(selector) {
    $(selector).remove();
}
function isEmpty(input) {
    return (!testeRegExp("(([a-zA-Z0-9á-źÁ-Ź]+[\s]*)+([\.]*))", input));
}
function testeRegExp(padrao, text) {
    var pattern = new RegExp(padrao);
    return pattern.test(text);
}
function fechaModal(idModal, readOnly) {

    if (readOnly != undefined) {
        var listaReadOnly = getElementsFromContainer(idModal, ".toReadOnly");
        for (var i = 0; i < listaReadOnly.length; i++) {
            listaReadOnly[i].prop('disabled', false);
        }
    }



    var lista = getElementsFromContainer(idModal, "input");

    idModal = idParse(idModal);

    for (var i = lista.length - 1; i >= 0; i--) {
        if (lista[i].attr("type") != "radio" && !lista[i].hasClass("dtinicio")) {
            console.log(lista[i].attr("name") + " - " + lista[i].hasClass("dtinicio"));
            lista[i].val("");
        }
    }


    $(idModal).modal('hide');
}
function mudaBorderRadius(col) {
    col = idParse(col);

    if ($(col).hasClass("col-open")) {
        $(col).removeClass("col-open");
    } else {
        $(col).addClass("col-open");
    }

}

function mountFormPF() {
    $("#form-cliente")
            .removeClass("cliente-pj")
            .addClass("cliente-pf");

    $("#form-cliente label[for=nome]")
            .html("Nome do cliente");
    $("#form-cliente input[name=nome]")
            .attr("placeholder", "Nome do Cliente");
    $("#form-cliente label[for=conjugue]")
            .html("Nome do Conjugue");
    $("#form-cliente input[name=conjugue]")
            .attr("placeholder", "Nome do Conjugue");
    $("#form-cliente label[for=cpf]")
            .html("CPF do Cliente");
    $("#form-cliente input[name=cpf]")
            .remove();
    $(".div-cpf").append(
            $("<input/>")
            .addClass("form-control")
            .attr("placeholder", "XXX.XXX.XXX-XX")
            .attr("id", "CPF")
            .attr("name", "cpf")
            .attr("type", "text"));

    $("#form-cliente label[for=rg]")
            .html("RG Representante");
    $("#form-cliente input[name=rg]")
            .attr("placeholder", "RG do Cliente");
    $("#form-cliente label[for=datanascimento]")
            .html("Data Nascimento");
    $("#cliente-salvar legend").html("Dados Pessoais do Cliente ( Pessoa Física )");
    $("input[name=tipo]").val("f");
    $(".cliente-pf").fadeIn(1000);

}

function mountFormPJ() {

    $("#form-cliente")
            .removeClass("cliente-pf")
            .addClass("cliente-pj");

    $("#form-cliente label[for=nome]")
            .html("Nome da Empresa");
    $("#form-cliente input[name=nome]")
            .attr("placeholder", "Nome da Empresa");
    $("#form-cliente label[for=conjugue]")
            .html("Representante da Empresa");
    $("#form-cliente input[name=conjugue]")
            .attr("placeholder", "Nome do Representante da Empresa");
    $("#form-cliente label[for=cpf]")
            .html("CNPJ da Empresa");
    $("#form-cliente input[name=cpf]")
            .remove();
    $(".div-cpf").append(
            $("<input/>")
            .addClass("form-control")
            .attr("placeholder", "XX.XXX.XXX/XXXX-XX")
            .attr("id", "cnpj")
            .attr("name", "cpf")
            .attr("type", "text"));

    $("#form-cliente label[for=rg]")
            .html("RG Representante");
    $("#form-cliente input[name=rg]")
            .attr("placeholder", "RG Representante");
    $("#form-cliente label[for=datanascimento]")
            .html("Nascimento Representante");
    $("#cliente-salvar legend").html("Dados da Empresa ( Pessoa Jurídica )");
    $("input[name=tipo]").val("j");
    $(".cliente-pj").fadeIn(1000);



}
