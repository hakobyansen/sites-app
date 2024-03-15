<?php

namespace App\Repositories;

use App\Models\SiteAddress;

interface ISiteAddressRepository
{
    public function store(array $data): SiteAddress;
}
