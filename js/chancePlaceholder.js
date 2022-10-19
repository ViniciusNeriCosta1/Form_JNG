$("#filtro").on("change", function() {
    var vatExpense = $("#filtro option:selected").val();
    var vatPlaceholder = "";
    switch(vatExpense){
        case "za_pedido":
            vatPlaceholder = "Nº Pedido"
            break
        case "za_dt_entrada":
            vatPlaceholder = "Ano-Mês-Dia"
            break
        case "za_nf":
            vatPlaceholder = "Nº NF"
            break
        default:
            vatPlaceholder = "teste"
    }
    $("#pesquisar").attr("placeholder", vatPlaceholder);
});