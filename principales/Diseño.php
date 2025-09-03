<?php
include "conexiones/conexion.php";

$total_registros = 0;
$cliente = isset($_SESSION['nombre']) ? $_SESSION['nombre'] : null;
$usuarioLogueado = isset($_SESSION['nombre']) ? 'true' : 'false';

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
    <link rel="icon" href="imagenes/logo_tienda.png">
    <title>Tu Diseño</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/index_css.css">
    <style>
        /* Nuevos estilos para las vistas */
        .view-options-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
            gap: 15px;
        }

        .view-option {
            display: flex;
            flex-direction: column;
            align-items: center;
            cursor: pointer;
        }

        .view-option img {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border: 2px solid #ddd;
            transition: all 0.3s;
        }

        .view-option img:hover {
            border-color: #666;
        }

        .view-option.active img {
            border-color: #0066cc;
            box-shadow: 0 0 5px rgba(0, 102, 204, 0.5);
        }

        .view-option p {
            margin-top: 5px;
            font-size: 14px;
            color: #333;
        }

        /* Estilo para la imagen movible */
        #movableImage {
            position: absolute;
            top: 0;
            left: 0;
            width: 100px;
            height: auto;
            user-select: none;
            pointer-events: none;
        }

        /* Notificación del carrito */
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
</head>

