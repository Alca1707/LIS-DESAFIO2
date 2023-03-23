window.onload = initForms;
let autores = [];

function initForms(){
    if (localStorage.getItem('autores') !== null) {
        autores = JSON.parse(localStorage.getItem('autores'));
        autores.forEach(value => {
            addAuthor(document.frmLibros.autores, value, false);
        });
    }

    var datoNombres;
    var datoApellidos;
    document.getElementById("agregarAutor").onclick = function(){
        datoNombres = document.frmLibros.nombres.value;
        datoApellidos = document.frmLibros.apellidos.value;
        if(datoNombres.length > 0 && datoApellidos.length > 0){
            addAuthor(document.frmLibros.autores, datoApellidos + ", " + datoNombres);
        }
        else{
            alert("Debe ingresar un al menos un nombre y un apellido para agregarlo.");
        }
    }

    document.getElementById("autores").onclick = function(){
        var contador = 0;
        for(var i=0; i<document.frmLibros.autores.options.length; i++){
            if(document.frmLibros.autores.options[i].selected){
                contador++;
            }
        }
        if(contador == 0){
            alert("No se han ingresado autores.");
            return false;
        }
    }
}

function addAuthor(optionMenu, value, push = true){
    var posicion = optionMenu.length;
    optionMenu[posicion] = new Option(value, value);

    if (push) {
        autores.push(value);
        localStorage.setItem('autores', JSON.stringify(autores));
    }
}