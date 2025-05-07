<?php
$csvFile = 'scraped-data.csv';

if (file_exists($csvFile)) {
    $csvData = array_map('str_getcsv', file($csvFile));
    $header = array_pop($csvData); // Get and remove the last row

    $hours = [];
    $todayPrice = [];
    $date = null;

    for ($i = count($csvData) - 1; $i >= 0; $i--) {
        $row = $csvData[$i];
        if (count($row) === 1) {
            // This is a date row, update the date
            $date = $row[0];
            break; // Stop processing when the latest date is found
        } else {
            list($startHour, $endHour) = explode(' - ', $row[0]);
            $hours[] = $startHour;
            $todayPrice[] = (float) $row[1];
        }
    }

    $hoursAll = [];
    $todayPriceAll = [];
    $dateAll = [];

    foreach ($csvData as $row) {
        // Check if the row contains dashes, if it does, it's a date
        $dashes = substr_count($row[0],"-"); 
        if (DateTime::createFromFormat('Y-m-d', $row[0]) !== false) {
            $dateAll[] = $row[0];
        } else {
            // If not, it's the price
            list($startHour, $endHour) = explode(' - ', $row[0]);
            $hoursAll[] = $startHour;
            $todayPriceAll[] = (float) $row[1];
        }
    }

    // Reverse the arrays back
    $hours = array_reverse($hours);
    $todayPrice = array_reverse($todayPrice);

    $chartData = [
        "hours" => $hours,
        "todayPrice" => $todayPrice,
        "date" => $date,
        "hoursAll" => $hoursAll,
        "todayPriceAll" => $todayPriceAll,
        "dateAll" => $dateAll,
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
