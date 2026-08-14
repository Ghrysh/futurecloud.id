<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ConvertImagesToWebp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:convert-images-to-webp {--disk=public : The disk to search for images}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Converts all jpg/png images in the specified disk to webp format using cwebp or GD';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        ini_set('memory_limit', '512M');
        $diskName = $this->option('disk');
        $this->info("Scanning disk '{$diskName}' for images to convert...");

        $disk = Storage::disk($diskName);
        $files = $disk->allFiles();
        
        $count = 0;
        
        // Cek apakah cwebp tersedia di sistem (jauh lebih stabil daripada GD)
        $hasCwebp = !empty(shell_exec('which cwebp'));

        foreach ($files as $file) {
            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            if (in_array($ext, ['jpg', 'jpeg', 'png'])) {
                $path = $disk->path($file);
                $webpPath = substr($path, 0, strrpos($path, '.')) . '.webp';
                
                $success = false;
                
                if ($hasCwebp) {
                    $cmd = sprintf('cwebp -q 85 %s -o %s > /dev/null 2>&1', escapeshellarg($path), escapeshellarg($webpPath));
                    shell_exec($cmd);
                    $success = file_exists($webpPath);
                }
                
                if (!$success && function_exists('imagewebp')) {
                    // Fallback to GD
                    $img = $ext === 'png' ? @imagecreatefrompng($path) : @imagecreatefromjpeg($path);
                    if ($img) {
                        imagepalettetotruecolor($img);
                        if ($ext === 'png') {
                            imagealphablending($img, true);
                            imagesavealpha($img, true);
                        }
                        if (@imagewebp($img, $webpPath, 85)) {
                            $success = true;
                        }
                        imagedestroy($img);
                    }
                }

                if ($success) {
                    // Delete original
                    $disk->delete($file);
                    $this->line("Converted and deleted: <info>{$file}</info>");
                    $count++;
                } else {
                    $this->error("Failed to save WebP: {$file}");
                }
            }
        }
        
        $this->info("Conversion complete! Total converted: {$count}");
    }
}
