<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Site extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'type',
    ];

    /**
     * @return HasOne
     */
    public function siteAddress(): HasOne
    {
        return $this->hasOne(SiteAddress::class);
    }
}
