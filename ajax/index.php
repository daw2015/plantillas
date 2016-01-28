<?php
require '../clases/AutoCarga.php';
$bd = new DataBase();
$gestorCountry = new ManageCountry($bd);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>{titulo}</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../estilo/vendor/bootstrap.min.css">
        <link rel="stylesheet" href="../estilo/vendor/bootstrap-theme.min.css">
        <link rel="stylesheet" href="../estilo/estilo.css">
        <script src="../js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    </head>
    <body>
        <!-- aqui van los dialogos -->
        <!-- Modal -->
        <div class="modal fade modal-form" id="formularioInsertar" role="dialog">
            <div class="modal-dialog">

        <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <form id="formInsertar" >
                            Nombre
                            <input type="text" id="Name" value="" /><hr>
                            Pais
                            <?php echo Util::getSelect("CountryCode", $gestorCountry->getValuesSelect());?><br/>
                            Distrito
                            <input type="text" id="District" value="" /><hr>
                            Poblacion
                            <input type="number" id="Population" value="" /><hr>
                            <input type="hidden" id="ID" value="" /><hr>
                        </form>
                    </div>
                    <div id="mensajeInsertar" ></div>
                    <div class="modal-footer">
                        <button id="btInsertar" type="button" class="btn btn-default" >Insert</button>
                        <button id="btEditar" type="button" class="btn btn-default" >Edit</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- fin dialogos -->
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">{titulo}</a>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="">Inicio</a></li>
                        <li><a href="#">Acerca</a></li>
                        <li><a href="#">Contacto</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Acciones <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Acción 1</a></li>
                                <li><a href="#">Acción 2</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Acción 3</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Login</a></li>
                                <li><a href="#">Registrarse</a></li>
                            </ul>
                        </li>
                    </ul>
                    <form class="navbar-form navbar-right">
                        <div class="form-group">
                            <input type="text" placeholder="e-mail" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="password" placeholder="clave" class="form-control">
                        </div>
                        <button id="btlogin" type="button" class="btn btn-success">acceder</button>
                    </form>
                </div><!--/.navbar-collapse -->
            </div>
        </div>
        <div class="jumbotron">
            <div class="container">
                <h1>{titulo}</h1>
                <p>{subtitulo}</p>
                <p><a class="btn btn-primary btn-lg" role="button">{boton} &raquo;</a></p>
            </div>
        </div>
        <div class="container">
            <div class="row" id="divLogin">
                <h1>Login</h1>
                <input type="text"     id="login"    value=""      placeholder="nombre de usuario"/>
                <input type="password" id="clave"    value=""      placeholder="clave de acceso" />
                <input type="button"   id="btlogin2" value="login" /><br/>
                <span class="ocultar" id="mensajeError">Fallo al iniciar la sesión.</span>
            </div>
            <div class="row ocultar" id="divRespuesta">
                <h1>Estás logueado.</h1>
                <h2><a href="#" id="btlogout">Cerrar sesión</a></h2>
            </div>
            <div class="row" id="divCiudades">
                <a href="#" id="anterior" >Anterior</a>
                <a href="#" id="siguiente" >Siguiente</a>
                <a href="#" id="insertar" >Insertar</a>
                <button id="botonInsertarDialog" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#formularioInsertar">Insertar</button>
                <br/>
            </div>
            <hr>
            <footer>
                <p>&copy; {pie}</p>
            </footer>
        </div>
        <script src="../js/vendor/jquery-1.11.1.js"></script>
        <script src="../js/vendor/bootstrap.min.js"></script>
        <script src="../js/ajax.js"></script>
        <script src="../js/codigoLogin.js"></script>
    </body>
</html>
<?php $bd->close(); ?>