<?php

namespace App\Repositories;

use App\Models\Site;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class SiteRepository implements ISiteRepository
{
    private Site $model;

    public function __construct(Site $site)
    {
        $this->model = $site;
    }

    public function store(array $data): Model
    {
        return $this->model
            ->newQuery()
            ->with('siteAddress')
            ->create($data);
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
            ->with('siteAddress')
            ->where('id', $siteID)
            ->first();
    }

    public function findByType(string $type): Collection
    {
        return $this->model
            ->newQuery()
            ->with('siteAddress')
            ->where('type', 'like', "%$type%")
            ->get();
    }

    public function deleteByID(int $siteID): int
    {
        return $this->model
            ->newQuery()
            ->where('id', $siteID)
            ->delete();
    }
}
