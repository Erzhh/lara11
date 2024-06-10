<?php

namespace App\Support\Traits;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;

trait LoaderTrait
{
    private $path_files = [];

    private function getSectionNames(array $paths): array
    {
        return $this->getSectionPaths($paths);
    }

    private function getSectionPaths(array $paths): array
    {
        $this->getSectionPathsIteration($paths);

        return Arr::collapse($this->path_files);
    }

    private function getSectionPathsIteration(array $paths){

        foreach ($paths as $path){
            $folders = File::directories(app_path($path));

            $filtered = collect($folders)->map(function ( $value) {
                return str_replace(app_path().'/', "",$value );
            })->toArray();

            $this->path_files[] = $filtered;

            $this->getSectionPathsIteration($filtered);
        }

    }

    private function getFilesSortedByName(string $apiRoutesPath): array
    {
        $files = File::allFiles($apiRoutesPath);
        $files = Arr::sort($files, function ($file) {
            return $file->getFilename();
        });

        return $files;
    }

    public function getClassFullNameFromFile(string $filePathName): string
    {
        return "{$this->getClassNamespaceFromFile($filePathName)}\\{$this->getClassNameFromFile($filePathName)}";
    }

    /**
     * Get the class namespace form file path using token
     */
    protected function getClassNamespaceFromFile(string $filePathName): ?string
    {
        $src = file_get_contents($filePathName);

        $tokens = token_get_all($src);
        $count = count($tokens);
        $i = 0;
        $namespace = '';
        $namespace_ok = false;
        while ($i < $count) {
            $token = $tokens[$i];
            if (is_array($token) && $token[0] === T_NAMESPACE) {
                // Found namespace declaration
                while (++$i < $count) {
                    if ($tokens[$i] === ';') {
                        $namespace_ok = true;
                        $namespace = trim($namespace);

                        break;
                    }
                    $namespace .= is_array($tokens[$i]) ? $tokens[$i][1] : $tokens[$i];
                }

                break;
            }
            $i++;
        }
        if (! $namespace_ok) {
            return null;
        }

        return $namespace;
    }

    /**
     * Get the class name from file path using token
     */
    protected function getClassNameFromFile(string $filePathName): mixed
    {
        $php_code = file_get_contents($filePathName);

        $classes = [];
        $tokens = token_get_all($php_code);
        $count = count($tokens);
        for ($i = 2; $i < $count; $i++) {
            if ($tokens[$i - 2][0] == T_CLASS
                && $tokens[$i - 1][0] == T_WHITESPACE
                && $tokens[$i][0] == T_STRING
            ) {
                $class_name = $tokens[$i][1];
                $classes[] = $class_name;
            }
        }

        return $classes[0];
    }
}
