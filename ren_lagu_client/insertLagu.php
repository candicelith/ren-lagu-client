<?php

if (isset($_POST['submit'])) {
    $judul = $_POST['judul'];
    $artis = $_POST['artis'];

    // Ensure the correct endpoint URL is used for your REST API
    $url = 'http://10.33.35.34/ren_lagu_api/lagu_api.php';
    $ch = curl_init($url);

    // Data to send to REST API in JSON format
    $jsonData = array(
        'judul' => $judul,
        'artis' => $artis,
    );

    // Encode the array into JSON.
    $jsonDataEncoded = json_encode($jsonData);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Ensure sending the request using the POST method
    curl_setopt($ch, CURLOPT_POST, true);

    // Attach the encoded JSON string to the POST fields.
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);

    // Set the content type to application/json
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

    // Execute the request
    $result = curl_exec($ch);

    // Check if cURL request was successful
    if ($result === false) {
        // If cURL failed, show the error message
        $error_msg = curl_error($ch);
        echo "<center><br>Error with cURL request: $error_msg</center>";
    } else {
        // Decode the JSON response
        $result = json_decode($result, true);

        // Check if the result is a valid array and has the required keys
        if (is_array($result) && isset($result['status']) && isset($result['message'])) {
            // Display response status and message
            print("<center><br>status :  {$result['status']} ");
            print("<br>");
            print("message :  {$result['message']} ");
            echo "<br>Sukses terkirim ke ubuntu server !";
            echo "<br><a href=showLagu.php> OK </a>";
        } else {
            // Handle cases where JSON decoding failed or the response structure is invalid
            echo "<center><br>Invalid response from server. The API response might not be in the expected format.</center>";
            var_dump($result);  // Debug the raw response
        }
    }

    // Close cURL resource
    curl_close($ch);
}
?>