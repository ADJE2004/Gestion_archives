<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Service;
use App\Models\User;

class Document extends Model
{
    protected $fillable = [
        'reference',
        'title',
        'file_path',
        'type',
        'year',
        'status',
        'service_id',
        'user_id'
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}