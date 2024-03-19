<?php

namespace App\Repositories;

use App\Models\SiteAddress;
use Illuminate\Database\Eloquent\Model;

interface ISiteAddressRepository
{
    /**
     * @param array $data
     * @return Model|SiteAddress
     */
    public function store(array $data): Model|SiteAddress;

    /**
     * @param int $siteID
     * @param array $data
     * @return Model|SiteAddress|null
     */
    public function updateBySiteID(int $siteID, array $data): Model|SiteAddress|null;

    /**
     * @param int $siteID
     * @return Model|SiteAddress|null
     */
    public function getBySiteID(int $siteID): Model|SiteAddress|null;
}
