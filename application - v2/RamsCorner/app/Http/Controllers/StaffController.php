<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Requests;
use App\Models\StatusHistory;
use App\Models\Reporter;
use App\Models\Ticket;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use App\Models\Notification;

class StaffController extends Controller
{
    public function staffHome()
    {
        $staff = Auth::user();
        if($staff == null){
            Alert::warning('Warning!!!', 'You are not authorized!');
            return redirect()->route('loginPage');


        }
        if($staff->u_role != "Staff"){
            Alert::warning('Warning!!!', 'Unauthorized Access!');
            if($staff->u_role == "Admin"){
                return redirect()->route('adminHome');
            }else{
                return redirect()->route('clientHome');
            }
        }
        $allUser = Reporter::get()->pluck('u_name');
        // dd($client);
        //'client_home' -> blade
        //["client"=>$client] -> variable na ipapasa from controller to view
        $user_info =Reporter::where('u_ID', $staff->u_ID)->get();



        $userCount = Reporter::all()->count();
        $staffCount = Reporter::whereNotIn('u_role', ['Client'])->get()->count();

        //add to staff
        $mostViewTicket = DB::table('tickets')->orderBy('t_views', 'desc')->get();
        $mostViewKBS = DB::table('k_b_s')->orderBy('kb_watch', 'desc')->where('kb_approved',1)->get();


        $mostViewTixs = $mostViewTicket->first();
        $mostViewKbs = $mostViewKBS->count();

        if($mostViewTixs != null){
                if($mostViewTixs->t_views == 0){
                    $mostViewTix = "--";
                    $views = 0;
                }else{
                    $mostViewTixss = DB::table('tickets')
                                        ->orderBy('t_views', 'desc')
                                        ->get()
                                        ->first();
                    $mostViewTix = $mostViewTixss->t_ID;
                    $views = $mostViewTixss->t_views;
                }
        }else{
            $mostViewTix = 0;
            $views = 0;
        }


        $ticketIds = Ticket::get()->all();


        $escalatedTickets = StatusHistory::whereIn('t_ID', $ticketIds)
        ->where('sh_status', 'ESCALATED')
        ->get()
        ->groupBy('t_ID')->count();
        $escalated = $escalatedTickets;


        if($mostViewKbs == 0 || $mostViewKB = DB::table('k_b_s')->orderBy('kb_watch', 'desc')
        ->where('kb_approved',1)->get()->first()->kb_watch == 0 ){
            $mostViewKB = "--";
            $watch = 0;
        }else{
            $mostViewKBss = DB::table('k_b_s')->orderBy('kb_watch', 'desc')
            ->where('kb_approved',1)->get()->first();
            $mostViewKB = $mostViewKBss->kb_ID;
            $watch = $mostViewKBss->kb_watch;
        }
        //

            $all = Ticket::all()->count();
            $new = Ticket::where('t_status', 'NEW')->get()->count();
            $opened = Ticket::where('t_status', 'OPENED')->get()->count();
            $pending = Ticket::where('t_status', 'PENDING')->get()->count();
            $ongoing = Ticket::where('t_status', 'ONGOING')->get()->count();
            $resolved = Ticket::where('t_status', 'RESOLVED')->get()->count();
            $closed = Ticket::where('t_status', 'CLOSED')->get()->count();
            $reopened = Ticket::where('t_status', 'REOPENED')->get()->count();
            $rejected = Ticket::where('t_status', 'REJECTED')->get()->count();
            $cancelled = Ticket::where('t_status', 'CANCELLED')->get()->count();


            $data =  DB::table('tickets')->select('t_status', DB::raw('count(*) as total'))->groupBy('t_status')->get();
            $assigned =  DB::table('tickets')->select('t_assignedTo', DB::raw('count(*) as total'))->groupBy('t_assignedTo')->get();
            $priority =  DB::table('tickets')->select('t_priority', DB::raw('count(*) as total'))->groupBy('t_priority')->get();

        //daily
            $tickets = DB::table('tickets')
            ->select(DB::raw('DATE(t_datetime) as date'), DB::raw('COUNT(*) as number'))
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->toArray();
        //weekly
            $tickets_weekly = DB::table('tickets')
            ->select(DB::raw('WEEK(t_datetime) as week'), DB::raw('COUNT(*) as number'))
            ->groupBy('week')
            ->orderBy('week')
            ->get();
        //monthly
            $tickets_monthly = DB::table('tickets')
           ->select(DB::raw('DATE_FORMAT(t_datetime, "%M") as month'), DB::raw('COUNT(*) as total'))
           ->groupBy('month')
           ->orderBy('month')
           ->get();
        //yearly
           $tickets_yearly = DB::table('tickets')
           ->select(DB::raw('YEAR(t_datetime) as year'), DB::raw('COUNT(*) as total'))
           ->groupBy('year')
           ->orderBy('year')
           ->get();

           $bri = DB::table('tickets')
            ->where('t_due', '<', Carbon::now())
            ->where('t_status', '<>', 'resolved')
            ->where('t_status', '<>', 'rejected')
            ->where('t_status', '<>', 'closed')
            ->where('t_status', '<>', 'cancelled')
            ->get();

            if($bri->count() ==0){
                // dd('No Breach');
            }else{
                foreach($bri as $breach){
                    // dd(' Breach');
                }
            }

            $totalCount = Ticket::where('t_assignedTo', $staff->u_name)->get()->count();
            $statusCounts = [
                'NEW'=>0,
                'OPENED' => 0,
                'PENDING' => 0,
                'ONGOING'=>0,
                'RESOLVED'=>0,
                'CLOSED' => 0,
                'CANCELLED'=>0,
                'REJECTED'=>0,
                'REOPENED'=>0,
                'ESCALATED'=>0
            ];

            $ticketss = Ticket::where('t_assignedTo', $staff->u_name)->select('t_status')->get();
            foreach ($ticketss as $ticketsss) {
                $statusCounts[$ticketsss->t_status]++;
            }

            $ticketData = [
                'user' => $staff->u_name,
                'statusCounts' => $statusCounts,
                'totalCount' => $totalCount,
            ];

            $ticketssss = Ticket::select('t_status', 't_due')
            ->get()
            ->map(function ($ticketsssss) {
                $dueDate = Carbon::parse($ticketsssss->t_due);
                $now = Carbon::now();
                $isOverdue = $dueDate->isPast();
                $ticketsssss->breaches = $isOverdue ? ($now->diffInMinutes($dueDate) > 0 ? true : false) : false;
                return $ticketsssss;
            });

            $ticketsssss = $ticketssss->where('breaches', true)->count();



            $notifCount = Notification::where('user_id', $staff->u_ID)->where('read_at', null)->get()->count();

        return view('staff_home',["staff"=>$user_info,
                                    'notif'=>$notifCount,
                                    'allUser'=>$allUser,
                                    'all'=>$all,
                                    'new'=>$new,
                                    'opened'=>$opened,
                                    'pending'=>$pending,
                                    'ongoing'=>$ongoing,
                                    'resolved'=>$resolved,
                                    'closed'=>$closed,
                                    'reopened'=>$reopened,
                                    'rejected'=>$rejected,
                                    'cancelled'=>$cancelled,
                                    'data'=> $data,
                                    'assign'=>$assigned,
                                    'priority' =>$priority,
                                    'tickets'=>$tickets,
                                    'weekly'=>$tickets_weekly,
                                    'monthly'=>$tickets_monthly,
                                    'yearly' => $tickets_yearly,
                                    'userCount'=>$userCount,
                                    'staffCount'=>$staffCount,
                                    'mostViewTix'=>$mostViewTix,
                                    'views'=>$views,
                                    'mostViewKB'=>$mostViewKB,
                                    'watch'=>$watch,
                                    'ticketData'=>$ticketData,
                                    'escalated'=>$escalated,
                                    'overdue'=>$ticketsssss]);
    }

