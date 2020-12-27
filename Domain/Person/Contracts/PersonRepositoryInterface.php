<?php

namespace Domain\Person\Contracts;

use Domain\Person\Person;

interface PersonRepositoryInterface
{
    public function all(): iterable;
    public function find(int $id): Person;
    public function create(Person $person): Person;
    public function update(Person $person): Person;
    public function delete(int $id): bool;
}
