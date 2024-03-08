<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotesController extends Controller
{
    public function __construct()
    {
        $this->middleware("owner")->only('show', 'edit', 'destroy');
    }

    public function index()
    {
        //dd(Auth::user()->notes);

        $notes = Note::where('user_id', Auth::user()->id)->get();
        $other = Auth::user()->shared;
        $notes = $notes->merge($other);
        return view("notes.index", compact(['notes']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $isEdit = false;
        return view('notes.create-edit', compact(['isEdit']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:8|unique:notes,title',
            'description' => 'required|min:8',
            'share' => 'required',
        ]);

        $note = new Note();
        $note->title = $request->title;
        $note->description = $request->description;
        $note->user_id = Auth::user()->id;
        $note->save();

        $note->shared()->attach($request->share);

        return redirect(route('notes.show', $note->id));
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        //$note = Note::find();
        //return $note;
        return view('notes.show', compact('note'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        $isEdit = true;
        return view('notes.create-edit', compact(['isEdit', 'note']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'share' => 'required',
        ]);

        //dd($request);

        $note->title = $request->title;
        $note->description = $request->description;
        $note->user_id = Auth::user()->id;
        $note->update();

        $note->shared()->detach();
        $note->shared()->attach($request->share);

        return redirect(route('notes.show', $note->id));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        $note->delete();
        return redirect(route('home'));
    }
}
