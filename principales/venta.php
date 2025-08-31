<?php

include "conexiones/conexion.php";

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

$stmt = $conn->prepare("SELECT * FROM clientes WHERE nombre = ?");
$stmt->bind_param("s", $cliente);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$suma_total_formateada = number_format($suma_total, 0, '.', '.');

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="imagenes/logo_tienda.png">
    <title>Proceso de compra</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="css/index_css.css">


        <nav class="navbar navbar-expand-lg">

            <div class="container">
                <div class="d-flex justify-content-center align-items-end">
                    <a class="logo" href="main.php">
                        <img src="imagenes/Armario Virtual.png" alt="">
                    </a>
                </div>
            </div>
        </nav>
    
</head>

<section style="background-color:rgb(255, 255, 255); align-items: center;">

    <br><br><br><br><br>

    <div class="container">

        <form action="conexiones/guardarventa.php" method = "post">

            <input type="hidden" id="nombre" name="cliente" value="<?php echo $user['nombre']; ?>">
            <input type="hidden" id="direccion" name="direccion" value="<?php echo $user['direccion']; ?>">
            <input type="hidden" id="fecha" name="fecha">
            <input type="hidden" id="cantidad" name="cantidad" value="<?php echo $suma_cantidad ?>">
            <input type="hidden" id="total" name="total" value="<?php echo $suma_total_formateada ?>">

            <h4 ><strong>Proceso de compra</strong></h4>
            <br>
            <div class="row mb-1">
                <div class="col-md-7">
                    <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                        <div class="col p-4 d-flex flex-column position-static">

                            <table class="table table-bordered tabla-sin-bordes">
                                <thead class="table-dark">
                                    <tr>
                                        <th colspan="2">IDENTIFICACION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="col-md-6" style="margin-left: 20px; pading: 30px;">
                                                <label for="nombre"><?php echo $user['nombre'];?></label>
                                                <label for="apellido"><?php echo $user['apellido'];?></label>
                                            </div>
                                            <div class="col-md-12" style="margin-left: 20px; pading: 30px;">
                                                <label for="nombre"><?php echo $user['correo'];?></label>
                                            </div>
                                            <div class="col-md-12" style="margin-left: 20px; pading: 30px;">
                                                <label for="nombre"><?php echo $user['telefono'];?></label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="perfil.php">
                                                Editar
                                            </a>
                                            
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                        <div class="col p-4 d-flex flex-column position-static">
                        <table class="table table-bordered">
                            <thead class="table-dark">
                                <tr>
                                    <th colspan="2">Resumen de compra</th>
                                </tr>
                            </thead>
                            <tbody style="margin-left: 20px;">
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
                                        <a href="carrito.php">
                                            Volver al carrito
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        </div>
                    </div>
                </div>

                <div class="col-md-7">
                    <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                        <div class="col p-4 d-flex flex-column position-static">

                            <table class="table table-bordered tabla-sin-bordes">
                                <thead class="table-dark">
                                    <tr>
                                        <th colspan="2">DIRECCION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="col-md-12" style="margin-left: 20px; pading: 30px;">
                                                <label for="nombre"><?php echo $user['direccion'];?></label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="perfil.php">
                                                Editar
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            
                        </div>
                    </div>
                </div>

                <div class="col-md-7">
                    <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                        <div class="col p-4 d-flex flex-column position-static">

                            <table class="table table-bordered tabla-sin-bordes">
                                <thead class="table-dark">
                                    <tr>
                                        <th colspan="2">PAGO</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <p style="margin-left: 20px; pading: 30px;">Selecciona el metodo de pago</p>
                                            <br>
                                        
                                            <label style="margin-left: 20px; padding: 15px; border: 1px solid #ccc; display: inline-block; border-radius: 5px; width: 500px;">
                                                <input type="radio" name="pago" value="pse" required>
                                                Tarjeta debito
                                            </label><br><br>

                                            <label style="margin-left: 20px; padding: 15px; border: 1px solid #ccc; display: inline-block; border-radius: 5px; width: 500px;">
                                                <input type="radio" name="pago" value="pse">
                                                PSE
                                            </label><br><br>

                                            <label style="margin-left: 20px; padding: 15px; border: 1px solid #ccc; display: inline-block; border-radius: 5px; width: 500px;">
                                                <input type="radio" name="pago" value="credito">
                                                Tarjeta de crédito
                                            </label><br><br>

                                            <label style="margin-left: 20px; padding: 15px; border: 1px solid #ccc; display: inline-block; border-radius: 5px; width: 500px;">
                                                <input type="radio" name="pago" value="nequi">
                                                NEQUI
                                            </label><br><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input  style="margin-left: 20px;" type="submit" value="Ir a pagar">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            
                        </div>
                    </div>
                </div>

            </div>

        </form>
        
    </div>

</section>

<body>

</body>

<script src="assets/js/plugins/jquery/dist/jquery.min.js"></script>
<script src="assets/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/argon-dashboard.min.js?v=1.1.2"></script>
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
    // Obtener la fecha en formato YYYY-MM-DD
    const hoy = new Date();
    const yyyy = hoy.getFullYear();
    const mm = String(hoy.getMonth() + 1).padStart(2, '0');
    const dd = String(hoy.getDate()).padStart(2, '0');
    const fecha = `${yyyy}-${mm}-${dd}`;

    // Insertar la fecha en el input oculto
    document.getElementById('fecha').value = fecha;
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