<body>
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
                        <div class="notification-badge"><?php echo $total_registros; ?></div>
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

    <section>
        <br><br>
    </section>

    <div class="album py-5 bg-body-tertiary">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 g-3">
                <div class="col">
                    <div style="position: relative; display: inline-block; margin-top: -20px; margin-left: 85px;">
                        <img style="height: 400px;" id="sueteR" src="imagenes/sueternegrodelante.png" alt="Suéter">
                        <div id="imageContainer" style="background:transparent; width: 400px; height: 500px; position: relative; color: white; margin-left: 20px; margin-top: -510px;">
                            <img id="movableImage" src="" alt="">
                        </div>
                        <canvas id="canvas" width="400" height="400" style="display:none;"></canvas>
                    </div>
                    
                    <!-- Nuevo diseño para las opciones de vista -->
                    <div class="view-options-container">
                        <div class="view-option" onclick="seleccionarVista('delante')">
                            <img id="delante" src="imagenes/sueternegrodelante.png" alt="Delante">
                            <p>Delante</p>
                        </div>
                        <div class="view-option" onclick="seleccionarVista('detras')">
                            <img id="detras" src="imagenes/sueternegrodetras.png" alt="Detrás">
                            <p>Detrás</p>
                        </div>
                        <div class="view-option" onclick="seleccionarVista('derecha')">
                            <img id="derecha" src="imagenes/sueternegroderecha.png" alt="Derecha">
                            <p>Derecha</p>
                        </div>
                        <div class="view-option" onclick="seleccionarVista('izquierda')">
                            <img id="izquierda" src="imagenes/sueternegroizquierda.png" alt="Izquierda">
                            <p>Izquierda</p>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="vista">
                        <br>
                        <p style="font-size: 20px; padding-left: 100px;"><strong>Color del producto:</strong></p>
                        <div class="selector" style="padding-left: 100px;">
                            <div style="background-color: blue;" class="option" name="azul" onclick="seleccionarColor('azul')"></div>
                            <div style="background-color: rgb(6, 77, 33);" class="option" name="verde" onclick="seleccionarColor('verde')"></div>
                            <div style="background-color: rgb(0, 0, 0);" class="option" name="negro" onclick="seleccionarColor('negro')"></div>
                            <div style="background-color: rgb(255, 0, 0);" class="option" name="rojo" onclick="seleccionarColor('rojo')"></div>
                            <div style="background-color: rgb(208, 255, 0);" class="option" name="amarillo" onclick="seleccionarColor('amarillo')"></div>
                        </div>
                        <br><br><br>
                        <p style="font-size: 20px; padding-left: 100px;"><strong>Editar:</strong></p>
                        <div class="selector" style="padding-left: 100px;">
                            <button style="width: 50px;background-color:white" onclick="document.getElementById('fileInput').click()">
                                <div style="background-image: url(https://static.vecteezy.com/system/resources/previews/016/017/372/non_2x/image-upload-free-png.png); background-size: cover;" class="optionn"></div>
                            </button>
                            <input type="file" id="fileInput" accept="image/*" style="display: none" onchange="mostrarImagen(event)">

                            <button style="width: 50px;background-color:white" onclick="guardarDiseño()">
                                <div style="background-image: url(https://static.vecteezy.com/system/resources/thumbnails/000/426/000/small/Web__28126_29.jpg); background-size: cover;" class="optionn"></div>
                            </button>
                            <button id="botonOculto" style="display: none; width: 50px;background-color:white" onclick="borrarImagen(event)">
                                <div style="background-image: url(https://cdn-icons-png.flaticon.com/512/8428/8428112.png); background-size: cover;" class="optionn"></div>
                            </button>
                        </div>
                        <br><br><br>

                        <form action="conexiones/Guardardiseño.php" method="post" onsubmit="return Enviaralcarro()">
                            <p style="font-size: 20px; padding-left: 100px;"><strong>Talla:</strong></p>
                            <input type="hidden" id="nombreArchivo" name="nombreArchivo">
                            <input type="hidden" name="talla" id="inputTalla">
                            <div class="size-selector" style="padding-left: 100px;">
                                <div class="size-option" onclick="seleccionarTalla('S')">S</div>
                                <div class="size-option" onclick="seleccionarTalla('M')">M</div>
                                <div class="size-option" onclick="seleccionarTalla('L')">L</div>
                                <div class="size-option" onclick="seleccionarTalla('XL')">XL</div>
                            </div>
                            <br><br><br>
                            <div class="size-agregar" style="padding-left: 100px;">
                                <input type="submit" class="size-boton" value="Agregar a la bolsa">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <br><br><br><br>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>

    <script>
        // Variables globales
        let descarga = false;
        const usuarioLogueado = <?php echo $usuarioLogueado; ?>;
        let colorSeleccionado = 'negro';
        let vistaSeleccionada = 'delante';
        let tallaSeleccionada = '';

        // Mapeo de imágenes para cada color
        const imagenesPorColor = {
            azul: {
                delante: "imagenes/sueterazuldelante.png",
                detras: "imagenes/sueterazuldetras.png",
                derecha: "imagenes/sueterazulderecha.png",
                izquierda: "imagenes/sueterazulizquierda.png"
            },
            verde: {
                delante: "imagenes/sueterverdedelante.png",
                detras: "imagenes/sueterverdedetras.png",
                derecha: "imagenes/sueterverdederecha.png",
                izquierda: "imagenes/sueterverdeizquierda.png"
            },
            negro: {
                delante: "imagenes/sueternegrodelante.png",
                detras: "imagenes/sueternegrodetras.png",
                derecha: "imagenes/sueternegroderecha.png",
                izquierda: "imagenes/sueternegroizquierda.png"
            },
            rojo: {
                delante: "imagenes/sueterrojodelante.png",
                detras: "imagenes/sueterrojodetras.png",
                derecha: "imagenes/sueterrojoderecha.png",
                izquierda: "imagenes/sueterrojoizquierda.png"
            },
            amarillo: {
                delante: "https://image.spreadshirtmedia.net/image-server/v1/products/T6A7?width=300&height=300&viewId=1.png",
                detras: "https://image.spreadshirtmedia.net/image-server/v1/products/T6A7?width=300&height=300&viewId=2.png",
                derecha: "https://image.spreadshirtmedia.net/image-server/v1/products/T6A7?width=300&height=300&viewId=3.png",
                izquierda: "https://image.spreadshirtmedia.net/image-server/v1/products/T6A7?width=300&height=300&viewId=4.png"
            }
        };

        // Función para seleccionar color
        function seleccionarColor(color) {
            colorSeleccionado = color;
            actualizarVistas();
        }

        // Función para seleccionar vista
        function seleccionarVista(vista) {
            vistaSeleccionada = vista;
            
            // Remover clase active de todas las opciones
            document.querySelectorAll('.view-option').forEach(option => {
                option.classList.remove('active');
            });
            
            // Agregar clase active a la opción seleccionada
            event.currentTarget.classList.add('active');
            
            // Actualizar la imagen principal
            actualizarImagenPrincipal();
        }

        // Función para actualizar todas las miniaturas de vista
        function actualizarVistas() {
            const imagenes = imagenesPorColor[colorSeleccionado];
            
            if (imagenes) {
                document.getElementById('delante').src = imagenes.delante;
                document.getElementById('detras').src = imagenes.detras;
                document.getElementById('derecha').src = imagenes.derecha;
                document.getElementById('izquierda').src = imagenes.izquierda;
                
                actualizarImagenPrincipal();
            }
        }

        // Función para actualizar la imagen principal
        function actualizarImagenPrincipal() {
            const imagenes = imagenesPorColor[colorSeleccionado];
            
            if (imagenes && imagenes[vistaSeleccionada]) {
                document.getElementById('sueteR').src = imagenes[vistaSeleccionada];
            }
        }

        // Función para seleccionar talla
        function seleccionarTalla(talla) {
            tallaSeleccionada = talla;
            document.getElementById('inputTalla').value = talla;
            
            // Remover selección anterior
            document.querySelectorAll('.size-option').forEach(option => {
                option.classList.remove('selected');
            });
            
            // Agregar selección a la opción actual
            event.currentTarget.classList.add('selected');
            
            // Habilitar botón de agregar
            document.querySelector('.size-boton').disabled = false;
            document.querySelector('.size-boton').classList.add('active');
        }

        // Función para guardar el diseño
        function guardarDiseño() {

            const canvas = document.getElementById("canvas");
            const ctx = canvas.getContext("2d");
            
            // Obtener la imagen base (el suéter)
            const sweaterImg = document.getElementById("sueteR");
            
            // Obtener la imagen superpuesta (el logo)
            const logoImg = document.getElementById("movableImage");

            ctx.clearRect(0, 0, canvas.width, canvas.height);
            ctx.drawImage(sweaterImg, 0, 0, canvas.width, canvas.height);

            if (logoImg.src) {
                const logoWidth = parseInt(logoImg.style.width) || logoImg.naturalWidth;
                const logoHeight = logoWidth * (logoImg.naturalHeight / logoImg.naturalWidth);
                
                // Ajusta estas líneas según necesites:
                const logoX = (canvas.width - logoWidth) / 2; // Centrado horizontal
                const logoY = parseInt(logoImg.style.top) || (canvas.height - logoHeight) / 2; // Centrado vertical o posición definida
                
                ctx.drawImage(logoImg, logoX, logoY, logoWidth, logoHeight);
            }
            
            // Descargar la imagen resultante
            downloadImage();
        }

        // Descargar la imagen
        
        function downloadImage() {
            const canvas = document.getElementById("canvas");
            const fileName = prompt("Ingrese el nombre del archivo:", "mi_diseño_personalizado");

            const link = document.createElement('a');
            link.download = fileName + ".png";
            link.href = canvas.toDataURL("image/png");
            link.click();

            if (fileName) {
                document.getElementById('nombreArchivo').value = fileName;
                descarga = true;
            }

        }

        // Función para validar antes de enviar al carrito
        function Enviaralcarro() {
            if (!usuarioLogueado) {
                alert("Debes iniciar sesión para agregar productos a la bolsa.");
                return false;
            }

            if (!descarga) {
                alert('Debes guardar el diseño primero.');
                return false;
            }

            if (!tallaSeleccionada) {
                alert('Por favor selecciona una talla.');
                return false;
            }

            return true;
        }

        // Función para mostrar imagen cargada
        function mostrarImagen(event) {
            const archivo = event.target.files[0];
            const boton = document.getElementById('botonOculto');

            if (archivo) {
                const url = URL.createObjectURL(archivo);
                document.getElementById('movableImage').src = url;
                boton.style.display = 'inline-block';
            } else {
                boton.style.display = 'none';
            }
        }

        // Función para borrar imagen
        function borrarImagen(event) {
            const boton = document.getElementById('botonOculto');
            document.getElementById('movableImage').src = "";
            boton.style.display = 'none';
            descarga = false;
        }

        // Función para acceder al carrito
        function accederAlCarrito() {
            if (usuarioLogueado) {
                window.location.href = 'carrito.php';
            } else {
                alert('Debes iniciar sesión para acceder al carrito.');
            }
        }

        // Configuración para mover y hacer zoom a la imagen
        const container = document.getElementById('imageContainer');
        const image = document.getElementById('movableImage');
        let isDragging = false;
        let offsetX = 0, offsetY = 0;

        container.addEventListener('mousedown', (e) => {
            isDragging = true;
            offsetX = e.clientX - image.offsetLeft;
            offsetY = e.clientY - image.offsetTop;
            container.style.cursor = 'grabbing';
        });

        document.addEventListener('mousemove', (e) => {
            if (!isDragging) return;

            let newLeft = e.clientX - offsetX;
            let newTop = e.clientY - offsetY;

            newLeft = Math.max(0, Math.min(newLeft, container.clientWidth - image.clientWidth));
            newTop = Math.max(0, Math.min(newTop, container.clientHeight - image.clientHeight));

            image.style.left = newLeft + 'px';
            image.style.top = newTop + 'px';
        });

        document.addEventListener('mouseup', () => {
            isDragging = false;
            container.style.cursor = 'grab';
        });

        container.addEventListener('wheel', (e) => {
            e.preventDefault();

            let scale = 1 + (e.deltaY > 0 ? -0.1 : 0.1);
            let newWidth = image.clientWidth * scale;

            if (newWidth >= 50 && newWidth <= 500) {
                image.style.width = newWidth + 'px';
            }
        });

        // Configuración del menú desplegable
        document.getElementById('dropdown-container').addEventListener('click', function(e) {
            e.stopPropagation();
            
            const dropdown = document.getElementById('dropdown-content');
            const botonCerrar = document.getElementById('cerrar');
            const botonPerfil = document.getElementById('perfil');
            
            const usuarioLogueado = this.getAttribute('data-sesion') === 'true';
            
            if (usuarioLogueado) {
                botonCerrar.style.display = 'block';
                botonPerfil.style.display = 'block';
                document.querySelectorAll('#dropdown-content a:not(#cerrar,#perfil)').forEach(enlace => {
                    enlace.style.display = 'none';
                });
            } else {
                botonCerrar.style.display = 'none';
                botonPerfil.style.display = 'none';
                document.querySelectorAll('#dropdown-content a:not(#cerrar,#perfil)').forEach(enlace => {
                    enlace.style.display = 'block';
                });
            }
        
            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        });

        document.addEventListener('click', function() {
            document.getElementById('dropdown-content').style.display = 'none';
        });

        // Función para la barra lateral
        function toggleSidebar() {
            var sidebar = document.getElementById("sidebar");
            if (sidebar.style.width === "250px") {
                sidebar.style.width = "0";
            } else {
                sidebar.style.width = "250px";
            }
        }

        // Seleccionar vista por defecto al cargar
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('.view-option').classList.add('active');
        });
    </script>
</body>

<hr class="featurette-divider">

<footer class="container">
    <p class="float-end" style="color: rgb(156, 156, 156);"><a href="#">Back to top</a></p>
    <p style="color: rgb(156, 156, 156);">&copy; 2024 Company, Inc.</p>
    <p style="color: rgb(156, 156, 156);"><strong>Contacto:</strong></p>
    <p style="color: rgb(156, 156, 156);">Teléfono: +57 320 5634901</p>
    <p style="color: rgb(156, 156, 156);">Correo: ArmarioVirtual@gmail.com</p>
    <p><a href="#" style="color: rgb(16, 130, 217);">Sobre Nosotros</a></p>
    <p><a href="#" style="color: rgb(16, 130, 217);">Servicios</a></p>
</footer>
</html>