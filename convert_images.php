<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Storage;

$files = Storage::disk('public')->allFiles();
$count = 0;
foreach ($files as $file) {
    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    if (in_array($ext, ['jpg', 'jpeg', 'png'])) {
        $path = Storage::disk('public')->path($file);
        $webpPath = substr($path, 0, strrpos($path, '.')) . '.webp';
        
        $img = $ext === 'png' ? @imagecreatefrompng($path) : @imagecreatefromjpeg($path);
        if ($img) {
            imagepalettetotruecolor($img);
            if ($ext === 'png') {
                imagealphablending($img, true);
                imagesavealpha($img, true);
            }
            if(imagewebp($img, $webpPath, 85)) {
                imagedestroy($img);
                Storage::disk('public')->delete($file);
                echo "Converted: $file\n";
                $count++;
            }
        }
    }
}
echo "Total converted: $count\n";
