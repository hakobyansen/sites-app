<?php

namespace App\Helpers;

use App\Models\Site;
use App\Repositories\ISiteAddressRepository;
use App\Repositories\ISiteRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

readonly class SiteHelper
{
    /**
     * @param ISiteRepository $siteRepository
     * @param ISiteAddressRepository $siteAddressRepository
     */
    public function __construct(
        private ISiteRepository        $siteRepository,
        private ISiteAddressRepository $siteAddressRepository
    )
    {
    }

    /**
     * @param array $data
     * @return Model|Site
     */
    public function storeDataInDB(array $data): Model|Site
    {
        $site = $this->siteRepository->store([
            'name' => $data['name'],
            'type' => $data['type'],
        ]);

        $this->siteAddressRepository->store([
            'site_id' => $site->id,
            'street' => $data['address']['street'],
            'city' => $data['address']['city'],
            'state' => $data['address']['state'],
            'zip' => $data['address']['zip'],
            'country' => $data['address']['country'],
        ]);

        $site->load('siteAddress');

        return $site;
    }

    /**
     * @param int $siteID
     * @param array $data
     * @return Model|Site
     */
    public function updateDataInDB(int $siteID, array $data): Model|Site
    {
        $this->siteRepository->update(
            siteID: $siteID,
            data: [
                'name' => $data['name'],
                'type' => $data['type'],
            ]
        );

        $this->siteAddressRepository->updateBySiteID(
            siteID: $siteID,
            data: [
                'street' => $data['address']['street'],
                'city' => $data['address']['city'],
                'state' => $data['address']['state'],
                'zip' => $data['address']['zip'],
                'country' => $data['address']['country'],
            ]
        );

        return $this->siteRepository->getById($siteID);
    }

    /**
     * @param int $siteID
     * @return int
     */
    public function deleteFromDB(int $siteID): int
    {
        return $this->siteRepository
            ->deleteByID($siteID);
    }

    /**
     * @param int $siteID
     * @return Model|Site|null
     */
    public function getByID(int $siteID): Model|Site|null
    {
        return $this->siteRepository->getById($siteID);
    }

    /**
     * @param int $siteID
     * @return bool
     */
    public function siteExists(int $siteID): bool
    {
        return $this->siteRepository->existsByID($siteID);
    }

    /**
     * @param string $type
     * @return Collection
     */
    public function findByType(string $type): Collection
    {
        return $this->siteRepository->findByType($type);
    }

    /**
     * @param Site $site
     * @return array
     */
    public function mapResponse(Site $site): array
    {
        return [
            'id' => $site->id,
            'name' => $site->name,
            'type' => $site->type,
            'address' => [
                'street' => $site->siteAddress?->street,
                'city' => $site->siteAddress?->city,
                'state' => $site->siteAddress?->state,
                'zip' => $site->siteAddress?->zip,
                'country' => $site->siteAddress?->country,
            ]
        ];
    }
}
