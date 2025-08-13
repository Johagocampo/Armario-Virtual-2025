<?php

include "../conexiones/conexion.php";

if (!isset($_SESSION['nombre'])) {
    
    header("Location: ../principales/login.html");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>
    Tablas
  </title>
  <!-- Favicon -->
  <link href="https://cdn-icons-png.freepik.com/256/17873/17873255.png?semt=ais_hybrid" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="../assets/js/plugins/nucleo/css/nucleo.css" rel="stylesheet" />
  <link href="../assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="../assets/css/argon-dashboard.css?v=1.1.2" rel="stylesheet" />
</head>

<body class="">
  <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
      <!-- Toggler -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- User -->
      <ul class="nav align-items-center d-md-none">
        <li class="nav-item dropdown">
          <a class="nav-link nav-link-icon" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="ni ni-bell-55"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right" aria-labelledby="navbar-default_dropdown_1">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="media align-items-center">
              <span class="avatar avatar-sm rounded-circle">
                <img alt="Image placeholder" src="../assets/img/theme/team-1-800x800.jpg
">
              </span>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
            <div class=" dropdown-header noti-title">
              <h6 class="text-overflow m-0">Welcome!</h6>
            </div>
            <a href="../examples/profile.html" class="dropdown-item">
              <i class="ni ni-single-02"></i>
              <span>My profile</span>
            </a>
            <a href="../examples/profile.html" class="dropdown-item">
              <i class="ni ni-settings-gear-65"></i>
              <span>Settings</span>
            </a>
            <a href="../examples/profile.html" class="dropdown-item">
              <i class="ni ni-calendar-grid-58"></i>
              <span>Activity</span>
            </a>
            <a href="../examples/profile.html" class="dropdown-item">
              <i class="ni ni-support-16"></i>
              <span>Support</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#!" class="dropdown-item">
              <i class="ni ni-user-run"></i>
              <span>Logout</span>
            </a>
          </div>
        </li>
      </ul>
      <!-- Collapse -->
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <!-- Collapse header -->
        <div class="navbar-collapse-header d-md-none">
          <div class="row">
            <div class="col-6 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>
    
        <!-- Navigation -->
        <ul class="navbar-nav">
          <li class="nav-item  active ">
            <a class="nav-link " href="../principales/index_admin.php">
              <i class="ni ni-tv-2 text-primary"></i> Dashboard Admin
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link  active " href="../conexiones/tables.php">
              <i class="ni ni-bullet-list-67 text-red"></i> Tables
            </a>
          </li>
        </ul>
        
      </div>
    </div>
  </nav>
  <div class="main-content">
    <!-- Navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="../index.html">Tables</a>
        
        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
                <img alt="Image placeholder" src="https://cdn-icons-png.freepik.com/256/17873/17873255.png?semt=ais_hybrid">
                </span>
                <div class="media-body ml-2 d-none d-lg-block">
                  <span class="mb-0 text-sm  font-weight-bold">
                  <?php echo $_SESSION['nombre']; ?>
                  </span>
                </div>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
              <div class="dropdown-divider"></div>
              <a href="../conexiones/cerrar.php" class="dropdown-item">
                <i class="ni ni-user-run"></i>
                <span>Logout</span>
              </a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
    <!-- End Navbar -->
    <!-- Header -->
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          <!-- Card stats -->
          <div class="row">
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Traffic</h5>
                      <span class="h2 font-weight-bold mb-0">350,897</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                        <i class="fas fa-chart-bar"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                    <span class="text-nowrap">Since last month</span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">New users</h5>
                      <span class="h2 font-weight-bold mb-0">2,356</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                        <i class="fas fa-chart-pie"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> 3.48%</span>
                    <span class="text-nowrap">Since last week</span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Sales</h5>
                      <span class="h2 font-weight-bold mb-0">924</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                        <i class="fas fa-users"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-warning mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span>
                    <span class="text-nowrap">Since yesterday</span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Performance</h5>
                      <span class="h2 font-weight-bold mb-0">49,65%</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                        <i class="fas fa-percent"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 12%</span>
                    <span class="text-nowrap">Since last month</span>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid mt--7">

            <div class="row mt-5">
        <div class="col">
          <div class="card bg-default shadow">
            <div class="card-header bg-transparent border-0">
              <h3 class="text-white mb-0">Ventas</h3>
            </div>
            <div class="table-responsive">
                  <table class="table align-items-center table-dark table-flush">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Direccion</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Metodo de pago</th>
                        <th scope="col">Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php while ($row = $result2->fetch_assoc()) { ?>
                        <tr>

                          <td><?php echo $row["id"]; ?></td>

                            <td>
                              <label for=""><?php echo $row['cliente']; ?></label>
                              
                            </td>
                            <td>
                              <label for=""><?php echo $row['direccion']; ?></label>
                              
                            </td>
                            <td>
                              <label for=""><?php echo $row['fecha']; ?></label>
                              
                            </td>
                            <td>
                              <label for=""><?php echo $row['cantidadP']; ?></label>
                              
                            </td>
                            <td>
                              <label for=""><?php echo $row['metodoPago']; ?></label>
                              
                            </td>
                            <td>
                              <label for=""><?php echo $row['total']; ?></label>
                              
                            </td>
                            
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
            </div>
          </div>
          <br>
        </div>
      </div>

      <!-- Dark table -->
      <div class="row mt-5">
        <div class="col">
          <div class="card bg-default shadow">
            <div class="card-header bg-transparent border-0">
              <h3 class="text-white mb-0">Usuarios</h3>
            </div>
            <div class="table-responsive">
                  <table class="table align-items-center table-dark table-flush">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">Telefono</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Direccion</th>
                        <th scope="col">Rol</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr>

                          <td><?php echo $row["id"]; ?></td>

                          <form method="post">
                            
                            <input type="hidden" id="id" name="id" value="<?php echo $row['id']; ?>">
                            <input type="hidden" id="borrar" name ="eliminarR" value ="ElimUser">


                            <td>
                              <input type="text" id="nombre" name="nombre" class="texto-plano" placeholder="<?php echo $row['nombre']; ?>">
                            </td>

                            <td>
                              <input type="text" id="apellido" name="apellido" class="texto-plano" placeholder="<?php echo $row['apellido']; ?>">
                            </td>

                            <td>
                              <input type="text" id="telefono" name="telefono" class="texto-plano" placeholder="<?php echo $row['telefono']; ?>">
                            </td>

                            <td>
                              <input type="text" id="correo" name="correo" class="texto-plano" placeholder="<?php echo $row['correo']; ?>">
                            </td>

                            <td>
                              <input type="text" id="direccion" name="direccion" class="texto-plano" placeholder="<?php echo $row['direccion']; ?>">
                            </td>

                            <td>
                              <select class="form-control" name="rol" id = "rol">
                                <option value=""><?php echo $row['rol']; ?></option>
                                <option value="User">User</option>
                                <option value="Admin">Admin</option>
                              </select>
                            </td>

                            <td>
                              <button type="submit" formaction="./actualizar_admin.php">
                              <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTM_TSX_JgoUO3P8bvPI8XnpoZDGdOZkpyl1A&s" alt="Actualizar" style="width:45px; height:40px; vertical-align:middle;">
                              </button>
                            </td>

                            <td>
                              <button type="submit" formaction="./eliminar.php">
                              <img src="https://cdn-icons-png.freepik.com/256/12319/12319540.png?semt=ais_hybrid" alt="borrar" style="width:45px; height:40px; vertical-align:middle;">
                              </button>

                            </td>
            
                          </form>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
            </div>
          </div>
          <br>
            <a href="../principales/Registro.html">
              <button>
                <span class="button_top"> Agregar Usuario </span>
              </button>
            </a>
        </div>
      </div>

      <div class="row mt-5">
        <div class="col">
          <div class="card bg-default shadow">
            <div class="card-header bg-transparent border-0">
              <h3 class="text-white mb-0">Productos</h3>
            </div>
            <div class="table-responsive">
                  <table class="table align-items-center table-dark table-flush">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Genero</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php while ($row = $result1->fetch_assoc()) { ?>
                        <tr>

                          <td><?php echo $row["id"]; ?></td>

                          <form method="post">
                            
                            <input type="hidden" id="id" name="id" value="<?php echo $row['id']; ?>">
                            <input type="hidden" id="borrar" name ="eliminarR" value ="ElimPro">

                            <td>
                              <input type="text" id="nombre" name="nombreP" class="texto-plano" placeholder="<?php echo $row['nombre']; ?>">
                            </td>

                            <td>
                              <input type="text" id="apellido" name="precioP" class="texto-plano" placeholder="<?php echo $row['precio']; ?>">
                            </td>

                            <td>
                              <input type="text" id="telefono" name="tipoP" class="texto-plano" placeholder="<?php echo $row['tipo']; ?>">
                            </td>

                            <td>
                              <input type="text" id="correo" name="generoP" class="texto-plano" placeholder="<?php echo $row['genero']; ?>">
                            </td>

                            <td>
                              <input type="text" id="direccion" name="cantidadP" class="texto-plano" placeholder="<?php echo $row['cantidad']; ?>">
                            </td>

                            <td>
                              <button type="submit" formaction="./actualizar_admin.php">
                              <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTM_TSX_JgoUO3P8bvPI8XnpoZDGdOZkpyl1A&s" alt="Actualizar" style="width:45px; height:40px; vertical-align:middle;">
                              </button>
                            </td>

                            <td>
                              <button type="submit" formaction="./eliminar.php">
                              <img src="https://cdn-icons-png.freepik.com/256/12319/12319540.png?semt=ais_hybrid" alt="borrar" style="width:45px; height:40px; vertical-align:middle;">
                              </button>

                            </td>
            
                          </form>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
            </div>
          </div>
          <br>
            <a href="./nuevoproducto.php">
              <button>
                <span class="button_top"> Agregar Producto </span>
              </button>
            </a>
        </div>
      </div>


      <style>
        .texto-plano {
            border: none;
            background: transparent;
            outline: none;
            padding: 0;
            margin: 0;
            font-size: inherit;
            color:white;
            width: auto;
          }

          input::placeholder {
            color: var(--placeholder-color, white);
          }

          button{
            cursor: pointer;
          }
          /* From Uiverse.io by Voxybuns */ 
          button {
            /* Variables */
            --button_radius: 0.75em;
            --button_color: #e8e8e8;
            --button_outline_color: #000000;
            font-size: 14px;
            font-weight: bold;
            border: none;
            cursor: pointer;
            border-radius: var(--button_radius);
            background: var(--button_outline_color);
          }

          .button_top {
            display: block;
            box-sizing: border-box;
            border: 2px solid var(--button_outline_color);
            border-radius: var(--button_radius);
            padding: 0.75em 1.5em;
            background: var(--button_color);
            color: var(--button_outline_color);
            transform: translateY(-0.2em);
            transition: transform 0.1s ease;
          }

          button:hover .button_top {
            /* Pull the button upwards when hovered */
            transform: translateY(-0.33em);
          }

          button:active .button_top {
            /* Push the button downwards when pressed */
            transform: translateY(0);
          }

      </style>

      <!-- Footer -->
      <footer class="footer">
        <div class="row align-items-center justify-content-xl-between">
          <div class="col-xl-6">
            <div class="copyright text-center text-xl-left text-muted">
              &copy; 2018 <a href="https://www.creative-tim.com" class="font-weight-bold ml-1" target="_blank">Creative Tim</a>
            </div>
          </div>
          <div class="col-xl-6">
            <ul class="nav nav-footer justify-content-center justify-content-xl-end">
              <li class="nav-item">
                <a href="https://www.creative-tim.com" class="nav-link" target="_blank">Creative Tim</a>
              </li>
              <li class="nav-item">
                <a href="https://www.creative-tim.com/presentation" class="nav-link" target="_blank">About Us</a>
              </li>
              <li class="nav-item">
                <a href="http://blog.creative-tim.com" class="nav-link" target="_blank">Blog</a>
              </li>
              <li class="nav-item">
                <a href="https://github.com/creativetimofficial/argon-dashboard/blob/master/LICENSE.md" class="nav-link" target="_blank">MIT License</a>
              </li>
            </ul>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!--   Core   -->
  <script src="../assets/js/plugins/jquery/dist/jquery.min.js"></script>
  <script src="../assets/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!--   Optional JS   -->
  <!--   Argon JS   -->
  <script src="../assets/js/argon-dashboard.min.js?v=1.1.2"></script>
  <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
  <script>
    window.TrackJS &&
      TrackJS.install({
        token: "ee6fab19c5a04ac1a32a645abde4613a",
        application: "argon-dashboard-free"
      });
  </script>
</body>

</html>