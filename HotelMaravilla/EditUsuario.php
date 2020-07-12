<?php
session_start();
include("libreria/motor.php");

if(isset($_SESSION['user'])){

    if($_POST){

        //asignando valores a propiedades de la instancia
        $user = new Usuario();
        $user->Id = $_GET['edit'];
        $user->Nombre = $_POST['nombre'];
        $user->Apellido = $_POST['apellido'];
        $user->User = $_POST['username'];
        $user->Pass = $_POST['password'];

        //Modificando usuario
        $user->Modificar();
        
        //Redirigiendo a Gestion de huespedes
        header("Location: GestionUsuario.php");
    } 
    elseif(isset($_GET['edit'])){
    
        $con = conexion::getInstance();
        $query = "SELECT * FROM usuarios WHERE id = '{$_GET['edit']}'";
        $result = mysqli_query($con, $query);
        $fila = mysqli_fetch_row($result);
    }
}
else {
    header("Location: Login.php");
}

?>

    <div class="main-div registro">
        <div class="row">
            <h4 id="form-title">Modificar usuario</h4>
        </div>
        <form class="col s12" method="POST" >
            <div class="row">
                <div class="input-field col s6">
                    <input id="nombre" name="nombre" type="text" value="<?php echo $fila[1] ?>" class="validate" >
                    <label for="nombre">Nombres</label>
                </div>
                <div class="input-field col s6">
                    <input id="apellido" name="apellido" type="text" value="<?php echo $fila[2] ?>" class="validate" >
                    <label for="apellido">Apellidos</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <input id="username" name="username" type="text" value="<?php echo $fila[3] ?>" class="validate" >
                    <label for="username">Nombre de usuario</label>
                </div>
                <div class="input-field col s6">
                    <input id="pass" name="pass" type="text" value="<?php echo $fila[4] ?>" class="validate" >
                    <label for="pass">Contraseña</label>
                </div>
            </div>
            <button class="btn waves-effect waves-light" type="submit">Modificar</button>
        </form>
    </div>

<?php include("libreria/pie.php") ?>