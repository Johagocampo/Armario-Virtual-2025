<?php

include "../conexiones/conexion.php";

$total_registros = 0;
$cliente = isset($_SESSION['nombre']) ? $_SESSION['nombre'] : null;
$usuarioLogueado = isset($_SESSION['nombre']) ? 'true' : 'false';

// Puedes usar $cliente ahora antes de destruir la sesión
if ($cliente !== null) {
    $sql = "SELECT COUNT(*) FROM carrito WHERE cliente = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $cliente);
    $stmt->execute();
    $stmt->bind_result($total_registros);
    $stmt->fetch();
    $stmt->close();
}

$stmt = $conn->prepare("SELECT * FROM clientes WHERE nombre = ?");
$stmt->bind_param("s", $cliente);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../imagenes/logo_tienda.png">
    <title>Perfil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../principales/css/index_css.css">
</head>

<header>
    <nav class="navbar navbar-expand-lg">

        <div class="container">
                <div class="d-flex align-items-end ms-5">
                    <a class="logo" href="main.php">
                        <img src="../imagenes/Armario Virtual.png" alt="">
                    </a>
                </div>
                <div class="collapse navbar-collapse justify-content-center" id="mi-menu">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="main.php">Inicio</a>

                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="hombress.php">Hombre</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="mujer.php">Mujer</a>
                        </li>
                    </ul>
                </div>
                <div class="d-flex align-items-end ms-5">
                        <div class="dropdown-container" id="dropdown-container"
                            
                            data-sesion="<?php echo isset($_SESSION['nombre']) ? 'true' : 'false'; ?>">

                            <?php if(isset($_SESSION['nombre'])): ?>
                                <span style="color: white;"><?php echo htmlspecialchars($_SESSION['nombre']); ?></span>
                            <?php endif; ?>
                
                            <img src="https://cdn-icons-png.flaticon.com/512/9777/9777892.png" alt="" class="img-thumbnail ms-auto">
                    
                            <div class="dropdown-content" id="dropdown-content">
                                <a href="Login.html">Iniciar Sesión</a>
                                <a href="Registro.html">Registrarme</a>
                                <a href="perfil.php" id="perfil" style="display: none;">Perfil</a>
                                <a href="../conexiones/cerrar.php" id="cerrar" style="display: none;">Cerrar Sesión</a>
                            </div>
                        </div>
        
                        <div class="bolsa-container" style="position: relative; display: inline-block;" onclick="accederAlCarrito()">
                            
                            <img src="https://cdn-icons-png.flaticon.com/512/11544/11544758.png" alt="" class="bolsa ms-auto">
                            
                            <div class="notification-badge"> <?php echo $total_registros; ?> </div>
                        </div>
                </div>
        </div>
    </nav>

    <main>
        <div class="content">
            <div id="sidebar" class="sidebar">
                <a href="main.php">Inicio</a>
                <a href="hombress.php">Hombre</a>
                <a href="mujer.php">Mujer</a>
                <a href="Diseño.php">Tu diseño</a>
            </div>

            <input type="checkbox" id="checkbox">
            <label for="checkbox" class="toggle" onclick="toggleSidebar()">
                <div class="bars" id="bar1"></div>
                <div class="bars" id="bar2"></div>
                <div class="bars" id="bar3"></div>
            </label>
        </div>
    </main>
</header>


<script>
    function accederAlCarrito() {
        const usuarioLogueado = <?php echo $usuarioLogueado; ?>;
        
        if (usuarioLogueado) {
            window.location.href = 'carrito.php';
        } else {
            alert('Debes iniciar sesión para acceder al carrito.');
        }
    }
</script>

<style>
    .notification-badge {
        position: absolute;
        top: -5px;
        right: -5px;
        background-color: red;
        color: white;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 12px;
        font-weight: bold;
    }
</style>

<section>
    <br>
    <br>
</section>

<body >
    <div class="album py-5 bg-body-tertiary">
        <div class="container">
            <br>
            <h2>Mi perfil</h2>
            <br>

            <form action="../conexiones/actualizar.php" method="post">
                <!-- Fila 1: Email y Password -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="inputEmail" class="form-label">NOMBRE</label>
                        <input type="" class="form-control" name="nombre" id="inputEmail" placeholder= "<?php echo $user['nombre'];?>">
                    </div>
                    <div class="col-md-6">
                        <label for="inputPassword" class="form-label">APELLIDO</label>
                        <input type="text" class="form-control" id="inputPassword" name="apellido" placeholder= "<?php echo $user['apellido'];?>">
                    </div>
                </div>

                <!-- Fila 2: Address -->
                <div class="row mb-3">
                    <div class="col-12">
                        <label for="inputAddress" class="form-label">DIRECCION</label>
                        <input type="text" class="form-control" id="inputAddress" name="direccion" placeholder= "<?php echo $user['direccion'];?>">
                    </div>
                </div>

                <!-- Fila 4: City, State, Zip -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="inputCity" class="form-label">CORREO</label>
                        <input type="text" class="form-control" id="inputCity" name="correo" placeholder= "<?php echo $user['correo'];?>">
                    </div>
                    
                    <div class="col-md-2">
                        <label for="inputZip" class="form-label">TELEFONO</label>
                        <input type="text" class="form-control" id="inputZip" name="telefono" placeholder= "<?php echo $user['telefono'];?>">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-12 d-flex gap-3">
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</body>

<script>

    // Maneja el clic en el contenedor del dropdown
    document.getElementById('dropdown-container').addEventListener('click', function(e) {
        e.stopPropagation(); // Evita que el evento se propague
        
        const dropdown = document.getElementById('dropdown-content');
        const botonCerrar = document.getElementById('cerrar');
        const botonPerfil = document.getElementById('perfil');
        
        // Verifica si el usuario está logueado (usando el atributo data)
        const usuarioLogueado = this.getAttribute('data-sesion') === 'true';
        
        if (usuarioLogueado) {
            // Mostrar solo el botón de cerrar sesión
            botonCerrar.style.display = 'block';
            botonPerfil.style.display = 'block';
            // Ocultar otros enlaces
            document.querySelectorAll('#dropdown-content a:not(#cerrar,#perfil)').forEach(enlace => {
                enlace.style.display = 'none';
            });
        } else {
            // Mostrar opciones normales (login/registro)
            botonCerrar.style.display = 'none';
            botonPerfil.style.display = 'none';
            document.querySelectorAll('#dropdown-content a:not(#cerrar,#perfil)').forEach(enlace => {
                enlace.style.display = 'block';
            });
        }
    
        // Alternar la visibilidad del dropdown
        dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
    });

    // Cerrar el dropdown al hacer clic fuera
    document.addEventListener('click', function() {
        document.getElementById('dropdown-content').style.display = 'none';
    });



    function toggleSidebar() {
        var sidebar = document.getElementById("sidebar");
        if (sidebar.style.width === "250px") {
            sidebar.style.width = "0";
        } else {
            sidebar.style.width = "250px";
        }
    }

</script>

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