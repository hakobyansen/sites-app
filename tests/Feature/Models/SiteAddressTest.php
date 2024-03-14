<?php

namespace Tests\Feature\Models;

use App\Models\Site;
use App\Models\SiteAddress;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SiteAddressTest extends TestCase
{
    use RefreshDatabase;

    public function testSite()
    {
        $siteAddress = SiteAddress::factory()
            ->has(Site::factory())
            ->make();

        $this->assertInstanceOf(
            expected: Site::class,
            actual: $siteAddress->site
        );
    }
}
