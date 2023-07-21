<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use App\Models\Requests;
use App\Models\Ticket;
use App\Models\Reporter;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\StatusHistory;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;



use Illuminate\Http\Request;

class ClientController extends Controller
{

    public function clientHome()
    {

        // dd($allUser);




        $client = Auth::user();
        if($client == null){
            Alert::warning('Warning!!!', 'You are not authorized!');
            return redirect()->route('loginPage');


        }
        $ticket = Ticket::all();
        if($client->u_role != "Client"){
            Alert::warning('Warning!!!', 'Unauthorized Access!');
            if($client->u_role == "Staff"){
                // return redirect()->route('staffHome');
            }else{
                return redirect()->route('adminHome');
            }
        }
        // dd($client);
        //'client_home' -> blade
        //["client"=>$client] -> variable na ipapasa from controller to view
        $user_info =Reporter::where('u_ID', $client->u_ID)->get();
        $ticket_info = Ticket::where('u_ID', $client->u_ID)->get();
        $ticketCount = Ticket::where('u_ID', $client->u_ID)->get()->count();


        $all = Ticket::where('u_ID', $client->u_ID)->get()->count();
        $new = Ticket::where('t_status', 'NEW')->where('u_ID', $client->u_ID)->get()->count();
        $opened = Ticket::where('t_status', 'OPENED')->where('u_ID', $client->u_ID)->get()->count();
        $pending = Ticket::where('t_status', 'PENDING')->where('u_ID', $client->u_ID)->get()->count();
        $ongoing = Ticket::where('t_status', 'ONGOING')->where('u_ID', $client->u_ID)->get()->count();
        $resolved = Ticket::where('t_status', 'RESOLVED')->where('u_ID', $client->u_ID)->get()->count();
        $closed = Ticket::where('t_status', 'CLOSED')->where('u_ID', $client->u_ID)->get()->count();
        $reopened = Ticket::where('t_status', 'REOPENED')->where('u_ID', $client->u_ID)->get()->count();
        $rejected = Ticket::where('t_status', 'REJECTED')->where('u_ID', $client->u_ID)->get()->count();
        $cancelled = Ticket::where('t_status', 'CANCELLED')->where('u_ID', $client->u_ID)->get()->count();

        $statusCounts = DB::table('tickets')
                        ->where('u_ID', $client->u_ID)
                        ->select('t_status', DB::raw('count(*) as count'))
                        ->groupBy('t_status')
                        ->orderBy('t_status')
                        ->get();
                    // dd($statusCounts);

        $notifCount = Notification::where('user_id', $client->u_ID)->where('read_at', null)->get()->count();
        return view('client_home',["client"=>$user_info,"ticket"=>$ticket_info, "tixCount"=>$ticketCount,"notif"=>$notifCount,
                        'all'=> $all,
                        'new'=>$new,
                        'opened'=>$opened,
                        'pending'=>$pending,
                        'ongoing'=>$ongoing,
                        'resolved'=>$resolved,
                        'closed'=>$closed,
                        'reopened'=>$reopened,
                        'rejected'=>$rejected,
                        'cancelled'=>$cancelled,
                        'data'=>$statusCounts]);
    }

