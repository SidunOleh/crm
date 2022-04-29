<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Company;
use App\Models\Project;
use App\Models\Contact;
use App\Models\Task;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guarded = [];

    protected $casts = [
        'permissions' => 'array',
    ];

    /**
     * Update user permissions.
     *
     * @param array $data
     * @return void
     */
    public function updatePermissions(array $data)
    {
        $perms = $this->permissions;
       
        $perms[$data['resource']][$data['operation']] = $data['permission'];

        if ($perms[$data['resource']]['update'] > $perms[$data['resource']]['read']) {
           
            $perms[$data['resource']]['update'] = $perms[$data['resource']]['read'];   
        
        }

        if ($perms[$data['resource']]['delete'] > $perms[$data['resource']]['update']) {        
           
            $perms[$data['resource']]['delete'] = $perms[$data['resource']]['update'];
        
        }

        $this->permissions = $perms;
    }

    /**
     * Get user company.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get user projects.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    /**
     * Get user contacts.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    /**
     * Get user tasks.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
