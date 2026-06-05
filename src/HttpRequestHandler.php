<?php

namespace Mesavolt\FiveOhThree;


class HttpRequestHandler implements RequestHandlerInterface
{
    public function getRequestParameter(string $name): ?string
    {
        return $_REQUEST[$name] ?? null;
    }

    public function setHeader(string $header): void
    {
        header($header);
    }

    public function getCookie(string $name): ?string
    {
        return $_COOKIE[$name] ?? null;
    }

    public function setCookie(string $name, ?string $value, array $options = []): void
    {
        setcookie($name, $value, $options);
    }

    public function setContent(string $content): void
    {
        echo $content;
    }

    public function terminate(): void
    {
        die();
    }
}
