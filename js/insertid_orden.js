function asignar_2(){
    
    var vari1 = parseInt(document.getElementById('id_oculto1').value);
    document.getElementById('pedidos_id').value = vari1;
}

function asignar_lab(){
    var b = parseInt(document.getElementById('laboratorio_select').value);
    var c = document.querySelector("#numero_tel");
    if(b == "1"){
            c.setAttribute("href","https://api.whatsapp.com/send/?phone=22519570");
    }else if(b == "2"){
            c.setAttribute("href","https://api.whatsapp.com/send/?phone=54785820");
    }else if(b == "3"){
            c.setAttribute("href","https://api.whatsapp.com/send/?phone=42357769");
    }else if(b == "4"){
            c.setAttribute("href","https://api.whatsapp.com/send/?phone=31821001");
    }

}