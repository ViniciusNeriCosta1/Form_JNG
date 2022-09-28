function confirme(id)
{
    var x;
    var r=confirm("Deseja informar a saída?");
    if (r==true)
    {
        x ="atualiza.php?za_id=" + id;
    }
    else
    {
        x = "inserir.php";
    }
    window.location.href=x;
}