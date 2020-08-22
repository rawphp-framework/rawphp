<?php

use Dotenv\Dotenv;
use Dotenv\Exception\InvalidPathException;

try {
    $env = Dotenv::createImmutable(base_path());
    $dotenv = $env->load();
} catch (InvalidPathException $e) {

}

return $dotenv;
