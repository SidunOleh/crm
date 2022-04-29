<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Contact::class, 'contact');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $user = $request->user();

        switch ($user->permissions['contacts']['read']) {
            case 1:
                $contacts = $user->contacts;
            break;

            case 2:
                $contacts = $user->company->contacts;
            break;
        }

        return view('contacts.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ContactRequest $request)
    {
        $validated = $request->safe()->merge([
            'user_id' => $request->user()->id,
        ])->all();

        Contact::create($validated);

        return back()->with([
            'status'  => 'ok',
            'message' => 'Contact was created successful',
        ]); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact $contact
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Contact $contact)
    {
        return view('contacts.show', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact $contact
     * @return \Illuminate\Http\Response
     */
    public function update(ContactRequest $request, Contact $contact)
    {
        $contact->update($request->validated());

         return back()->with([
            'status'  => 'ok',
            'message' => 'Contact was updated successfully',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact $contact
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->route('contacts.index');
    }

     /**
     * Search for contacts.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function search(Request $request)
    {
        $search = $request->validate(['search'=>'nullable|string'])['search'];
        $user   = $request->user();

        $contacts = $user->company->contacts()->where(
            function ($query) use($search) {
                $query->where('contacts.name', 'like', "%$search%")
                    ->orWhere('contacts.surname', 'like', "%$search%")
                    ->orWhere('contacts.phone', 'like', "%$search%")
                    ->orWhere('contacts.email', 'like', "%$search%")
                    ->orWhere('contacts.type', 'like', "%$search%");
            }
        );

        if ($user->permissions['contacts']['read'] == 1) {
            $contacts->where('user_id', $user->id);
        }

        return view('contacts.search', ['contacts' => $contacts->get(),]);
    }

    /**
     * Change contact activity.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Contact $contact
     * @return void
     */
    public function activity(Request $request, Contact $contact)
    {
        $contact->is_active = $contact->is_active ? false : true;
        $contact->save();
    }
}
