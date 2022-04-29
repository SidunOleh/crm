<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegRequest;
use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegController extends Controller
{
    /**
     * Display a form for registration.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('auth.reg');
    }

    /**
     * Registration.
     *
     * @param  \App\Http\Requests\RegRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(RegRequest $request)
    {
        $validated = $request->validated();

        $company = Company::create([
            'name' => $validated['company'],
        ]);

        User::create([
            'email'       => $validated['email'],
            'password'    => Hash::make($validated['password']),
            'is_admin'    => true,
            'permissions' => [
                'projects' => [
                    'create' => 1,
                    'read'   => 2,
                    'update' => 2,
                    'delete' => 2,
                ],
                'contacts' => [
                    'create' => 1,
                    'read'   => 2,
                    'update' => 2,
                    'delete' => 2,
                ],
                'tasks' => [
                    'create' => 1,
                    'read'   => 2,
                    'update' => 2,
                    'delete' => 2,
                ],
            ],
            'company_id'  => $company->id,
        ]);

        return redirect()->route('login.index');
    }
}
