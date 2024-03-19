<?php

namespace App\Repositories;

use App\Models\SiteAddress;
use Illuminate\Database\Eloquent\Model;

class SiteAddressRepository implements ISiteAddressRepository
{
    /**
     * @var SiteAddress
     */
    private SiteAddress $model;

    /**
     * @param SiteAddress $siteAddress
     */
    public function __construct(SiteAddress $siteAddress)
    {
        $this->model = $siteAddress;
    }

    /**
     * @param array $data
     * @return SiteAddress
     */
    public function store(array $data): SiteAddress
    {
        return $this->model->create($data);
    }

    /**
     * @param int $siteID
     * @param array $data
     * @return Model|SiteAddress|null
     */
    public function updateBySiteID(int $siteID, array $data): Model|SiteAddress|null
    {
        $this->model
            ->newQuery()
            ->where('site_id', $siteID)
            ->update($data);

        return $this->getBySiteID($siteID);
    }

    /**
     * @param int $siteID
     * @return Model|SiteAddress|null
     */
    public function getBySiteID(int $siteID): Model|SiteAddress|null
    {
        return $this->model
            ->newQuery()
            ->where('site_id', $siteID)
            ->first();
    }
}
