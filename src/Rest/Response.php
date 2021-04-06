<?php

namespace App\Rest;

use JetBrains\PhpStorm\ArrayShape;

class Response
{
    private bool $success = false;
    private ?array $data = null;
    private ?array $error = null;

    #[ArrayShape(['success' => "mixed", 'data' => "mixed", 'error' => "mixed"])]
    public function getResult(): array
    {
        return [
            'success' => $this->success,
            'data' => $this->data,
            'error' => $this->error,
        ];
    }
}
