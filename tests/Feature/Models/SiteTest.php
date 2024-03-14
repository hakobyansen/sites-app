<?php

namespace Tests\Feature\Models;

use App\Models\Site;
use App\Models\SiteAddress;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SiteTest extends TestCase
{
    use RefreshDatabase;

    public function testAddress()
    {
        $site = Site::factory()
            ->for(SiteAddress::factory())
            ->make();

        $this->assertInstanceOf(
            expected: SiteAddress::class,
            actual: $site->siteAddress
        );
    }
}
