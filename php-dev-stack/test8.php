<?php

require __DIR__ . '/vendor/autoload.php';

use Symfony\Component\String\UnicodeString;

//Encrypt/Decrypt values in certain column(s) with provided keys, using asymmetric encryption

// --- Pasul 1: Generarea cheilor ---

// Configurare pentru generarea unei noi perechi de chei RSA
$config = [
    "digest_alg" => "sha512",
    "private_key_bits" => 2048,
    "private_key_type" => OPENSSL_KEYTYPE_RSA,
];

// Creează resursa pentru noua pereche de chei
$privateKeyResource = openssl_pkey_new($config);

// Extrage cheia privată ca string
openssl_pkey_export($privateKeyResource, $privateKey);

// Extrage cheia publică ca string
$publicKeyDetails = openssl_pkey_get_details($privateKeyResource);
$publicKey = $publicKeyDetails["key"];

echo "--- Cheile au fost generate ---" . PHP_EOL;
// echo "Cheia Publică:\n" . $publicKey . PHP_EOL; // Decomentează pentru a vedea cheile
// echo "Cheia Privată:\n" . $privateKey . PHP_EOL; // Decomentează pentru a vedea cheile

// --- Pasul 2: Criptarea ---

$messageToEncrypt = 'Valoare secretă din fișierul CSV.';
$encryptedData = '';

echo "Mesaj Original: " . $messageToEncrypt . PHP_EOL;

// Criptează datele folosind cheia publică
openssl_public_encrypt($messageToEncrypt, $encryptedData, $publicKey);

// Afișăm datele criptate folosind Base64 pentru a le face lizibile
echo "Date Criptate (Base64): " . base64_encode($encryptedData) . PHP_EOL;

// --- Pasul 3: Decriptarea ---

$decryptedData = '';

// Decriptează datele folosind cheia privată corespunzătoare
openssl_private_decrypt($encryptedData, $decryptedData, $privateKey);

echo "Date Decriptate: " . $decryptedData . PHP_EOL;
