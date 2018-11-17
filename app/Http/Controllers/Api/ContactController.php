<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ContactRequest;
use App\Models\Contact;

class ContactController extends Controller
{
    public function store(ContactRequest $request)
    {
    	Contact::create($request->only('name', 'title', 'message'));
    	return response()->json(['status' => 'success', 'message' => 'Sent']);
    }
}
