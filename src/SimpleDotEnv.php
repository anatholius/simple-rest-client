<?php

namespace App;

class SimpleDotEnv
{
    const DOTENV_PATH = __DIR__.'/../.env';

    /**
     * @param bool $ignoreMissingDotenv
     *
     * @return bool|array
     */
    public static function getVars(bool $ignoreMissingDotenv = false)
    {
        return self::readEnv($ignoreMissingDotenv);
    }

    public static function getVar(string $varName): ?string
    {
        $vars = self::getVars();
        if(!isset($vars[$varName])) {
            return null;
        }

        return $vars[$varName];
    }

    private static function readEnv(bool $ignoreMissingDotenv = false): array
    {
        $vars = [];

        // check `.env`
        $envFilename = realpath(self::DOTENV_PATH);
        if(realpath(self::DOTENV_PATH.'.local')) {
            // check `.env.local`
            $envFilename = realpath(self::DOTENV_PATH.'.local');
        }

        if(!$envFilename && !$ignoreMissingDotenv) {
            throw new \RuntimeException('There is no ".env" or ".env.local" file!');
        } elseif(!$envFilename && $ignoreMissingDotenv) {
            return [];
        }

        $lines = file($envFilename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach($lines as $line) {
            $tmp = explode('=', $line);
            $vars[$tmp[0]] = $tmp[1];
        }

        return $vars;
    }
}
