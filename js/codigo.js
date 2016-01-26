// "use strict";

var contador = 0;

(function(){
    var  btnombre;
    var nombre;
    btnombre = document.getElementById("btnombre");
    nombre = document.getElementById("nombre");
        
    btnombre.addEventListener("click", function(){
        
        var procesarRespuesta = function(){
            if(peticionAsincrona.readyState==4){
                if(peticionAsincrona.status===200){
                    //correcto
                    
                    // var json = JSON.parse(peticionAsincrona.responseText);
                    //nombre.value = json.nombre;
                    
                    alert(peticionAsincrona.response.nombre);
                    //nombre.value=peticionAsincrona.responseText; // Si se pide algo en Json
                    //peticionAsincrona.responseXML; Si se pide algo en xml
                }else{
                    //incorrecto
                    nombre.value="error";
                }
            }
            contador++;
            console.log("me están llamando "+contador);
            console.log("Estado: " + peticionAsincrona.readyState);
            console.log("estatus: " + peticionAsincrona.status)        }
        
        var peticionAsincrona = new XMLHttpRequest();
        peticionAsincrona.open("GET", "getdatos.php"); //si se pone true como tercer parametro es asincrona
        peticionAsincrona.responseType="json";
        peticionAsincrona.send();
        peticionAsincrona.onreadystatechange = procesarRespuesta;        
    }, false);
})();