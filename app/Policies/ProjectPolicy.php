<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;

    /** 
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->permissions['projects']['read'] != 0 ?: false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Project $project)
    {
        if ($user->company_id != $project->user->company_id) {
            return false;
        }

        switch ($user->permissions['projects']['read']) {
            case 0:
                return false;
            break;

            case 1:
                return $user->id == $project->user_id ?: false;
            break;

            case 2:
                return true;
            break;
        }
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->permissions['projects']['create'] == 1 ?: false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Project $project)
    {
        if ($user->company_id != $project->user->company_id) {
            return false;
        }

        return $user->permissions['projects']['update'] == 2 or
            ($user->permissions['projects']['update'] == 1 and $user->id == $project->user_id);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Project $project)
    {
        if ($user->company_id != $project->user->company_id) {
            return false;
        }

        return $user->permissions['projects']['delete'] == 2 or
            ($user->permissions['projects']['delete'] == 1 and $user->id == $project->user_id);
    }

    /**
     * Determine whether the user can search the model.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function search(User $user)
    {
        return $user->permissions['projects']['read'] != 0 ?: false;
    }
}
