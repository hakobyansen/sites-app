<?php

namespace App\Repositories;

use App\Models\Site;

class SiteRepository implements ISiteRepository
{
    private Site $model;

    public function __construct(Site $site)
    {
        $this->model = $site;
    }

    public function store(array $data): Site
    {
        return $this->model->create($data);
    }
}
