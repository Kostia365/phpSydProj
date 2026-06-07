<?php

namespace Frontend\Src;

class ApiClient
{
    private string $baseUrl;

    public function __construct(string $baseUrl = 'http://localhost:8000')
    {
        $this->baseUrl = $baseUrl;
    }

    public function request(string $method, string $path, array $data = [])
    {
        $url = $this->baseUrl . $path;

        $options = [
            'http' => [
                'method' => $method,
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'content' => http_build_query($data),
                'ignore_errors' => true
            ]
        ];

        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);

        return json_decode($result, true); // Бэкенд теперь шлет JSON
    }
}