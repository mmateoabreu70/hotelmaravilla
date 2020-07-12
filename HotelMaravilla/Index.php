<?php
session_start();
include("libreria/motor.php");

if(isset($_SESSION["user"]))
{    

    $mensaje = "";

    if($_POST)
    {
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $pasaporte = $_POST['pasaporte'];
        $email = $_POST['email'];
        $tel = $_POST['tel'];
        $pais = $_POST['pais'];
        $fechaInicio = $_POST['date-from'];
        $fechaSalida = $_POST['date-to'];
        $room = $_POST['room'];
        
        $res = new Reservacion();

        $res->Nombre = $_POST['nombre'];
        $res->Apellido = $_POST['apellido'];
        $res->Pasaporte = $_POST['pasaporte'];
        $res->Email = $_POST['email'];
        $res->Telefono = $_POST['tel'];
        $res->Pais = $_POST['pais'];
        $res->Llegada = $_POST['date-from'];
        $res->Salida = $_POST['date-to'];
        $res->Room = $_POST['room'];
        
        if(!$res->Crear())
        {
            $mensaje = "Todos los campos son necesarios";
        }

        header("Location: registrado.php");
    }

}
else {

    header("Location: Login.php");
}

?>

    <div class="main-div registro">
        <div class="row">
            <h4 id="form-title">Registrar huesped</h4>
        </div>
        <p class="errormsg"> <?php echo $mensaje ?> </p>
        <form class="col s12" method="POST" >
            <div class="row">
                <div class="input-field col s6">
                    <i class="material-icons prefix">account_circle</i>
                    <input id="icon_prefix" name="nombre" type="text" value="<?php echo $nombre ?>" class="validate" required>
                    <label for="icon_prefix">Nombre</label>
                </div>
                <div class="input-field col s6">
                    <i class="material-icons prefix">account_circle</i>
                    <input id="icon_apellido" name="apellido" type="text" value="<?php echo $apellido ?>" class="validate" required>
                    <label for="icon_apellido">Apellido</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <i class="material-icons prefix">account_circle</i>
                    <input id="icon_passport" name="pasaporte" type="text" value="<?php echo $pasaporte ?>" class="validate" required>
                    <label for="icon_passport">Pasaporte</label>
                </div>
                <div class="input-field col s6">
                    <i class="material-icons prefix">email</i>
                    <input id="icon_email" name="email" type="text" value="<?php echo $email ?>" class="validate" required>
                    <label for="icon_email">Correo</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <i class="material-icons prefix">contact_phone</i>
                    <input id="icon_telephone" name="tel" type="text" value="<?php echo $tel ?>" class="validate" required>
                    <label for="icon_telephone">Telefono</label>
                </div>
                <div class="input-field col s6">
                    <i class="material-icons prefix">public</i>
                    <input id="icon_pais" name="pais" type="text" value="<?php echo $pais ?>" class="validate" required>
                    <label for="icon_pais">Pais</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <i class="material-icons prefix">perm_contact_calendar</i>
                    <input id="datepicker-from" name="date-from" type="date" value="<?php echo $fechaInicio ?>" class="validate" required>
                    <label for="datepicker-from">Llegada</label>
                </div>
                <div class="input-field col s6">
                    <i class="material-icons prefix">perm_contact_calendar</i>
                    <input id="datepicker-to" name="date-to" type="date" value="<?php echo $fechaSalida ?>" class="validate" required>
                    <label for="datepicker-to">Salida</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <i class="material-icons prefix">hotel</i>
                    <input id="room" name="room" type="text" value="<?php echo $room ?>" class="validate" required>
                    <label for="room">No. de Habitacion</label>
                </div>
            </div>
            
            <button class="btn waves-effect waves-light" type="submit" name="action">Registrarse
                <i class="material-icons right">send</i>
            </button>
        </form>
    </div>

<?php include("libreria/pie.php"); ?>