<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;

    protected $table = 'clients';
    protected $fillable = [
        'client_type_id',
        'name',
        'profile_image',
        'email',
        'mobile',
        'linkedin',
        'skype',
        'slack',
        'company_name',
        'company_country',
        'company_state',
        'business_since',
        'is_active',
    ];

    public function clientType(): HasOne
    {
        return $this->hasOne(ClientType::class, 'id', 'client_type_id');
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
    
    public function scopeFilter($query, $params)
    {
        if ($params ?? false) {

            $query->where(function (Builder $query) use ($params) {
                $query->when($params['client_type_id'], function (Builder $query) use ($params) {
                    $query->where('client_type_id', $params['client_type_id']);
                })->when(($params['is_active'] === '1' || $params['is_active'] === '0'), function (Builder $query) use ($params) {
                    $query->where('is_active', $params['is_active']);
                });
            });
        }
    }

}
