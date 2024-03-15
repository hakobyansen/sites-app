<?php

namespace App\Repositories;

use App\Models\SiteAddress;

class SiteAddressRepository implements ISiteAddressRepository
{
    private SiteAddress $model;

    public function __construct(SiteAddress $siteAddress)
    {
        $this->model = $siteAddress;
    }

    public function store(array $data): SiteAddress
    {
        return $this->model->create($data);
    }
}
