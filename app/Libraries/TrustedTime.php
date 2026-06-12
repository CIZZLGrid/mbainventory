<?php

namespace App\Libraries;

use DateTimeImmutable;
use DateTimeZone;
use Exception;

class TrustedTime
{
    public function nowUtc(): DateTimeImmutable
    {
        $timestamp = $this->getNtpTimestamp();

        if (!$timestamp) {
            throw new Exception('Cannot verify internet time.');
        }

        return (new DateTimeImmutable('@' . $timestamp))
            ->setTimezone(new DateTimeZone('UTC'));
    }

    private function getNtpTimestamp(): ?int
    {
        $server = 'pool.ntp.org';
        $port = 123;
        $timeout = 3;

        $socket = @fsockopen("udp://{$server}", $port, $errno, $errstr, $timeout);

        if (!$socket) {
            return null;
        }

        stream_set_timeout($socket, $timeout);

        $packet = chr(0x1B) . str_repeat(chr(0x00), 47);

        fwrite($socket, $packet);
        $response = fread($socket, 48);
        fclose($socket);

        if (strlen($response) < 48) {
            return null;
        }

        $data = unpack('N12', $response);

        $ntpSeconds = $data[11];
        $unixSeconds = $ntpSeconds - 2208988800;

        return $unixSeconds;
    }
}