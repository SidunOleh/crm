<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\PermissionChangeRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserInvitation;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $users = User::where('company_id', $request->user()->company_id)
            ->get();

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated               = $request->validate(['email'=>'required|unique:users,email']);
        $validated['company_id'] = $request->user()->company_id;
        $validated['password']   = Hash::make($password = getPassword(5));

        $user = User::create($validated);

        Mail::to($user)->send(new UserInvitation($user, $password));

        return back()->with([
            'status'  => 'ok',
            'message' => 'Invitation has been sent',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Contracts\View\View
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UserUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $validated = $request->validated();

        if (isset($validated['avatar'])) {
          $validated['avatar'] = $validated['avatar']->store('image', 'public');
        }

        $user->update($validated);

        return back()->with([
            'status'  => 'ok',
            'message' => 'Changes were saved successfully',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index');
    }

    /**
     * Search for users.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function search(Request $request)
    {
        $search = $request->validate(['search'=>'nullable|string'])['search'];

        $users = User::where('company_id', $request->user()->company_id)
            ->where(function ($query) use($search) {
                $query->where('email', 'like', "%$search%")
                    ->orWhere('name', 'like', "%$search%")
                    ->orWhere('surname', 'like', "%$search%");
            })->get();
            
        return view('users.search', compact('users'));
    }

    /**
     * Change user activity.
     *
     * @param  \Illuminate\Http\Request $request
     * @return void
     */
    public function activity(User $user)
    {        
        $user->is_active = $user->is_active ? false : true;
        $user->save();
    }

    /**
     * Change user permissions.
     *
     * @param  \App\Http\Requests\PermissionChangeRequest $request
     * @return void
     */
    public function permissions(PermissionChangeRequest $request, User $user)
    {
          $validated = $request->validated();
          
          $user->updatePermissions($validated);
          $user->save();
    }
}
