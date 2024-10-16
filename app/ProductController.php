<?php
session_start();
class ProductController
{
  function getAllProducts($token)
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
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer ' . $token,
    'Cookie: XSRF-TOKEN=eyJpdiI6Ilp6a0d6MDVLb3E4Z2VhdFByelB5a3c9PSIsInZhbHVlIjoiQWF6N2Zyb29vbVdZczJwc1JoVTVMeXAyZ1VLOTFHM1h6TFJmVW1udTZSMFRoRVV0a0lwaDRpZm1iVWl1QXpOd1haM0RNaDVUZUJjc2szTWdka1diZWtCVHBCb2J0WVBKL0tLS1k1cy8vRlZCeW9ldEJmOStWbnhIdFhMbHFCT2EiLCJtYWMiOiI0NGEzOTFkNDAyYjdkNDBhNDBiMzVjMzMyNDkzM2NkMTIxZWNhYjEwY2U1ODkwODA5YTYzNjAzNTJhZDMxMmJlIiwidGFnIjoiIn0%3D; apicrud_session=eyJpdiI6IndDNnZxNE9hNkJKM2hpcXFnSTJrNUE9PSIsInZhbHVlIjoiRXlvc1gwYUhaWWJjN1pNM2RrdWVtVEtrUU9jOGtsVjYwQ0l6cVdZQVZZRklYcURpdy9ha3g1UUNnU3lFQXNnNHdmZzQzNnZwU1M1TDZOalgxcTMrZkRVQlFvMzdUZm5OUVdPLzgzUk51bGxnaGFBU0Z2SnF5UEJNR2o0TVFtS3IiLCJtYWMiOiJkNTBjZDNlZDJkNDYzNTkzMDQ3MzUyY2EwZmZiODRjNjk3YjdmZjI1ZjkxMzVjZjQwNzBiNmZlNzVlZTQwMDhlIiwidGFnIjoiIn0%3D'
  ),
));
    $response = curl_exec($curl);
    curl_close($curl);

    return json_decode($response)->data;
  }
}