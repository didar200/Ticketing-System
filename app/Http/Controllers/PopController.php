<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pop;

class PopController extends Controller
{
    public function popCreate()
    {
    	return view('pop.popCreate');
    }

    public function popCreateProcess(Request $request)
    {
    	$request->validate([

    		'pop_name' => 'required',
    		'address' => 'required',
    	]);

    	Pop::create([
    		'pop_name' => $request->pop_name,
    		'address' => $request->address
    	]);

    	return back()->with('create', 'New POP added successfully!');
    }

    public function popList()
    {
    	$pops = Pop::select('id','pop_name','address','status')->orderBy('pop_name')->paginate(30);

    	return view('pop.popList', compact('pops'));
    }

    public function popUpdate(Request $request)
    {
        $pop = Pop::find($request->query('id'));

        return view('pop.popUpdate', compact('pop'));
    }

    public function popUpdateProcess(Request $request)
    {
        $request->validate([
            'pop_name' => 'required',
            'address' => 'required',
        ]);

        $pop = Pop::find($request->id);

        $pop->pop_name = $request->pop_name;
        $pop->address = $request->address;
        $pop->status = $request->status;

        $pop->save();

        return redirect()->route('pop.list');
    }
}
