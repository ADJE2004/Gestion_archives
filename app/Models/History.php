<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class History extends Model
{
    use HasFactory;

    // Autorise le remplissage de ces champs
    protected $fillable = [
        'user_id',
        'service_id',
        'action',
        'document_title',
        'document_ref',
        'ip_address'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
