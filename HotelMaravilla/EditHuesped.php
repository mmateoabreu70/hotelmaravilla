<?php
session_start();
include("libreria/motor.php");

if(isset($_SESSION['user']))
{
    if($_POST){
        //asignando valores a propiedades de la instancia
        $res = new Reservacion();
        $res->Id = $_GET['edit'];
        $res->Nombre = $_POST['nombre'];
        $res->Apellido = $_POST['apellido'];
        $res->Pasaporte = $_POST['pasaporte'];
        $res->Email = $_POST['email'];
        $res->Telefono = $_POST['tel'];
        $res->Pais = $_POST['pais'];
        $res->Llegada = $_POST['date-from'];
        $res->Salida = $_POST['date-to'];
        $res->Room = $_POST['room'];

        //Modificando reservacion
        $res->Modificar();
        //Redirigiendo a Gestion de huespedes
        header("Location: GestionHuesped.php");
    } 
    elseif(isset($_GET['edit'])){
    
        $con = conexion::getInstance();
        $query = "SELECT * FROM reservaciones WHERE id = '{$_GET['edit']}'";
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
            <h4 id="form-title">Modificar huesped</h4>
        </div>
        <p class="errormsg"> <?php echo $mensaje ?> </p>
        <form class="col s12" method="POST" >
            <div class="row">
                <div class="input-field col s6">
                    <i class="material-icons prefix">account_circle</i>
                    <input id="icon_prefix" name="nombre" type="text" value="<?php echo $fila[1] ?>" class="validate" >
                    <label for="icon_prefix">Nombre</label>
                </div>
                <div class="input-field col s6">
                    <i class="material-icons prefix">account_circle</i>
                    <input id="icon_apellido" name="apellido" type="text" value="<?php echo $fila[2] ?>" class="validate" >
                    <label for="icon_apellido">Apellido</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <i class="material-icons prefix">account_circle</i>
                    <input id="icon_passport" name="pasaporte" type="text" value="<?php echo $fila[3] ?>" class="validate" >
                    <label for="icon_passport">Pasaporte</label>
                </div>
                <div class="input-field col s6">
                    <i class="material-icons prefix">email</i>
                    <input id="icon_email" name="email" type="text" value="<?php echo $fila[4] ?>" class="validate" >
                    <label for="icon_email">Correo</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <i class="material-icons prefix">contact_phone</i>
                    <input id="icon_telephone" name="tel" type="text" value="<?php echo $fila[5] ?>" class="validate" >
                    <label for="icon_telephone">Telefono</label>
                </div>
                <div class="input-field col s6">
                    <i class="material-icons prefix">public</i>
                    <input id="icon_pais" name="pais" type="text" value="<?php echo $fila[6] ?>" class="validate" >
                    <label for="icon_pais">Pais</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <i class="material-icons prefix">perm_contact_calendar</i>
                    <input id="datepicker-from" name="date-from" type="date" value="<?php echo $fila[7] ?>" class="validate" >
                    <label for="datepicker-from">Llegada</label>
                </div>
                <div class="input-field col s6">
                    <i class="material-icons prefix">perm_contact_calendar</i>
                    <input id="datepicker-to" name="date-to" type="date" value="<?php echo $fila[8] ?>" class="validate" >
                    <label for="datepicker-to">Salida</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <i class="material-icons prefix">hotel</i>
                    <input id="room" name="room" type="text" value="<?php echo $fila[9] ?>" class="validate" >
                    <label for="room">No. de Habitacion</label>
                </div>
            </div>
            
            <button class="btn waves-effect waves-light" type="submit" name="action">Modificar</button>
        </form>
    </div>

<?php include("libreria/pie.php"); ?>

