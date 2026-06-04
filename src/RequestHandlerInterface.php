<?php

namespace Mesavolt\FiveOhThree;


interface RequestHandlerInterface
{
    public function setHeader(string $header): void;
    public function setCookie(string $name, string $value): void;
    public function setContent(string $content): void;
    public function terminate(): void;
}
