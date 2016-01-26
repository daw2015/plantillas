"use strict";
(function () {
    var misCiudades = [];
    var login, clave, btlogin, btlogout, btInsertar, mensajeInsertar, formularioInsertar;
    btInsertar = document.getElementById("btInsertar");
    btlogin = document.getElementById("btlogin2");
    btlogout = document.getElementById("btlogout");
    login = document.getElementById("login");
    clave = document.getElementById("clave");
    var divLogin = document.getElementById("divLogin");
    var divRespuesta = document.getElementById("divRespuesta");
    var mensaje = document.getElementById("mensajeError");
    var divCiudades = document.getElementById("divCiudades");
    var mensajeInsertar = document.getElementById("mensajeInsertar");
    var formularioInsertar = $("#formularioInsertar");
    var formulariosModalesInsertar = $(".form-Insertar");
    var name = document.getElementById("Name");
    var countryCode = document.getElementById("CountryCode");
    var district = document.getElementById("District");
    var population = document.getElementById("Population");
    formularioInsertar.on('hidden.bs.modal', function () {
        name.value = "";
        countryCode.value = "";
        district.value = "";
        population.value = "";
    });
    /*
    Le falta un ratillo de estudio
    formulariosModalesInsertar.each(function(){
        $(this).on('hidden.bs.modal', function () {
            name.value = "";
            countryCode.value = "";
            district.value = "";
            population.value = "";
            var formulario = $(this).getElementsByTagName("form")[0];
            formulario.reset();
        });
    });
    */
    
    var pagina = 1;
    var paginas = 1;

    btInsertar.addEventListener("click",function() {
        var procesarRespuesta = function (respuesta) {
            if (respuesta.insert > 0) {
                formularioInsertar.modal('toggle');
                var registro = {
                    "ID":respuesta.insert,
                    "Name":name.value,
                    "CountryCode":countryCode.value,
                    "District":district.value,
                    "Population":population.value
                };
                misCiudades.push(registro);
                refrescoCiudades(misCiudades);
            } else {
                mensajeInsertar.textContent = "Algo fallo al insertar la ciudad";
            }
        };
        var ajax = new Ajax();
        var datoName = encodeURI(name.value);
        var datoCountrycode = encodeURI(countryCode.value);
        var datoDistrict = encodeURI(district.value);
        var datoPopulation = encodeURI(population.value);
        ajax.setUrl("ajaxCityInsert.php?Name=" + datoName + "&CountryCode=" + datoCountrycode
                 + "&District=" + datoDistrict + "&Population=" + datoPopulation);
        ajax.setRespuesta(procesarRespuesta);
        ajax.doPeticion();
    });

    btlogin.addEventListener("click", function () {
        var procesarRespuesta = function (respuesta) {
            if (respuesta.login) {
                divLogin.classList.add("ocultar");
                divRespuesta.classList.remove("ocultar");
                peticionCiudades();
            } else {
                mensaje.classList.remove("ocultar");
            }
        };
        var ajax = new Ajax();
        var datoLogin = encodeURI(login.value);
        var datoClave = encodeURI(clave.value);
        ajax.setUrl("ajaxLogin.php?login=" + datoLogin + "&clave=" + datoClave);
        ajax.setRespuesta(procesarRespuesta);
        ajax.doPeticion();
    }, false);

    btlogout.addEventListener("click", function () {
        var procesarRespuesta = function (respuesta) {
            if (!respuesta.login) {
                divLogin.classList.remove("ocultar");
                divRespuesta.classList.add("ocultar");
                mensaje.classList.add("ocultar");
            }
        };
        var ajax = new Ajax();
        ajax.setUrl("ajaxLogout.php");
        ajax.setRespuesta(procesarRespuesta);
        ajax.doPeticion();
    }, false);

    var procesarRespuesta = function (respuesta) {
        if (respuesta.login) {
            divLogin.classList.add("ocultar");
            divRespuesta.classList.remove("ocultar");
            peticionCiudades();
        }
    };
    var ajax = new Ajax();
    ajax.setUrl("ajaxLogueado.php");
    ajax.setRespuesta(procesarRespuesta);
    ajax.doPeticion();
    
    function borrarElementoMisCiudades(listaCiudades,id){
        for(var i=0; i<listaCiudades.length; i++){
            if(listaCiudades[i].ID == id){
                listaCiudades.splice(i,1);
            }
        }
    }
    
    function borrarElemento(id){
        var procesarRespuesta = function (respuesta) {
            if(respuesta.delete > 0){
                //borrar del array el elemento
                borrarElementoMisCiudades(misCiudades,id);
                refrescoCiudades(misCiudades);
            }else{
                alert("La ciudad no se ha podido borrar.");
            }
        };
        var ajax = new Ajax();
        ajax.setUrl("ajaxCityDelete.php?ID=" + id);
        ajax.setRespuesta(procesarRespuesta);
        ajax.doPeticion();
    }
    
    function estoLoHagoParaEvitarLasClausuras(){
        
    }
    
    function refrescoCiudades(listaCiudades){
        var idLista = "listaDeCiudades";
        var lista = document.getElementById(idLista);
        if(lista){
            borrarNodo(lista);
        }
        var myList = document.createElement("ul");
        var enlace;
        myList.id = idLista;
        for(var i=0; i<listaCiudades.length; i++){
            var li = document.createElement("li");
            var idCiudad = listaCiudades[i].ID;
            li.textContent = listaCiudades[i].Name;
            enlace = document.createElement("a");
            enlace.className = "borrar";
            enlace.href = "#";
            enlace.textContent = "Borrar  " + idCiudad;
            enlace.addEventListener("click", function (event) {
                event.preventDefault();
                if (window.confirm("Borrar?")) {
                    //borrarElemento(idCiudad);
                    alert(idCiudad);
                }
            }, false);
            li.appendChild(enlace);
            myList.appendChild(li);
        }
        divCiudades.appendChild(myList);
    }
    
    var peticionCiudades = function(){
        var procesarRespuesta = function(respuesta){
            misCiudades = respuesta.ciudades;
            refrescoCiudades(misCiudades);
            paginas = respuesta.paginas;
        };
        var ajax = new Ajax();
        ajax.setUrl("ajaxciudades.php?pagina=" + pagina);
        ajax.setRespuesta(procesarRespuesta);
        ajax.doPeticion();
    };
    
    var siguiente = document.getElementById("siguiente");
    siguiente.addEventListener("click", siguienteFunc);
    function siguienteFunc(e) {
        e.preventDefault();
        pagina++;
        if(pagina > paginas){
            pagina = paginas;
        }
        peticionCiudades();
    };
    
    var anterior = document.getElementById("anterior");
    anterior.addEventListener("click", anteriorFunc);
    function anteriorFunc(e) {
        e.preventDefault();
        if(pagina>1){
            pagina--;
        }
        peticionCiudades();
    };
    
    function borrarNodo(padre){
        if (padre.parentNode) {
            padre.parentNode.removeChild(padre);
        }
    }
})();