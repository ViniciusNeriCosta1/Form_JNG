async function listTrans(valor){
    if(valor.length >= 3){
        const dados = await fetch('loadTrans.php?zb_transportador=' + valor);
        const resposta = await dados.json();

        var html = "<ul class='dropdown'>";

        if(resposta['erro']){
            html += "<li class='list-group-item disabled'>"+ resposta['msg'] +"</li>"
        }else{
            for(i=0; i<resposta['dados'].length; i++){
                html += "<li onclick='get_id_transp("+ resposta['dados'][i].zb_id + "," + 
                JSON.stringify(resposta['dados'][i].zb_transportador) +")'>"+ resposta['dados'][i].zb_transportador +"</li>"
            }
        }
        html += "</ul>";

        document.getElementById('resultado_pesquisa').innerHTML = html;
    }
}

function get_id_transp(id_transp, zb_transportador){
    document.getElementById("id_transp").value = id_transp;
    document.getElementById("transp").value = zb_transportador;
}

const fechar = document.getElementById('transp');
document.addEventListener('click', function(event){
    const validar_clique = fechar.contains(event.target);
    if(!validar_clique){
        document.getElementById('resultado_pesquisa').innerHTML ='';
    }
});