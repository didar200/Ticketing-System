<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Group;
use App\Models\User;
use App\Models\Ticket;
use App\Models\Note;
use App\Models\History;
use App\Models\UserNotification;

use App\Notifications\TicketEmailNotification;
use Illuminate\Support\Facades\Notification;


class TicketController extends Controller
{
    
    public function ticketCreate()
    {
    	$customers = Customer::select('id','customer_id', 'name')->where('status', 1)->orderBy('customer_id')->get(); 
    	$groups = Group::select('id','group_name')->where('status', 1)->orderBy('group_name')->get();
    	return view('ticket.ticketCreate', compact('customers', 'groups'));
    }

    public function ticketCreateProcess(Request $request)
    {
        $request->validate([

            'customer_id' => 'required',
            'title' => 'required',
            'status' => 'required',
            'description' => 'required',
            'user_id' => 'required',
            'group_id' => 'required'
            
        ]);

        $ticket = new Ticket();

        $ticket->customer_id = $request->customer_id;
        $ticket->user_id = $request->user_id;
        $ticket->group_id = $request->group_id;
        $ticket->created_user = auth()->user()->first_name ." ". auth()->user()->last_name;
        $ticket->status = $request->status;
        $ticket->title = $request->title;
        $ticket->description = $request->description;

        if($request->hasfile('attachment'))
        {
            $request->validate([
                'attachment' => 'required',
                'attachment.*' => 'mimes:jpeg,jpg,png,gif,txt,pdf|max:2048'
             ]);

            foreach($request->file('attachment') as $file)
            {
                $name = time().'_'.$file->getClientOriginalName();
                $file->move(public_path('/assets/attachment/'), $name);
                $imgData[] = $name;  
            }

            $ticket->attachment = json_encode($imgData);
        }    

        $ticket->save();

        $user = User::find($request->user_id);
        $history = new History();
        $history->history = auth()->user()->first_name." ".auth()->user()->last_name." Assign To ".$user->first_name." ".$user->last_name.". Status: ".$request->status;
        $history->ticket_id = $ticket->id;

        $history->save();

        $group = Group::with('users')->find($request->group_id);

        $notify = UserNotification::find(1);
        
        if($notify !=null)
        {
            if($notify->notification_status == 1)
            {
                $ticket_id = $ticket->id;
                $group_name = $group->group_name;

                foreach($group->users as $user)
                {
                    Notification::route('mail' , $user->email)->notify(new TicketEmailNotification($ticket_id, $group_name));
                }
            }
        }
        
        
        return redirect()->route('myTicket.list');
    }

    public function myTicketList()
    {
        $status = array('Open', 'Reopen', 'Pending');
        $tickets = Ticket::with('user','group','customer')->where('user_id', auth()->user()->id)->whereIn('status', $status)->paginate(10);
        $myCount = Ticket::with('user','group','customer')->where('user_id', auth()->user()->id)->whereIn('status', $status)->count();

        $gCount = 0;

        $user = User::with('groups')->find(auth()->user()->id);
        
        foreach($user->groups as $group)
        {
            $gCount += Ticket::with('user','group','customer')->where('group_id', $group->id)->count();

        }

        return view('ticket.ticketList', compact('tickets','myCount','gCount'));
    }

    public function groupTicketList()
    {
        
        $myCount = Ticket::with('user','group','customer')->where('user_id', auth()->user()->id)->count();
        $gCount = 0;

        $user = User::with('groups')->find(auth()->user()->id);

        $tickets = array();
        
        foreach($user->groups as $group)
        {
            $tickets[] = Ticket::with('user','group','customer')->where('group_id', $group->id)->get()->toArray();
            $gCount += Ticket::with('user','group','customer')->where('group_id', $group->id)->count();

        }

        return view('ticket.groupTicketList', compact('tickets','myCount','gCount'));
    }

    public function ticketList()
    {
        $status = array('Open', 'Reopen', 'Pending');

        $allTickets = Ticket::with('user','group','customer')->whereIn('status', $status)->orderBy('id', 'DESC')->get();

        $mytickets = $allTickets->where('user_id', auth()->user()->id);
        

        $myCount = $mytickets->count();

        $gCount = 0;

        $gtickets = array();
        
        $user = User::with('groups')->find(auth()->user()->id);

        $groups = array();

        foreach($user->groups as $group)
        {
            array_push($groups, $group->id);
        }

        $gtickets[] = $allTickets->whereIn('group_id', $groups)->toArray();

        foreach($gtickets as $gt){
            foreach($gt as $data){
                $gCount++;
            }
        }


        return view('ticket.ticketList', compact('mytickets','gtickets','myCount','gCount'));
    }

