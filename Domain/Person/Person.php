<?php

namespace Domain\Person;

class Person
{
    private $id;
    private $name;

    public function __construct(int $id = null, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }
}
