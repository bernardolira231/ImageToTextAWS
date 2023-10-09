<?php 
    /**
     * Converts an image to text using the specified API URL, token, and filename.
     *
     * @param string $API_URL The URL of the API.
     * @param string $token The authentication token.
     * @param string $filename The path to the image file.
     * @throws Exception If there is an error during the conversion process.
     * @return void
     */
    function imageToText($API_URL, $token, $filename){

        $headers = array(
            "Authorization: Bearer $token"
        );

        $data = file_get_contents($filename);

        $ch = curl_init($API_URL);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if($response === false) {
            echo 'Error al realizar la solicitud: ' . curl_error($ch);
        } else {
            $json_response = json_decode($response, true);
            #print_r($json_response);
            echo $json_response[0]['generated_text'];
        }

        curl_close($ch);
    }
?>