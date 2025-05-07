<?php
$csvFile = 'scraped-data2.csv';

if (file_exists($csvFile)) {
    $csvData = array_map('str_getcsv', file($csvFile));
    $header = array_pop($csvData); // Get and remove the last row

    $date2 = [];
    $numericPricePerKWh = [];
    
    foreach ($csvData as $row) {
        // Check if the row contains dashes, if it does, it's a date
        if (strpos($row[0], '-') !== false) {
            $date2[] = $row[0];
        } else {
            // If not, it's the price
            $numericPricePerKWh[] = (float) $row[0];
        }
    }

    $chartData = [
        "numericPricePerKWh" => $numericPricePerKWh,
        "date2" => $date2,
    ];
    
    header('Content-Type: application/json');
    echo json_encode($chartData);
    
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
