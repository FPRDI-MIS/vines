<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vine;
use App\Models\Picture;
use Illuminate\Support\Facades\Storage;

class PicturesController extends Controller
{
    public function create(int $vineId)
    {
        $vine = Vine::find($vineId);
        return view('pictures.create')->with('vineId', $vineId)->with('vine', $vine);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'picture' => 'required|image'
        ]);

        /* shows the filename of the file that is selected for uploading */
        $filenameWithExtension = $request->file ('picture')->getClientOriginalName();

        $filename = pathinfo ($filenameWithExtension, PATHINFO_FILENAME);

        $extension = $request->file('picture')->getClientOriginalExtension();

        $filenameToStore = $filename . '_' . time() . '.' . $extension;

        /* save the image to the server files */
        $request->file('picture')->storeAs('public/pictures/' . $request->input('vine_id'), $filenameToStore);

        // $path = $request->file('photo')->storeAs('public/vines/' . $request->input('sci_name'), $filenameToStore);
        // dd($path);

        /* save pictures to database pictures table */
        $picture = new Picture();
        $picture->image = $filenameToStore;
        $picture->vine_id = $request->input('vine_id');
        
        $picture->save();

        /* return view to vines index */
        return redirect('/vines/'.$request->input('vine_id'))->with('success', 'Photo added successfully!');
    }
}
