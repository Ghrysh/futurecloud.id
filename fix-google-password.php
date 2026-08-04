<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// We will just leave existing users alone, or set password=null for all users with google_id 
// BUT we don't know who changed their password. So let's just rely on password being null.
