<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Staff;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // Create some data
        $title = 'About Page TEST';
        $metaDesc = 'We have staff members';

        $allStaff = Staff::all();

        return view('about.index', compact('title', 'metaDesc', 'allStaff'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('about.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate( $request, [
            'first_name'=>'required|min:2|max:20',
            'last_name'=>'required|min:2|max:30',
            'age'=>'required|between:0,130|integer',
            'profile_image'=>'required|image|between:0,2000'
        ]);

        // Get the files extension
        $fileExtention = $request->file('profile_image')->getClientOriginalExtension();
        
        // Generate a random name to prevent overwrites
        $fileName = 'staff-'.uniqid().'.'.$fileExtention;

        // Move the file from temp to final
        $request->file('profile_image')->move('img/staff', $fileName);
        
        \Image::make('img/staff/'.$fileName)->resize(240, null, function($constraint){
            $constraint->aspectRatio();
        })->save('img/staff/'.$fileName);

        // Extract the form data
        $input = $request->all();

        // Insert a slug into the request
        $input['slug'] = str_slug( $request->first_name.' '.$request->last_name ); 
        $input['profile_image'] = $fileName;

        // Mass assign the form data into the database
        $staffMember = Staff::create($input);

        // Redirect to the new staff member by their slug
        return redirect('about/'.$staffMember->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($slug)
    {

        $staffMember = Staff::where('slug', $slug)->firstOrFail();
      
        return view('about.show', compact('staffMember'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($slug)
    {
        $staffMember = Staff::where('slug', $slug)->firstOrFail();

        return view('about.edit', compact('staffMember'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $slug)
    {
        
        // Validation
        $this->validate( $request, [
            'first_name'=>'required|min:2|max:20',
            'last_name'=>'required|min:2|max:30',
            'age'=>'required|between:0,130|integer',
            'profile_image'=>'image|between:0,2000'
        ]);

        // Find the staff member to edit
        $staffMember = Staff::where('slug', $slug)->firstOrFail();

        $staffMember->first_name = $request->first_name;
        $staffMember->last_name = $request->last_name;
        $staffMember->age = $request->age;

        // Insert a slug into the request
        $staffMember->slug = str_slug( $request->first_name.' '.$request->last_name );

        // If the user provided a new image
        if( $request->hasFile('profile_image') ) {

            // Generate a new filename
            // Get the files extension
            $fileExtention = $request->file('profile_image')->getClientOriginalExtension();
            
            // Generate a random name to prevent overwrites
            $fileName = 'staff-'.uniqid().'.'.$fileExtention;

            // Move the file from temp to final
            $request->file('profile_image')->move('img/staff', $fileName);
            
            \Image::make('img/staff/'.$fileName)->resize(240, null, function($constraint){
                $constraint->aspectRatio();
            })->save('img/staff/'.$fileName);

            // Delete the old image
            \File::Delete('img/staff/'.$staffMember->profile_image);

            // Tell the database of the new image
            $staffMember->profile_image = $fileName;

        }

        $staffMember->save();

        return redirect('about/'.$staffMember->slug);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
