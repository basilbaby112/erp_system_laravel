<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    // show index padge
    public function index(){
        $listings=Listing::withTrashed()->active()->latest()->paginate(10);
        return view('index', compact('listings'));
    }

    //create listing object
    public function create(){
        return view('create');
    }

    //store listing object
    public function store(){
        
        $listing_data=request()->validate([
            'name'=> 'required',
            'email'=> 'required|email|unique:listings,email',
            'date_of_birth'=> 'required',
        ]);
        if(request()->hasFile('image')){
            
            $listing_data['image'] = request()->file('image')->store('listings','public');
        }
        
        Listing::create($listing_data);
        return redirect()->route('home')->with('message','Listing added successfully');
    }

    //show data
    public function show($id){
        $data_id=decrypt($id);
        $data=Listing::find($data_id);
        return view('edit',compact('data'));
    }

    //update data
    public function update(){
        $user_id=decrypt(request('id'));
        request()->validate(['name'=>'required', 'email'=>'required']);
        $data=Listing::find($user_id);
        $data->update([
            'name' =>request('name'),
            'email' =>request('email'),
            'date_of_birth' =>request('date_of_birth')
        ]);
        if(request()->hasFile('image')){
            // echo "hello"; exit();
            $data->update(['image' =>request()->file('image')->store('listings', 'public')]);
        }
        return redirect()->route('home')->with('message', 'updated successfully');
    }

    // delete data
    public function delete($id){
        $user_id=decrypt($id);
        Listing::find($user_id)->delete();
        return redirect()->route('home')->with('message', 'deleted successfully');

    }

    // restore data
    public function restore($id){
        $user_id=decrypt($id);
        Listing::withTrashed()->find($user_id)->restore();

        return redirect()->route('home')->with('message','Data restored successfully');
    }

    //Force delete data
    public function forceDelete($id){
        $user_id=decrypt($id);
        Listing::withTrashed()->find($user_id)->forceDelete();

        return redirect()->route('home')->with('message','Data deleted permanently');

    }


    // show about-us page
    public function about(){
        return view('about');
    }

    // show contact-us page
    public function contact(){
        return view('contact');
    }
}
