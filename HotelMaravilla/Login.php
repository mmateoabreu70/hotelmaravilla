<?php
session_start();
include("libreria/motor.php");
conexion::getInstance();

$mensaje = "";

if($_POST)
{
    $username = $_POST['username'];
    $pass = $_POST['password'];

    $user = new Usuario();
    $confirm = $user->Verificar($_POST['username'], $_POST['password']);

    if(!$confirm)
    {
        $mensaje = "Usuario o contraseña incorrecta";
    } else {
        header("Location: Index.php"); 
    }
}

?>
    
    <div class="main-div login">
        <div class="row">
            <h4 id="form-title">Iniciar Sesion</h4>
        </div>
        <p class="errormsg"> <?php echo $mensaje ?> </p>
        <form class="col s12" method="POST">
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix">perm_identity</i>
                    <input id="username" name="username" type="text" value="<?php echo $username ?>" class="validate" required>
                    <label for="username">Usuario</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix">lock_outline</i>
                    <input id="password" name="password" type="password" value="<?php echo $pass ?>" class="validate" required>
                    <label for="password">Contraseña</label>
                </div>
            </div>
            <div class="row" style="padding: 0px 0px 5px 10px;">
                <p class="form-link">No tienes una cuenta? <a href="Registro.php">Ingresa aquí</a></p>
            </div>
            
            <button class="btn waves-effect waves-light" type="submit">Iniciar Sesion
                <i class="material-icons right"></i>
            </button>
        </form>
    </div>

<?php include("libreria/pie.php") ?>