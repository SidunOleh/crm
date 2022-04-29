<?php

namespace App\Policies;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContactPolicy
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
        return $user->permissions['contacts']['read'] != 0 ?: false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Contact $contact)
    {
        if ($user->company_id != $contact->user->company_id) {
            return false;
        }

        switch ($user->permissions['contacts']['read']) {
            case 0:
                return false;
            break;

            case 1:
                return $user->id == $contact->user_id ?: false;
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
        return $user->permissions['contacts']['create'] == 1 ?: false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Contact $contact)
    {
        if ($user->company_id != $contact->user->company_id) {
            return false;
        }

        return $user->permissions['contacts']['update'] == 2 or
            ($user->permissions['contacts']['update'] == 1 and $user->id == $contact->user_id);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Contact $contact)
    {
        if ($user->company_id != $contact->user->company_id) {
            return false;
        }

        return $user->permissions['contacts']['delete'] == 2 or
            ($user->permissions['contacts']['delete'] == 1 and $user->id == $contact->user_id);
    }

    /**
     * Determine whether the user can search the model.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function search(User $user)
    {
        return $user->permissions['contacts']['read'] != 0 ?: false;
    }

    /**
     * Determine whether the user can search the model.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function activity(User $user, Contact $contact)
    {
        if ($user->company_id != $contact->user->company_id) {
            return false;
        }
        
        return $user->permissions['contacts']['update'] == 2 or
            ($user->permissions['contacts']['update'] == 1 and $user->id == $contact->user_id);
    }
}
