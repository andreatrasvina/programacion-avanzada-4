<?php
session_start();

if(isset($_POST['action'])){
  switch($_POST['action']){

    case 'create_product':
      $nombre = $_POST['name']; 
      $slug = $_POST['slug'];    
      $description = $_POST['description'];
      $features = $_POST['features'];
      $brand_id = $_POST['brand_id'];

      $cover = null;
      if (isset($_FILES['cover']) && $_FILES['cover']['error'] == UPLOAD_ERR_OK) {
          $cover = $_FILES['cover'];
      }

      $productController = new ProductController();
      $productController->create($nombre, $slug, $description, $features, $cover, $brand_id);
      break;

      case 'update_product':
        $nombre = $_POST['nombre'];
        $slug = $_POST['slug'];
        $description = $_POST['description'];
        $features = $_POST['features'];
        $product_id = $_POST['product_id'];
        $producController = new ProducController();
        $producController->update($nombre,$slug,$description,$features,$product_id);
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

  function create($nombre, $slug, $description, $features, $cover, $brand_id) {
    $curl = curl_init();
    $data = [
        'name' => $nombre,
        'slug' => $slug,
        'description' => $description,
        'features' => $features,
        'brand_id' => $brand_id,
    ];

    if ($cover) {
        $data['cover'] = new CURLFile($cover['tmp_name'], $cover['type'], $cover['name']);
    }
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $data,
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer ' . $_SESSION['api_token'],
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
  
    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        header("Location: ../home.php"); 
        exit;
    }
  }

  public function update($nombre,$slug,$description,$features,$product_id)
	{
		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'PUT',
		  CURLOPT_POSTFIELDS => 'name='.$nombre.'&slug='.$slug.'&description='.$description.'&features='.$features.'&id='.$product_id,
		  CURLOPT_HTTPHEADER => array(
		    'Content-Type: application/x-www-form-urlencoded',
		    'Authorization: Bearer '.$_SESSION['user_data']->token
		  ),
		));
		
		$response = curl_exec($curl); 
		curl_close($curl);
		$response = json_decode($response);
		if (isset($response->code) && $response->code == 4) {
			
			header('Location: ../home.php?status=ok');
		}else{
			header('Location: ../home.php?status=error');
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
