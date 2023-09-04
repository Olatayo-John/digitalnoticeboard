<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'profile_image',
        "resume",
        "gender",
        "dob",
        "permanent_address",
        "current_address",
        "contact_mobile",
        "emp_code",
        "qualification",
        "designation",
        "reporting_manager",
        "ctc",
        "personal_linkedin",
        "personal_slack",
        "personal_github",
        "personal_skype",
        "official_linkedin",
        "official_slack",
        "official_github",
        "official_skype",
        "official_email",
        "joining_date",
        "leaving_date",
        "fandf_date",
        "blood_group",
        "contact_one_name",
        "contact_one_mobile",
        "contact_one_relationship",
        "contact_two_name",
        "contact_two_mobile",
        "contact_two_relationship",
        'is_active',
        'password',
        'time_zone',
        'time_offset',
        'user_type',
        'time_offset',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'id' => 'integer',
        'email_verified_at' => 'datetime',
    ];

    public function scopeFilter($query, $filters)
    {
        if ($filters ?? false) {

            $query->where(function (Builder $query) use ($filters) {
                $query->when(($filters['is_active'] === '1' || $filters['is_active'] === '0'), function (Builder $query) use ($filters) {
                    $query->where('is_active', $filters['is_active']);
                })->when($filters['designation'], function (Builder $query) use ($filters) {
                    $query->where('designation', $filters['designation']);
                })->when($filters['reporting_manager'], function (Builder $query) use ($filters) {
                    $query->where('reporting_manager', $filters['reporting_manager']);
                });
            });
        }
    }

    public function userDesignation(): HasOne
    {
        return $this->hasOne(Designation::class, 'id', 'designation');
    }

    public function userReportingManager(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'reporting_manager');
    }

    public function bloodGroup(): HasOne
    {
        return $this->hasOne(BloodGroup::class, 'id', 'blood_group');
    }

    public function technologies()
    {
        return $this->belongsToMany(Technology::class)->withPivot('id', 'experience');
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class,'assigned_to');
    }
}
