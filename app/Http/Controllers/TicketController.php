<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Ticket;

class TicketController extends Controller
{
    public function index(){
        $permissions = [];

        if(Auth::user()->is_super_admin) {
            $permissions = ['IS_SUPER_ADMIN'];
        } else if(count(Auth::user()->roles)) {
            $permissions = Auth::user()->roles[0]->permissions;
        }
        if(!user_is_authorized($permissions, 'VIEW_TICKET')){
            return redirect()->back();
        }

        $tickets = Ticket::paginate(5);
        return view('tickets.index')->with('tickets', $tickets);
    }

    public function reply(Request $request){
        $permissions = [];

        if(Auth::user()->is_super_admin) {
            $permissions = ['IS_SUPER_ADMIN'];
        } else if(count(Auth::user()->roles)) {
            $permissions = Auth::user()->roles[0]->permissions;
        }
        if(!user_is_authorized($permissions, 'REPLY_TICKET')){
            return redirect()->back();
        }

        Validator::make($request->all(),[
            'reply' => 'required',
        ])->validate();

        $ticket = Ticket::find($request->ticket_id);

        if($ticket) {
            $ticket->reply = $request->reply;

            if($ticket->save()) {
                return redirect()->back()->with('message', 'reply successfully given.');
            }
        }

       return redirect()->back();
    }

    public function delete(Request $request){
        $permissions = [];
        
        if(Auth::user()->is_super_admin) {
            $permissions = ['IS_SUPER_ADMIN'];
        } else if(count(Auth::user()->roles)) {
            $permissions = Auth::user()->roles[0]->permissions;
        }
        if(!user_is_authorized($permissions, 'DELETE_TICKET')){
            return redirect()->back();
        }

        $ticket = Ticket::find($request->ticket_id);

        if($ticket->delete()){
            return redirect()->back()->with('message','Ticket is deleted successfully!');
        } else {
            return redirect()->back();
        }
    }
}
