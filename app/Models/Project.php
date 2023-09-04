<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;

    protected $table = "projects";
    protected $fillable = [
        "name",
        "client_id",
        "priority",
        "status",
        "start_date",
        "due_date",
        "objective",
        "url",
        "type",
        "notes",
        "remarks",
        "credentials",
        "created_by"
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function members()
    {
        return $this->belongsToMany(User::class);
    }

    public function scopeFilter($query, $params)
    {
        if ($params ?? false) {

            $query->where(function (Builder $query) use ($params) {
                $query->when($params['priority'], function (Builder $query) use ($params) {
                    $query->where('priority', $params['priority']);
                })->when($params['status'], function (Builder $query) use ($params) {
                    $query->where('status', $params['status']);
                })->when($params['type'], function (Builder $query) use ($params) {
                    $query->where('type', $params['type']);
                })->when($params['client_id'], function (Builder $query) use ($params) {
                    $query->where('client_id', $params['client_id']);
                });
            });
        }
    }
}
