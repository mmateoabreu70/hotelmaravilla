<?php
session_start();

class Evento {

    private $Id = 0;
    private $Fecha_hora = "";
    private $IdEvento = 0;
    private $IdCliente = 0;
    private $IdUsuario = 0;
    private $DirIp = "";

    function __get($prop)
    {
        return $this->$prop;
    }

    function __set($prop, $value)
    {
        if(isset($prop))
        {
            $this->$prop = $value;
        }
    }

    function obtIpReal()
    {
        if(isset($_SERVER['HTTP_CLIENT_IP'])){
            return $_SERVER['HTTP_CLIENT_IP'];
        }
        elseif(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else {
            return $_SERVER['REMOTE_ADDR'];
        }
    
    }

    function RegistrarEvento($idEvent, $cliente)
    {
        //Obteniendo fecha y hora
        date_default_timezone_set('America/Santo_Domingo');
        $fecha_hora = date("Y-m-d H:i:s");

        //obteniendo usuario
        $idUser = $_SESSION['id'];

        //Obteniendo Ip Real
        $ip = $this->obtIpReal();

        $con = conexion::getInstance();
        $query = "INSERT INTO logeventos VALUES (0, '$fecha_hora', $idEvent, $cliente, $idUser, '$ip')";
        
        if(mysqli_query($con, $query))
        {
            $this->Id = mysqli_insert_id($con);
            return true;
        }

        return false;
        
    }

    function Consultar()
    {
        $con = conexion::getInstance();
        $query = "SELECT idEvento, fecha_hora, evento, clt_afectado, username, dir_ip
                FROM logeventos
                INNER JOIN tipo_evento ON logeventos.idTipo = tipo_evento.idTipoEvent
                INNER JOIN usuarios ON logeventos.usuario = usuarios.id";

        return mysqli_query($con, $query);
    }

}

