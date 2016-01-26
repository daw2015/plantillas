// "use strict";
var contador = 0;

(function(){
    var btLogin;
    var user, password, texto, btlogout;
    var texto = document.getElementById("texto");
    btLogin = document.getElementById("btlogin2");
    login = document.getElementById("login");
    clave = document.getElementById("clave");
    btlogout = document.getElementById("btlogout");
    
    btLogin.addEventListener("click", function(){
       var procesarRespuesta = function(){
           if(peticionAsincrona.readyState == 4){
                if(peticionAsincrona.status == 200){
                    if(peticionAsincrona.response.login){
                        var divLogin = document.getElementById('divLogin');
                        divLogin.classList.add("ocultar");
                        var divRespuesta = document.getElementById('divRespuesta');
                        divRespuesta.classList.remove("ocultar");
                    }else{
                        var mensaje = document.getElementById("mensajeError");
                        mensaje.classList.remove("ocultar");
                    }
                }else{
                    alert('error');
                }
           }
       };
       var peticionAsincrona = new XMLHttpRequest();
       var datoLogin = encodeURI (login.value);
       var datoClave = encodeURI(clave.value);
       peticionAsincrona.open("GET", "ajaxLogin.php?login="+datoLogin+"&clave="+datoClave);
       peticionAsincrona.responseType="json";
       peticionAsincrona.setRequestHeader(
            "Content-type",
            "application/x-www-form-urlencoded");
      peticionAsincrona.send();
      peticionAsincrona.onreadystatechange = procesarRespuesta;
      
      
      /*POST
      peticionAsincrona.open("POST", "login.php");
      peticionAsincrona.responseType="json";
      peticionAsincrona.setRequestHeader(
            "Content-type",
            "application/x-www-form-urlencoded");
      peticionAsincrona.send("login="+datoLogin+"&clave="+datoClave);
       peticionAsincrona.onreadystatechange = procesarRespuesta;*/
    }, false);

        btlogout.addEventListener("click", function(){
        var procesarRespuesta = function(){
           if(logoutAsincrona.readyState == 4){
                if(logoutAsincrona.status == 200){
                    if(!logoutAsincrona.response.login){
                        var divLogin = document.getElementById('divLogin');
                        divLogin.classList.remove("ocultar");
                        var divRespuesta = document.getElementById('divRespuesta');
                        divRespuesta.classList.add("ocultar");
                         var mensaje = document.getElementById("mensajeError");
                         mensaje.classList.add("ocultar");
                    }
                }else{
                    alert('error');
                }
           }
       };
       var logoutAsincrona = new XMLHttpRequest();
       logoutAsincrona.open("GET", "ajaxLogout.php");
       logoutAsincrona.responseType="json";
       logoutAsincrona.send();
       logoutAsincrona.onreadystatechange = procesarRespuesta;
        }, false);

       var procesarRespuesta = function(){
           if(comprobarLoginAsincrono.readyState == 4){
                if(comprobarLoginAsincrono.status == 200){
                    if(comprobarLoginAsincrono.response.login){
                        var divLogin = document.getElementById('divLogin');
                        divLogin.classList.add("ocultar");
                        var divRespuesta = document.getElementById('divRespuesta');
                        divRespuesta.classList.remove("ocultar");
                    }
                }else{
                    alert('error');
                }
           }
       };
    
    var comprobarLoginAsincrono = new XMLHttpRequest();
       comprobarLoginAsincrono.open("GET", "ajaxLogueado.php");
       comprobarLoginAsincrono.responseType="json";
       comprobarLoginAsincrono.send();
       comprobarLoginAsincrono.onreadystatechange = procesarRespuesta;
})();