function confirme(id)
{
    var pedido = document.getElementById('za_pedido');
    var x;
    var r=confirm("Pedido:" + pedido +"já existe, Deseja inserir mesmo assim?");
    if (r==true)
    {
        x ="atualiza.php?za_id=" + id;
    }
    else
    {
        x = "inserir.php";
    }
    window.location.href=x;
}a