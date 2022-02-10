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

    }

    public function create()
    {
    }

    public function store(Request $request)
    {

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
