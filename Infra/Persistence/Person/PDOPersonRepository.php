<?php

namespace Infra\Persistence\Person;

use Domain\Person\Person;
use Domain\Person\Contracts\PersonRepositoryInterface;

class PDOPersonRepository implements PersonRepositoryInterface
{
    public function all(): iterable
    {
        return [ new Person(1, 'Carlos'), new Person(2, 'Pedro') ];
    }

    public function find(int $id): Person
    {
        return new Person(1, 'Carlos');
    }

    public function create(Person $person): Person
    {
        return new Person(3, 'Roberto Peres');
    }

    public function update(Person $person): Person
    {
        return new Person(2, 'Pedrinho');
    }

    public function delete(int $id): bool
    {
        return true;
    }
}
