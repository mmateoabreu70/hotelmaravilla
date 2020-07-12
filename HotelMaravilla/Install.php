<?php

    include("libreria/motor.php");
    $error = "";

    if($_POST)
    {
        $host = $_POST['host'];
        $user = $_POST['user'];
        $pass = $_POST['pass'];
        $db = $_POST['db'];
        $nom = $_POST['nombre'];
        $username = $_POST['username'];
        $userPass = $_POST['userPass'];
        $ok = true;

        if(empty($host) || empty($user) || empty($db) || empty($nom) || empty($username) || empty($userPass))
        {
            $error = "Todos los campos son obligatorios";
            $ok = false;
        }

        if($ok)
        {   
            $con = mysqli_connect($host, $user, $pass);
            
            if($con == false)
            {
                $error = "Revisa, no podemos conectar!";
            } else {
                
                $sql = "CREATE DATABASE {$db}";
                $creada = mysqli_query($con, $sql);

                mysqli_query($con, "USE {$db}");

                $sql = "CREATE TABLE `reservacionstatus` (
                    `idStatus` int(11) NOT NULL,
                    `status` varchar(20) NULL,
                    CONSTRAINT pk_status PRIMARY KEY (`idStatus`)
                  );";
                mysqli_query($con, $sql);

                $sql = "INSERT INTO `reservacionstatus` (`idStatus`, `status`) VALUES
                (1, 'Activo'),
                (2, 'Eliminado');";
                mysqli_query($con, $sql);

                $sql = "CREATE TABLE `tipo_evento` (
                    `idTipoEvent` int(11) NOT NULL,
                    `evento` varchar(30) NULL,
                    CONSTRAINT pk_tipoEvento PRIMARY KEY (`idTipoEvent`)
                  );";
                mysqli_query($con, $sql);

                $sql = "INSERT INTO `tipo_evento` (`idTipoEvent`, `evento`) VALUES
                (1, 'Crear huesped'),
                (2, 'Modificar huesped'),
                (3, 'Eliminar huesped');";
                mysqli_query($con, $sql);

                $sql = "CREATE TABLE `tipo_user` (
                    `idTipo` int(11) NOT NULL,
                    `tipo` varchar(20) NULL,
                    CONSTRAINT pk_tipoUser PRIMARY KEY (`idTipo`)
                  );";
                mysqli_query($con, $sql);

                $sql = "INSERT INTO `tipo_user` (`idTipo`, `tipo`) VALUES
                (1, 'admin'),
                (2, 'user');";
                mysqli_query($con, $sql);

                $sql = "CREATE TABLE `usuarios` (
                    `id` int(11) NOT NULL AUTO_INCREMENT,
                    `nombre` varchar(50)  NOT NULL,
                    `apellido` varchar(50)  NOT NULL,
                    `username` varchar(50)  DEFAULT NULL,
                    `password` varchar(100)  DEFAULT NULL,
                    `tipoId` int(11) DEFAULT NULL,
                    CONSTRAINT pk_usuarios PRIMARY KEY (`id`),
                    CONSTRAINT `fk_usuarios_tipoUser` FOREIGN KEY (`tipoId`) REFERENCES `tipo_user` (`idTipo`)
                  );";
                mysqli_query($con, $sql);

                $sql = "CREATE TABLE `reservaciones` (
                    `id` int(11) NOT NULL AUTO_INCREMENT,
                    `nombre` varchar(40) NULL,
                    `apellido` varchar(40) NULL,
                    `pasaporte` varchar(20) NOT NULL,
                    `email` varchar(70) NULL,
                    `telefono` varchar(11) NULL,
                    `pais` varchar(30) NULL,
                    `llegada` date NULL,
                    `salida` date NULL,
                    `room` varchar(4)  NULL,
                    `idUser` int(11) NOT NULL,
                    `idStatus` int(11) NOT NULL,
                    CONSTRAINT pk_res PRIMARY KEY (`id`),
                    CONSTRAINT `fk_res_usuarios` FOREIGN KEY (`idUser`) REFERENCES `usuarios` (`id`),
                    CONSTRAINT `fk_reserv_status` FOREIGN KEY (`idStatus`) REFERENCES `reservacionstatus` (`idStatus`)
                  );";
                mysqli_query($con, $sql);

                $sql = "CREATE TABLE `logeventos` (
                    `idEvento` int(11) NOT NULL AUTO_INCREMENT,
                    `fecha_hora` datetime NULL,
                    `idTipo` int(11) NOT NULL,
                    `clt_afectado` int(11) NOT NULL,
                    `usuario` int(11) NOT NULL,
                    `dir_ip` varchar(30) NULL,
                    CONSTRAINT pk_log PRIMARY KEY (`idEvento`),
                    CONSTRAINT `fk_log_tipoEvent` FOREIGN KEY (`idTipo`) REFERENCES `tipo_evento` (`idTipoEvent`),
                    CONSTRAINT `fk_log_res` FOREIGN KEY (`clt_afectado`) REFERENCES `reservaciones` (`id`),
                    CONSTRAINT `fk_log_usuarios` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`id`)
                  );";
                mysqli_query($con, $sql);

                $sql = "INSERT INTO usuarios VALUES (1, '$nom', '', '$username', '$userPass', 1)";
                mysqli_query($con, $sql);

                $info = "<?php

                    define('DB_HOST', '{$host}');
                    define('DB_USER', '{$user}');
                    define('DB_PASS', '{$pass}');
                    define('DB_NAME', '{$db}');
                    
                ";

                file_put_contents("libreria/config.php", $info);

                if($creada)
                {
                    header("Location: index.php");
                }
            
            }


        }
    }

?>
    
    <div class="main-div registro">
        <div class="row">
            <h4 id="form-title">Asistente de instalacion</h4>
            <p>Bienvenido! Para instalar el programa debe introducir los siguientes datos:</p>
        </div>

        <span class="errormsg"><?php echo $error ?></span>
        
        <form class="col s12" method="POST">
            <div class="row">
                <div class="input-field col s6">
                    <label for="host">Nombre de servidor</label>
                    <input type="text" name="host" id="host" value="<?php echo $host ?>" required>
                    
                </div>
                <div class="input-field col s6">
                    <label for="user">Usuario</label>
                    <input type="text" name="user" id="user" value="<?php echo $user ?>" required>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <label for="pass">Contraseña</label>
                    <input type="password" name="pass" id="pass" value="<?php echo $pass ?>">
                </div>
                <div class="input-field col s6">
                    <label for="db">Base de datos (Nombre)</label>
                    <input type="text" name="db" id="db" value="<?php echo $db ?>" required>
                </div>
            </div>
            <div class="row">
                <h5>Creando usuario administrador</h5>
                <p>Por favor, inserte los datos del nuevo usuario administrador</p>
                <div class="input-field col s12">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" value="<?php echo $nom ?>" required>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <label for="username">Nombre de usuario</label>
                    <input type="text" name="username" id="username" value="<?php echo $username ?>" required>
                </div>
                <div class="input-field col s6">
                    <label for="userPass">Contraseña</label>
                    <input type="text" name="userPass" id="userPass" value="<?php echo $userPass ?>" required>
                </div>
            </div>


            <div class="submit-div" style="padding: 10px;">
                <input class="btn" type="submit" value="Instalar">
            </div>
        </form>
    </div>

<?php include("libreria/pie.php"); ?>