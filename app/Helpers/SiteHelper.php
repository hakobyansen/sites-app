<?php

namespace App\Helpers;

use App\Models\Site;
use App\Repositories\ISiteAddressRepository;
use App\Repositories\ISiteRepository;
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

    public function updateDataInDB(array $data): Model|Site
    {
        $this->siteRepository->update(
            siteID: $data['site_id'],
            data: [
                'name' => $data['name'],
                'type' => $data['type'],
            ]
        );

        $this->siteAddressRepository->store([
            'street' => $data['address']['street'],
            'city' => $data['address']['city'],
            'state' => $data['address']['state'],
            'zip' => $data['address']['zip'],
            'country' => $data['address']['country'],
        ]);

        return $this->siteRepository->getById($data['site_id']);
    }

    public function deleteFromDB(int $siteID): int
    {
        return $this->siteRepository
            ->deleteByID($siteID);
    }

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
