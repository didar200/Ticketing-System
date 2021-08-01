<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Group;
use App\Models\Ticket;

class UserController extends Controller
{
    public function register()
    {
    	$groups = Group::select('id','group_name')->where('status', 1)->get();
    	return view('admin.register', compact('groups'));
    }

    public function registerProcess(Request $request)
    {
    	$request->validate([

    		'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
    		'email' => 'required|unique:users|email',
    		'password' => 'required|min:6|confirmed'
    	]);

        if($request->photo != null)
        {
            $imageName = time().'_'.$request->file('photo')->getClientOriginalName();
            $request->photo->move(public_path('/assets/images/'), $imageName);
            $photo = '/assets/images/'.$imageName;

        }
        else
        {
            $photo = "/assets/images/default.png";
        }

        $user = new User();

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->phone = $request->phone;
        $user->email = $request->email;
    	$user->password = bcrypt($request->password);
    	$user->status = $request->status;
    	$user->role = $request->role;
        $user->photo = $photo;

        $user->save();

       // if($user->save()):
       //   save information to inform table
       //  else:
       //      error message then redirect form page.
       //  endif;

        $groups = $request->groups;

        foreach($groups as $group)
        {
        	$user->groups()->attach($group);
        }
        

    	return back()->with('create', 'Registration has been successfully completed');


    }

    public function dashboard()
    {
        $all = Ticket::get();

        $status = array('Open', 'Reopen', 'Pending');

        $open = $all->whereIn('status', $status)->count();

        $closed = $all->where('status', 'Closed')->count();

        $mytickets = $all->where('user_id', auth()->user()->id)->whereIn('status', $status)->count();

        
        $total = $all->count();
    	return view('admin.dashboard', compact('total','open','closed','mytickets'));
    }

    public function userList()
    {
        $groups = Group::select('id','group_name')->get();
        $users = User::with('groups')->select('id','first_name','last_name','email','phone','status','role','photo')->orderBy('first_name')->paginate(100);
        return view('admin.userList', compact('users','groups'));
    }

    public function changePassword()
    {
        return view('admin.changePassword');
    }

    public function changePasswordProcess(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'confirmed|min:6|different:current_password'
        ]);

        $id = auth()->user()->id;
        $user = User::find($id);


        if(Hash::check($request->current_password, $user->password))
        {
            $user->password = bcrypt($request->new_password); 

            $user->save();

            return back()->with('pass_change', 'Password has been changed successfully!');

        }
        else
        {
          return back()->with('pass_error', 'Current Password not match!');  
        }
    }

    public function userUpdate(Request $request)
    {
        $user = User::with('groups')->select('id','first_name','last_name','email','phone','status','role')->find($request->query('id'));

        $groups = Group::select('id','group_name','status')->where('status', 1)->get();

        return view('admin.userUpdate', compact('user','groups'));
    }

    public function userUpdateProcess(Request $request)
    {
        $request->validate([

            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required'
        ]);

        $user = User::find($request->id);

        if($request->password != null)
        {
            $request->validate([
            'password' => 'confirmed|min:6|different:current_password'
            ]);

            $user->password = bcrypt($request->password);
        }


        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->phone = $request->phone;
        $user->role = $request->role;
        $user->status = $request->status;

        $user->save();

        $groups = $request->groups;
        $user->groups()->detach();

        if($groups)
        {
            foreach($groups as $group)
            {
                $user->groups()->attach($group);
            }
        }
        

        return redirect()->route('user.list');


    }

    public function userDelete($id)
    {
        $user = User::find($id);
        return view('admin.userDelete', compact('user'));
    }

    public function userDeleteProcess(Request $request)
    {
        $user = User::find($request->id);

        $user->delete();

        return redirect()->route('user.list');
    }

    public function searchUserListByGroup(Request $request)
    {
        if($request->search == 0)
        {
            $group = '';
            $users = User::with('groups')->select('id','first_name','last_name','email','phone','status','role','photo')->orderBy('first_name')->paginate(100);
            $search_view   = view('admin.searchUserListByGroup', compact('users','group'))->render();
        }
        else
        {
            $users = '';
            $group = Group::with('users')->find($request->search);    
            $search_view   = view('admin.searchUserListByGroup', compact('group','users'))->render();
        }

        $data['data'] = json_encode($search_view);
        $data['status'] = 'success';

        return $data;
    }
}
