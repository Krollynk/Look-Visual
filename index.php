<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@200;500;700;800&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/2d26adbd14.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="./styles/estilo_index.css">
        <link rel="stylesheet" href="./styles/normalize.css">
        <title>Login</title>
    </head>

    <body>
        <main class="login-design">
            <div class="animation">
                <img src="./assets/opitca3.png" alt="">
            </div>
            <div class="login">
                <div class="login-data">
                    <img src="./assets/login1.png" alt="">
                    <h1>Inicio de Sesion</h1>
                    
                    <form action="functions/acceso_loby.php" method="post" class="login-form">
                        <div class="input-group">
                            <i class="fa-solid fa-user"></i>
                            <input type="text" name="usuario" placeholder="Usuario">
                        </div>
                        <div class="input-group">
                            <i class="fa-solid fa-lock"></i>
                            <input type="password" name="password" placeholder="contraseña">
                        </div>
                        <input type="submit" name="submit" value="Iniciar Sesion" class="btn-login">
                    </form>
                    <!-- <a href="https://storyset.com/web">Web illustrations by Storyset</a> -->
                </div>
            </div>
        </main>
        
    </body>

</html>