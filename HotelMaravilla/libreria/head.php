<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="js/hotel.js"></script>
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/jquery.mask.js"></script>
    <style>
        .errormsg {
            font-weight: bold;
            color: red;
        }
    </style>

</head>
<body>
    <nav>
        <div class="nav-wrapper">
            <a href="Index.php" class="brand-logo"><i class="material-icons">business</i>Hotel Maravilla</a>
            
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                
                <?php
                    if(isset($_SESSION['user']))
                    {
                        echo "
                            <li><span style='padding-right: 10px;'>Hola, " . $_SESSION['nombre'] . "</span></li>
                            <li><a href='Index.php' title='Inicio'><i class='material-icons'>home</i></a></li>
                        ";

                        if($_SESSION['tipo'] == "admin")
                        {
                            echo "
                                <li><a href='GestionUsuario.php'>Gestionar usuarios</a></li>
                                <li><a href='LogEventos.php'>Log de eventos</a></li>
                            ";
                        }

                        echo "
                            <li><a href='GestionHuesped.php' title='Gestiona los huespedes que has registrado'>Gestionar huespedes</a></li>
                            <li><a href='funcion.php?accion=logout' title='Cerrar Sesion'><i class='material-icons'>exit_to_app</i></a></li>
                        ";
                    } 
                ?>
            </ul>
        </div>
    </nav>
    
