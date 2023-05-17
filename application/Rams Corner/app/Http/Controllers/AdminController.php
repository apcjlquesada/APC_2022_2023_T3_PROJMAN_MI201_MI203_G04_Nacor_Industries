<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Requests;
use App\Models\StatusHistory;
use App\Models\User;
use App\Models\Ticket;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\View\View\share;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function adminHome()
    {

        $admin = Auth::user();
        if($admin == null){
            Alert::warning('Warning!!!', 'You are not authorized!');
            return redirect()->route('loginPage');


        }

        if($admin->u_role != "Admin"){
            Alert::warning('Warning!!!', 'Unauthorized Access!');
            if($admin->u_role == "Staff"){
                // return redirect()->route('staffHome');
            }else{
                return redirect()->route('clientHome');
            }
        }
        // dd($client);
        //'client_home' -> blade
        //["client"=>$client] -> variable na ipapasa from controller to view
        $user_info =User::where('u_ID', $admin->u_ID)->get();

        $allUser = User::get()->pluck('u_name');
        $userCount = User::all()->count();
        $staffCount = User::whereNotIn('u_role', ['Client'])->get()->count();

        //add to staff
        $mostViewTicket = DB::table('tickets')->orderBy('t_views', 'desc')->get();
        $mostViewKBS = DB::table('k_b_s')->orderBy('kb_watch', 'desc')->where('kb_approved',1)->get();


        $mostViewTixs = $mostViewTicket->count();
        $mostViewKbs = $mostViewKBS->count();

        if($mostViewTixs == 0){
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




            $totalCount = Ticket::where('t_assignedTo', $admin->u_name)->get()->count();
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

            $ticketss = Ticket::where('t_assignedTo', $admin->u_name)->select('t_status')->get();
            foreach ($ticketss as $ticketsss) {
                $statusCounts[$ticketsss->t_status]++;
            }

            $ticketData = [
                'user' => $admin->u_name,
                'statusCounts' => $statusCounts,
                'totalCount' => $totalCount,
            ];


        return view('admin_home',[
            "admin"=>$user_info,
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
            'allUser'=>$allUser,
            'userCount'=>$userCount,
            'staffCount'=>$staffCount,
            'mostViewTix'=>$mostViewTix,
            'views'=>$mostViewTixs,
            'mostViewKB'=>$mostViewKB,
            'watch'=>$watch,
            'ticketData'=>$ticketData


        ], );
    }

    public function viewAllTickets(){
        $admin = Auth::user();
        if($admin == null){
            Alert::warning('Warning!!!', 'You are not authorized!');
            return redirect()->route('loginPage');


        }
        $user_info =User::where('u_ID', $admin->u_ID)->get();
        $alltickets = Ticket::all();
        $allUsers = User::all();
        $allStaff = User::where('u_role', 'Staff')->get();

        $currentDateTime = now();

        return view('admin_view_ticket',["tickets"=>$alltickets, "users"=>$allUsers, "admin"=>$user_info, 'staff'=>$allStaff, 'curDatetime'=>$currentDateTime]);

    }

    public function openTicket($t_id){

        $admin = Auth::user();
        if($admin == null){
            Alert::warning('Warning!!!', 'You are not authorized!');
            return redirect()->route('loginPage');


        }
        $user_info = User::where('u_ID', $admin->u_ID)->get();
        $tickets = Ticket::where('t_id', $t_id)->get()->first();
        $client = User::where('u_ID', $tickets->u_ID)->get()->first();
        $status = StatusHistory::where('t_id', $tickets->t_ID)->get();
        $staff = User::whereNotIn('u_role', ['Client'])->get();


        if($tickets->t_status == "NEW"){


        StatusHistory::create( [
            "t_ID"=>$tickets->t_ID,
            "sh_Status" => 'OPENED',
            "sh_doneBy" => $admin->u_name

        ]);




        if($tickets->t_priority == 1){
            $dues = now()->addHours(4);
        }else if($tickets->t_priority == 2){
            $dues = now()->addHours(72);
        }else{
            $dues = now()->addHours(168);
        }

        $tickets->t_status = 'OPENED';
        $tickets->t_due = $dues;
        $tickets->save();
    }


    $tickets->t_views = ($tickets->t_views)+1;
    $tickets->save();



        if($admin->u_role == "Admin"){
            return view('admin_open_ticket', ['tickets' => $tickets, "admin"=>$user_info, 'client'=>$client, 'status'=>$status, 'staffs'=>$staff]);
        }else{
            return view('staff_open_ticket', ['tickets' => $tickets, "staff"=>$user_info, 'client'=>$client, 'status'=>$status, 'staffs'=>$staff]);
        }
       }




}
