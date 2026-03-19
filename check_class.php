<?php
require __DIR__ . '/vendor/autoload.php';

if (class_exists('Mailtrap\Mime\MailtrapEmail')) {
    echo "CLASS FOUND\n";
} else {
    echo "CLASS NOT FOUND\n";
    // Let's see what is in the autoloader for Mailtrap
    $loader = require __DIR__ . '/vendor/composer/autoload_psr4.php';
    if (isset($loader['Mailtrap\\'])) {
        echo "Mailtrap namespace mapped to: " . implode(', ', $loader['Mailtrap\\']) . "\n";
    } else {
        echo "Mailtrap namespace NOT mapped in PSR-4\n";
    }
}
