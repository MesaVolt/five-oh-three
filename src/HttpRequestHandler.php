<?php

namespace Mesavolt\FiveOhThree;


class HttpRequestHandler implements RequestHandlerInterface
{
    public function setHeader(string $header): void
    {
        header($header);
    }

    public function setCookie(string $name, string $value): void
    {
        setcookie($name, $value);
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
