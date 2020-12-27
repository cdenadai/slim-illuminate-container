<?php

namespace Domain\Person\Contracts;

interface PersonControllerInterface
{
    public function getAll();
    public function getById(int $id);
}