    public function ticketList(){
        $client = Auth::user();
        if($client == null){
            Alert::warning('Warning!!!', 'You are not authorized!');
            return redirect()->route('loginPage');


        }
        $ticket = Ticket::all();
        if($client->u_role != "Client"){
            Alert::warning('Warning!!!', 'Unauthorized Access!');
            if($client->u_role == "Staff"){
                // return redirect()->route('staffHome');
            }else{
                return redirect()->route('adminHome');
            }
        }
        // dd($client);
        //'client_home' -> blade
        //["client"=>$client] -> variable na ipapasa from controller to view
        $user_info =Reporter::where('u_ID', $client->u_ID)->get();
        $ticket_info = Ticket::where('u_ID', $client->u_ID)->select('t_ID', 't_category', 't_assignedTo', 't_title', 't_status', 't_priority', 't_datetime', 't_due', DB::raw('(CASE WHEN t_due < NOW() THEN 1 ELSE 0 END) AS breaches'))
        ->get();
        $ticketCount = Ticket::where('u_ID', $client->u_ID)->get()->count();

        $notifCount = Notification::where('user_id', $client->u_ID)->where('read_at', null)->get()->count();
        return view('ticket_list',["notif"=>$notifCount,"client"=>$user_info,"ticket"=>$ticket_info, "tixCount"=>$ticketCount]);
    }
    public function clientViewTickets(){

        $client = Auth::user();
        if($client == null){
            Alert::warning('Warning!!!', 'You are not authorized!');
            return redirect()->route('loginPage');
        }
        $allUser = Reporter::get()->pluck('u_name');
        // $allUser = [];
        // foreach($allUsers as $user){
        //     $allUser[] = $user;
        // }


        $user_info =Reporter::where('u_ID', $client->u_ID)->get();
        $mytickets = Ticket::where('u_ID', $client->u_ID)->get()->sortByDesc('t_datetime');
        $allUsers = Reporter::all();
        $allStaff = Reporter::wherenotIn('u_role', ['Client'])->get();

        $currentDateTime = now();
        $notifCount = Notification::where('user_id', $client->u_ID)->where('read_at', null)->get()->count();

        if($client->u_role == "Admin"){
            return view('admin_personal_view',["notif"=>$notifCount,"tickets"=>$mytickets, "users"=>$allUsers, "client"=>$user_info, 'staff'=>$allStaff, 'curDatetime'=>$currentDateTime, 'allUser'=>$allUser]);

        }elseif($client->u_role == "Staff"){
            return view('staff_personal_view',["notif"=>$notifCount,"tickets"=>$mytickets, "users"=>$allUsers, "client"=>$user_info, 'staff'=>$allStaff, 'curDatetime'=>$currentDateTime, 'allUser'=>$allUser]);

        }else{
            return view('client_view_ticket',["notif"=>$notifCount,"tickets"=>$mytickets, "users"=>$allUsers, "client"=>$user_info, 'staff'=>$allStaff, 'curDatetime'=>$currentDateTime, 'allUser'=>$allUser]);

        }


    }

    public function clientOpenTicket($t_id){

        $client = Auth::user();
        if($client == null){
            Alert::warning('Warning!!!', 'You are not authorized!');
            return redirect()->route('loginPage');


        }
        $user_info = Reporter::where('u_ID', $client->u_ID)->get();
        $tickets = Ticket::where('t_id', $t_id)->get()->first();
        $client = Reporter::where('u_ID', $tickets->u_ID)->get()->first();
        $status = StatusHistory::where('t_id', $tickets->t_ID)->get();
        $staff = Reporter::where('u_role', "Staff")->get();

        $allUsers = Reporter::all();
        $notifCount = Notification::where('user_id', $client->u_ID)->where('read_at', null)->get()->count();
        $last = StatusHistory::where('t_id', $tickets->t_ID)->get()->last();
        if($client->u_role =="Admin"){
            return view('admin_personal_tickets', ['last'=>$last,'notif'=>$notifCount,'allUser'=>$allUsers,'tickets' => $tickets, "client"=>$user_info, 'userinfo'=>$client, 'status'=>$status, 'staffs'=>$staff]);

        }elseif($client->u_role =="Staff"){
            return view('staff_personal_tickets', ['last'=>$last,'notif'=>$notifCount,'allUser'=>$allUsers, 'tickets' => $tickets, "client"=>$user_info, 'userinfo'=>$client, 'status'=>$status, 'staffs'=>$staff]);

        }else{
            return view('client_open_ticket', ['last'=>$last,'notif'=>$notifCount,'allUser'=>$allUsers, 'tickets' => $tickets, "client"=>$user_info, 'userinfo'=>$client, 'status'=>$status, 'staffs'=>$staff]);

        }

       }

       public function viewHelp(){
        $client = Auth::user();
        if($client == null){
            Alert::warning('Warning!!!', 'You are not authorized!');
            return redirect()->route('loginPage');


        }
        $user_info = Reporter::where('u_ID', $client->u_ID)->get();
        $notifCount = Notification::where('user_id', $client->u_ID)->where('read_at', null)->get()->count();
        return view('help', ['notif'=>$notifCount, "client"=>$user_info, 'userinfo'=>$client]);

       }


}
