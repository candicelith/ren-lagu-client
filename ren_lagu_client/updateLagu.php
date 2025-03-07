<?php

if(isset($_POST['submit']))
{    

$judul = $_POST['judul'];
$artis = $_POST['artis'];
$id_lagu = $_POST['id_lagu'];


//Pastikan sesuai dengan artis endpoint dari REST API di ubuntu
$url='http://10.33.35.34/ren_lagu_api/lagu_api.php?id_lagu='.$id_lagu.'';
$ch = curl_init($url);
//kirimkan data yang akan di update
$jsonData = array(
    'judul' =>  $judul,
    'artis' =>  $artis,
);

//Encode the array into JSON.
$jsonDataEncoded = json_encode($jsonData);


curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//Tell cURL that we want to send a POST request.
curl_setopt($ch, CURLOPT_POST, true);

//Attach our encoded JSON string to the POST fields.
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);

//Set the content type to application/json
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); 

$result = curl_exec($ch);
$result = json_decode($result, true);
curl_close($ch);

//var_dump($result);
print("<center><br>status :  {$result["status"]} "); 
print("<br>");
print("message :  {$result["message"]} "); 
 echo "<br>Sukses mengupdate data di ubuntu server !";
 echo "<br><a href=showLagu.php> OK </a>";
}
?>

 