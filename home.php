<?php
 session_start();
  include_once("app/ProductController.php");
  $productController = new ProductController();
  $products = $productController->getAllProducts($_SESSION['api_token']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark w-100 mb-3">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Navbar</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Dropdown
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">Action</a></li>
                  <li><a class="dropdown-item" href="#">Another action</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link disabled" aria-disabled="true">Disabled</a>
              </li>
            </ul>
            <form class="d-flex" role="search">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success me-3" type="submit">Search</button>
              <a href="add.php" class="btn btn-success"t ype="submit">+</a>
            </form>
          </div>
        </div>
      </nav>

    <div class="container-fluid">

        <div class="row">

            <nav class="col-md-3 col-lg-2 bg-light sidebar py-4 overflow-auto h-100 rounded d-none d-md-block">
                
                <div class="px-3">
                    <h5 class="text-dark">Sidebar</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link text-dark active" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="#">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="#">Orders</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="#">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="#">Customers</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-4">
              <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">

                  <?php if (!empty($products)) : ?>
                      <?php foreach ($products as $product) : ?>
                          <div class="col">
                              <div class="card">
                                  <div class="card-body">
                                      <!--img-->
                                      <img class="d-block w-50 mx-auto" src="<?= $product->cover ?>">

                                      <!--nombre-->
                                      <h5 class="card-title pt-3"><?= $product->name ?></h5>

                                      <!--descripcionn-->
                                      <p class="card-text"><?= $product->description ?></p>

                                      <!-- btn-->
                                      <?php
                                        echo '<a href="details.php?slug=' . $product->slug . '" class="btn btn-dark">Ver Detalles</a>';                                       
                                      ?>

                                      <div class="row">
                                        <div class="col-sm-12 pt-3">
                                          <a href="edit.php" class="btn btn-success" role="button" aria-pressed="true">Editar</a>
                                          <a href="#" class="btn btn-danger" role="button" aria-pressed="true">Borrar</a>
                                        </div>
                                      </div>


                                    </div>
                              </div>
                          </div>
                      <?php endforeach; ?>
                  <?php else : ?>
                      <p>NO EXISTEN</p>
                  <?php endif; ?>

                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
