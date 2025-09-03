<?php

include "conexiones/conexion.php";

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

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="https://images.emojiterra.com/google/android-pie/512px/2642.png">
    <title>Hombre</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/index_css.css">
</head>

<header>
    <nav class="navbar navbar-expand-lg">

        <div class="container">
                <div class="d-flex align-items-end ms-5">
                    <a class="logo" href="main.php">
                        <img src="imagenes/Armario Virtual.png" alt="">
                    </a>
                </div>
                <div class="collapse navbar-collapse justify-content-center" id="mi-menu">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="main.php">Inicio</a>

                        </li>

                        <li class="nav-item">
                            <a class="nav-link" style="border-bottom: 5px solid #addd; text-decoration: none; color: rgba(255, 255, 255, 0.867);" href="hombress.php">Hombre</a>
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
                                <a href="conexiones/cerrar.php" id="cerrar" style="display: none;">Cerrar Sesión</a>
                            </div>
                        </div>
        
                        <div class="bolsa-container" style="position: relative; display: inline-block;" onclick="accederAlCarrito()">
                            <img src="https://cdn-icons-png.flaticon.com/512/11544/11544758.png" alt="" class="bolsa ms-auto">

                            <div class="notification-badge"> <?php echo $total_registros; ?> </div>
                        </div>
                </div>
        </div>
    </nav>

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

    function toggleSideba() {
        var sidebar = document.getElementById("sideba");
        if (sidebar.style.width === "350px") {
            sidebar.style.width = "0";
        } else {
            sidebar.style.width = "350px";
        }
    }

    async function copiarElemento() {
        event.preventDefault();

        const precio = event.target.closest('.item').querySelector('.precio').textContent;
        localStorage.setItem('textoPrecio', precio);

        const texto = event.target.closest('.item').getAttribute('data-text');
        localStorage.setItem('textoCopiado', texto);

        const imagenLink = event.target.closest('.card').querySelector('img').src;
        localStorage.setItem('imagenLink', imagenLink);

        window.location.href = event.target.closest('a').getAttribute('href');
    }

    document.querySelectorAll('.item').forEach(item => {
        item.addEventListener('click', copiarElemento);
    });

</script>


