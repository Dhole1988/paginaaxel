<?php
include("conexion.php");

if (isset($_post['btn btn-primary d-block w-100'])){
    if(
        strlen($_POST['email']) >= 1 &&
        strlen($_POST['password']) >= 1

        ) {
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
            
            $consulta = "INSERT INTO datos(email,password)
                      VALUES ('$email','$password')";
            $resultado = mysqli_query($conexion, $consulta);
            if ($resultado){

            ?>
            <h3 class= "success"> registro completado</h3>
            <?php
             }else {
                ?>
                <h3 class= "error"> ocurrio un error</h3>
                <?php
             }

    } else {
        ?>
               <h3 class="error">llena todos los campos</h3>
    <?php
    }

}
?>