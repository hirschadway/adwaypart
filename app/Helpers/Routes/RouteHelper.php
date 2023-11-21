<?php
namespace App\Helpers\Routes;

use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class RouteHelper
{
    public static function includeRouteFiles(string $dir)
    {
        // iterate through v1 directory recursively

        $dirIterator = new RecursiveDirectoryIterator($dir);

        /**
         * wrap iterator in RecursiveIteratorIterator to have acess to a few more helper methods
         * @var RecursiveIteratorIterator|RecursiveDirectoryIterator $it
         */
        $it = new RecursiveIteratorIterator($dirIterator);
        while ($it->valid()) {
            if (!$it->isDot() && $it->isFile() && $it->isReadable() && $it->current()->getExtension() === 'php') {
                // require $it->current()->getPathname()
                require $it->key();
            }
            $it->next();
        }
    }
}


