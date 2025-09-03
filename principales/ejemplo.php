<?php

include "conexiones/conexion.php";

$cliente = $_SESSION['nombre'];
$usuarioLogueado = isset($_SESSION['nombre']) ? 'true' : 'false';

$sql = "SELECT COUNT(*) FROM carrito WHERE cliente = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $cliente); // ← "s" para string
$stmt->execute();
$stmt->bind_result($total_registros);
$stmt->fetch();
$stmt->close();


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="imagenes/logo_tienda.png">
    <title></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="css/index_css.css">


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
    
</head>

<header>
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

<section>
    <br>
    <br>
</section>

<body>
    <div class="album py-5 bg-body-tertiary">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 justify-content-center">
                <div class="col">
                    <div class="ejemplar">
                        <div class="card shadow-sm justify-content-center" style="transition: none; transform: none;">
                            <img id="imagenMostrada" src="" alt="Texto">
                        </div>
                    </div>
                </div>
                
                <div class="col">
                    <label for="" style= "padding-left: 60px; padding-top: 30px; font-size: 20px;">

                    <form action="conexiones/agregarbolsa.php" method="post" id ="micarro" onsubmit="return prepareForm()">
                        <br>
                        <p id="textoMostrado" name= "nombre" ><strong></strong></p>
                        <p id="precioMostrado" name= "precio"></p>

                        <input type="hidden" name="nombre" id="inputNombre">
                        <input type="hidden" name="precio" id="inputPrecio">
                        <input type="hidden" name="talla" id="inputTalla">
                        <input type="hidden" name="imagen" id="inputImagen">
                        
                        <p><strong>Talla</strong></p>
                        <div class="size-selector">
                            <div class="size-option">S</div>
                            <div class="size-option">M</div>
                            <div class="size-option">L</div>
                            <div class="size-option">XL</div>
                        </div>
                        <br>
                        <br>
                        <br>
                        <div class="size-agregar">
                            <input type="submit" class="size-boton" value="Agregar a la bolsa" disabled>
                        </div>
                        <br>
                        <br>
                        <br>
                    </form>
                    </label>
                </div>
            </div>
        </div>
    </div>
</body>

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
    // Mostrar imagen desde localStorage
    const imagenLink = localStorage.getItem('imagenLink');
    if (imagenLink) {
        document.getElementById('imagenMostrada').src = imagenLink;
    }

    // Mostrar nombre desde localStorage
    const textoCopiado = localStorage.getItem('textoCopiado');
    if (textoCopiado) {
        const strongElement = document.createElement('strong');
        strongElement.innerText = textoCopiado;
        document.getElementById('textoMostrado').appendChild(strongElement);
        document.title = textoCopiado;
    }

    // Mostrar precio desde localStorage
    const textoPrecio = localStorage.getItem('textoPrecio');
    if (textoPrecio) {
        document.getElementById('precioMostrado').textContent = textoPrecio;
    }

    // Dropdown toggle
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

    // Sidebar toggle
    function toggleSidebar() {
        var sidebar = document.getElementById("sidebar");
        sidebar.style.width = (sidebar.style.width === "250px") ? "0" : "250px";
    }

    // Manejo de talla seleccionada
    let selectedSize = '';
    const sizeOptions = document.querySelectorAll('.size-option');
    const addToBagButton = document.querySelector('.size-boton');

    sizeOptions.forEach(option => {
        option.addEventListener('click', (e) => {
            // Quitar selección anterior
            sizeOptions.forEach(opt => opt.classList.remove('selected'));
            option.classList.add('selected');

            // Guardar talla
            selectedSize = option.textContent;
            document.getElementById('inputTalla').value = selectedSize;

            // Activar botón
            addToBagButton.disabled = false;
            addToBagButton.classList.add('active');
        });
    });


    function prepareForm() {

        const usuarioLogueado = <?php echo $usuarioLogueado; ?>;
        const nombreTexto = document.getElementById('textoMostrado').innerText.trim();
        const precioTexto = document.getElementById('precioMostrado').innerText.trim();
        const ImagenTexto = document.getElementById('imagenMostrada').src;

        // Copiar valores a los inputs ocultos
        document.getElementById('inputNombre').value = nombreTexto;
        document.getElementById('inputPrecio').value = precioTexto;
        document.getElementById('inputImagen').value = ImagenTexto;

        if (!usuarioLogueado) {
            alert("Debes iniciar sesión para agregar productos a la bolsa.");
            return false; // cancela el envío
        }

        return true; // permite enviar
        
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