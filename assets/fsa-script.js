


$(document).ready(function() {

    // Ao carregar página
    atualizaBarraCalculo();

    // Ao calcular/recalcular frete 
    const buttonCalcular = $('button.page-cart__totals__calculator__form__submit.shipping-calculator-button')[0];
    $(buttonCalcular).on('click',() => {
        
        atualizaBarraCalculo();
    })

    // Ao atualizar produtos do carrinho
    $(document.body).on('updated_cart_totals', function() {

        atualizaBarraCalculo();	
    });

})

/*
** Calcula o valor restante, porcentagem e anima o width
*/
function atualizaBarraCalculo(){

    var inputValue = $('input#calc_shipping_postcode')[0].value;
    // Verifica qual regda o cep se encaixa
    var valorRegda = regdaFaixaDeCep(inputValue)


    // Valor total dos produtos no carrinho
    var totalCarrinhoText = $('.page-cart__totals__value__calculated')[0].innerText;

    // Remove 'R$' do total dos produtos
    var totalCarrinho = parseFloat(totalCarrinhoText.replace('R$', '').trim());

    // Animate o width da barra de cálculo
    var porcentagem = (totalCarrinho / valorRegda) * 100;
    var targetWidth = porcentagem;
    $('.barra-loading').animate({ width: targetWidth + '%' }, 500);


    // Insere o valor float restante no span
    var valorRestante = valorRegda - totalCarrinho
    if(valorRestante <= 0){
        $('.valor-restante-barra').text(`R$$0,00`);

    }else{
        $('.valor-restante-barra').text(`R$${valorRestante}`);
    }
}


/*
** Retorna o valor necessário de acordo com a regda de CEP
*/
function regdaFaixaDeCep(inputValue) {
    console.log(inputValue);
    var formattedValue = inputValue.replace(/\D/g, '');
    
    if (/^\d{5}-\d{3}$/.test(inputValue)) {
        var numericValue = parseInt(formattedValue.replace('-', ''));
        var freteNorte = gerenciador_de_avaliacoes_data.frete_norte;
        var freteNordeste = gerenciador_de_avaliacoes_data.frete_nordeste;
        var freteSul = gerenciador_de_avaliacoes_data.frete_sul;
        var freteSudeste = gerenciador_de_avaliacoes_data.frete_sudeste;
        var freteCentroOeste = gerenciador_de_avaliacoes_data.frete_centro_oeste;


        if (numericValue >= 0100000 && numericValue <= 39999999){
            return freteSudeste
        }
        
        if (numericValue >= 80000000 && numericValue <= 99999999) {
            return freteSul;
        }
        if ((numericValue >= 70000000 && numericValue <= 76799999) || (numericValue >= 78000000 && numericValue <= 79999999)) {
            return freteCentroOeste;
        }
        if ((numericValue >= 66000000 && numericValue <= 69999999) || (numericValue >= 76800000 && numericValue <= 77999999)) {
            return freteNorte;
        }

        if (numericValue >= 40000000 && numericValue <= 65999999){
            return freteNordeste;
        }
    }
}

