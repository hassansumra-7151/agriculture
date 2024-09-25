<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Agriculture;
use App\Models\TractorPlow;
use App\Models\Fertilizer;
use PDF;


class AgricultureController extends Controller
{
    public function create()
    {
    	$plows = TractorPlow::all();
    	$fertilizers = Fertilizer::all();
        return view('admin.agriculture.create', compact('plows','fertilizers'));
        
    }

    public function store(Request $request)
	{
	    $data = [
	        'agriculture_name' => $request->input('agriculture_name'),
	        'total_area' => $request->input('total_area'),
	        'plow_name' => $request->input('plow_name'),
	        'see' => $request->input('see'),
	        'plow_price' => $request->input('plow_price'),
	        'fertilizer_name' => $request->input('fertilizer_name'),
	        'fertilizer_qty' => $request->input('fertilizer_qty'),
	        'fertilizer_price' => $request->input('fertilizer_price'),
	        'sapray_name' => $request->input('sapray_name'),
	        'sapray_price' => $request->input('sapray_price'),
	        'labour_work' => $request->input('labour_work'),
	        'labour_price' => $request->input('labour_price'),
	    ];

	    Agriculture::create($data);

	    return response()->json(['message' => 'Agriculture Added successfully!']);
	}

	public function list(){
        $agricultures = Agriculture::all();
        return view('admin.agriculture.index' , compact('agricultures'));
    }

	public function downloadPDF()
	{
	    $agricultures = Agriculture::all();
	    $pdf = PDF::loadView('admin.agriculture.pdf', compact('agricultures'));
	    return $pdf->stream('agricultures.pdf');
	}
	
	public function destroy($id)
    {
        $Agriculture = Agriculture::find($id);
        
        if ($Agriculture) {
            $Agriculture->delete();
            return response()->json(['message' => 'Agriculture deleted successfully!']);
        }
    }


}








