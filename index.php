<?php
session_start();

if (isset($_SESSION['error_message'])) {
  echo '<div class="alert alert-danger alert-overlay" role="alert">' . $_SESSION['error_message'] . '</div>';
  unset($_SESSION['error_message']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulario</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

    <div class="container-fluid vh-100">
      
        <div class="row h-100">

        <div class="col-md-6 p-0 d-none d-md-block shadow-lg">
          <img src="assets/images/image.jpg" class="img-fluid w-100 h-100" style="object-fit: cover;">
        </div>
  
        <div class="col-md-6 d-flex align-items-center justify-content-center">

        <div class="w-75">

          <div class="mb-4 text-center">
            <img src="assets/images/logo.png" class="img-fluid mx-auto pb-5" width="250">
          </div>

          <h2 class="pb-1">WELCOME TO REDBULL TEAM!</h2>

          <form method="POST" action="app/AuthController.php">

            <div class="mb-3">
              <label for="email" class="form-label">Email address</label>
              <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" required>
              <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>

            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="exampleInputPassword1" name="contrasena" required>
            </div>

            <div class="mb-3 form-check">
              <input type="checkbox" class="form-check-input" id="check" name="remember_me">
              <label class="form-check-label" for="check">Check me out</label>
            </div>

            <button type="submit" class="btn btn-dark w-100">Submit</button>

            <input type="hidden" name="action" value="access">
          </form>
          
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script>
setTimeout(function() {
    var alertElement = document.querySelector('.alert');
    if (alertElement) {
        alertElement.style.display = 'none';
    }
}, 5000);

//si hay o no
const token = localStorage.getItem('user_token');

if (token) {
    console.log('Usuario autenticado, token presente:', token);
} else {
    console.log('No hay token, el usuario no ha iniciado sesión');
}


</script>
  </body>
</html>
