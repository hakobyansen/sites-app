<?php

namespace App\Http\Controllers\API\V1;

use App\Helpers\SiteHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSiteRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SiteController extends Controller
{
    /**
     * @param SiteHelper $siteHelper
     */
    public function __construct(
        private readonly SiteHelper $siteHelper,
    )
    {
    }

    /**
     * @param StoreSiteRequest $request
     * @return JsonResponse
     */
    public function store(StoreSiteRequest $request): JsonResponse
    {
        Log::info('Creating new site');

        $data = $request->toArray();

        $site = $this->siteHelper->storeDataInDB($data);

        return response()->json(
            data: $this->siteHelper->mapResponse($site),
            status: 201
        );
    }

    /**
     * @param int $siteID
     * @return JsonResponse
     */
    public function show(int $siteID): JsonResponse
    {
        Log::info('Getting site by type');

        if(!$this->siteHelper->siteExists($siteID)) {
            return response()->json(
                data: [
                    'message' => 'Site is not found'
                ],
                status: 404
            );
        }

        return response()->json(
            $this->siteHelper->mapResponse(
                $this->siteHelper->getByID($siteID)
            )
        );
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function findByType(Request $request): JsonResponse
    {
        $type = $request->input('type');

        $sites = $this->siteHelper->findByType($type);

        return response()->json(data: $sites);
    }

    /**
     * @param StoreSiteRequest $request
     * @param int $siteID
     * @return JsonResponse
     */
    public function update(StoreSiteRequest $request, int $siteID): JsonResponse
    {
        Log::info('Updating existing site');

        $data = $request->toArray();

        if(!$this->siteHelper->siteExists($siteID)) {
            return response()->json(
                data: [
                    'message' => 'Site is not found'
                ],
                status: 404
            );
        }

        $site =$this->siteHelper->updateDataInDB($siteID, $data);

        return response()->json(
            $this->siteHelper->mapResponse($site)
        );
    }

    /**
     * @param int $siteID
     * @return JsonResponse
     */
    public function destroy(int $siteID): JsonResponse
    {
        Log::info("Deleting site {$siteID}");

        if(!$this->siteHelper->siteExists($siteID)) {
            return response()->json(
                data: [
                    'message' => 'Site is not found'
                ],
                status: 404
            );
        }

        $this->siteHelper->deleteFromDB($siteID);

        return response()->json(
            data: [
                'message' => 'Site is deleted'
            ],
        );
    }
}
