<?php
session_start();

var_dump($_POST);

if(isset($_POST['action'])){
  switch($_POST['action']){

    case 'create_product':
      $nombre = $_POST['name'];  // Asegúrate de que coincide con el nombre del campo
      $slug = $_POST['slug'];     // Cambié 'slug' a 'slug'
      $description = $_POST['description'];
      $features = $_POST['features'];

      $productController = new ProductController();
      $productController->create($nombre, $slug, $description, $features);
    break;
  }
}

class ProductController{

  function getProduct($slug) {
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products/slug/' . $slug,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer ' . $_SESSION['api_token']
      ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);
    
    return json_decode($response)->data;
  }

  function getAllProducts($token){
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer ' . $token,
      ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);

    return json_decode($response)->data;
  }

  function create($nombre, $slug, $description, $features) {
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
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
    if (curl_errno($curl)) {
        echo 'Error: ' . curl_error($curl);
    } else {
        echo 'Respuesta: ' . $response;
    }
    curl_close($curl);
  }
}
