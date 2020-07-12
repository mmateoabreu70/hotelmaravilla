<?php
session_start();

class Reservacion {
    
    private $Id = 0;
    private $Nombre = "";
    private $Apellido = "";
    private $Pasaporte = "";
    private $Email = "";
    private $Telefono = "";
    private $Pais = "";
    private $Llegada = "2020-02-05";
    private $Salida = "2020-06-05";
    private $Room = "";

    function __set($prop, $value)
    {
        $this->$prop = $value;
    }

    function __get($prop)
    {
        return $this->$prop;     
    }

    function Crear()
    {
        $con = conexion::getInstance();
        $query = "INSERT INTO reservaciones VALUES (0, '$this->Nombre', '$this->Apellido', '$this->Pasaporte', 
                '$this->Email', '$this->Telefono', '$this->Pais', '$this->Llegada', '$this->Salida', '$this->Room', {$_SESSION['id']}, 1);";

        if(mysqli_query($con, $query))
        {
            $this->Id = mysqli_insert_id($con);

            $event = new Evento();
            $event->RegistrarEvento(1, $this->Id);
            return true;
        }

        return false;
    }

    function Consultar()
    {
        $con = conexion::getInstance();

        $query = "SELECT * FROM reservaciones
                WHERE idUser = '{$_SESSION['id']}' AND idStatus = '1' ";

        return mysqli_query($con, $query);
    }

    function Modificar()
    {
        $con = conexion::getInstance();

        $query = "UPDATE reservaciones SET nombre = '$this->Nombre', apellido = '$this->Apellido', pasaporte = '$this->Pasaporte', Email = '$this->Email', 
                telefono = '$this->Telefono', pais = '$this->Pais', llegada = '$this->Llegada', salida = '$this->Salida', room = '$this->Room'
                WHERE id = '$this->Id'";

        if(mysqli_query($con, $query)){

            $event = new Evento();
            $event->RegistrarEvento(2, $this->Id);
            return true;
        }

        return false;
    }

    function Eliminar()
    {
        $con = conexion::getInstance();

        $query = "UPDATE reservaciones SET idStatus = '2' WHERE id = '{$this->Id}'";

        if(mysqli_query($con, $query)){

            $event = new Evento();
            $event->RegistrarEvento(3, $this->Id);
            return true;
        }

        return false;
    }

}

?>
