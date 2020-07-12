<?php

class conexion {

    static $con = null;
    public $instancia = null;

    public function __construct()
    {
        $this->instancia = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);  
        
        if($this->instancia == false){
            echo "
                <script>
                    window.location = 'install.php';
                </script>
            ";
        }
    }

    function __destruct()
    {
        mysqli_close($this->instancia);
    }

    static function getInstance()
    {
        if(self::$con == null)
        {
            self::$con = new conexion();
        } 

        return self::$con->instancia;
    }
    
}

?>