<?php

if (isset($_POST['email_reg'])) {
    require_once '../config/server.php';
    $name_reg = $_POST['name_reg'];
    $rubro_reg = $_POST['rubro_reg'];
    $tel_reg = $_POST['tel_reg'];
    $desc_reg = $_POST['desc_reg'];
    $addres_reg = $_POST['addres_reg'];
    $url_reg = $_POST['url_reg'];

    $nombres_reg = $_POST['nombres_reg'];
    $apell_reg = $_POST['apell_reg'];
    $email_reg = $_POST['email_reg'];
    $pass_reg = $_POST['pass_reg'];
    $passn = encryption($pass_reg);
    
    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "pep_store2";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO negocio (neg_nombre,neg_rubro,neg_descripcion,neg_dirección,neg_telefono,neg_messeger,neg_fecha)
        VALUES ('$name_reg','$rubro_reg','$tel_reg','$desc_reg','$addres_reg','$url_reg',now())";

    if ($conn->query($sql) === TRUE) {
        $sql = "INSERT INTO usuario ( `usu_nombre`, `usu_apellido`, `usu_gmail`, `usu_password`,`usu_fecha`)
            VALUES ('$nombres_reg','$apell_reg','$email_reg','$passn',now())";
        if ($conn->query($sql) === TRUE) {
            echo "ok";
        }else{
            echo "fu";
        }
    } else {
        echo "fn";
    }

    $conn->close();
    

}

function encryption($string){
    $output=FALSE;
    $key=hash('sha256', SECRET_KEY);
    $iv=substr(hash('sha256', SECRET_IV), 0, 16);
    $output=openssl_encrypt($string, METHOD, $key, 0, $iv);
    $output=base64_encode($output);
    return $output;
}

