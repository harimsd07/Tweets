<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;

class IdeaController extends Controller
{
    public function show(Idea $idea){

        return view('ideas.show',compact('idea'));
    }
    public function store(){

        $validated= request()->validate([
            'content' => 'required|min:3|max:512'
        ]);

        // here idea is the name of the textarea given in the submit-idea blade
        $validated['user_id'] = auth()->id();
        $idea = Idea::create($validated );
    return redirect()->route('dashboard')->with('success','Idea Created Successfully');
    }

    public function delete(Idea $idea){
        // Idea::where('id',$id)->firstOrFail()->delete();

        if(auth()->id() != $idea->id){
            abort(404);
        }
        $idea->delete();
        return redirect()->route('dashboard')->with('success','Idea Deleted Successfully');
    }

    public function edit(Idea $idea){
        if(auth()->id() != $idea->id){
            abort(404);
        }
        $editing =true;

        return view('ideas.show',compact('idea','editing'));
    }

    public function update(Idea $idea){
        if(auth()->id() != $idea->id){
            abort(404);
        }

        $validated=request()->validate([
            'content' => 'required|min:3|max:512'
        ]);

      $idea->update($validated);

       return redirect()->route('ideas.show',$idea->id)->with('success','Idea Update Successfully');
    }
}
