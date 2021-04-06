<?php

namespace App\Rest;

use JetBrains\PhpStorm\ArrayShape;

class Response
{
    private bool $success = false;
    private ?array $data = null;
    private ?array $error = null;

    public function __construct(bool|string $response, array $info)
    {
        // TODO: let's process the response here
    }

    public function getResult(): array
    {
        return [
            'success' => $this->success,
            'data' => $this->data,
            'error' => $this->error,
        ];
    }
}
