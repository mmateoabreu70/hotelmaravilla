<?php
    session_start();
    include("libreria/motor.php");
    conexion::getInstance();

    $mensaje = "";

    if($_POST)
    {
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $username = $_POST['username'];

        $user = new Usuario();
        $user->Nombre = $_POST['nombre'];
        $user->Apellido = $_POST['apellido'];
        $user->User = $_POST['username'];
        $user->Pass = $_POST['pass'];
        $result = $user->CrearUsuario();
        $mensaje = $result;

        if($result == true)
        {
            header("Location: Login.php");
        }
    }

?>
    
    <div class="main-div registro">
        <div class="row">
            <h4 id="form-title">Registrate</h4>
        </div>
        <p class="errormsg"> <?php echo $mensaje ?> </p>
        <form class="col s12" method="POST" >
            <div class="row">
                <div class="input-field col s6">
                    <input id="nombre" name="nombre" type="text" value="<?php echo $nombre ?>" class="validate" required>
                    <label for="nombre">Nombres</label>
                </div>
                <div class="input-field col s6">
                    <input id="apellido" name="apellido" type="text" value="<?php echo $apellido ?>" class="validate" required>
                    <label for="apellido">Apellidos</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <input id="username" name="username" type="text" value="<?php echo $username ?>" class="validate" required>
                    <label for="username">Nombre de usuario</label>
                </div>
                <div class="input-field col s6">
                    <input id="pass" name="pass" type="password" class="validate" required>
                    <label for="pass">Contraseña</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <input id="confirmPass" name="confirmPass" type="password" class="validate" required>
                    <label for="confirmPass">Confirmar contraseña</label>
                </div>
            </div>
            <div class="row" style="padding: 0px 0px 5px 10px;">
                <p class="form-link">Ya tienes una cuenta? <a href="Login.php">Ingresa aquí</a></p>
            </div>
            <button class="btn waves-effect waves-light" type="submit">Registrarse</button>
        </form>
    </div>
    
<?php include("libreria/pie.php") ?>