"use strict";
(function () {
    var misCiudades = [];
    var login, clave, btlogin, btlogout, btInsertar, mensajeInsertar, formularioInsertar,
    idFormulario, btEditar;
    idFormulario = document.getElementById("ID");
    btInsertar = document.getElementById("btInsertar");
    btEditar = document.getElementById("btEditar");
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
    
    btEditar.addEventListener("click",function() {
        var procesarRespuesta = function (respuesta) {
            if (respuesta.edit > 0) {
                formularioInsertar.modal('toggle');
                var registro = {
                    "ID": idFormulario.value,
                    "Name":name.value,
                    "CountryCode":countryCode.value,
                    "District":district.value,
                    "Population":population.value
                };
                //misCiudades.push(registro);
                reemplazarCiudad(registro);
                refrescoCiudades(misCiudades);
            } else {
                mensajeInsertar.textContent = "Algo fallo al editar la ciudad";
            }
        };
        var ajax = new Ajax();
        var datoName = encodeURI(name.value);
        var datoCountrycode = encodeURI(countryCode.value);
        var datoDistrict = encodeURI(district.value);
        var datoPopulation = encodeURI(population.value);
        ajax.setUrl("ajaxCityEdit.php?ID="+idFormulario.value +"&Name=" + datoName + "&CountryCode=" + datoCountrycode
                 + "&District=" + datoDistrict + "&Population=" + datoPopulation);
        ajax.setRespuesta(procesarRespuesta);
        ajax.doPeticion();
    });
    
    function reemplazarCiudad(ciudad){
        var ciudadOriginal = getCiudad(ciudad.ID);
        ciudadOriginal.Name = ciudad.Name;
        ciudadOriginal.CountryCode = ciudad.CountryCode;
        ciudadOriginal.Population = ciudad.Population;
        ciudadOriginal.District = ciudad.District;
    }

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

    $(document).on("click", "#botonInsertarDialog", function () {
        document.getElementById("btEditar").style.display = "none";
        document.getElementById("btInsertar").style.display = "inline";
    });

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
    
    function borrarCiudad(link, id){
        link.addEventListener("click", function (event) {
                event.preventDefault();
                if (window.confirm("Borrar?")) {
                    borrarElemento(id);
                    //alert(id); //idCiudad tiene el valor esperado: closure
                }
            }, false);
    }
    
        function getCiudad(id){
        for(var i=0; i<misCiudades.length; i++){
            if(misCiudades[i].ID == id){
                return misCiudades[i];
            }
        }
    }
    
    function editarCiudad(link, ciudad){
        link.addEventListener("click", function (event) {
                event.preventDefault();
                document.getElementById("btEditar").style.display = "inline";
                document.getElementById("btInsertar").style.display = "none";
                idFormulario.value = ciudad.ID;
              //  var ciudad = getCiudad(id);
                name.value = ciudad.Name;
                countryCode.value = ciudad.CountryCode;
                district.value = ciudad.District;
                population.value = ciudad.Population;
            }, false);
    }
    
    function refrescoCiudades(listaCiudades){
        var li, idCiudad;
        var idLista = "listaDeCiudades";
        var lista = document.getElementById(idLista);
        if(lista){
            borrarNodo(lista);
        }
        var myList = document.createElement("ul");
        var enlace, enlaceEditar;
        myList.id = idLista;
        for(var i=0; i<listaCiudades.length; i++){
            li = document.createElement("li");
            idCiudad = listaCiudades[i].ID;
            li.textContent = listaCiudades[i].Name;
            enlace = document.createElement("a");
            enlaceEditar = document.createElement("a");
            //data-toggle="modal" data-target="#formularioInsertar"
            enlaceEditar.setAttribute("data-toggle", "modal");
            enlaceEditar.setAttribute("data-target", "#formularioInsertar");
            enlace.className = "borrar";
            enlace.href = "#";
            enlaceEditar.href = "#";
            enlace.textContent = "Borrar  ";
            enlaceEditar.textContent = "Editar  ";
            borrarCiudad(enlace, idCiudad);
            editarCiudad(enlaceEditar, listaCiudades[i]);
            
            /* enlace.addEventListener("click", function (event) {
                event.preventDefault();
                if (window.confirm("Borrar?")) {
                    //borrarElemento(idCiudad);
                    alert(idCiudad); //idCiudad no tiene el valor esperado: closure (por la posicion en la que está)
                }
            }, false); */
            
            li.appendChild(enlace);
            li.appendChild(enlaceEditar);
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