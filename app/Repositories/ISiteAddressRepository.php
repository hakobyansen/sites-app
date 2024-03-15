<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

interface ISiteAddressRepository
{
    public function store(array $data): Model;
}
