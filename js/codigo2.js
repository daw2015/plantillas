// "use strict";

var contador = 0;

(function(){
    var btedad;
    var edad;
    btedad = document.getElementById("btedad");
    edad = document.getElementById("edad");
    
    btedad.addEventListener("click", function(){
       var peticionAsincrona = new XMLHttpRequest();
       var procesarRespuesta = function(){
           var r = peticionAsincrona.response;
           edad.value = r.edad;
       }
       peticionAsincrona.open("POST", "getdatos.php");
       peticionAsincrona.responseType="json";
       peticionAsincrona.setRequestHeader(
            "Content-type",
            "application/x-www-form-urlencoded");
      var dato = encodeURI("Pepe Pérez"); // Hay que usarlo siempre que aparezcan carácteres extraños
      peticionAsincrona.send("id=23&nomre="+dato);
      peticionAsincrona.onreadystatechange = procesarRespuesta;
    }, false);
    
})();