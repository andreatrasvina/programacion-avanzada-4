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

    <main class="col-lg-6 mx-auto px-4">

        <form>
            <div class="form-group row">
                <label for="nameProduct" class="col-sm-2 col-form-label">Nombre</label>
                <div class="col-sm-10 pb-4">
                <input type="text" class="form-control" id="inputPassword" placeholder="Laptop negra HP">
                </div>
            </div>

            <div class="form-group row">
                <label for="priceProduct" class="col-sm-2 col-form-label">Precio</label>
                <div class="col-sm-10 pb-4">
                <input type="text" class="form-control" id="priceProduct" placeholder="$19999">
                </div>
            </div>

            <div class="form-group row">
                <label for="descriptionProduct" class="col-sm-2 col-form-label">Descripcion</label>
                <div class="col-sm-10 pb-4">
                <textarea type="text" class="form-control" id="descriptionProduct" placeholder="Este equipo contiene memoria ram de 32GB..." rows="3"></textarea>
                </div>
            </div>

            <div class="form-group row custom-control custom-checkbox">
                <label for="descriptionProduct" class="col-sm-2 col-form-label">Etiquetas</label>
                
                <div class="col-sm-10 pb-4">
                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                    <label class="custom-control-label" for="customCheck1">Lorem</label>

                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                    <label class="custom-control-label" for="customCheck1">Ipsum</label>

                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                    <label class="custom-control-label" for="customCheck1">Dolor</label>

                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                    <label class="custom-control-label" for="customCheck1">Sit</label>

                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                    <label class="custom-control-label" for="customCheck1">Amet</label>
                </div>
            </div>

            <div class="form-group row custom-control custom-checkbox">
                <label for="descriptionProduct" class="col-sm-2 col-form-label">Categorias</label>
                
                <div class="col-sm-10 pb-4">
                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                    <label class="custom-control-label" for="customCheck1">Lorem</label>

                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                    <label class="custom-control-label" for="customCheck1">Ipsum</label>

                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                    <label class="custom-control-label" for="customCheck1">Dolor</label>

                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                    <label class="custom-control-label" for="customCheck1">Sit</label>

                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                    <label class="custom-control-label" for="customCheck1">Amet</label>
                </div>
            </div>

            <div class="form-group custom-file pb-4">
                <input type="file" class="custom-file-input" id="customFileLang" lang="es">
                <label class="custom-file-label" for="customFileLang">Seleccionar Archivo</label>
            </div>

            <button type="submit" class="btn btn-primary">Guardar producto</button>
        </form>
              
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>