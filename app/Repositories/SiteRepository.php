<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class SiteRepository implements ISiteRepository
{
    private Model $model;

    public function __construct(Model $site)
    {
        $this->model = $site;
    }

    public function store(array $data): Model
    {
        return $this->model
            ->with('siteAddress')
            ->create($data)
            ->first();
    }

    public function getByID(int $siteID): Model
    {
        return $this->model
            ->where('id', $siteID)
            ->first();
    }
}
