<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Resources\ContactsResource;

class ContactController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected $contact;

    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    //
    public function index(Request $request)
    {
        $contacts = $this->contact->orderBy('name', 'asc')->get();

        return ContactsResource::collection($contacts);
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:64',
            'email' => 'required|email',
        ]);

        $contact = Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'content' => $request->content
        ]);

        if ($contact) {
            $data = [
                'status' => 'Contact form has been submitted successfully',
                "code" => 200
            ];
        }

        return response()->json($data);
    }

    public function edit($id)
    {
    }

    public function update($id)
    {
    }

    public function destroy($id)
    {
    }
}
