var search = document.getElementById('pesquisar');

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
    window.location = 'pesquisaRetira.php?search='+search.value;
}

function searchDataSedex()
{
    window.location = 'pesquisaSedex.php?search='+search.value;
}

function searchDataTransporte()
{
    window.location = 'pesquisaTransporte.php?search='+search.value;
}