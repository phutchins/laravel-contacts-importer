<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Events\ContactsRetrieved;
use App\Contact;

class ContactsController extends Controller {
  public function fetchAll() {
    $out = new \Symfony\Component\Console\Output\ConsoleOutput();
    $out->writeln("hit fetchAll api call");
    $contacts = Contact::all();
    event(broadcast(new ContactsRetrieved($contacts)));
    return response()->json('retrieved');
  }

  public function findOne($id) {
    // Add a find by phone
    $contact = Contact::findOrFail($id);
    broadcast(new ContactsRetrieved($contact));
    return response()->json('retrieved');
  }

  public function store(Request $request) {
    $contact = Contact::create($request->all());
    broadcast(new ContactCreated($contact));
    return response()->json("added");
  }

  public function delete($id) {
    $contact = Contact::find($id);
    broadcast(new ContactDeleted($contact));
    return response()->json("deleted");
  }
}
