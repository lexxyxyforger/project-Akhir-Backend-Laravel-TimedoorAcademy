<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
use Illuminate\Support\Facades\DB;

// Replace known absolute URLs to relative storage path
DB::statement("UPDATE products SET image_url = REPLACE(image_url, 'http://localhost:8000/storage/', '/storage/') WHERE image_url LIKE 'http://localhost:8000/storage/%'");
DB::statement("UPDATE products SET image_url = REPLACE(image_url, 'http://localhost/storage/', '/storage/') WHERE image_url LIKE 'http://localhost/storage/%'");
DB::statement("UPDATE products SET image_url = REPLACE(image_url, 'http://127.0.0.1:8000/storage/', '/storage/') WHERE image_url LIKE 'http://127.0.0.1:8000/storage/%'");

$count = DB::table('products')->where('image_url','LIKE','/storage/%')->count();
echo "rows with relative image_url: $count\n";
