<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;

class IdeaController extends Controller
{
    //Read Method
    public function show(Idea $idea){
        // dd($idea->comments); //find relationship in model
       return view('ideas.show',compact('idea'));
    }

     //Edit Method - copy show method and create a var editing
     public function edit(Idea $idea){
        $editing = true;
        return view('ideas.show',compact('idea', 'editing'));
     }

      //Update Method
      public function update(Idea $idea){
        request()->validate([
            'content'=> 'required|min:5|max:240'
          ]);
       $idea->content = request()->get('content', '');
       $idea->save();

        return redirect()->route('ideas.show', $idea->id)->with('success', 'Idea updated successfully!');
     }
    public function store(){
        //Validate
        request()->validate([
          'content'=> 'required|min:5|max:240'
        ]);
         //Create a database entry (record)
         $idea = Idea::create(     //To automate - pass an array here
            [
             'content' => request()->get('content', ''), //request method
            ]
        );
        //redirect user back to Dashboard
        return redirect()->route('dashboard')->with('success', 'Idea created successfully');

    }

    //Destroy method
    public function destroy(Idea $idea){
        //Laravel automatically inject the Idea inside destroy(Idea $id)
        $idea->delete();

        //First get Idea from Model, where id=1
    //    Idea::where('id', $id)->firstOrFail()->delete(); //Give first item to match this id

       //redirect user back to Dashboard
       return redirect()->route('dashboard')->with('success', 'Idea deleted successfully');
    }
}



       // dump(request()->get('idea', ''));

        // $idea->save(); //Store in the database

        //View all
        // dump(Idea::all());
