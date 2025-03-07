<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>

<?php
$id_lagu = $_GET['id_lagu'];
$curl = curl_init();
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

// URL for fetching data (replace with the correct endpoint)
curl_setopt($curl, CURLOPT_URL, 'http://10.33.35.34/ren_lagu_api/lagu_api.php?id_lagu=' . $id_lagu);
$res = curl_exec($curl);
$json = json_decode($res, true);
curl_close($curl);

// Check if data exists in the response before using it
if (isset($json['data'][0])) {
    $song = $json['data'][0];
    $judul = $song['judul'];
    $artis = $song['artis'];
} else {
    // If there's no valid data, display an error
    $judul = '';
    $artis = '';
    echo "<center><br>No data found for ID: $id_lagu</center>";
}
?>

<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h2>Update Data</h2>
                </div>
                <p>Please fill this form and submit to update.</p>
                <form action="updateLagu.php" method="post">
                    <input type="hidden" name="id_lagu" value="<?php echo $id_lagu; ?>">
                    <div class="form-group">
                        <label>judul</label>
                        <input type="text" name="judul" class="form-control" value="<?php echo htmlspecialchars($judul); ?>">
                    </div>
                    <div class="form-group">
                        <label>artis</label>
                        <input type="text" name="artis" class="form-control" value="<?php echo htmlspecialchars($artis); ?>">
                    </div>
                    <input type="submit" class="btn btn-primary" name="submit" value="Update">
                </form>
            </div>
        </div>        
    </div>
</div>

</body>