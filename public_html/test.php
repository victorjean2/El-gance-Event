<?php
// test_mongo.php - à mettre temporairement à la racine
echo phpversion() . "\n";
echo (extension_loaded('mongodb') ? '✅ mongodb OK' : '❌ mongodb ABSENT') . "\n";
print_r(get_loaded_extensions());