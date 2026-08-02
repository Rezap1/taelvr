<?php

$src = 'public/assets/images/logo-ft.jpeg';
$dest = 'public/assets/images/logo-ft.png';

if (!file_exists($src)) {
    die("Source file not found: $src\n");
}

$img = imagecreatefromjpeg($src);
if (!$img) {
    die("Could not load JPEG\n");
}

$width = imagesx($img);
$height = imagesy($img);

$newImg = imagecreatetruecolor($width, $height);
imagealphablending($newImg, false);
imagesavealpha($newImg, true);

$transparent = imagecolorallocatealpha($newImg, 255, 255, 255, 127);
imagefill($newImg, 0, 0, $transparent);

for ($y = 0; $y < $height; $y++) {
    for ($x = 0; $x < $width; $x++) {
        $rgb = imagecolorat($img, $x, $y);
        $r = ($rgb >> 16) & 0xFF;
        $g = ($rgb >> 8) & 0xFF;
        $b = $rgb & 0xFF;

        // If the pixel is very close to white (JPEG artifacts)
        if ($r > 230 && $g > 230 && $b > 230) {
            imagesetpixel($newImg, $x, $y, $transparent);
        } else {
            // Keep original pixel but on the new image
            $color = imagecolorallocatealpha($newImg, $r, $g, $b, 0);
            imagesetpixel($newImg, $x, $y, $color);
        }
    }
}

imagepng($newImg, $dest);
imagedestroy($img);
imagedestroy($newImg);

echo "Converted and removed white background successfully!\n";
