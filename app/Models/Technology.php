<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    use HasFactory;

    protected $table = "technologies";
    protected $fillable = ["name", "status"];

    public function user()
    {
        return $this->belongsToMany(User::class);
    }
}
