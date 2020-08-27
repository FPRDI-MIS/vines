<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vine;
use App\Models\Picture;
use DB;
use Illuminate\Support\Facades\Storage;

class VinesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $vine = Vine::orderBy('sci_name','asc')->get();

        return view('vines.index')->with('vine', $vine);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vines.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'sci_name' => 'required',
            'photo' => 'required|image',
            'description' => 'required'
        ]);

        /* shows the filename of the file that is selected for uploading */
        $filenameWithExtension = $request->file ('photo')->getClientOriginalName();

        $filename = pathinfo ($filenameWithExtension, PATHINFO_FILENAME);

        $extension = $request->file('photo')->getClientOriginalExtension();

        $filenameToStore = $filename . '_' . time() . '.' . $extension;

        /* save the image to the server files */
        $request->file('photo')->storeAs('public/vines/' . $request->input('sci_name'), $filenameToStore);

        // $path = $request->file('photo')->storeAs('public/vines/' . $request->input('sci_name'), $filenameToStore);
        // dd($path);

        /* save entry to database table */
        $vine = new Vine();
        $vine->sci_name = $request->input('sci_name');
        $vine->com_name = $request->input('com_name');
        $vine->loc_name = $request->input('loc_name');
        $vine->family = $request->input('family');
        $vine->genus = $request->input('genus');
        $vine->species = $request->input('species');
        $vine->auth_name = $request->input('auth_name');
        $vine->description = $request->input('description');
        $vine->comments = $request->input('comments');
        $vine->photo = $filenameToStore;
        $vine->size = $request->file('photo')->getSize();
        $vine->longitude = $request->input('longitude');
        $vine->latitude = $request->input('latitude');
        $vine->save();

        /* return view to vines index */
        return redirect('/vines')->with('success', 'New vine specimen created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vine = Vine::find($id);

        return view('vines.show')->with('vine', $vine);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vine = Vine::find($id);

        return view('vines.edit')->with('vine', $vine);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'sci_name' => 'required',
            'description' => 'required'
        ]);

        $vine = Vine::find($id);
        $vine->sci_name = $request->input('sci_name');
        $vine->com_name = $request->input('com_name');
        $vine->loc_name = $request->input('loc_name');
        $vine->family = $request->input('family');
        $vine->genus = $request->input('genus');
        $vine->species = $request->input('species');
        $vine->auth_name = $request->input('auth_name');
        $vine->description = $request->input('description');
        $vine->comments = $request->input('comments');
        
        
        $vine->longitude = $request->input('longitude');
        $vine->latitude = $request->input('latitude');

        if($request->hasfile('photo'))
        {
            $filenameWithExtension = $request->file ('photo')->getClientOriginalName();
            $filename = pathinfo ($filenameWithExtension, PATHINFO_FILENAME);
            $extension = $request->file('photo')->getClientOriginalExtension();
            $filenameToStore = $filename . '_' . time() . '.' . $extension;
            $request->file('photo')->storeAs('public/vines/' . $vine->sci_name, $filenameToStore);
        }

        $vine->save();

        return redirect('/vines/'.$vine->id)->with('vine', $vine)->with('success', 'Entry updated successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vine = Vine::find($id);

        if (Storage::delete('public/vines/' . $vine->sci_name . '/' . $vine->photo )) {
            $vine->delete();

            return redirect('/vines')->with('success', 'Entry deleted successfully!!');
        } 
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
        $vine = DB::table('vines')->where('sci_name', 'LIKE', '%' .$search. '%')
                    ->orWhere ('com_name', 'LIKE', '%' .$search. '%')
                    ->orWhere ('loc_name', 'LIKE', '%' .$search. '%')
                    ->orWhere ('description', 'LIKE', '%' .$search. '%')
                    ->paginate(5);

        return view('vines.search')->with("vine", $vine);
    }
}
