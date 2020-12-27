<?php

namespace Services\Person;

use Domain\Person\Contracts\PersonRepositoryInterface;
use Domain\Person\Person;
use Domain\Person\Contracts\PersonServiceInterface;

class PersonService implements PersonServiceInterface
{
    private $personRepository;
    public function __construct(PersonRepositoryInterface $personRepository)
    {
        $this->personRepository = $personRepository;
    }

    public function all(): iterable
    {
        return $this->personRepository->all();
    }
    public function find(int $id): Person
    {
        return $this->personRepository->find($id);
    }

    public function create($personData): Person
    {
        $person = new Person($personData['id'], $personData['name']);
        return $this->personRepository->create($person);
    }

    public function update($personData): Person
    {
        $person = new Person($personData['id'], $personData['name']);
        return $this->personRepository->update($person);
    }

    public function delete(int $id): bool
    {
        return $this->personRepository->delete($id);
    }
}
