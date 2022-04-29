<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Project;
use App\Models\Contact;
use App\Models\Task;

class Company extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get company users.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get company projects.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function projects()
    {
        return $this->hasManyThrough(Project::class, User::class);
    }

    /**
     * Get company contacts.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function contacts()
    {
        return $this->hasManyThrough(Contact::class, User::class);
    }

    /**
     * Get company tasks.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function tasks()
    {
        return $this->hasManyThrough(Task::class, User::class);
    }
}
