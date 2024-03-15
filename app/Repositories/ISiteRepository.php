<?php

namespace App\Repositories;

use App\Models\Site;

interface ISiteRepository
{
    public function store(array $data): Site;
}
