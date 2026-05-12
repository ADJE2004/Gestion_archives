<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['name', 'description','responsable'];

    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function documents()
    {
        return $this->hasMany(Document::class);
    }
}