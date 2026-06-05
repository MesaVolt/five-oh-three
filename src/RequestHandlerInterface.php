<?php

namespace Mesavolt\FiveOhThree;


interface RequestHandlerInterface
{
    public function getRequestParameter(string $name): ?string;
    public function setHeader(string $header): void;
    public function getCookie(string $name): ?string;
    public function setCookie(string $name, ?string $value): void;
    public function setContent(string $content): void;
    public function terminate(): void;
}
