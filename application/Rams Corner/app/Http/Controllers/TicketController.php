<?php

namespace App\Http\Controllers;
use App\Models\StatusHistory;
use App\Models\Ticket;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;

use App\Notifications\NewTicketNotification;

use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class TicketController extends Controller
{


    // public function sendNewTicketNotification()
    //     {
    //         $users = User::wherenotIn('u_role', ['Client']);
    //         $this->notify(new NewTicketNotification($this));
    //     }
//Ticket Creation
    public function createTicket(Request $request){


        $user_ID = Auth::user();

        if($user_ID == null){
            Alert::warning('Warning!!!', 'You are not authorized!');
            return redirect()->route('loginPage');
        }


        if ($request->file('profile')) {
            $file = $request->file('profile');
            #filename -> isesave sa database
            $filename = $user_ID->u_name[0] .'tix_file.'.now()->toDateString().now()->minute.'.'. $file->getClientOriginalExtension();
            $file->move(public_path('/ticketImages'), $filename);
        }else{
            $filename = "";
        }


        if($request->urgency == 1 && $request->impact ==1){
            $priority = 1;

        }else if($request->urgency == 1 && $request->impact ==2){
            $priority = 2;

        }else if($request->urgency == 1 && $request->impact ==3){
            $priority = 2;

        }else  if($request->urgency == 2 && $request->impact ==1){
            $priority = 1;

        }else if($request->urgency == 2 && $request->impact ==2){
            $priority = 2;

        }else if($request->urgency == 2 && $request->impact ==3){
            $priority = 3;

        }else if($request->urgency == 3 && $request->impact ==1){
            $priority = 2;

        }else if($request->urgency == 3 && $request->impact ==2){
            $priority = 2;

        }else if($request->urgency == 3 && $request->impact ==3){
            $priority = 3;

        }else{
            $priority = 3;

        }




        Ticket::create( [
            "u_ID"=>$user_ID->u_ID,
            "t_urgency"=>$request->urgency,
            "t_impact"=>$request->impact,
            "t_priority"=>$priority,
            "t_category"=>strtoupper($request->category),
            "t_cc"=>$request->cc,
            "t_title"=>$request->title,
            "t_content"=>$request->content,
            "t_image"=>$filename
        ]);

        $get_uID = $user_ID->u_ID;
        $get_tID = Ticket::where("u_ID", $get_uID)->get()->last()->t_ID;


        StatusHistory::create( [
            "t_ID"=>$get_tID

        ]);

        Alert::success("Success!", "Your ticket was sent successfully. Please wait for your ticket's status updates.");
        if($user_ID->u_role == "Admin"){
            return redirect()->route('adminHome');
        }elseif($user_ID->u_role == "Staff"){
            return redirect()->route('staffHome');
        }else{
            return redirect()->route('clientHome');
        }

    }


    public function viewTicket(){
        $tickets = DB::select('select * from tickets');
        return redirect()->route('clientHome', ['tickets' => $tickets]);

    }

//Updating Ticket
    public function updateTicket(Request $request, $tID){
        $user = Auth::user();
        if($user == null){
            Alert::warning('Warning!!!', 'You are not authorized!');
            return redirect()->route('loginPage');


        }

        $ticket = Ticket::find($tID);
        if($request->status == null){
            Alert::warning('Status Change required!');
            return back();
        }
        if($request->priority == 1){
            $dues = Carbon::parse($ticket->t_datetime)->addHours(4);
        }else if($request->priority == 2){
            $dues = Carbon::parse($ticket->t_datetime)->addHours(72);
        }else{
            $dues = Carbon::parse($ticket->t_datetime)->addHours(168);
        }


        $ticket->t_status = $request->status;
        $ticket->t_category = $request->category;
        $ticket->t_urgency = $request->urgency;
        $ticket->t_impact = $request->impact;
        $ticket->t_due = $dues;
        $ticket->t_assignedTo = $request->assign;
        $ticket->update();

        StatusHistory::create( [
            "t_ID"=>$tID,
            "sh_Status" => $request->status,
            "sh_AssignedTo" => $request->assign,
            "sh_message" => $request->message

        ]);
        Alert::success("Success!", "Ticket details has been updated");

        if($user->u_divRole == "ITRO Head" ){
            return redirect()->route('openTicket',$tID);
        }else{
            return redirect()->route('staffOpenTickets',$tID);
        }

    }


//Cancel Ticket

   public function cancelTicket(Request $request){
    $user = Auth::user();
    if($user == null){
        Alert::warning('Warning!!!', 'You are not authorized!');
        return redirect()->route('loginPage');
    }
    $ticketId = $request->tID;
    $ticket = Ticket::find($ticketId);
    $ticket->t_status = 'CANCELLED';
    $ticket->save();

    StatusHistory::create( [
        "t_ID"=>$ticketId,
        "sh_Status" => 'CANCELLED',

    ]);

    Alert::info("TICKET CANCELLATION", "You have cancelled your ticket with the ID {$ticketId}");

    return back();
   }



//Saving Resolution
   public function saveResolution(Request $request, $tID){

    $user = Auth::user();
    if($user == null){
        Alert::warning('Warning!!!', 'You are not authorized!');
        return redirect()->route('loginPage');


    }
    $user_info = User::where('u_ID', $user->u_ID)->get();


    $ticket = Ticket::find($tID);
    $ticket->t_status = 'RESOLVED';
    $ticket->t_resolution = $request->resolution;
    $ticket->save();

    StatusHistory::create( [
        "t_ID"=>$tID,
        "sh_Status" => 'RESOLVED',
        "sh_AssignedTo" => $ticket->t_assignedTo,
        "sh_doneBy" => $user->u_name

    ]);
    Alert::success("Saved", "Ticket # {$tID} has been resolved!");
    return back();
   }

//Ticket Escalation
   public function escalateTicket($tID){
    $user = Auth::user();
    if($user == null){
        Alert::warning('Warning!!!', 'You are not authorized!');
        return redirect()->route('loginPage');


    }
    $user_info = User::where('u_ID', $user->u_ID)->get();



    $ticket = Ticket::find($tID);
    $ticket->t_status = 'ESCALATED';
    $ticket->t_priority = 0;
    $ticket->t_urgency = '1';
    $ticket->t_impact = '1';
    $ticket->t_assignedTo = 'Jose Castillo';
    $ticket->t_due = now()->addHours(2);
    $ticket->save();

    StatusHistory::create( [
        "t_ID"=>$tID,
        "sh_Status" => 'ESCALATED',
        "sh_AssignedTo" => 'Jose Castillo',
        "sh_doneBy" => $user->u_name

    ]);
    Alert::success("Escalated", "Ticket # {$tID} has been sent to the Administrator!");
    return back();


   }


   //Viewing tags
   public function viewTags(){

    $users = Auth::user();

    if($users == null){
        Alert::warning('Warning!!!', 'You are not authorized!');
        return redirect()->route('loginPage');
    }
    $user_info = User::where('u_ID', $users->u_ID)->get();
    $tickets = DB::table('tickets')
    ->join('users', 'users.u_ID', '=', 'tickets.u_ID')
    ->select('tickets.*', 'users.u_name','users.email')
    ->where('tickets.t_cc', $users->u_name)
    ->get();

    $tixCount = $tickets->count();
        $ticketss = DB::table('tickets')
        ->join('users', 'users.u_ID', '=', 'tickets.u_ID')
        ->select('tickets.*', 'users.u_name','users.email')
        ->where('tickets.t_cc', $users->u_name)
        ->get()->first();









    // $tixCount = Ticket::where('t_cc', $users->u_name)->get()->count();


    if($users->u_role == "Admin"){
        return view('admin_tags', ['tixCount'=>$tixCount,'sample'=>$ticketss, 'ticket' => $tickets, "user"=>$user_info, "admin"=>$user_info,  'display'=>'block']);
    }else if ($users->u_role == "Staff"){
        return view('staff_tags', ['sample'=>$ticketss,'ticket' => $tickets, "user"=>$user_info, "staff"=>$user_info, 'tixCount'=>$tixCount, 'display'=>'block']);
    }else{
        return view('client_tags', ['sample'=>$ticketss,'ticket' => $tickets, "user"=>$user_info, "client"=>$user_info, 'tixCount'=>$tixCount, 'display'=>'block']);
    }
   }

   public function getTicketData($id){

    $users = Auth::user();
    if($users == null){
        Alert::warning('Warning!!!', 'You are not authorized!');
        return redirect()->route('loginPage');
    }
    $user_info = User::where('u_ID', $users->u_ID)->get();
    $tixCount = Ticket::where('t_cc', $users->u_name)->get()->count();


    $ticket= DB::table('tickets')
    ->join('users', 'users.u_ID', '=', 'tickets.u_ID')
    ->select('tickets.*', 'users.u_name','users.email')
    ->where('tickets.t_cc', $users->u_name)
    ->get();

    $ticketss = DB::table('tickets')
    ->join('users', 'users.u_ID', '=', 'tickets.u_ID')
    ->select('tickets.*', 'users.u_name','users.email')
    ->where('tickets.t_cc', $users->u_name)
    ->where('tickets.t_ID',$id)
    ->get()->first();






    if($users->u_role == "Admin"){
        return view('admin_tags', ['ticket'=>$ticket,'sample'=>$ticketss, "user"=>$user_info, "admin"=>$user_info, 'tixCount'=>$tixCount, 'display'=>'block']);
    }else if ($users->u_role == "Staff"){
        return view('staff_tags', ['ticket'=>$ticket, 'sample'=>$ticketss, "user"=>$user_info, "staff"=>$user_info, 'tixCount'=>$tixCount, 'display'=>'block']);
    }else{
        return view('client_tags', ['ticket'=>$ticket,'sample'=>$ticketss, "user"=>$user_info, "client"=>$user_info, 'tixCount'=>$tixCount, 'display'=>'block']);
    }
   }

}
