<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    protected $table = "tasks";
    protected $fillable = [
        "name",
        "project_id",
        "assigned_to",
        "assigned_by",
        "start_date_time",
        "end_date_time",
        "status",
        "priority",
        "description",
        "remarks",
        "notes",
        "billable",
        "file",
        "created_by",
    ];

    public function scopeFilter($query, $params)
    {
        if ($params ?? false) {

            $query->where(function (Builder $query) use ($params) {
                $query->when($params['priority'], function (Builder $query) use ($params) {
                    $query->where('priority', $params['priority']);
                })->when($params['status'], function (Builder $query) use ($params) {
                    $query->where('status', $params['status']);
                })->when($params['assigned_to'], function (Builder $query) use ($params) {
                    $query->where('assigned_to', $params['assigned_to']);
                })->when($params['assigned_by'], function (Builder $query) use ($params) {
                    $query->where('assigned_by', $params['assigned_by']);
                })->when($params['project_id'], function (Builder $query) use ($params) {
                    $query->where('project_id', $params['project_id']);
                });
            });
        }
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function assignedBy()
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }
}
