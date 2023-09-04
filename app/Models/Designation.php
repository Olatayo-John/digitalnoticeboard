<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Designation extends Model
{
    use HasFactory;

    protected $table = 'designations';
    protected $fillable = ['name', 'status'];

    public function reportingManager(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reporting_manager');
    }
}
