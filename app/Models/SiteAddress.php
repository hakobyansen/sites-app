<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SiteAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_id',
        'street',
        'city',
        'state',
        'zip',
        'country'
    ];

    public function site(): BelongsTo
    {
        return $this->belongsTo(Site::class);
    }
}