    public function staffViewAllTickets(){
        $staff = Auth::user();
        if($staff == null){
            Alert::warning('Warning!!!', 'You are not authorized!');
            return redirect()->route('loginPage');


        }
        $user_info =Reporter::where('u_ID', $staff->u_ID)->get();
        $allUsers = Reporter::all();
        $allStaff = Reporter::whereNotIn('u_role', ['Client'])->get();
        $assignedTickets =  Ticket::select('t_ID', 't_category', 't_assignedTo', 't_title', 't_status', 't_priority', 't_datetime', 't_due', DB::raw('(CASE WHEN t_due < NOW() THEN 1 ELSE 0 END) AS breaches'))
        ->get()->sortByDesc('t_datetime');

        $ticketssss = Ticket::select('t_status', 't_due')
        ->get()
        ->map(function ($ticketsssss) {
            $dueDate = Carbon::parse($ticketsssss->t_due);
            $now = Carbon::now();
            $isOverdue = $dueDate->isPast();
            $ticketsssss->breaches = $isOverdue ? ($now->diffInMinutes($dueDate) > 0 ? true : false) : false;
            return $ticketsssss;
        });

        $ticketsssss = $ticketssss->where('breaches', true)->count();

        $notifCount = Notification::where('user_id', $staff->u_ID)->where('read_at', null)->get()->count();
        $currentDateTime = now();
            return view('staff_view_ticket',['notif'=>$notifCount,'ticketsss'=>$ticketssss,"tickets"=>$assignedTickets, "users"=>$allUsers, "staff"=>$user_info, 'allStaff'=>$allStaff, 'curDatetime'=>$currentDateTime]);



    }



    public function staffOpenTickets($t_id){

        $staffss = Auth::user();
        if($staffss == null){
            Alert::warning('Warning!!!', 'You are not authorized!');
            return redirect()->route('loginPage');


        }
        $user_info = Reporter::where('u_ID', $staffss->u_ID)->get();
        $tickets = Ticket::where('t_id', $t_id)->get()->first();
        $client = Reporter::where('u_ID', $tickets->u_ID)->get()->first();
        $status = StatusHistory::where('t_id', $tickets->t_ID)->get();

        $staff = Reporter::whereNotIn('u_role', ['Client'])->get();


        // if($tickets->t_status == "NEW"){


        //     StatusHistory::create( [
        //         "t_ID"=>$tickets->t_ID,
        //         "sh_Status" => 'OPENED',
        //         "sh_doneBy" => $staffss->u_name

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

        $notifCount = Notification::where('user_id', $staffss->u_ID)->where('read_at', null)->get()->count();
        $notification = Notification::where('user_id', $staffss->u_ID)->where('ticket_id', $t_id)->get()->first();


    if($notification->read_at == null){
        $notification->read_at = now();
        $notification->save();
    }
    $last = StatusHistory::where('t_id', $tickets->t_ID)->get()->last();

        return view('staff_open_ticket', ['last'=>$last,'notif'=>$notifCount,'tickets' => $tickets, "staff"=>$user_info, 'client'=>$client, 'status'=>$status, 'staffs'=>$staff]);
    }


}
