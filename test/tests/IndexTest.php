<?php

use PHPUnit\Framework\TestCase;

class IndexTest extends TestCase
{
    /** @test */
    public function filesExist()
    {
        $baseDirectory = '/var/www/html/electricity-market-analyzer';

        $filesToCheck = [
            'OurData/my-config.js',
            'OurData/electricity-data.csv',
            'OurData/data.php',
            'Hourly/hourly.csv',
            'Hourly/hourly-config.js',
            'Hourly/hourlydata.php',
            'Hourly/scraped-data.csv',
            'Hourly/scraped-data2.csv',
            'Hourly/scrapedHourlydata.php',
            'Hourly/scrapedHourlydata2.php',
            'index.php',
            'scraped-hourly-config.js',
            'gulpfile.js'
        ];

        foreach ($filesToCheck as $file) {
            $path = $baseDirectory . DIRECTORY_SEPARATOR . $file;
            $this->assertTrue(file_exists($path), "File $file does not exist at $path");
            $content = file_get_contents($path);
            $this->assertNotEmpty($content, "File $file is empty");
        }
    }
}
