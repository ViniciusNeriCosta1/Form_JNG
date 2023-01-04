var search = document.getElementById('pesquisar');
var origem = document.getElementById('origem');
var select = document.getElementById('select');

search.addEventListener("keydown", function(event) {
    if (event.key === "Enter") 
    {
        searchDataRetira();
        searchDataSedex();
        searchDataTransporte();
    }
});

function searchDataRetira()
{
    window.location = 'pesquisaRetira.php?select='+select.value+'&search='+search.value;
}

function searchDataSedex()
{
    window.location = 'pesquisaSedex.php?select='+select.value+'&search='+search.value;
}

function searchDataTransporte()
{
    window.location = 'pesquisaTransporte.php?select='+select.value+'&origem='+origem.value+'&search='+search.value;
}