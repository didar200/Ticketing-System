<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Notifications\CustomerEmailNotification;
use Illuminate\Support\Facades\Notification;
use App\Models\Pop;
use App\Models\CustomerMailHistory;

class CustomerController extends Controller
{
    public function customerCreate()
    {
        $pops = Pop::select('id', 'pop_name')->where('status', 1)->orderBy('pop_name')->get();
    	return view('customer.customerCreate', compact('pops'));
    }

    public function customerCreateProcess(Request $request)
    {
    	$request->validate([
    		'customer_id' => 'required',
            'name' => 'required',
            'phone' => 'required',
    		'email' => 'required',
    		'address' => 'required'
    	]);


        $customer = new Customer();

        $customer->customer_id = $request->customer_id;
        $customer->name = $request->name;
        $customer->phone = $request->phone;
        $customer->email = $request->email;
    	$customer->address = $request->address;
    	$customer->status = $request->status;
        $customer->pop_id = $request->pop;
    	

        $customer->save();
        

    	return back()->with('create', 'New Customer Added!');
    }

    public function customerList()
    {

        $customers = Customer::with('pop')->select('id','customer_id','name','email','phone','address','pop_id','status')->orderBy('customer_id')->paginate(30);

        $pops = Pop::select('id', 'pop_name')->where('status', 1)->orderBy('pop_name')->get();
        return view('customer.customerList', compact('customers','pops'));
    }

    public function customerUpdate(Request $request)
    {
        $customer = Customer::with('pop')->select('id','customer_id','name','email','phone','address','pop_id','status')->find($request->id);
        $pops = Pop::select('id','pop_name')->where('status', 1)->orderBy('pop_name')->get();

        return view('customer.customerUpdate', compact('customer','pops'));
    }

    public function customerDetailAjax(Request $request)
    {
        $customer = Customer::with('pop')->select('id','customer_id','name','email','phone','address','pop_id','status')->find($request->id);

        $detail_view   = view('customer.customerDetailAjax', compact('customer'))->render();
        $data['data'] = json_encode($detail_view);
        $data['status'] = 'success';

        return $data;   
    }

    public function customerUpdateProcess(Request $request)
    {
        $request->validate([
            'customer_id' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'address' => 'required'
        ]);

        $customer = Customer::find($request->id);

        $customer->customer_id = $request->customer_id;
        $customer->name = $request->name;
        $customer->phone = $request->phone;
        $customer->email = $request->email;
        $customer->address = $request->address;
        $customer->pop_id = $request->pop;
        $customer->status = $request->status;

        $customer->save();

        return redirect()->route('customer.list');
    }

    public function searchCustomerList(Request $request)
    {
        $customers = Customer::with('pop')->select('id','customer_id','name','email','phone','address','pop_id','status')->orderBy('customer_id')->where('customer_id', 'LIKE',"%{$request->search}%")->get()->toArray();

        $search_view   = view('customer.searchCustomerList', compact('customers'))->render();
        $data['data'] = json_encode($search_view);
        $data['status'] = 'success';

        return $data;
    }

    public function searchCustomerListPop(Request $request)
    {
        if($request->search == 0)
        {
            $customers = Customer::with('pop')->select('id','customer_id','name','email','phone','address','pop_id','status')->orderBy('customer_id')->get()->toArray();
        }
        else
        {
            $customers = Customer::with('pop')->select('id','customer_id','name','email','phone','address','pop_id','status')->orderBy('customer_id')->where('pop_id', $request->search)->get()->toArray();
        }
        

        $search_view   = view('customer.searchCustomerList', compact('customers'))->render();
        $data['data'] = json_encode($search_view);
        $data['status'] = 'success';

        return $data;
    }

    public function getCustomerByPop(Request $request)
    {

        $html = '';

        if($request->id == 0)
        {
            $html = '<option value="'.$request->id.'">'.'All'.'</option>';
        }

        else
        {
            $customers = Customer::with('pop')->select('id','customer_id','name','email','phone','address','pop_id','status')->orderBy('customer_id')->where('pop_id', $request->id)->get();

            // $html = view('bladeName', compact('data'));
            
            $html .= '<option value="'.'0'.'">'.'All'.'</option>';
            foreach($customers as $customer):
                $html .= '<option value="'.$customer->id.'">'.$customer->customer_id.'('.$customer->name.')</option>';
            endforeach;

        }
        

        $data['status'] = 'success';
        $data['html'] = $html;
        return response()->json($data);
    }


