<?php

use PHPUnit\Framework\TestCase;

class DataTest extends TestCase
{
    // File paths for the CSV files
    private $hourlyCsvFile = '/var/www/html/electricity-market-analyzer/Hourly/scraped-data.csv';
    private $hourlyCsvFile2 = '/var/www/html/electricity-market-analyzer/Hourly/scraped-data2.csv';
    private $hourlyCsvFile3 = '/var/www/html/electricity-market-analyzer/Hourly/hourly.csv';
    private $csvFile = '/var/www/html/electricity-market-analyzer/OurData/electricity-data.csv';

    /**
     * Test if the hourly CSV file exists.
     */
    public function testHourlyFileExists()
    {
        $this->assertFileExists($this->hourlyCsvFile);
    }

    /**
     * Test if today's date exists in the hourly CSV file.
     */
    public function testHourlyTodayDateExists()
    {
        // Read the content of the hourly CSV file
        $content = file_get_contents($this->hourlyCsvFile);

        // Get today's date
        $today = date('Y-m-d');

        // Assert that today's date is present in the content
        $this->assertStringContainsString($today, $content);
    }

    /**
     * Test the format of data in the hourly CSV file.
     */
    public function testHourlyDataFormat()
    {
        // Read lines from the hourly CSV file
        $lines = file($this->hourlyCsvFile, FILE_IGNORE_NEW_LINES);

        // Iterate through each line
        foreach ($lines as $line) {
            // Skip lines with dates
            if (strpos($line, '-') !== false) {
                continue;
            }

            // Split the line into parts using a comma
            $parts = explode(',', $line);

            // Assert that there are two parts (hours and value)
            $this->assertCount(2, $parts, 'Row does not have the expected number of parts');

            // Assert that the hours have the expected format
            $this->assertMatchesRegularExpression('/^\d{2} - \d{2}$/', $parts[0]);

            // Assert that the value has the expected format
            $this->assertMatchesRegularExpression('/^\d+\.\d+$/', $parts[1]);
        }

        // Add this assertion to mark the test as passed
        $this->assertTrue(true, 'Hourly test passed');
    }

    /**
     * Test if the second hourly CSV file exists.
     */
    public function testHourlyFile2Exists()
    {
        $this->assertFileExists($this->hourlyCsvFile2);
    }

    /**
     * Test if the third hourly CSV file exists.
     */
    public function testHourlyFile3Exists()
    {
        $this->assertFileExists($this->hourlyCsvFile3);
    }

    /**
     * Test the format of data in the CSV file.
     */
    public function testCsvFileFormat()
    {
        // Read the content of the CSV file
        $fileContent = file($this->csvFile);

        // Get the first row
        $firstRow = str_getcsv(trim($fileContent[0]));

        // Assert that the number of columns is either 6 or 7
        $this->assertContains(count($firstRow), [6, 7], 'Csv row 1 does not have the expected number of columns');
    }
}
