<?php

use PHPUnit\Framework\TestCase;

class PortForwardingTest extends TestCase
{
    private $baseURL = 'http://localhost:80';

    /** @test */
    public function successfulConnection()
    {
        $port = 80;
        $url = $this->baseURL . ':' . $port;
        $response = @file_get_contents($url);
        $this->assertTrue($response !== false, 'Failed to establish a connection via port forwarding.');
    }

    /** @test */
    public function invalidConfigurations()
    {
        $invalidPort = 9999;
        $url = $this->baseURL . ':' . $invalidPort;

        // Use stream_context_create to handle the error when attempting to connect to an invalid port
        $context = @stream_context_create(['http' => ['timeout' => 1]]);
        $response = @file_get_contents($url, false, $context);

        $this->assertFalse($response, 'Connection succeeded with invalid configurations.');
    }

}
