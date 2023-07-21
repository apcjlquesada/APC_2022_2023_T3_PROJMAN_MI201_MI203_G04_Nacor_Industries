<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Psy\TabCompletion\Matcher\FunctionsMatcher;

use Illuminate\Support\Facades\Auth;
use App\Models\Requests;
use App\Models\StatusHistory;
use App\Models\Reporter;
use App\Models\Ticket;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\View\View\share;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
   public function notification(){
    $users = Auth::user();
    if($users == null){
        Alert::warning('Warning!!!', 'You are not authorized!');
        return redirect()->route('loginPage');
    }

    $user_info =Reporter::where('u_ID', $users->u_ID)->get();
    $notifs = Notification::where('user_id', $users->u_ID)->get()->sortByDesc('created_at');

    $notifCount = Notification::where('user_id', $users->u_ID)->where('read_at', null)->get()->count();


    if($users->u_role == "Admin"){
        return view('admin_notifs',
        [
            "notif"=>$notifCount,
            "users"=>$users,
            "admin" =>$user_info,
            "notifs"=>$notifs] );
    }elseif($users->u_role == "Staff"){
        return view('staff_notifs',
        [
            "notif"=>$notifCount,
            "users"=>$users,
            "staff" =>$user_info,
            "notifs"=>$notifs] );
    }else{
        return view('client_notifs',
        [
            "notif"=>$notifCount,
            "users"=>$users,
            "client" =>$user_info,
            "notifs"=>$notifs] );
    }




   }

   public function openTicketByNotif($nid){
    $user = Auth::user();
    if($user == null){
        Alert::warning('Warning!!!', 'You are not authorized!');
        return redirect()->route('loginPage');


    }

    $notif = Notification::where('nID', $nid)->get()->first();
    $user_info = Reporter::where('u_ID', $user->u_ID)->get();
    $tickets = Ticket::where('t_id', $notif->ticket_id)->get()->first();
    $client = Reporter::where('u_ID', $tickets->u_ID)->get()->first();
    $status = StatusHistory::where('t_id', $tickets->t_ID)->get();
    $staff = Reporter::whereNotIn('u_role', ['Client'])->get();




//     if($tickets->t_status == "NEW"){


//     StatusHistory::create( [
//         "t_ID"=>$tickets->t_ID,
//         "sh_Status" => 'OPENED',
//         "sh_doneBy" => $user->u_name

//     ]);





//     if($tickets->t_priority == 1){
//         $dues = now()->addHours(4);
//     }else if($tickets->t_priority == 2){
//         $dues = now()->addHours(72);
//     }else{
//         $dues = now()->addHours(168);
//     }

//     $tickets->t_status = 'OPENED';
//     $tickets->t_due = $dues;
//     $tickets->save();
// }


$tickets->t_views = ($tickets->t_views)+1;
$tickets->save();

$notifCount = Notification::where('user_id', $user->u_ID)->where('read_at', null)->get()->count();

$notification = Notification::where('user_id', $user->u_ID)->where('nID', $nid)->get()->first();


if($notification->read_at == null){
    $notification->read_at = now();
    $notification->save();
}


$last = StatusHistory::where('t_id', $tickets->t_ID)->get()->last();

    if($user->u_role == "Admin"){
        return view('admin_open_ticket', ['last'=>$last,'notif'=>$notifCount,'tickets' => $tickets, "admin"=>$user_info, 'client'=>$client, 'status'=>$status, 'staffs'=>$staff]);
    }else{
        return view('staff_open_ticket', ['last'=>$last,'notif'=>$notifCount, 'tickets' => $tickets, "staff"=>$user_info, 'client'=>$client, 'status'=>$status, 'staffs'=>$staff]);
    }
   }







   public function clientOpenTicketByNotif($nid){
    $client = Auth::user();
    if($client == null){
        Alert::warning('Warning!!!', 'You are not authorized!');
        return redirect()->route('loginPage');


    }

    $notif = Notification::where('nID', $nid)->get()->first();

    $user_info = Reporter::where('u_ID', $client->u_ID)->get();
    $tickets = Ticket::where('t_id', $notif->ticket_id)->get()->first();
    // $clients = Reporter::where('u_ID', $tickets->u_ID)->get()->first();
    $status = StatusHistory::where('t_id', $tickets->t_ID)->get();
    $staff = Reporter::where('u_role', "Staff")->get();

    $allUsers = Reporter::all();
    $notifCount = Notification::where('user_id', $client->u_ID)->where('read_at', null)->get()->count();


    if($notif->read_at == null){
        $notif->read_at = now();
        $notif->save();
    }
    $last = StatusHistory::where('t_id', $tickets->t_ID)->get()->last();
    if($client->u_role =="Admin"){
        return view('admin_personal_tickets', ['last'=>$last,'notif'=>$notifCount,'allUser'=>$allUsers,'tickets' => $tickets, "client"=>$user_info, 'userinfo'=>$client, 'status'=>$status, 'staffs'=>$staff]);

    }elseif($client->u_role =="Staff"){
        return view('staff_personal_tickets', ['last'=>$last,'notif'=>$notifCount,'allUser'=>$allUsers, 'tickets' => $tickets, "client"=>$user_info, 'userinfo'=>$client, 'status'=>$status, 'staffs'=>$staff]);

    }else{
        return view('client_open_ticket', ['last'=>$last,'notif'=>$notifCount,'allUser'=>$allUsers, 'tickets' => $tickets, "client"=>$user_info, 'userinfo'=>$client, 'status'=>$status, 'staffs'=>$staff]);

    }
   }
}
