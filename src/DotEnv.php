<?php

namespace App;

class DotEnv
{
    const DOTENV_PATH = __DIR__.'/../.env';

    public static function getVars(bool $ignoreMissingDotenv = false): bool|array
    {
        if(!file_exists(self::DOTENV_PATH) && !$ignoreMissingDotenv) {
            throw new \RuntimeException('There is no ".env" file!');
        } elseif(!file_exists(self::DOTENV_PATH) && $ignoreMissingDotenv) {
            return [];
        }

        $lines = file(self::DOTENV_PATH, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $vars = [];
        foreach($lines as $line) {
            $tmp = explode('=', $line);
            $vars[$tmp[0]] = $tmp[1];
        }

        return $vars;
    }
}
