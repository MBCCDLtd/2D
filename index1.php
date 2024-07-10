<?php

// Step 1: Get the JSON data from the API
$url = "https://api.thaistock2d.com/live"; // Replace with your API URL
$interval = 5;

$jsonData = file_get_contents($url);
// Step 2: Decode the JSON data into a PHP array
$dataArray = json_decode($jsonData, true); // The 'true' parameter converts it into an associative array
$arrayData = [];
// Check if the decoding was successful
if (json_last_error() === JSON_ERROR_NONE) {
    // Print the PHP array
    foreach ($dataArray as $data) {
        if (is_array($data)) {
            $arrayData[] = $data;
            // foreach ($data as $d) {
            //     print_r($d);
            //     echo "<br>";
            // }
            // echo "<hr>";
        }
    }
} else {
    // Handle the error
    echo "Error decoding JSON: " . json_last_error_msg();
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="live col-md-12 text-center mb-5">
                <h1>Live </h1>
                <h1 class="text-success fw-bold"><?= $arrayData[0]['twod'] ?></h1>
                <h6>Updated at : <?= $arrayData[0]['date'] ?></h6>
            </div>
            <div class="col-md-8">
                <table class="table table-striped table-dark table-hover">
                    <tr>
                        <th class="text-info">Set</th>
                        <th class="text-info">Value</th>
                        <th class="text-info">ချဲထွက်ချိန်</th>
                        <th class="text-info">2D</th>
                        <th class="text-info">နေ့စွဲ</th>
                    </tr>
                    <?php foreach ($arrayData[1] as $data) : ?>
                        <tr>
                            <td><?= $data['set'] ?></td>
                            <td><?= $data['value'] ?></td>
                            <td><?php
                                if ($data['open_time'] == '11:00:00') {
                                    echo "11 နာရီ";
                                }
                                if ($data['open_time'] == '12:01:00') {
                                    echo "12 နာရီ";
                                }
                                if ($data['open_time'] == '15:00:00') {
                                    echo "3 နာရီ";
                                }
                                if ($data['open_time'] == '16:30:00') {
                                    echo "4 နာရီ";
                                }
                                ?></td>
                            <td><?= $data['twod'] ?></td>
                            <td><?= $data['stock_date'] ?></td>
                        </tr>
                    <?php endforeach ?>
                </table>

            </div>
        </div>

    </div>

</body>

</html>