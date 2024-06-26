function mascaraMutuario(o,f){
    v_obj=o
    v_fun=f
    setTimeout('execmascara()',1)
}

function execmascara(){
    v_obj.value=v_fun(v_obj.value)
}

function cpfCnpj(v){

    //Remove tudo o que nÃ£o Ã© dÃ­gito
    v=v.replace(/\D/g,"")

    if (v.length <= 14) { //CPF

        //Coloca um ponto entre o terceiro e o quarto dÃ­gitos
        v=v.replace(/(\d{3})(\d)/,"$1.$2")

        //Coloca um ponto entre o terceiro e o quarto dÃ­gitos
        //de novo (para o segundo bloco de numeros)
        v=v.replace(/(\d{3})(\d)/,"$1.$2")

        //Coloca um hifen entre o terceiro e o quarto di­gitos
        v=v.replace(/(\d{3})(\d{1,2})$/,"$1-$2")

    } else { //CNPJ

        //Coloca ponto entre o segundo e o terceiro dÃ­gitos
        v=v.replace(/^(\d{2})(\d)/,"$1.$2")

        //Coloca ponto entre o quinto e o sexto dÃ­gitos
        v=v.replace(/^(\d{2})\.(\d{3})(\d)/,"$1.$2.$3")

        //Coloca uma barra entre o oitavo e o nono dÃ­gitos
        v=v.replace(/\.(\d{3})(\d)/,".$1/$2")

        //Coloca um hÃ­fen depois do bloco de quatro dÃ­gitos
        v=v.replace(/(\d{4})(\d)/,"$1-$2")

    }

    return v
}