    public function detailTicket(Request $request)
    {
        $id = $request->query('tt');
        $status = array('Open', 'Reopen', 'Pending', 'Closed');
        $ticket = Ticket::with('user','group','customer')->find($id);

        $user_group = Group::with('users')->find($ticket->group->id);

        foreach($user_group->users as $user)
        {
            if(auth()->user()->role == 1 )
            {
                $member = 1;
                break;
            }
            elseif($user->id == auth()->user()->id && $ticket->status != "Closed" )
            {
                $member = 1;
                break;
            }
            else
            {
                $member = 0;
            }
        }

        $notes = Note::with('user')->where('ticket_id', $id)->orderBy('created_at', 'desc')->get();
        $histories = History::where('ticket_id', $id)->orderBy('created_at', 'desc')->get();
        $groups = Group::with('users')->where('status', 1)->select('id','group_name')->orderBy('group_name')->get();
        
        return view('ticket.detailTicket', compact('ticket','groups','notes','status','histories','member'));
    }

    public function getUserByGroupID(Request $request)
    {
    	$group = Group::find($request->id);
    	$users = $group->users;

        // $html = view('bladeName', compact('data'));
        $html = '';

        foreach($users as $user):
            $html .= '<option value="'.$user->id.'">'.$user->first_name.' '.$user->last_name.'</option>';
        endforeach;


        $data['status'] = 'success';
        $data['html'] = $html;
        return response()->json($data);
    }

    public function addNoteProcess(Request $request)
    {
        $request->validate([
            'notes' => 'required'
        ]);

        $note = new Note();

        $file = $request->attachment;

        if($request->hasfile('attachment'))
        {
            $request->validate([
                'attachment' => 'required',
                'attachment.*' => 'mimes:jpeg,jpg,png,gif,txt,pdf|max:2048'
             ]);

            foreach($request->file('attachment') as $file)
            {
                $name = time().'_'.$file->getClientOriginalName();
                $file->move(public_path('/assets/attachment/'), $name);
                $imgData[] = $name;  
            }

            $note->attachment = json_encode($imgData);
        }

        $note->user_id = $request->user_id;
        $note->ticket_id = $request->ticket_id;
        $note->notes = $request->notes;

        $note->save();

        return back();

    }

    public function ticketUpdateProcess(Request $request)
    {
        $request->validate([
            'status' => 'required',
            'user_id' => 'required',
            'group_id' => 'required'
        ]);

        $ticket = Ticket::find($request->id);

        $ticket->user_id = $request->user_id;
        $ticket->group_id = $request->group_id;
        $ticket->status = $request->status;

        $ticket->save();

        $user = User::find($request->user_id);
        $history = new History();
        $history->history = auth()->user()->first_name." ".auth()->user()->last_name." Assign To ".$user->first_name." ".$user->last_name.". Status: ".$request->status;
        $history->ticket_id = $request->id;

        $history->save();

        $group = Group::with('users')->find($request->group_id);

        $notify = UserNotification::find(1);
        
        if($notify !=null)
        {
            if($notify->notification_status == 1)
            {
                $ticket_id = $request->id;
                $group_name = $group->group_name;

                foreach($group->users as $user)
                {
                    Notification::route('mail' , $user->email)->notify(new TicketEmailNotification($ticket_id, $group_name));
                }
            }
        }

        return redirect()->route('myTicket.list');
    }

    public function searchTicketProcess(Request $request)
    {
        $request->validate([

            'search' => 'required|numeric'

        ]);

        $ticket = Ticket::with('user','group','customer')->find($request->search);

        if($ticket)
        {
            $message ='';
            return view('ticket.searchTicket', compact('ticket','message'));
        }

        $ticket='';
        $message = "No Data Found!";
        
        return view('ticket.searchTicket', compact('message','ticket'));
    }

    public function searchTicketAjax(Request $request)
    {
        $tickets = Ticket::with('user','group','customer')->where('id','LIKE',"{$request->search}")->get()->toArray();

        $search_view   = view('ticket.searchTicketAjax', compact('tickets'))->render();
        $data['data'] = json_encode($search_view);
        $data['status'] = 'success';

        return $data;

    }

    public function searchCustomerTicketAjax(Request $request)
    {
        $customers = Customer::where('customer_id', $request->customer_id)->get();

        $customer = 0;

        foreach($customers as $customer)
        {
            $customer = $customer->id;
        }

        $tickets = Ticket::with('user','group','customer')->where('customer_id', $customer)->get()->toArray();

        $search_view   = view('ticket.searchTicketAjax', compact('tickets'))->render();
        $data['data'] = json_encode($search_view);
        $data['status'] = 'success';

        return $data;

    }

    public function search()
    {
        return view('ticket.search');
    }

    public function searchCustomerTicketProcess(Request $request)
    {
        $request->validate([

            'customer_id' => 'required'

        ]);

        $customers = Customer::where('customer_id', $request->customer_id)->get();

        $customer = 0;

        foreach($customers as $customer)
        {
            $customer = $customer->id;
        }
        
        if($customer == 0)
        {
            $tickets='';
            $message = "No Data Found!";
            return view('ticket.searchCustomerTicket', compact('tickets','message'));
        }

        $tickets = Ticket::with('user','group','customer')->where('customer_id', $customer)->get();

        if($tickets)
        {
            $message ='';
            return view('ticket.searchCustomerTicket', compact('tickets','message'));
        }

        $tickets='';
        $message = "No Data Found!";
        
        return view('ticket.searchCustomerTicket', compact('message','tickets'));
    }


}
