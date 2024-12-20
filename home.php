<?php
 session_start();
  include_once("app/ProductController.php");
  include_once("app/BrandController.php");
  $productController = new ProductController();
  $brandController = new BrandController();
  $brands = $brandController->get();
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
              <?php if (isset($_GET['status'])): ?>
                <?php if ($_GET['status'] == 'deleted'): ?>
                  <div class="alert alert-success">Producto eliminado correctamente.</div>
                <?php elseif ($_GET['status'] == 'error'): ?>
                  <div class="alert alert-danger">Hubo un error al eliminar el producto.</div>
                <?php endif; ?>
              <?php endif; ?>

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

                                  <!--descripcion-->
                                  <p class="card-text"><?= $product->description ?></p>

                                  <!-- Botones -->
                                  <a href="details/<?= $product->slug ?>" class="btn btn-dark">Ver Detalles</a>

                                  <div class="row pt-3">
                                      <div class="col-sm-12">
                                      <button onclick='editar(this)' data-product='<?= json_encode($product)  ?>' data-bs-toggle="modal" data-bs-target="#updateModal" type="button" class="btn btn-warning">
                                        Editar
                                      </button>
                                      
                                      <a href="delete.php?id=<?= $product->id ?>" class="btn btn-danger btn-borrar" onclick="return confirmDelete()">Borrar</a>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  <?php endforeach; ?>
              <?php else : ?>
                  <p>No existen productos</p>
              <?php endif; ?>

            </div>
          </main>
        </div>
    </div>

    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h1 class="modal-title fs-5" id="exampleModalLabel">
	        	Editar producto
	        </h1>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body">
	        <form method="POST" action="app/ProductController.php">
			  
			  <div class="mb-3">
			    <label for="nombre" class="form-label">
			    	Nombre
			    </label>
			    <input type="text" class="form-control" id="update_nombre" name="nombre" aria-describedby="emailHelp" required> 
			  </div>
			  
			  <div class="mb-3">
			    <label for="slug" class="form-label">
			    	Slug
			    </label>
			    <input type="text" class="form-control" id="update_slug" name="slug" required> 
			  </div>
			  <div class="mb-3">
			    <label for="slug" class="form-label">
			    	description
			    </label>
			    <input type="text" class="form-control" id="update_description" name="description" required> 
			  </div>
			  <div class="mb-3">
			    <label for="slug" class="form-label">
			    	features
			    </label>
			    <input type="text" class="form-control" id="update_features" name="features" required> 
			  </div>
			  
			  <div class="mb-3">
			    <label for="slug" class="form-label">
			    	Marca
			    </label>
			    
			    <select class="form-control">
			    	<?php if (isset($brands) && count($brands)): ?>
			    	<?php foreach ($brands as $brand): ?>
			    	<option value="<?= $brand->id ?>">
			    		<?= $brand->name ?>
			    	</option>
			    	<?php endforeach ?>
			    	<?php endif ?>
			    	
			    </select>
			  </div>
			  
			  <button type="submit" class="btn btn-primary">
			  	Crear producto
			  </button>
			  <input type="hidden" name="action" value="update_product">
				
			  <input type="hidden" name="product_id" id="product_id">
			</form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
	        	Cancelar
	        </button> 
	      </div>
	    </div>
	  </div>
	</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
  function confirmDelete() {
      return confirm("¿Estás seguro de que deseas borrar este producto?");
  }
</script>

  <script>
  document.addEventListener('DOMContentLoaded', function() {
      const editButtons = document.querySelectorAll('.btn-editar');
      editButtons.forEach(button => {
          button.addEventListener('click', function() {
              const id = this.getAttribute('data-id');
              const name = this.getAttribute('data-name');
              const slug = this.getAttribute('data-slug');
              const description = this.getAttribute('data-description');
              const features = this.getAttribute('data-features');

              document.getElementById('productId').value = id;
              document.getElementById('nameEditar').value = name;
              document.getElementById('slugEditar').value = slug;
              document.getElementById('descriptionEditar').value = description;
              document.getElementById('featuresEditar').value = features;
          });
      });
  });
  </script>

  <script type="text/javascript">
		
		function editar(boton)
		{
			let producto = JSON.parse(boton.dataset.product);
			console.log(producto.id)
			
			document.getElementById("update_nombre").value = producto.name
			document.getElementById("update_slug").value = producto.slug
			document.getElementById("update_description").value = producto.description
			document.getElementById("update_features").value = producto.features
			document.getElementById("product_id").value = producto.id
			
		}
  </script>

  </body>
</html>
