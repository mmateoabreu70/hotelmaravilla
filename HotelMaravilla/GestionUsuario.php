<?php 
session_start();
include("libreria/motor.php");

if(isset($_SESSION['user'])){

    $user = new Usuario();
    $result = $user->Consultar();

    if(isset($_GET['del']))
    {
        $user->Id = $_GET['del'];
        $user->Eliminar();
        header("Location: GestionUsuario.php");
    }

}
else {
    header("Location: Login.php");
}

?>

<div class="main-div gestion">
    <div class="row">
        <h4 id="form-title">Gestionar usuarios</h4>
    </div>
    <table class="centered striped highlight">
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Username</th>
                <th>Contraseña</th>
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
                                <td>{$fila['username']}</td>
                                <td>{$fila['password']}</td>
                                <td>
                                    <a href='EditUsuario.php?edit={$fila['id']}'><i class='small material-icons'>edit</i></a>
                                </td>
                                <td>
                                    <a href='GestionUsuario.php?del={$fila['id']}'><i class='small material-icons'>delete_forever</i></a>
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