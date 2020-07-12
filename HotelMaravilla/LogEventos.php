<?php
session_start();
include("libreria/motor.php");

if(isset($_SESSION['user']))
{
    $event = new Evento();
    $result = $event->Consultar();

} else {
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
                <th>Fecha/Hora</th>
                <th>Actividad</th>
                <th>Cliente afectado</th>
                <th>Usuario</th>
                <th>direccion ip (usuario)</th>
            </tr>
        </thead>
        <tbody>

            <?php
                $count = 0;

                if($result == null)
                {
                    echo "
                    <tr>
                        <td colspan='10'>No hay eventos registrados</td>
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
                                <td>{$fila['fecha_hora']}</td>
                                <td>{$fila['evento']}</td>
                                <td>{$fila['clt_afectado']}</td>
                                <td>{$fila['username']}</td>
                                <td>{$fila['dir_ip']}</td>
                            </tr>
                        ";
                    }
                }
            
            ?>

        </tbody>
    </table>
</div>


<?php include("libreria/pie.php") ?>