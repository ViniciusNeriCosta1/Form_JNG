var search = document.getElementById('pesquisar');

search.addEventListener("keydown", function(event) {
    if (event.key === "Enter") 
    {
        searchDataRetira();
    }
});

function searchDataRetira()
{
    window.location = 'pesquisaRetira.php?search='+search.value;
}