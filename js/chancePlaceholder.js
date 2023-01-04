$("#select").on("change", function() {
    var vatExpense = $("#select option:selected").val();
    var vatPlaceholder = "";
    switch(vatExpense){
        case "za_pedido":
            vatPlaceholder = "Nº Pedido"
            break
        case "za_dt_saida":
            vatPlaceholder = "Ano-Mês-Dia"
            break
        case "za_dt_entrada":
            vatPlaceholder = "Ano-Mês-Dia"
            break
        case "za_nf":
            vatPlaceholder = "Nº NF"
            break    
    }
    $("#pesquisar").attr("placeholder", vatPlaceholder);
});