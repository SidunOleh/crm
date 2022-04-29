<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
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
        return $user->permissions['tasks']['read'] != 0 ?: false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Task $task)
    {
        if ($user->company_id != $task->user->company_id) {
            return false;
        }

        switch ($user->permissions['tasks']['read']) {
            case 0:
                return false;
            break;

            case 1:
                return $user->id == $task->user_id ?: false;
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
        return $user->permissions['tasks']['create'] == 1 ?: false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Task $task)
    {
        if ($user->company_id != $task->user->company_id) {
            return false;
        }

        return $user->permissions['tasks']['update'] == 2 or
            ($user->permissions['tasks']['update'] == 1 and $user->id == $task->user_id);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Task $task)
    {
        if ($user->company_id != $task->user->company_id) {
            return false;
        }
        
        return $user->permissions['tasks']['delete'] == 2 or
            ($user->permissions['tasks']['delete'] == 1 and $user->id == $task->user_id);
    }

    /**
     * Determine whether the user can search the model.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function search(User $user)
    {
        return $user->permissions['tasks']['read'] != 0 ?: false;
    }
}
