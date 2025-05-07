<?php
$csvFile = 'hourly.csv';

if (file_exists($csvFile)) {
    $csvData = array_map('str_getcsv', file($csvFile));
    $header = array_shift($csvData);

    $data = [];

    foreach ($csvData as $row) {
        $floatRow = [];
        foreach ($row as $value) {
            $floatRow[] = (float) $value; // Convert each value to float
        }

        $data[] = [
            "hours" => $floatRow[0],
            "Jan" => $floatRow[1],
            "Feb" => $floatRow[2],
            "Mar" => $floatRow[3],
            "Apr" => $floatRow[4],
            "May" => $floatRow[5],
            "Jun" => $floatRow[6],
            "Jul" => $floatRow[7],
            "Aug" => $floatRow[8],
            "Sep" => $floatRow[9],
            "Oct" => $floatRow[10],
            "Nov" => $floatRow[11],
            "Dec" => $floatRow[12],
        ];
    }

    header('Content-Type: application/json');
    echo json_encode($data);
} else {
    header('HTTP/1.1 404 Not Found');
    echo 'CSV file not found.';
}
?>
