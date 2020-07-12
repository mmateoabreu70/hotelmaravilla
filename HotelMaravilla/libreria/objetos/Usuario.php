<?php
session_start();
$_SESSION['autorizado'] = false;

class Usuario
{
    private $Id = 0;
    private $Nombre = "";
    private $Apellido = "";
    private $User = "";
    private $Pass = "";
    private $Tipo = "";

    function __construct()
    {    
    }

    function __get($prop)
    {
        return $this->$prop;
    }

    function __set($prop, $value)
    {
        $this->$prop = $value;
    }

    function Verificar($user, $pass)
    {

        $con = conexion::getInstance();

        $query = "SELECT id, nombre, apellido, username, password, tipo 
                  FROM usuarios 
                  INNER JOIN tipo_user on usuarios.tipoId = tipo_user.idTipo 
                  WHERE username = '$user'";

        $result = mysqli_query($con, $query);

        if(mysqli_error($con))
        {
           return false;
        }

        $fila = $result->fetch_row();

        if($fila == null)
        {
            return false;
            
        } else {

            if($pass == $fila[4])
            {
                $_SESSION['id'] = $fila[0];
                $_SESSION['nombre'] = $fila[1];
                $_SESSION['apellido'] = $fila[2];
                $_SESSION['user'] = $fila[3];
                $_SESSION['pass'] = $fila[4];
                $_SESSION['tipo'] = $fila[5];

                return true;
                
            } else {
                return false;
            }
        }
    }

    function CrearUsuario()
    {
        $con = conexion::getInstance();

        $query = "SELECT * FROM usuarios WHERE username = '{$this->User}' ";
        $result = mysqli_query($con, $query);

        if(mysqli_num_rows($result) == 1)
        {
            return "Este nombre de usuario ya existe";
        }
        elseif($this->Pass != $_POST['confirmPass'])
        {
            return "Las contraseñas no coinciden";
        }
        
        $query = "INSERT INTO usuarios VALUES(0, '$this->Nombre', '$this->Apellido', '$this->User', '$this->Pass', 2)";

        if(mysqli_query($con, $query))
        {
            $this->Id = mysqli_insert_id($con);
            return true;
        }

        return false;
    }

    function Modificar()
    {
        $con = conexion::getInstance();
        $query = "UPDATE usuarios 
                SET nombre = '$this->Nombre', apellido = '$this->Apellido', username = '$this->User'
                WHERE id = '$this->Id'";
        return mysqli_query($con, $query);
    }

    function Eliminar()
    {
        $con = conexion::getInstance();
        $query = "DELETE FROM usuarios WHERE id = '{$this->Id}'";
        return mysqli_query($con, $query);
    }

    function Consultar()
    {
        $con = conexion::getInstance();
        $query = "SELECT * FROM usuarios WHERE tipoId = '2'";
        return mysqli_query($con, $query);
    }

}