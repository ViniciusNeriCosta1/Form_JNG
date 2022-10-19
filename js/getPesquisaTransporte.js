var search = document.getElementById('pesquisar');

search.addEventListener("keydown", function(event) {
    if (event.key === "Enter") 
    {
        searchDataTransporte();
    }
});

function searchDataTransporte()
{
    window.location = 'pesquisaTransporte.php?search='+search.value;
}