function asignar_3(){
    
    var vari1 = parseInt(document.getElementById('id_oculto2').value);
    document.getElementById('id_venta').value = vari1;
}

function suma_auto(){
    var p_lente = parseFloat(document.getElementById('precio_lente').value) || 0;
    var p_montura = parseFloat(document.getElementById('precio_montura').value) || 0;
    var p_accs = parseFloat(document.getElementById('precio_accs').value) || 0;
    var abono = parseFloat(document.getElementById('abono').value) || 0;
    var total = p_lente + p_montura + p_accs;
    var saldo = total - abono;

    document.getElementById('total').value = total;
    document.getElementById('saldo').value = saldo;
}