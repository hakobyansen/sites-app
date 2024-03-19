<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface ISiteRepository
{
    /**
     * @param array $data
     * @return Model
     */
    public function store(array $data): Model;

    /**
     * @param int $siteID
     * @return Model|null
     */
    public function getById(int $siteID): ?Model;

    /**
     * @param int $siteID
     * @return bool
     */
    public function existsByID(int $siteID): bool;

    /**
     * @param int $siteID
     * @param array $data
     * @return Model
     */
    public function update(int $siteID, array $data): Model;

    /**
     * @param int $siteID
     * @return int
     */
    public function deleteByID(int $siteID): int;

    /**
     * @param string $type
     * @return Collection
     */
    public function findByType(string $type): Collection;
}
