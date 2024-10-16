<?php
session_start();

if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'access':
            $authController = new AuthController();

            $email = strip_tags($_POST['email']);
            $password = strip_tags($_POST['contrasena']);

            $authController->login($email, $password);
            break;

        default:
            //otra cosa
            break;
    }
}

class AuthController {
    public function login($email = null, $password = null) {

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://crud.jonathansoto.mx/api/login',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array('email' => $email,'password' => $password),
        CURLOPT_HTTPHEADER => array(
            'Cookie: XSRF-TOKEN=eyJpdiI6IjlWdGFEZmltcVIyaGtiZFREMklZaHc9PSIsInZhbHVlIjoibmhEMkkwaElRZzV4dmxtN1N1d1BYS1NmMzYrL212NHlML3J1cnJ5WVRTMWtzVWFtQi9pMWt0RHVSaXZJRGZRUTdkMnRWYSs4bjIzU2tJV1p6bC9OQVZrRDhwSzJuY1Fwb1ZJWitaT3JUWTk1WHFKMlhPTGd4M0xybHlWS3l3U28iLCJtYWMiOiI0M2I3MTgxOWNmODEyY2U2OWRkODliYTU4NGE3OWRmMDAxNmVlZjRkMWMwYzg3NGIyYzAxZmM4MzBmM2ExNWI5IiwidGFnIjoiIn0%3D; apicrud_session=eyJpdiI6IitjZG82Nk5zN2J5V1l6azVwOEUwSUE9PSIsInZhbHVlIjoibndZaVZHOHlpR1Y5N0VoU0lvYUY2N1NmbEJYNHB0b3kwS0g2VXNoTHB2eU4vQkNENnN5UVZjUXYvSWh5cHc3d2d5RzNOWFp1QnFBRE0wTEtBT0k3bERTRWF5WFpQT2Jhb0d6KzJLQXNraWJVa2xzdE5TUXI1ODczb0laSFJhOEciLCJtYWMiOiJhNzg4YzhjNjMzZDJlMDcwNmZkMmI5ZTY5MzQyM2Y0NWU2YTFhNWM0OGZiYTg0NDM1ZjcyNmYwYjc3MjQ2ZTUwIiwidGFnIjoiIn0%3D'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $response = json_decode($response);

        if (isset($response->data->name) && isset($response->data->token)) {
            $_SESSION['user_data'] = $response->data;
            $_SESSION['user_id'] = $response->data->id;
        
            //token en la sesión
            $_SESSION['api_token'] = $response->data->token; 
            echo "<script>
                    localStorage.setItem('user_token', '{$response->data->token}');
                    window.location.href = '../home.php';
                  </script>";
            //header('Location: ../home.php'); 
            exit();

        } else {
            $_SESSION['error_message'] = 'Error: Credenciales incorrectas. Inténtalo de nuevo.';
            header('Location: ../index.php');
            exit();
        }
        //echo $response->data->name;
        //echo $response->data->id;
    }
}
