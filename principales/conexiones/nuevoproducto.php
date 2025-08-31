<?php

include "../conexiones/conexion.php";

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/9938/9938261.png">
    <title>Nuevo producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/index_css.css">
</head>

<header>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
                <div class="d-flex align-items-end ms-5">
                    <a class="logo" href="main.php">
                        <img src="../imagenes/Armario Virtual.png" alt="">
                    </a>
                </div>
        </div>
    </nav>
</header>

<section>
    <br>
    <br>
</section>

<body >
    <div class="album py-5 bg-body-tertiary">
        <div class="container">
            <br>
            <h2>Nuevo producto</h2>
            <br>

            <form action="../conexiones/guardarproducto.php" method="post">
                <!-- Fila 1: Email y Password -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="inputEmail" class="form-label">NOMBRE</label>
                        <input type="" class="form-control" name="nombre">
                    </div>
                    <div class="col-md-6">
                        <label for="inputPassword" class="form-label">PRECIO</label>
                        <input type="text" class="form-control" id="inputPassword" name = "precio">
                    </div>
                </div>

                <!-- Fila 2: Address -->
                <div class="row mb-3">
                    <div class="col-6">
                        <label for="inputAddress" class="form-label">TIPO</label>
                        <input type="text" class="form-control" id="inputAddress" name="tipo">
                    </div>
                    <div class="col-6">
                        <label for="inputAddress" class="form-label">GENERO</label>
                        <input type="text" class="form-control" id="inputAddress" name="genero">
                    </div>
                </div>

                <!-- Fila 4: City, State, Zip -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="inputCity" class="form-label">CANTIDAD</label>
                        <input type="text" class="form-control" id="inputCity" name="cantidad">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-12 d-flex gap-3">
                        <button type="submit" class="btn btn-primary">Agregar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</body>

<hr class="featurette-divider">

<footer class="container">

    <p class="float-end" style="color: rgb(156, 156, 156);"><a href="#">Back to top</a></p>
    <p style="color: rgb(156, 156, 156);">&copy; 2024 Company, Inc.</p>
    <p style="color: rgb(156, 156, 156);"><strong>Contacto:</strong></p>
    <p style="color: rgb(156, 156, 156);">Teléfono: +57 320 5634901</p>
    <p style="color: rgb(156, 156, 156);">Correo: ArmarioVirtual@gmail.com</p>
    <p ><a href="#" style="color: rgb(16, 130, 217);">Sobre Nosotros</a></p>
    <p><a href="#" style="color: rgb(16, 130, 217);">Servicios</a></p>

</footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous">
    </script>


</html>