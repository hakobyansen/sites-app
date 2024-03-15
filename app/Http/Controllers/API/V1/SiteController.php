<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShowSiteRequest;
use App\Http\Requests\StoreSiteRequest;
use App\Repositories\ISiteAddressRepository;
use App\Repositories\ISiteRepository;
use Illuminate\Support\Facades\Log;

class SiteController extends Controller
{
    public function __construct(
        private readonly ISiteRepository $siteRepository,
        private readonly ISiteAddressRepository $siteAddressRepository
    )
    {
    }

    public function store(StoreSiteRequest $request)
    {
        Log::info('Creating new site');

        $data = $request->toArray();

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

        return response(
            content: $site->toArray(),
            status: 201,
        );
    }

    public function show(int $siteID)
    {
        Log::info('Getting site by type');

        $site = $this->siteRepository->getByID($siteID);

        $site->load('siteAddress');

        return response(content: $site);
    }

    public function update()
    {

    }

    public function destroy(int $siteID)
    {

    }
}
