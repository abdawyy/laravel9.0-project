<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use App\Models\User;

class ListingController extends Controller
{

    // Show all listings
    public function index() {

        return view('listings.index',[
            'listings'=> Listing::latest()->filter(request(['tag' , 'search']))
            ->paginate(5)
            ]);

        //show single listing
    }
    public function show(Listing $listing){
        return view ('listings.show',[
            'listing' =>$listing
        ]);
        // show create form


    }
    public function create(){
        return view('listings.create');
     }
     //store data
     public function store(Request $request){
        $formFields = $request->validate([
            'title' =>'required',
            'company'=>['required', Rule::unique('listings',
            'company')],
            'location'=>'required',
            'website'=>'required',
            'email'=>['required','email'],
            'tags'=> 'required',
            'description'=>'required'




        ]);
        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos','public');
        }
        $formFields['user_id'] = auth()->id();
        Listing::create($formFields);


        return redirect('/home')->with('message','Listing created successfully!');

    }
    // Show Edit Form
    public function edit(Listing $listing){
        return view('listings.edit', ['listing' =>$listing]);
    }
    // update Listing Data
    public function update(Request $request, Listing $listing)
    {
        // make sure logged in user is owner
        if($listing->user_id != auth()->id()){
            abort(403, 'unauthorized Action');
        }
        $formFields = $request->validate([
            'title' =>'required',
            'company'=>['required'],
            'location'=>'required',
            'website'=>'required',
            'email'=>['required','email'],
            'tags'=> 'required',
            'description'=>'required'




        ]);

        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos','public');
        }
        $listing->update($formFields);


        return back()->with('message','Listing updated successfully!');

    }
    // Delete Listing
    public function destroy(Listing $listing){
        if($listing->user_id != auth()->id()){
            abort(403, 'unauthorized Action');
        }



        $listing->delete();
        return redirect('/home')->with('message', 'Listing deleted Successfully ');
  }
  //manage Listings
  public function manage(){
    return view ('listings.manage',['listings' =>auth()->user()->listings()->get()]);
  }
}
