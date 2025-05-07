<?php
$csvFile = 'electricity-data.csv';

if (file_exists($csvFile)) {
    $csvData = array_map('str_getcsv', file($csvFile));
    $header = array_shift($csvData);

    $data = [];

    foreach ($csvData as $row) {
        $rowData = [
            "date" => $row[0],
            "payed_with_solar" => (float) $row[1],
            "would_pay_without_solar" => (float) $row[2],
            "enefit" => (float) $row[3],
            "elektrum" => (float) $row[4],
            "ignitis" => (float) $row[5],
            "link" => isset($row[6]) ? $row[6] : null,
        ];

        $data[] = $rowData;

    }

    header('Content-Type: application/json');
    echo json_encode($data);

    
} else {
    header('HTTP/1.1 404 Not Found');
    $errorResponse = [
        "error" => "CSV file not found",
        "message" => "The data file could not be located.",
    ];
    echo json_encode($errorResponse);
    error_log('CSV file not found: ' . $csvFile);
}
?>
