<?php
session_start();

if(isset($_POST['action'])){
  switch($_POST['action']){

    case 'create_product':
      $nombre = $_POST['name']; 
      $slug = $_POST['slug'];    
      $description = $_POST['description'];
      $features = $_POST['features'];

      $productController = new ProductController();
      $productController->create($nombre, $slug, $description, $features);
      break;

    case 'update':
      $productId = $_POST['productId'];
      $nombre = $_POST['nameEditar'];
      $slug = $_POST['slugEditar'];
      $description = $_POST['descriptionEditar'];
      $features = $_POST['featuresEditar'];
      
      $productController = new ProductController();
      $productController->editarProducto($productId, $nombre, $slug, $description, $features);
      break;
  }
}

class ProductController {

  function getProduct($slug) {
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products/slug/' . $slug,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer ' . $_SESSION['api_token']
      ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);
    
    $decodedResponse = json_decode($response);
    return $decodedResponse ? $decodedResponse->data : null;
  }

  function getAllProducts($token) {
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer ' . $token,
      ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);

    $decodedResponse = json_decode($response);
    return $decodedResponse ? $decodedResponse->data : null;
  }

  function create($nombre, $slug, $description, $features) {
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array(
            'name' => $nombre,
            'slug' => $slug,
            'description' => $description,
            'features' => $features
        ),
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer ' . $_SESSION['api_token'], 
        ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);

    $decodedResponse = json_decode($response);
    
    if (isset($decodedResponse->code) && $decodedResponse->code == 4) {
      header('Location: ../home.php?status=ok');
    } else {
      header('Location: ../home.php?status=error');
    }
  }

  function editarProducto($productId, $name, $slug, $description, $features) {
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products/' . $productId,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => http_build_query(array(
        'id' => $productId,
        'name' => $name,
        'slug' => $slug,
        'description' => $description,
        'features' => $features
      )),
      CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer ' . $_SESSION['api_token'],
        'Content-Type: application/json',
      ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);

    $decodedResponse = json_decode($response);

    if ($decodedResponse && isset($decodedResponse->code) && $decodedResponse->code == 4) {
        header("location: ../home.php?status=updated");
    } else {
        header("location: ../home.php?status=error");
    }
  }

  function deleteProduct($productId) {
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products/' . $productId,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'DELETE',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer ' . $_SESSION['api_token'],
            'Content-Type: application/json',
        ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);

    $decodedResponse = json_decode($response);

    if ($decodedResponse && isset($decodedResponse->code) && $decodedResponse->code == 4) {
        header("Location: ../home.php?status=deleted");
    } else {
        header("Location: ../home.php?status=error");
    }
}
}
?>
