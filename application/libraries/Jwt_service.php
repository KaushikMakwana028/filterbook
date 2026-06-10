<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jwt_service
{
    private $secret = 'fillterbook_jwt_secret_change_this_in_production_2026';
    private $algo = 'sha256';

    private function base64UrlEncode($data)
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    private function base64UrlDecode($data)
    {
        $remainder = strlen($data) % 4;

        if ($remainder) {
            $data .= str_repeat('=', 4 - $remainder);
        }

        return base64_decode(strtr($data, '-_', '+/'));
    }

    public function encode(array $payload, $ttl = 86400)
    {
        $issuedAt = time();
        $payload['iat'] = $issuedAt;
        $payload['exp'] = $issuedAt + (int) $ttl;

        $header = [
            'typ' => 'JWT',
            'alg' => 'HS256',
        ];

        $headerEncoded = $this->base64UrlEncode(json_encode($header));
        $payloadEncoded = $this->base64UrlEncode(json_encode($payload));
        $signature = hash_hmac($this->algo, $headerEncoded . '.' . $payloadEncoded, $this->secret, true);

        return $headerEncoded . '.' . $payloadEncoded . '.' . $this->base64UrlEncode($signature);
    }

    public function decode($token)
    {
        if (!is_string($token) || trim($token) === '') {
            throw new Exception('Token is missing.');
        }

        $parts = explode('.', $token);

        if (count($parts) !== 3) {
            throw new Exception('Invalid token format.');
        }

        list($headerEncoded, $payloadEncoded, $signatureProvided) = $parts;

        $header = json_decode($this->base64UrlDecode($headerEncoded), true);
        $payload = json_decode($this->base64UrlDecode($payloadEncoded), true);

        if (!is_array($header) || !is_array($payload)) {
            throw new Exception('Invalid token payload.');
        }

        if (($header['alg'] ?? '') !== 'HS256') {
            throw new Exception('Unsupported token algorithm.');
        }

        $signature = hash_hmac($this->algo, $headerEncoded . '.' . $payloadEncoded, $this->secret, true);
        $expectedSignature = $this->base64UrlEncode($signature);

        if (!hash_equals($expectedSignature, $signatureProvided)) {
            throw new Exception('Invalid token signature.');
        }

        if (isset($payload['exp']) && time() >= (int) $payload['exp']) {
            throw new Exception('Token has expired.');
        }

        return $payload;
    }
}
