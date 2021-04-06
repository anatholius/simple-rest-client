<?php

namespace App\Rest;

/**
 * @name Response Class
 *
 * @author Anatol Derbisz <anatholius@gmail.com>
 */
class Response implements ResponseInterface
{
    private bool $success = false;
    private ?array $data = null;
    private ?array $error = null;

    /**
     * @param string|array $response - expected array - if there is json, it should be ute here
     *                               as array, because in here will be processed
     * @param array|null   $info     - expected array as cURL it returns
     *                               BTW `curl_getinfo` can return a `string`, but only if
     *                               `paramName` is given. In this case, it always is an array.
     */
    public function __construct($response = [], ?array $info = [])
    {
        $this->processOutput($response, $info);
    }

    public function getResult(): array
    {
        return [
            'success' => $this->success,
            'data' => $this->data,
            'error' => $this->error,
        ];
    }

    /**
     * @param array|string $response
     * @param array        $info
     */
    private function processOutput($response, array $info)
    {
        $this->success = isset($info['http_code']) && $info['http_code'] >= 400 ? false : true;
        if($this->success) {
            if(is_string($response)) {
                // Probably 500
                $this->success = false;
                $this->data = null;
                $this->error = [
                    'success' => $this->success,
                    'data' => null,
                    'error' => [
                        'code' => $info['http_code'] ?? 500,
                        'reason_code' => 'unfortunately unknown 🤨',
                        'messages' => ["[author's quote]: „The 500's when you ask wrong question to the right answer” 🤣"],
                    ],
                ];
            } else {
                $this->data = $response;
            }
        } else {
            $this->error = [
                'success' => $this->success,
                'data' => null,
                'error' => [
                    'code' => $info['http_code'],
                    'reason_code' => 'unfortunately unknown 🤨',
                    'messages' => [$response],
                ],
            ];
        }
    }
}
