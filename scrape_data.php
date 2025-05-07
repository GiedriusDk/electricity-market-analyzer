<?php
$url = 'https://ignitis.lt/lt/ismanus-valandinis-elektros-tiekimo-planas#birzos-kainos-grafikas';

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$html = curl_exec($ch);

if (curl_errno($ch)) {
    echo 'cURL error: ' . curl_error($ch);
    exit;
}

curl_close($ch);

// Extract JSON data from the HTML content
if (preg_match('/<script type="application\/json" data-drupal-selector="drupal-settings-json">(.*?)<\/script>/s', $html, $matches)) {
    $jsonData = $matches[1];
    $data = json_decode($jsonData, true);
    $marketData = $data['market_data'];
    $date = $marketData['today_time'];
    $formattedDate = date("Y-m-d", strtotime($date)); // Reformat the date


    $csvFilePath = __DIR__ . '/Hourly/scraped-data.csv';

    if (file_exists($csvFilePath)) {
        $csvContent = file_get_contents($csvFilePath);

        // Check if the CSV file already contains the same date
        if (strpos($csvContent, $date) !== false) {
            //echo "CSV file already contains data for the date $date. No action needed.";
        } else {
            $csvContent .= "$date";

            // Process the data and add rows to the CSV
            foreach ($marketData['today'] as $hourData) {
                $startHour = $hourData['start_hour'];
                $endHour = $hourData['end_hour'];
                $value = $hourData['value'];

                // Add the data for each hour
                $csvContent .= "\n$startHour - $endHour,$value";
            }
            $csvContent .= "\n";

            file_put_contents($csvFilePath, $csvContent);

            //echo "New data has been appended to the CSV file: $csvFilePath";
        }
    } else {
        $csvContent = "$date";

        foreach ($marketData['today'] as $hourData) {
            $startHour = $hourData['start_hour'];
            $endHour = $hourData['end_hour'];
            $value = $hourData['value'];

            $csvContent .= "\n$startHour - $endHour,$value";
        }

        file_put_contents($csvFilePath, $csvContent);

        //echo "CSV file has been created and saved to: $csvFilePath";
    }
} else {
    echo 'JSON data not found on the page.';
}
?>
