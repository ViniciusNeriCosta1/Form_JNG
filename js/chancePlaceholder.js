$("#filtro").on("change", function() {
    var vatExpense = $("#filtro option:selected").val();
    var vatPlaceholder = "";
    if (vatExpense == "za_pedido") {
        vatPlaceholder = "Nº Pedido";
    } else if (vatExpense == "za_dt_entrada") {
        vatPlaceholder = "Ano-Mês-Dia";
    }
    $("#pesquisar").attr("placeholder", vatPlaceholder);
});