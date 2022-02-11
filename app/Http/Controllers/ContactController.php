<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Resources\ContactsResource;
use App\Mail\ContactMail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

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

        $data = array([
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'content' => $request->content,
            "created_at" => Carbon::now(), 
            "updated_at" => now()
        ]);

        $contact = DB::table('contacts')->insert($data, true);

        //To use the mailer set up the mail mailer in your env file first.
        Mail::send(new ContactMail($data));

        if ($contact) {
            $data = [
                'status' => 'Contact form has been submitted successfully',
                "code" => 200
            ];
        }else{
            $data = [
                'status' => 'Oops something went wrong please try again later',
                "code" => 401
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
