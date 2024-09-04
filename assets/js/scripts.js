function adicionarLinha() {

    var tabela = document.getElementById('minhaTabela').getElementsByTagName('tbody')[0];

    
    var novaLinha = document.createElement('tr');

    // Cria as células (td) da nova linha e define o HTML dentro delas
    novaLinha.innerHTML = `
        <td><input type="text" class="input" name="produto"></td>
        <td><input type="text" class="input" name="quantidade"></td>
        <td><input type="text" class="input" name="valorParcial"></td>
        <td><img class="deleteLinha" src="assets/images/remover.svg" alt="" /></td>
    `;

    
    tabela.appendChild(novaLinha);
}


var tabela = document.getElementById('minhaTabela')

tabela.addEventListener("click", function(event){
    var elementoClicado = event.target;
    if(elementoClicado.classList.contains("deleteLinha")){
        var btRemover = elementoClicado.parentNode;
        var removeLinha = btRemover.parentNode;
        removeLinha.remove();
    }
})



