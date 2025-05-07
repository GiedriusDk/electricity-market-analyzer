<?php
$url2 = 'https://www.kaina24.lt/elektra/';

$ch2 = curl_init($url2);
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
$html2 = curl_exec($ch2);

if (curl_errno($ch2)) {
    echo 'cURL error: ' . curl_error($ch2);
    exit;
}

curl_close($ch2);
//echo(''. $html2);

$dom = new DOMDocument();
@$dom->loadHTML($html2);

$xpath = new DOMXPath($dom);
$productItems = $xpath->query('//div[@class="product-item"]');
$datePattern = '/Elektros tiekėjų kainos paskutinį kartą atnaujintos (\d{4}-\d{2}-\d{2})/';

// Extract the date information
if (preg_match($datePattern, $html2, $dateMatches)) {
    $lastUpdatedDate = $dateMatches[1];
    echo "Last Updated Date: $lastUpdatedDate\n";
} else {
    echo "Date not found or not in the expected format.\n";
}


foreach ($productItems as $productItem) {
    // Extract information from each product item
    $plan = $xpath->evaluate('string(.//h2/a)', $productItem);
    
    similar_text($plan, "Pažangus planas - Standartinis (Viena laiko zona)", $percent);

    if ($percent > 98) {
        $pricePerKWhElement = $xpath->query('.//div[@class="details-1"]/div/span[@title="Vienos laiko zonos tarifas"]', $productItem)->item(0);
        $pricePerKWh = $pricePerKWhElement ? $pricePerKWhElement->nodeValue : '';
        
        // Extract only the numeric part using a regular expression
        preg_match('/([\d.]+)/', $pricePerKWh, $matches);
        $numericPricePerKWh = isset($matches[1]) ? $matches[1] : '';

        echo "Provider Name: $plan\n";
        echo "Price per kWh: $numericPricePerKWh\n";


        echo "-----------------\n";

        break;
    }
}

   


    $csvFilePath2 = __DIR__ . '/Hourly/scraped-data2.csv';

    if (file_exists($csvFilePath2)) {
        $csvContent2 = file_get_contents($csvFilePath2);

            // Remove existing "eof" lines
        $csvLines = explode("\n", $csvContent2);
        $csvLines = array_filter($csvLines, function($line) {
            return trim($line) !== 'eof';
        });
        $csvContent2 = implode("\n", $csvLines);

        // Check if the CSV file already contains the same date
        if (strpos($csvContent2, $lastUpdatedDate) !== false) {
            //echo "CSV file already contains data for the date $lastUpdatedDate. No action needed.";
        } else {
            $csvContent2 .= "$lastUpdatedDate";            
            $csvContent2 .= "\n";
            $csvContent2 .= "$numericPricePerKWh\n";
            $csvContent2 .= "eof\n";



            file_put_contents($csvFilePath2, $csvContent2);

            //echo "New data has been appended to the CSV file: $csvFilePath2";
        }
    } else {
        $csvContent2 .= "$lastUpdatedDate";            
        $csvContent2 .= "\n";
        $csvContent2 .= "$numericPricePerKWh\n";
        $csvContent2 .= "eof\n";


        file_put_contents($csvFilePath2, $csvContent2);

        //echo "CSV file has been created and saved to: $csvFilePath2";
    }

?>
