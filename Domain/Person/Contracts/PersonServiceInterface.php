<?php

namespace Domain\Person\Contracts;

use Domain\Person\Person;

interface PersonServiceInterface
{
    public function all(): iterable;
    public function find(int $id): Person;
    public function create($person): Person;
    public function update($person): Person;
    public function delete(int $id): bool;
}
