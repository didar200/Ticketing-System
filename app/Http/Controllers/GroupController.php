<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use Illuminate\Support\Str;

class GroupController extends Controller
{
    public function groupCreate()
    {
    	return view('group.groupCreate');
    }

    public function groupCreateProcess(Request $request)
    {
    	$request->validate([

    		'group_name' => 'required',
    	]);

    	$slug = Str::slug($request->group_name);

    	Group::create([
    		'group_name' => $request->group_name,
    		'slug' => $slug
    	]);

    	return back()->with('create', 'New group created successfully!');
    }

    public function groupList()
    {
    	$groups = Group::select('id','group_name', 'status')->orderBy('group_name')->paginate(100);

    	return view('group.groupList', compact('groups'));
    }

    public function groupUpdate(Request $request)
    {
        $group = Group::find($request->query('id'));

        return view('group.groupUpdate', compact('group'));
    }

    public function groupUpdateProcess(Request $request)
    {
        $request->validate([
            'group_name' => 'required'
        ]);

        $group = Group::find($request->id);

        $group->group_name = $request->group_name;
        $group->status = $request->status;

        $group->save();

        return redirect()->route('group.list');
    }
}
