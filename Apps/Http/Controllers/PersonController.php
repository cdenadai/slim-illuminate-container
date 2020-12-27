<?php

namespace App\Http\Controllers;

use Domain\Person\Contracts\PersonServiceInterface;

class PersonController
{
    private $service;

    public function __construct(PersonServiceInterface $personService)  
    {
        $this->service = $personService; 
    }

    public function getAll()
    {
        return $this->service->all();
    }

    public function find(int $id)
    {
        return $this->service->find($id);
    }
}
