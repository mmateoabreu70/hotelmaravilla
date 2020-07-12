<?php
session_start();
include("libreria/motor.php");

if(isset($_SESSION['user'])){
    $res = new Reservacion();
    $result = $res->Consultar();

    if(isset($_GET['del']))
    {
        $res->Id = $_GET['del'];
        $res->Eliminar();
        header("Location: GestionHuesped.php");
    }
} 
else {
    header("Location: Login.php");
}

?>

<div class="main-div gestion">
    <div class="row">
        <h4 id="form-title">Gestionar Huespedes</h4>
    </div>
    <table class="centered striped highlight">
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Pasaporte</th>
                <th>Email</th>
                <th>Telefono</th>
                <th>Pais</th>
                <th>Llegada</th>
                <th>Salida</th>
                <th>Room</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>

            <?php
                $count = 0;

                if($result == null)
                {
                    echo "
                    <tr>
                        <td colspan='10'>No hay huespedes registrados</td>
                    </tr>
                    ";
                }
                else {

                    foreach($result as $fila)
                    {
                        $count++;

                        echo "
                            <tr>
                                <td>{$count}</td>
                                <td>{$fila['nombre']}</td>
                                <td>{$fila['apellido']}</td>
                                <td>{$fila['pasaporte']}</td>
                                <td>{$fila['email']}</td>
                                <td>{$fila['telefono']}</td>
                                <td>{$fila['pais']}</td>
                                <td>{$fila['llegada']}</td>
                                <td>{$fila['salida']}</td>
                                <td>{$fila['room']}</td>
                                <td>
                                    <a href='EditHuesped.php?edit={$fila['id']}'><i class='small material-icons'>edit</i></a>
                                </td>
                                <td>
                                    <a href='GestionHuesped.php?del={$fila['id']}'><i class='small material-icons'>delete_forever</i></a>
                                </td>
                            </tr>
                        ";
                    }
                }
            
            ?>

        </tbody>
    </table>
</div>


<?php include("libreria/pie.php") ?>