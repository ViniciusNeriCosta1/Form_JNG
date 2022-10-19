var search = document.getElementById('pesquisar');

search.addEventListener("keydown", function(event) {
    if (event.key === "Enter") 
    {
        searchDataSedex();
    }
});

function searchDataSedex()
{
    window.location = 'pesquisaSedex.php?search='+search.value;
}