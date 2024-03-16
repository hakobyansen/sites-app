<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

interface ISiteRepository
{
    public function store(array $data): Model;

    public function getById(int $siteID): ?Model;

    public function update(int $siteID, array $data): Model;
}
