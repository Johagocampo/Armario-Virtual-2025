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

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mujer</title>
    <link rel="icon" href="https://upload.wikimedia.org/wikipedia/commons/thumb/d/d5/Female_symbol_%28heavy_pink%29.svg/1200px-Female_symbol_%28heavy_pink%29.svg.png">
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
            <div class="collapse navbar-collapse justify-content-center" id="mi-menu">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="main.php">Inicio</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="hombress.php">Hombre</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" style="border-bottom: 5px solid #addd; text-decoration: none; color: rgba(255, 255, 255, 0.867);" href="mujer.php">Mujer</a>
                    </li>
                </ul>
            </div>
            <div class="d-flex align-items-end ms-5">
                
                <div class="dropdown-container" id="dropdown-container"
                    data-sesion="<?php echo isset($_SESSION['nombre']) ? 'true' : 'false'; ?>">
                    
                    <?php if(isset($_SESSION['nombre'])): ?>
                        <span style="color: white;"><?php echo htmlspecialchars($_SESSION['nombre']); ?></span>
                    <?php endif; ?>
                    
                    <img src="https://cdn-icons-png.flaticon.com/512/9777/9777892.png" alt="Menú usuario" class="img-thumbnail ms-auto">
                    
                    <div class="dropdown-content" id="dropdown-content" style="display: none;">
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
                    <img src="../imagenes/basicos (1).png" class="img-fluid zoom-image" alt="Imagen 1">
                </div>
                <div class="col-3 zoom-container custom-col" >
                    <img src="../imagenes/oversize (1).png" class="img-fluid zoom-image" alt="Imagen 2">
                </div>
                <div class="col-3 zoom-container custom-col" >
                    <img src="../imagenes/croptop.png" class="img-fluid zoom-image" alt="Imagen 3">
                </div>
                <div class="col-3 zoom-container custom-col">
                    <img src="../imagenes/buszosmm (1).png" class="img-fluid zoom-image" alt="Imagen 4">
                </div>
            </div>
        </div>

        <h1>Seccion de Mujeres</h1>
    </section>

    <div class="album py-5 bg-body-tertiary">
        <div class="container">
            <div class="row row-cols-2 row-cols-sm-2 row-cols-md-3 g-3 justify-content-center">
                <div class="col">

                    <a href="ejemplo.php" class="item" onclick="copiarElemento()" data-text="Polo Manga Larga Verde Básico">
                        <div class="card shadow-sm">
                            <img id="ima_gen" src="https://b2cmattelsa.vtexassets.com/arquivos/ids/616043-800-auto?v=638672666545830000&width=800&height=auto&aspect=true" alt="Texto">
                            <div class="card-body">
                                <p class="texto"><strong>Polo Manga Larga Verde Básico</strong></p>
                                <p class="precio">89.000</p>
                            </div>
                        </div>
                    </a>
                
                </div>
                <div class="col">
                    <a href="ejemplo.php" class="item" onclick="copiarElemento()" data-text="Camiseta Slim Negro Texto">
                        <div class="card shadow-sm">
                            <img id="ima_gen" src="https://b2cmattelsa.vtexassets.com/arquivos/ids/616875-800-auto?v=638672835423000000&width=800&height=auto&aspect=true" alt="Texto">
                            <div class="card-body">
                                    <p class="texto"><strong>Camiseta Slim Negro Texto</strong></p>
                                    <p class="precio">79.000</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="ejemplo.php" class="item" onclick="copiarElemento()" data-text="Buzo Pullover Marfil Ilustración">
                        <div class="card shadow-sm">
                            <img id="ima_gen" src="https://b2cmattelsa.vtexassets.com/arquivos/ids/614745-800-auto?v=638666592305670000&width=800&height=auto&aspect=true" alt="Imagen 1">
                            <div class="card-body">
                                    <p class="texto"><strong>Buzo Pullover Marfil Ilustración</strong></p>
                                    <p class="precio">$149.000</p>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col">
                    <a href="ejemplo.php" class="item" onclick="copiarElemento()" data-text="Croptop Negro Texto">
                        <div class="card shadow-sm">
                            <img src="https://b2cmattelsa.vtexassets.com/arquivos/ids/652072-1200-auto?v=638769427485930000&width=1200&height=auto&aspect=true" alt="Imagen 1">
                            <div class="card-body">
                                <p class="card-text"><strong>Croptop Negro Texto</strong></p>
                                <p class="precio">$63.000</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="ejemplo.php" class="item" onclick="copiarElemento()" data-text="Camiseta Slim Verde">
                        <div class="card shadow-sm">
                            <img src="https://b2cmattelsa.vtexassets.com/arquivos/ids/648587-1200-auto?v=638751283638300000&width=1200&height=auto&aspect=true" alt="Imagen 1">
                            <div class="card-body">
                                <p class="card-text"><strong>Camiseta Slim Verde</strong></p>
                                <p class="precio">$79.0000</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="ejemplo.php" class="item" onclick="copiarElemento()" data-text="Top Manga Larga Negro">
                        <div class="card shadow-sm">
                            <img src="https://b2cmattelsa.vtexassets.com/arquivos/ids/652784-1200-auto?v=638780151743230000&width=1200&height=auto&aspect=true" alt="Imagen 1">
                            <div class="card-body">
                                <p class="card-text"><strong>Top Manga Larga Negro</strong></p>
                                <p class="precio">$79.000</p>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col">
                    <a href="ejemplo.php" class="item" onclick="copiarElemento()" data-text="Buzo Pullover Negro">
                        <div class="card shadow-sm">
                            <img src="https://b2cmattelsa.vtexassets.com/arquivos/ids/648535-1200-auto?v=638751283469870000&width=1200&height=auto&aspect=true" alt="Imagen 1">
                            <div class="card-body">
                                <p class="card-text"><strong>Buzo Pullover Negro</strong></p>
                                <p class="precio">$129.000</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="ejemplo.php" class="item" onclick="copiarElemento()" data-text="Camiseta Oversize Café ">
                        <div class="card shadow-sm">
                            <img src="https://b2cmattelsa.vtexassets.com/arquivos/ids/635246-1200-auto?v=638703066629770000&width=1200&height=auto&aspect=true" alt="Imagen 1">
                            <div class="card-body">
                                <p class="card-text"><strong>Camiseta Oversize Café </strong></p>
                                <p class="precio">$79.000</p>
                            </div>
                        </div>
                    </a>
                </div>
                
                <div class="col">
                    <a href="ejemplo.php" class="item" onclick="copiarElemento()" data-text="Camiseta Crop Marfil">
                        <div class="card shadow-sm">
                            <img src="https://b2cmattelsa.vtexassets.com/arquivos/ids/595695-800-auto?v=638588003923130000&width=800&height=auto&aspect=true" alt="Imagen 1">
                            <div class="card-body">
                                <p class="card-text"><strong>Camiseta Crop Marfil</strong></p>
                                <p class="precio">$99.000</p>
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