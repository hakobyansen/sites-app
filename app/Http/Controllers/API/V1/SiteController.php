<?php

namespace App\Http\Controllers\API\V1;

use App\Helpers\SiteHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSiteRequest;
use App\Repositories\ISiteRepository;
use Illuminate\Support\Facades\Log;

class SiteController extends Controller
{
    /**
     * @param ISiteRepository $siteRepository
     */
    public function __construct(
        private readonly ISiteRepository $siteRepository,
    )
    {
    }

    public function store(StoreSiteRequest $request)
    {
        Log::info('Creating new site');

        $siteHelper = app(SiteHelper::class);

        $data = $request->toArray();

        $site = $siteHelper->storeDataInDB($data);

        return response(
            content: $siteHelper->mapResponse($site),
            status: 201,
        );
    }

    public function show(int $siteID)
    {
        Log::info('Getting site by type');

        $siteHelper = app(SiteHelper::class);

        $site = $this->siteRepository
            ->getByID($siteID);

        if(!$site) {
            return response(
                content: 'Site is not found',
                status: 404
            );
        }

        return response(
            content: $siteHelper->mapResponse($site)
        );
    }

    public function update(StoreSiteRequest $request)
    {
        Log::info('Updating existing site');

        $siteHelper = app(SiteHelper::class);

        $data = $request->toArray();

        $site = $this->siteRepository
            ->getById($data['site_id']);

        if(!$site) {
            return response(
                content: 'Site is not found',
                status: 404
            );
        }

        $site = app(SiteHelper::class)
            ->updateDataInDB($data);

        return response(
            content: $siteHelper->mapResponse($site),
        );
    }

    public function destroy(int $siteID)
    {
        Log::info("Deleting site {$siteID}");

        $this->siteRepository->deleteByID($siteID);

        app(SiteHelper::class)
            ->deleteFromDB($siteID);

        return response(
            content: 'Site is deleted'
        );
    }
}
