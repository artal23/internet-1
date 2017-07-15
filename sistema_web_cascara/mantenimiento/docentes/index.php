<?php
session_start();

require_once("..\..\clases/conexion/conexion.php");
    $con=$conexion;


?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>SISTEMA DE PROCESOS DE ADMISION</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link href="estilo.css" rel="stylesheet" type="text/css">
        
    </head>


    <body class="fixed-left">

              <!-- COMIENZO DE PAGINA -->
        <div id="envoltura">

            <!-- COMIENZO DE BARRA TOP -->
            <div class="barra-top">
                <!-- LOGO -->
                <div class="barra-top-izquierda">

                    <a href="#" class="logo">Proyecto</a>
                </div>
                
                
            </div>
            <!-- Barra top fin -->


            <!-- ========== MENU Izquierda ========== -->

            <div class="izq menu-lateral">
                <div class="menu-dentro slimscrollleft">

                   
                    <div class="detalles-usuario">
                        <div class="text-center">
                            <img src="../img/admin.jpg" alt="" class="img-circle">
                        </div>
                        <div class="info-usuario">
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">ADMINISTRADOR</a>
                                <ul class="dropdown-menu">
                                    <li><a href=""> Perfil</a></li>
                                    <li><a href=""> Configuracion   </a></li>
                                    <li class="divider"></li>
                                    <li><a href=""> Cerrar Sesion</a></li>
                                </ul>
                            </div>


                        </div>
                    </div>
                    <!--- DIVISOR -->


                    <div id="menu-barra" >
                        <ul>
                            <li>
                                <a href="index.html" ><span> INICIO </span></a>
                            </li>
                            <li class="activado" >
                                <a href="mantenimiento/" ><span> MANTENIMIENTO </span></a>
                            </li>
                            <li>
                                <a href="#"><span> CREAR PREGUNTA </span></a>
                            </li>
                            <li>
                                <a href="#"><span> SELECCIONAR PREGUNTAS</span></a>
                            </li>
                            <li>
                                <a href="#"><span> SELECCIONAR PROCESO </span></a>
                            </li>
                            <li>
                                <a href="#"><span> IMPORTAR DATOS </span></a>
                            </li>
                            <li>
                                <a href="#"><span> EXPORTAR SELECCION</span></a>
                            </li>
                            <li>
                                <a href="#"><span> SALIR </span></a>
                            </li>

                        </ul>
                    </div>
                  
                    <div class="clearfix"></div>
                </div> <!-- MENU INTERIOR -->
            </div>
        </div>
            <!-- MENU IZQUIERDA -->


            <!-- CONTENIDO AQUI -->

            <div class="pagina-contenido">
                <!-- Contenido -->
               
                <div class="contenido">
                      
                    <div class="cabecera-titulo">
                            <h1>LISTADO DE DOCENTES</h1>
                        </div>
                </div><!-- contenedor -->
             <div class="container">
              
            
            <div class="row" id="m_tabla" >
                            
                            
                    <div class="col-sm-3 col-md-3">
                                    <a href="crear_adm.php" class="btn btn-primary ">
                                        <span class="fa fa-check-square"></span> Ingresar nuevo Docente
                                            </a>
                                    
                    </div>
                    <div class="col-sm-1 col-md-1"></div>
                    <div class="col-sm-1 col md-1"></div>
                    <div class="col-sm-3 c  ol-md-3">
                             <div class="btn-group">
                                <button class="btn btn-primary " data-toggle="dropdown" id="boton">
                            	  Filtrar por cargo <span class="caret"></span>
                                </button>
                                    <ul class="dropdown-menu" id="filtro">
                                        <?php
									       $query=mysqli_query($con,"SELECT * FROM tipo_participante WHERE tipo='admin' ");
									       while($d=mysqli_fetch_array($query)){
                                                    echo '<li><a href="index.php?cargo='.$d['cargo'].'">'.$d['cargo'].'</a></li>';	
                                            }
                                        ?>
                                        <li class="divider"></li>
                                        <li><a href="index.php?cargo=todos">Todos</a></li>
                                    </ul>
                                </div> 
                            </div>
                    <div class="col-sm-4 col-md-4">
                            <form name="form1" method="post" action="index.php">
                              <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Buscar por Nombres / Apellidos / DNI" aria-describedby="basic-addon2">
                                    <span class="input-group-addon" id="basic-addon2"><span class="glyphicon glyphicon-search"></span>
                              </div>
                               
                            </form> 
                            </form> 
                            </div>
                
        
        </div>
        <div class="row" id="tabla_ad">
                   <br>
                    <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Dni</th>
                        <th>Apellido</th>
                        <th>Nombre</th>
                        <th>Dependencia</th>
                        <th>Telefono</th>
                        <th>Correo</th>
                        <th>Cargo</th>
                    
                        <th>Actualizar</th>
                        <th>Eliminar</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                       if(empty($_GET['cargo'])){
					   if(empty($_POST['bus']))
                       {
						  $sql="SELECT * FROM participante ORDER BY apellidos";
					   }else{
						      $bus=$_POST['bus'];
						      $sql="SELECT * FROM participante WHERE nombre LIKE '$bus%' or apellidos LIKE '$bus%' or dni='$bus' ORDER BY apellidos";
					       }
				        }
                        else
                        {
					       $bus=$_GET['cargo'];
					       if($bus<>"todos"){
						          $sql="SELECT * FROM participante WHERE cargo='$bus' ORDER BY apellidos";
					           }
                           else{
						          $sql="SELECT * FROM participante ORDER BY apellidos";
					           }
				        
                        }
                       
                       $query=mysqli_query($con,$sql);


                        
                        while($d=mysqli_fetch_array($query))
                            {
                             echo '<tr><td>'.$d['dni'].'</td><td>'.$d['apellidos'].'</td><td>'.$d['nombre'].'</td><td>'.$d['dependencia'].'</td><td>'.$d['telefono'].'</td><td>'.$d['correo'].'</td><td>'.$d['cargo'].'</td><td>BOTONactulizar</td><td>BOTONELIMINAR</td>';	
                            }
                       
                       
                        ?>

                    
                </tbody>
                </table>
                <?php
                 if(!$d=mysqli_fetch_array($query))
                 {
                     echo '<div class="alert alert-info" align="center"><strong>No hay Administrativos Registrados</strong></div>' ;
                     
                 }
                ?>
                </div>
                <br><br><br>
            </div> <!-- pagina contenido -->
        </div> 
              


            <!-- Fin del contenido de la pagina-->


        <!-- Fin de la envoltura-->
    </body>
</html>