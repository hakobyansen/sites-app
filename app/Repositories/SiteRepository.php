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
            ->newQuery()
            ->with('siteAddress')
            ->create($data)
            ->first();
    }

    public function update(int $siteID, array $data): Model
    {
          $this->model
              ->newQuery()
              ->where('id', $siteID)
              ->update($data);

          return $this->getById($siteID);
    }

    public function getByID(int $siteID): ?Model
    {
        return $this->model
            ->newQuery()
            ->where('id', $siteID)
            ->with('siteAddress')
            ->first();
    }
}
