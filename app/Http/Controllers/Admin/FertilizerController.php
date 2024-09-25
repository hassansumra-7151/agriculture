<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Fertilizer;

class FertilizerController extends Controller
{
    public function create()
    {
        return view('admin.fertilizer.create');
        
    }
    public function store(Request $request)
	{
	    $validatedData = $request->validate([
	        'fertilizer_name' => 'required|string|max:255|unique:fertilizers,fertilizer_name,',
	    ]);

	    $data = array(
	         'fertilizer_name' => $request->fertilizer_name,
	        );
	        $create = Fertilizer::create($data);
	        return response()->json(['message' => 'Fertilizer Added successfully!']);
	}

	public function list(){
        $fertilizers = Fertilizer::all();
        return view('admin.fertilizer.index' , compact('fertilizers'));
    }

     public function edit($id){
        $fertilizer = Fertilizer::findOrFail($id);
        return view('admin.fertilizer.edit', compact('fertilizer'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
             'fertilizer_name' => 'required|string|max:255|unique:fertilizers,fertilizer_name,' . $id,
        ]);
        $fertilizer = Fertilizer::findOrFail($id);

        $fertilizer->fertilizer_name = $request->fertilizer_name;
        $fertilizer->save();
        return response()->json(['message' => 'Fertilizer updated successfully!']);
    }



    public function destroy($id)
    {
        $fertilizer = Fertilizer::find($id);
        
        if ($fertilizer) {
            $fertilizer->delete();
            return response()->json(['message' => 'banner deleted successfully!']);
        }
    }
}
