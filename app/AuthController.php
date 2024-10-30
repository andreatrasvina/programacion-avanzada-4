<?php
session_start();

if (isset($_POST['action'])) {
    if (isset($_POST['global_token']) && $_POST['global_token'] === $_SESSION['global_token']) {
        switch ($_POST['action']) {
            case 'access':
                $authController = new AuthController();
                $email = strip_tags($_POST['email']);
                $password = strip_tags($_POST['contrasena']);

                $authController->login($email, $password);
                break;
        }
    } else {
        $_SESSION['error_message'] = 'Error: Solicitud no válida.';
        header("Location: ../index.php");
        exit();
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
            CURLOPT_POSTFIELDS => array('email' => $email, 'password' => $password),
            CURLOPT_HTTPHEADER => array(
                'Cookie: XSRF-TOKEN=your_xsrf_token_here; apicrud_session=your_session_token_here'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response);

        if (isset($response->data->name) && isset($response->data->token)) {
            $_SESSION['user_data'] = $response->data;
            $_SESSION['user_id'] = $response->data->id;
            $_SESSION['api_token'] = $response->data->token; 

            echo "<script>
                    localStorage.setItem('user_token', '{$response->data->token}');
                    window.location.href = '../home.php';
                  </script>";
            exit();

        } else {
            $_SESSION['error_message'] = 'Error: Credenciales incorrectas. Inténtalo de nuevo.';
            header('Location: ../index.php');
            exit();
        }
    }
}
?>