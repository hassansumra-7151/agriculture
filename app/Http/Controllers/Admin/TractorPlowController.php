<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TractorPlow;


class TractorPlowController extends Controller
{
    public function create()
    {
        return view('admin.plow.create');
        
    }

    public function store(Request $request)
	{
	    $validatedData = $request->validate([
	        'plow_name' => 'required|string|max:255|unique:tractor_plows,plow_name,',
	    ]);

	    $data = array(
	         'plow_name' => $request->plow_name,
	        );
	        $create = TractorPlow::create($data);
	        return response()->json(['message' => 'Plow Added successfully!']);
	}

	public function list(){
        $plows = TractorPlow::all();
        return view('admin.plow.index' , compact('plows'));
    }

     public function edit($id){
        $plow = TractorPlow::findOrFail($id);
        return view('admin.plow.edit', compact('plow'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
             'plow_name' => 'required|string|max:255|unique:tractor_plows,plow_name,' . $id,
        ]);
        $fertilizer = TractorPlow::findOrFail($id);

        $fertilizer->plow_name = $request->plow_name;
        $fertilizer->save();
        return response()->json(['message' => 'Plow updated successfully!']);
    }



    public function destroy($id)
    {
        $fertilizer = TractorPlow::find($id);
        
        if ($fertilizer) {
            $fertilizer->delete();
            return response()->json(['message' => 'banner deleted successfully!']);
        }
    }
}
