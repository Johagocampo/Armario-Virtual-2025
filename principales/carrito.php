<?php

include "../conexiones/conexion.php";

$cliente = $_SESSION['nombre'];

$sql = "SELECT COUNT(*) FROM carrito WHERE cliente = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $cliente); // ← "s" para string
$stmt->execute();
$stmt->bind_result($total_registros);
$stmt->fetch();
$stmt->close();

$sql = "SELECT SUM(total) AS total_precio FROM carrito WHERE cliente = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $cliente); // ← "s" para string
$stmt->execute();
$stmt->bind_result($suma_total);
$stmt->fetch();
$stmt->close();

$sql = "SELECT SUM(cantidad) AS total_cantidad FROM carrito WHERE cliente = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $cliente); // ← "s" para string
$stmt->execute();
$stmt->bind_result($suma_cantidad );
$stmt->fetch();
$stmt->close();

$stmt = $conn->prepare("SELECT * FROM carrito WHERE cliente = ?");
$stmt->bind_param("s", $cliente);
$stmt->execute();
$result = $stmt->get_result();

$suma_total_formateada = number_format($suma_total, 0, '.', '.');

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../imagenes/logo_tienda.png">
    <title>Carrito</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="../principales/css/index_css.css">


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
    
                    <div class="bolsa-container" style="position: relative; display: inline-block;">
                    <a href="carrito.php">
                        <img href= "carrito.php" src="https://cdn-icons-png.flaticon.com/512/11544/11544758.png" alt="" class="bolsa ms-auto">
                    </a>
                    <div class="notification-badge"> <?php echo $total_registros; ?> </div>
                    
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
        </div>
    </main>
</header>

<section style="background-color:rgb(255, 255, 255); text-align: center;">
    <br><br><br><br><br>
    <h1 style="display: inline-block; margin: 0;">Carrito</h1>
    <br><br>
    <h3 style="display: inline-block; margin: 0;">Detalle de su pedido a realizar</h3>
    <br><br><br><br>

    <div class="container">
        <div class="row mb-2">
            <div class="col-md-12">
                <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <div class="col p-4 d-flex flex-column position-static">
                        <table class="table table-bordered table-striped">
                            <thead class="table-dark">
                            <tr>
                                <th>Imagen</th>
                                <th>Nombre</th>
                                <th>Cantidad</th>
                                <th>Talla</th>
                                <th>Precio</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php while ($row = $result->fetch_assoc()) { ?>
                            <tr>

                            <form method="post" action= "../conexiones/procesar.php" onsubmit="return validarInput()">

                                <input type="hidden" id="id" name="id" value="<?php echo $row['id']; ?>">
                                <input type="hidden" id="cantidad" name="cantidad" value="<?php echo $row['cantidad']; ?>">

                                <td>
                                    <img src="<?php echo $row['imagen']; ?>" alt="Imagen" width="50">
                                </td>

                                <td>
                                    <label for="imagen" id="nombre" name="nombre" class="texto-plano"><?php echo $row['nombre']; ?></label>
                                </td>

                                <td>
                                    <button class="delete" type="submit"  value ="file1" name="submit_file">
                                        <input type="number" class="inputTexto" name="cantidad" value = "<?php echo $row['cantidad']; ?>" style="border: none; outline: none; width:40px;">
                                    </button>
                                </td>
        
                                <td>
                                    <label for="imagen" id="nombre" name="nombre" class="texto-plano"><?php echo $row['talla']; ?></label>
                                </td>

                                <td>
                                    <label for="imagen" id="nombre" name="nombre" class="texto-plano"><?php echo $row['precio']; ?></label>
                                </td>

                                <td>
                                    <button class="delete" type="submit"  value ="file2" name="submit_file">
                                        <strong>X</strong>
                                    </button>
                                </td>
                            </form>
                            </tr>
                        <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <div class="col p-4 d-flex flex-column position-static">
                    <table class="table table-bordered tabla-sin-bordes">
                        <thead class="table-dark">
                            <tr>
                                <th colspan="2">Resumen de compra</th>
                            </tr>
                        </thead>

                        <form action="venta.php">
                            <tbody>
                                <tr>
                                    <td>Cantidad</td>
                                    <td><?php echo $suma_cantidad  ?></td>
                                </tr>
                                <tr>
                                    <td>Envio</td>
                                    <td><strong>Gratis</strong></td>
                                </tr>

                                <tr>
                                    <td><strong>Total</strong></td>
                                    <td><?php echo "$". $suma_total_formateada ?></td>
                                </tr>

                                <tr>
                                    <td>
                                        <button type="submit"><strong>Continuar Compra</strong></button>
                                    </td>
                                </tr>
                            </tbody>
                        </form>
                    </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

<body>
</body>


<script src="../assets/js/plugins/jquery/dist/jquery.min.js"></script>
<script src="../assets/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/argon-dashboard.min.js?v=1.1.2"></script>
<script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
<script>
    window.TrackJS &&
    TrackJS.install({
        token: "ee6fab19c5a04ac1a32a645abde4613a",
        application: "argon-dashboard-free"
    });
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


    

    .delete{
        background: none;
        color: red;
        width: 20px;
    }

    .cantidad{
        border: none;
        outline: none;
        width: 40px;
    }

</style>

<script>
    function validarInput() {
        const input = btn.getElementById('.inputTexto');

        if (input.value.trim() === "") {
            return false;
        }
        return true;
    }
</script>

<script>

    const imagenLink = localStorage.getItem('imagenLink');
    if (imagenLink) {
        document.getElementById('imagenMostrada').src = imagenLink;
    }

    const textoCopiado = localStorage.getItem('textoCopiado');
    if (textoCopiado) {

        const strongElement = document.createElement('strong');
        strongElement.innerText = textoCopiado;

        document.getElementById('textoMostrado').appendChild(strongElement);
        document.title = textoCopiado;
    }

    const textoPrecio = localStorage.getItem('textoPrecio');
    if (textoPrecio) {
        document.getElementById('precioMostrado').textContent = textoPrecio;
    }

    document.getElementById('dropdown-container').addEventListener('click', function () {
        const dropdown = document.getElementById('dropdown-content');
        dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
    });

    document.addEventListener('click', function (event) {
        const container = document.getElementById('dropdown-container');
        const dropdown = document.getElementById('dropdown-content');
        if (!container.contains(event.target)) {
            dropdown.style.display = 'none';
        }
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