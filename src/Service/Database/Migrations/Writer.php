<?php
namespace Mbroersen\LaravelDatabaseMigrate\Service\Database\Migrations;

use Illuminate\Support\Facades\File;

class Writer
{
    public static function write($filePath, $migration)
    {
        if (!File::isDirectory(dirname($filePath))) {
            File::makeDirectory(dirname($filePath), 0777, true, true);
        }

        File::put($filePath, $migration);
    }
}
