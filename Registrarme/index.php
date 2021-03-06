<?php

  session_start();

  if (isset($_SESSION['user_id'])) {
    header('Location: ../Home');
  }

  require '../database/database.php';

  $messeage = '';

  if(ValidarCampos()){
    $sql = "INSERT INTO users_t (name, surname, nameuser, password, email, cuil) VALUES (:name, :surname, :nameuser, :password, :email, :cuil)";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':name', $_POST['name']);
    $stmt->bindParam(':surname', $_POST['surname']);
    $stmt->bindParam(':nameuser', $_POST['nameuser']);

    $stmt->bindParam(':password', $_POST['password']);
    /*
      $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
      $stmt->bindParam(':password', $password);
    */

    $stmt->bindParam(':email', $_POST['email']);
    $stmt->bindParam(':cuil', $_POST['cuil']);

    if ($stmt->execute()) {
      $message = '<script> alert("USUARIO CREADO"); </script>';
    } else {
      $message = '<script> alert("ERROR: usuario no creado"); </script>';
    }
  }

  function ValidarCampos(){
    return ( (!empty($_POST['name'])) && (!empty($_POST['surname'])) && (!empty($_POST['nameuser'])) && (!empty($_POST['password'])) && (!empty($_POST['email'])) && (!empty($_POST['cuil'])) );
  }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Register</title>
        <meta charset="UTF-8"/>
        
        <?php
          require("../partials/linkCSS.php");
        ?>

    </head>
    <body>
        <div class="Register-box">
            
            <img src="img/emblema.svg" class="avatar" alt="Emblema COTEUS">
            
            <form action='index.php' method="post" autocomplete="off">
                <div class="Columns">
                    <label for="Name">Nombre</label><br>
                    <input type='text' name='name' placeholder='Nombre' require><br>
                    <label for="cuil">CUIL</label><br>
                    <input type='number' name='cuil' placeholder='CUIL' require><br>
                    <label for="Password">Contraseña</label><br>
                    <input type='password' name='password' placeholder='qEu759jFG3M' require><br>
                    <!--Capcha-->
                    <label >Aqui va el captcha</label>
                    <br><br><br><br><br><br>
                    <a href="../Login" style="color: black;">¿Tienes una cuenta?</a><br>
                </div>
                <div class="Columns">
                    <label for="Last-Name">Apellido</label><br>
                    <input type='text' name='surname' placeholder='Apellido' require><br>
                    
                    <label for="Mail">Ingrese Email</label><br>
                    <input type='email' name='email' placeholder='Email' require><br>
                    <label for="confirm_password">Repita Contraseña</label><br>
                    <input type='password' name='confirm_password' placeholder='qEu759jFG3M' require>
                    <br><br><br><br>

                    <input type="submit" value="Sign in">
                </div>
                <div class="Columns">
                    <label for="Birth">Fecha de Nacimiento</label><br>
                    <input type="date" style="color: rgb(53, 50, 50);"><br>
                    <label for="Username">Nombre de Usuario</label><br>
                    <input type='text' name='nameuser' placeholder='Usuario' require>
                    
                    
                    
                </div>
            </form>
        </div>
    </body>

    <?php if(!empty($message)): ?>
        <p><?= $message ?></p>
    <?php endif; ?>

</html>
</body>
</html>
