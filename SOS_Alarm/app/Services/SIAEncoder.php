<?php

namespace App\Services;

class SIAEncoder
{
    /**
     * Encode a SIA message.
     *
     * @param string $eventCode The SIA event code (e.g., 'XT' for low battery).
     * @param string $accountId The unique account ID for the device.
     * @param string $data Additional data for the event.
     * @return string Encoded SIA message.
     */
    public function encodeMessage($eventCode, $accountId, $data)
    {
        // Sequence number (incrementing or random)
        $sequence = str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);

        // Timestamp (UTC/GMT)
        $timestamp = gmdate('_H:i:s,m-d-Y');

        // Event message data
        $messageData = "#{$accountId}|{$eventCode}|{$data}";

        // Compute CRC (checksum)
        $crc = $this->calculateCRC($messageData);

        // Construct the full message
        $message = "<LF>{$crc}<0LLL>*SIA-DCS{$sequence}R0000L0000#{$accountId}[{$messageData}]{$timestamp}<CR>";

        // Optionally encrypt the message
        return $this->encryptMessage($message);
    }

    /**
     * Calculate CRC (checksum) for the message.
     *
     * @param string $message The message to compute the checksum for.
     * @return string Checksum as 4 ASCII characters.
     */
    private function calculateCRC($message)
    {
        $crc = 0;

        // Compute CRC for each byte in the message
        for ($i = 0; $i < strlen($message); $i++) {
            $crc += ord($message[$i]);
        }

        // Convert CRC to 4-character ASCII hex string
        return strtoupper(str_pad(dechex($crc & 0xFFFF), 4, '0', STR_PAD_LEFT));
    }

    /**
     * Encrypt the message using AES.
     *
     * @param string $message The message to encrypt.
     * @return string Encrypted message as a hexadecimal string.
     */
    private function encryptMessage($message)
    {
        $key = "your-256-bit-key"; // Replace with your AES key
        $iv = str_repeat("\0", 16); // Initialization vector (16 bytes of zero)

        // Encrypt the message using AES-256-CBC
        $encrypted = openssl_encrypt($message, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv);

        // Convert encrypted binary data to hexadecimal ASCII
        return bin2hex($encrypted);
    }
}