    public function customerEmail()
    {
        $pops = Pop::select('id', 'pop_name')->where('status', 1)->orderBy('pop_name')->get();
        return view('customer.customerEmailNotification', compact('pops'));
    }

    public function customerEmailProcess(Request $request)
    {
        $request->validate([
            'subject' => 'required',
            'body' => 'required'
        ]);

        $subject = $request->subject;
        $body = $request->body;
        $attach = '';

        if($request->pop == 0)
        {
            if($request->status == 1)
            {
                $customers = Customer::select('email')->where('status', 1)->get();
            }
            elseif ($request->status == 0) 
            {
                $customers = Customer::select('email')->where('status', 0)->get();
            }
            else
            {
                $customers = Customer::select('email')->get();
            }
        }
        else
        {
            if($request->status == 1)
            {
                if($request->customer == 0)
                {
                    $customers = Customer::select('email')->where('status', 1)->where('pop_id', $request->pop)->get();
                }
                else
                {
                    $customers = Customer::select('email')->where('status', 1)->where('id', $request->customer)->get();
                }
                
            }
            elseif ($request->status == 0) 
            {
                
                if($request->customer == 0)
                {
                    $customers = Customer::select('email')->where('status', 0)->where('pop_id', $request->pop)->get();
                }
                else
                {
                    $customers = Customer::select('email')->where('status', 0)->where('id', $request->customer)->get();
                }
            }
            else
            {
                if($request->customer == 0)
                {
                    $customers = Customer::select('email')->where('pop_id', $request->pop)->get();
                }
                else
                {
                    $customers = Customer::select('email')->where('id', $request->customer)->get();
                }
            }
        }
        

        if($request->hasfile('attachment'))
        {
            $request->validate([
                'attachment' => 'required|mimes:jpeg,jpg,png,gif,txt,pdf|max:5120'
             ]);

            $name = time().'_'.$request->file('attachment')->getClientOriginalName();
            $request->attachment->move(public_path('/assets/CustomerAttachment/'), $name);
            $attach = '/assets/CustomerAttachment/'.$name;   
        }

        // if($request->hasfile('attachment'))
        // {
        //     $request->validate([
        //         'attachment' => 'required',
        //         'attachment.*' => 'mimes:jpeg,jpg,png,gif,txt,pdf|max:5120'
        //      ]);

        //     foreach($request->file('attachment') as $file)
        //     {
        //         $name = time().'_'.$file->getClientOriginalName();
        //         $file->move(public_path('/assets/CustomerAttachment/'), $name);
        //         $imgData[] = $name;  
        //     }

        //     $ticket->attachment = json_encode($imgData);
        // }


        foreach($customers as $customer)
        {
            Notification::route('mail' , $customer->email)->notify(new CustomerEmailNotification($subject, $body, $attach));
        }

        $customerMailHistory = new CustomerMailHistory();

        $customerMailHistory->subject = $request->subject;
        $customerMailHistory->body = $request->body;
        $customerMailHistory->attachment = $attach;

        if($request->pop == 0)
        {
            $customerMailHistory->pop = 'All';
        }
        else
        {
            $pop = Pop::select('pop_name')->find($request->pop);
            $customerMailHistory->pop = $pop->pop_name;
        }

        if($request->customer == 0)
        {
            $customerMailHistory->customer = 'All';
        }
        else
        {
            $customer = Customer::select('customer_id','name')->find($request->customer);
            $customerMailHistory->customer = $customer->customer_id.'('.$customer->name.')';
        }
        
        
        if($request->status == 0)
        {
            $customerMailHistory->category = 'Inactive';
        }
        elseif ($request->status == 1) 
        {
            $customerMailHistory->category = 'Active';
        }
        else
        {
            $customerMailHistory->category = 'All';
        }
        
        $customerMailHistory->save();

        return back()->with('email_send', 'Email sending completed.');
    }

    public function customerEmailHistory()
    {
        $emailHistories = CustomerMailHistory::orderBy('id', 'DESC')->paginate(30);
        return view('customer.customerEmailHistory', compact('emailHistories'));
    }

    public function detailCustomerEmail(Request $request)
    {
        $emailHistory = CustomerMailHistory::select('subject','body','attachment')->find($request->id);

        $detail_view   = view('customer.customerEmailDetailAjax', compact('emailHistory'))->render();
        $data['data'] = json_encode($detail_view);
        $data['status'] = 'success';

        return $data;
    }
}