<main>

    <section class="py-5 text-center container" style="margin-bottom: -30px;" >

        <div class="containerr" style="height: 200px;">
            <br>
            <div class="row" style="height: 150px;">
                <div class="col-3 zoom-container custom-col">
                    <a href="categorias- hombres/Basicos.html"><img src="imagenes/basicoss.png" class="img-fluid zoom-image" alt="Imagen 1"> </a>
                </div>
                <div class="col-3 zoom-container custom-col" >
                    <a href="categorias- hombres/Oversize.html"><img src="imagenes/oversize.png" class="img-fluid zoom-image" alt="Imagen 2"></a>
                </div>
                <div class="col-3 zoom-container custom-col" >
                    <a href="categorias- hombres/camisillas.html"><img src="imagenes/CAMISILLA.png" class="img-fluid zoom-image" alt="Imagen 3"></a>
                </div>
                <div class="col-3 zoom-container custom-col">
                    <a href="categorias- hombres/buzos.html"><img src="imagenes/buzos.png" class="img-fluid zoom-image" alt="Imagen 4"></a>
                </div>
            </div>
        </div>

        <h1>Seccion de Hombres</h1>
    </section>

    <div class="album py-5 bg-body-tertiary">
        <div class="container">
            <div class="row row-cols-2 row-cols-sm-2 row-cols-md-3 g-3 justify-content-center">
                <div class="col">

                    <a href="ejemplo.php" class="item" onclick="copiarElemento()" data-text="Camiseta Box Fit Negro Ilustración">
                        <div class="card shadow-sm">
                            <img id="ima_gen" src="https://b2cmattelsa.vtexassets.com/arquivos/ids/597782-800-auto?v=638600082088070000&width=800&height=auto&aspect=true" alt="Texto">
                            <div class="card-body">
                                <p class="texto"><strong>Camiseta Box Fit Negro Ilustración</strong></p>
                                <p class="precio">129.000</p>
                            </div>
                        </div>
                    </a>
                
                </div>
                <div class="col">
                    <a href="ejemplo.php" class="item" onclick="copiarElemento()" data-text="Camiseta Oversize Blanca">
                        <div class="card shadow-sm">
                            <img id="ima_gen" src="https://b2cmattelsa.vtexassets.com/arquivos/ids/597706-800-auto?v=638600081634270000&width=800&height=auto&aspect=true" alt="Texto">
                            <div class="card-body">
                                    <p class="texto"><strong>Camiseta Oversize Blanca</strong></p>
                                    <p class="precio">99.000</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="ejemplo.php" class="item" onclick="copiarElemento()" data-text="Camiseta Oversize Marfil Ilustración">
                        <div class="card shadow-sm">
                            <img id="ima_gen" src="https://b2cmattelsa.vtexassets.com/arquivos/ids/598098-800-auto?v=638600084118270000&width=800&height=auto&aspect=true" alt="Imagen 1">
                            <div class="card-body">
                                    <p class="texto"><strong>Camiseta Oversize Marfil Ilustración</strong></p>
                                    <p class="precio">$109.000</p>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col">
                    <a href="ejemplo.php" class="item" onclick="copiarElemento()" data-text="Camiseta Oversize Blanco">
                        <div class="card shadow-sm">
                            <img src="https://b2cmattelsa.vtexassets.com/arquivos/ids/651968-1200-auto?v=638769426925270000&width=1200&height=auto&aspect=true" alt="Imagen 1">
                            <div class="card-body">
                                <p class="card-text"><strong>Camiseta Oversize Blanco</strong></p>
                                <p class="precio">$89.000</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="ejemplo.php" class="item" onclick="copiarElemento()" data-text="Camiseta Oversize Rojo Lavandería">
                        <div class="card shadow-sm">
                            <img src="https://b2cmattelsa.vtexassets.com/arquivos/ids/651884-1200-auto?v=638769426546070000&width=1200&height=auto&aspect=true" alt="Imagen 1">
                            <div class="card-body">
                                <p class="card-text"><strong>Camiseta Oversize Rojo Lavandería</strong></p>
                                <p class="precio">$109.000</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="ejemplo.php" class="item" onclick="copiarElemento()" data-text="Tank Negro">
                        <div class="card shadow-sm">
                            <img src="https://b2cmattelsa.vtexassets.com/arquivos/ids/597743-500-auto?v=638600081769800000&width=500&height=auto&aspect=true" alt="Imagen 1">
                            <div class="card-body">
                                <p class="card-text"><strong>Tank Negro</strong></p>
                                <p class="precio">$59.000</p>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col">
                    <a href="ejemplo.php" class="item" onclick="copiarElemento()" data-text="Camiseta Verde">
                        <div class="card shadow-sm">
                            <img src="https://b2cmattelsa.vtexassets.com/arquivos/ids/641375-1200-auto?v=638714203577900000&width=1200&height=auto&aspect=true" alt="Imagen 1">
                            <div class="card-body">
                                <p class="card-text"><strong>Camiseta Verde</strong></p>
                                <p class="precio">$79.000</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="ejemplo.php" class="item" onclick="copiarElemento()" data-text="Buzo Hoodie Box Fit">
                        <div class="card shadow-sm">
                            <img src="https://b2cmattelsa.vtexassets.com/arquivos/ids/596585-800-auto?v=638594033198830000&width=800&height=auto&aspect=true" alt="Imagen 1">
                            <div class="card-body">
                                <p class="card-text"><strong>Buzo Hoodie Box Fit</strong></p>
                                <p class="precio">$169.000</p>
                            </div>
                        </div>
                    </a>
                </div>
                
                <div class="col">
                    <a href="ejemplo.php" class="item" onclick="copiarElemento()" data-text="Camiseta Box Fit Negro">
                        <div class="card shadow-sm">
                            <img src="https://b2cmattelsa.vtexassets.com/arquivos/ids/595723-800-auto?v=638588004057070000&width=800&height=auto&aspect=true" alt="Imagen 1">
                            <div class="card-body">
                                <p class="card-text"><strong>Camiseta Box Fit Negro</strong></p>
                                <p class="precio">$79.000</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

</main>

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

</html>