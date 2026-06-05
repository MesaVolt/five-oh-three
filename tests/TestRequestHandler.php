<?php

namespace Tests;


use Mesavolt\FiveOhThree\RequestHandlerInterface;

class TestRequestHandler implements RequestHandlerInterface
{
    public array $requestParameters = [];
    public array $headers = [];
    public array $cookies = [];
    public ?string $content = null;

    public bool $terminated = false;

    public function getRequestParameter(string $name): ?string
    {
        return $this->requestParameters[$name] ?? null;
    }

    public function setHeader(string $header): void
    {
        $this->headers[] = $header;
    }

    public function getCookie(string $name): ?string
    {
        return $this->cookies[$name] ?? null;
    }

    public function setCookie(string $name, ?string $value): void
    {
        $this->cookies[$name] = $value;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function terminate(): void
    {
        $this->terminated = true;
    }
}