//Aplica a mascara no campo
//Função para ser utilizada nos eventos do input para formatação dinamica
function aplica_mascara_cpfcnpj(campo,tammax,teclapres) {
    var tecla = teclapres.keyCode;

    // Adicione uma verificação para a tecla "Tab" (código 9)
    if (tecla == 9) {
        return true; // Permite a tecla "Tab" sem aplicar a máscara
    }

    if ((tecla < 48 || tecla > 57) && (tecla < 96 || tecla > 105) && tecla != 46 && tecla != 8) {
        return false;
    }

    var vr = campo.value;
    vr = vr.replace( /\//g, "" );
    vr = vr.replace( /-/g, "" );
    vr = vr.replace( /\./g, "" );
    var tam = vr.length;

    if ( tam <= 2 ) {
        campo.value = vr;
    }
    if ( (tam > 2) && (tam <= 5) ) {
        campo.value = vr.substr( 0, tam - 2 ) + '-' + vr.substr( tam - 2, tam );
    }
    if ( (tam >= 6) && (tam <= 8) ) {
        campo.value = vr.substr( 0, tam - 5 ) + '.' + vr.substr( tam - 5, 3 ) + '-' + vr.substr( tam - 2, tam );
    }
    if ( (tam >= 9) && (tam <= 11) ) {
        campo.value = vr.substr( 0, tam - 8 ) + '.' + vr.substr( tam - 8, 3 ) + '.' + vr.substr( tam - 5, 3 ) + '-' + vr.substr( tam - 2, tam );
    }
    if ( (tam == 12) ) {
        campo.value = vr.substr( tam - 12, 3 ) + '.' + vr.substr( tam - 9, 3 ) + '/' + vr.substr( tam - 6, 4 ) + '-' + vr.substr( tam - 2, tam );
    }
    if ( (tam > 12) && (tam <= 14) ) {
        campo.value = vr.substr( 0, tam - 12 ) + '.' + vr.substr( tam - 12, 3 ) + '.' + vr.substr( tam - 9, 3 ) + '/' + vr.substr( tam - 6, 4 ) + '-' + vr.substr( tam - 2, tam );
    }

    return true; // Retorna true para permitir a tecla digitada
}


//Verifica se CPF ou CGC e encaminha para a devida funÃçao, no caso do cpf/cgc estar digitado sem mascara
function verifica_cpf_cnpj(cpf_cnpj) {
	if (cpf_cnpj.length == 11) {
		return(verifica_cpf(cpf_cnpj));
	} else if (cpf_cnpj.length == 14) {
		return(verifica_cnpj(cpf_cnpj));
	} else { 
		return false;
	}
	return true;
}

//Verifica se o numero de CPF informado é valido
function verifica_cpf(sequencia) {
	if ( Procura_Str(1,sequencia,'00000000000,11111111111,22222222222,33333333333,44444444444,55555555555,66666666666,77777777777,88888888888,99999999999,00000000191,19100000000') > 0 ) {
		return false;
	}
	seq = sequencia;
	soma = 0;
	multiplicador = 2;
	for (f = seq.length - 3;f >= 0;f--) {
		soma += seq.substring(f,f + 1) * multiplicador;
		multiplicador++;
	}
	resto = soma % 11;
	if (resto == 1 || resto == 0) {
		digito = 0;
	} else {
		digito = 11 - resto;
	}
	if (digito != seq.substring(seq.length - 2,seq.length - 1)) {
		return false;
	}
	soma = 0;
	multiplicador = 2;
	for (f = seq.length - 2;f >= 0;f--) {
		soma += seq.substring(f,f + 1) * multiplicador;
		multiplicador++;
	}
	resto = soma % 11;
	if (resto == 1 || resto == 0) {
		digito = 0;
	} else {
		digito = 11 - resto;
	}
	if (digito != seq.substring(seq.length - 1,seq.length)) {
		return false;
	}
	return true;
}

//Verifica se o nÃºmero de CNPJ informado Ã© vÃ¡lido
function verifica_cnpj(sequencia) {
	seq = sequencia;
	soma = 0;
	multiplicador = 2;
	for (f = seq.length - 3;f >= 0;f-- ) {
		soma += seq.substring(f,f + 1) * multiplicador;
		if ( multiplicador < 9 ) {
			multiplicador++;
		} else {
			multiplicador = 2;
		}
	}
	resto = soma % 11;
	if (resto == 1 || resto == 0) {
		digito = 0;
	} else {
		digito = 11 - resto;
	}
	if (digito != seq.substring(seq.length - 2,seq.length - 1)) {
		return false;
	}

	soma = 0;
	multiplicador = 2;
	for (f = seq.length - 2;f >= 0;f--) {
		soma += seq.substring(f,f + 1) * multiplicador;
		if (multiplicador < 9) {
			multiplicador++;
		} else {
			multiplicador = 2;
		}
	}
	resto = soma % 11;
	if (resto == 1 || resto == 0) {
		digito = 0;
	} else {
		digito = 11 - resto;
	}
	if (digito != seq.substring(seq.length - 1,seq.length)) {
		return false;
	}
	return true;
}

//Procura uma string dentro de outra string
function Procura_Str(param0,param1,param2) {
	for (a = param0 - 1;a < param1.length;a++) {
		for (b = 1;b < param1.length;b++) {
			if (param2 == param1.substring(b - 1,b + param2.length - 1)) {
				return a;
			}
		}
	}
	return 0;
}

//Retira a mascara do valor de cpf_cnpj
function retira_mascara(cpf_cnpj) {
	return cpf_cnpj.replace(/\./g,'').replace(/-/g,'').replace(/\//g,'')
}
function aplica_mascara_telefone(input) {
    // Remove todos os caracteres que não são dígitos
    var rawValue = input.value.replace(/\D/g, '');
    
    // Verifica o tamanho do número de telefone para aplicar a máscara correta
    if (rawValue.length <= 10) {
        // Máscara para números de telefone com 10 dígitos (XX) XXXX-XXXX
        input.value = rawValue.replace(/^(\d{2})(\d{4})(\d{4})$/, '($1) $2-$3');
    } else {
        // Máscara para números de telefone com 11 dígitos (XX) XXXXX-XXXX
        input.value = rawValue.replace(/^(\d{2})(\d{5})(\d{4})$/, '($1) $2-$3');
    }
}

