<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Reporter;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\StatusHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Models\Notification;

class ReportController extends Controller
{
    public function generateReport()
    {
        $user = Auth::user();

        if($user == null){
            Alert::warning('Warning!!!', 'You are not authorized!');
            return redirect()->route('loginPage');
        }

        //populate years

        $years = [];
        $currentYear = Carbon::now()->year;

            for ($i = 0; $i < 20; $i++) {
                $year = $currentYear + $i;
                $years[$year] = $year;
            }

        //populate all staff

        $allStaff = Reporter::whereNotIn('u_role', ['Client'])->get();

        //populate tickets

        $tickets = StatusHistory::where('sh_status', 'OPENED')->get();



        $reportData = DB::table('tickets')
        ->select('tickets.t_ID', 'tickets.t_title','tickets.t_datetime', 'tickets.t_status','tickets.t_assignedTo', 'status_histories.sh_status',
        'status_histories.sh_datetime as opened_date')
        ->join('status_histories', 'tickets.t_ID', '=', 'status_histories.t_ID')
        ->join(DB::raw('(SELECT t_ID, MAX(t_ID) as max_id FROM status_histories GROUP BY t_ID) latest_statuses'), function ($join) {
            $join->on('status_histories.t_ID', '=', 'latest_statuses.max_id');
        })
        ->where('latest_statuses.max_id', '=', DB::raw('status_histories.t_ID'))
        ->where('status_histories.sh_status', '=', 'OPENED')
        ->get();





        $user_info = Reporter::where('u_ID', $user->u_ID)->get();
        $month = 2;

        // Retrieve resolved tickets for the selected month from the database
        $monthly = StatusHistory::where('sh_status','RESOLVED')
                        ->whereMonth('sh_datetime', $month)
                        ->whereNotNull('sh_datetime')
                        ->get();

        // dd($monthly);
        $filters = [];

        $notifCount = Notification::where('user_id', $user->u_ID)->where('read_at', null)->get()->count();
        if($user->u_role == "Admin"){
            return view('admin_reports', ['notif'=>$notifCount,'monthly'=>$monthly,
            'admin'=>$user_info,
            'years'=>$years,
            'allStaff'=>$allStaff,
            'reportData'=>$reportData,
            'display'=>'none',
            'filters'=>$filters,
            'records'=> 0

            ]);
        }elseif($user->u_role == "Staff"){
            return view('staff_reports', ['notif'=>$notifCount,'monthly'=>$monthly,
            'staff'=>$user_info,
            'years'=>$years,
            'allStaff'=>$allStaff,
            'reportData'=>$reportData,
            'display'=>'none',
            'filters'=>$filters,
            'records'=> 0

            ]);
        }else{
            Alert::warning('WARNING', 'Unathorized access!');
            return back();
        }

    }

    public function generateReportbyFilter($reportdata, $request)
    {
        $user = Auth::user();

        if($user == null){
            Alert::warning('Warning!!!', 'You are not authorized!');
            return redirect()->route('loginPage');
        }

        //populate years

        $years = [];
        $currentYear = Carbon::now()->year;

            for ($i = 0; $i < 20; $i++) {
                $year = $currentYear + $i;
                $years[$year] = $year;
            }
        //populate all staff
        $allStaff = Reporter::whereNotIn('u_role', ['Client'])->get();
        //populate tickets

        //users
        $user = Auth::user();
        $user_info = Reporter::where('u_ID', $user->u_ID)->get();

        // $month = 2;
        // // Retrieve resolved tickets for the selected month from the database
        // $monthly = StatusHistory::where('sh_status','RESOLVED')
        //                 ->whereMonth('sh_datetime', $month)
        //                 ->whereNotNull('sh_datetime')
        //                 ->get();

        // dd($monthly);

        $records = $reportdata->count();


        $notifCount = Notification::where('user_id', $user->u_ID)->where('read_at', null)->get()->count();
        if($user->u_role == "Admin"){
            return view('admin_reports', ['notif'=>$notifCount,'admin'=>$user_info,
            'years'=>$years,
            'allStaff'=>$allStaff,
            'reportData'=>$reportdata,
            'display'=>'block',
            'records'=>$records,
            'filters'=>$request

            ]);
        }elseif($user->u_role == "Staff"){
            return view('staff_reports', ['notif'=>$notifCount,'staff'=>$user_info,
            'years'=>$years,
            'allStaff'=>$allStaff,
            'reportData'=>$reportdata,
            'display'=>'block',
            'records'=>$records,
            'filters'=>$request

            ]);
        }else{
            Alert::warning('WARNING', 'Unathorized access!');
            return back();
        }

    }







    public function generate(Request $request){
        $user = Auth::user();

        if($user == null){
            Alert::warning('Warning!!!', 'You are not authorized!');
            return redirect()->route('loginPage');
        }

        $user_info = Reporter::where('u_ID', $user->u_ID)->get();
        if($request->dateRange == ""){

            Alert::warning('Incomplete Argument', 'Select a Date Range/Date');
            return back();
        }else{

            if($request->dateRange == "Day"){

                $day = Carbon::parse($request->dayDate);
                if($request->dayDate == null){
                    Alert::warning('Incomplete Argument', 'Select a Date Range/Date');
                    return back();
                }else{
                    if($request->priority == "All" && $request->assigned == "All"){
                        $reportData = DB::table('tickets')
                        ->select('tickets.t_ID', 'tickets.t_title','tickets.t_datetime', 'tickets.t_status','tickets.t_assignedTo', 'status_histories.sh_status',
                        'status_histories.sh_datetime as opened_date')
                        ->join('status_histories', 'tickets.t_ID', '=', 'status_histories.t_ID')
                        ->join(DB::raw('(SELECT t_ID, MAX(t_ID) as max_id FROM status_histories GROUP BY t_ID) latest_statuses'), function ($join) {
                            $join->on('status_histories.t_ID', '=', 'latest_statuses.max_id');
                        })
                        ->where('latest_statuses.max_id', '=', DB::raw('status_histories.t_ID'))
                        ->where('status_histories.sh_status', '=', 'OPENED')
                        ->whereDate('tickets.t_datetime', '=', $day)
                        ->get();

                        return app()->call([$this,'generateReportByFilter'],['reportdata'=>$reportData, 'request'=>$request]);
                    }

                    if($request->priority != "All" && $request->assigned == "All"){
                        $reportData = DB::table('tickets')
                        ->select('tickets.t_ID', 'tickets.t_title','tickets.t_priority','tickets.t_datetime', 'tickets.t_status','tickets.t_assignedTo', 'status_histories.sh_status',
                        'status_histories.sh_datetime as opened_date')
                        ->join('status_histories', 'tickets.t_ID', '=', 'status_histories.t_ID')
                        ->join(DB::raw('(SELECT t_ID, MAX(t_ID) as max_id FROM status_histories GROUP BY t_ID) latest_statuses'), function ($join) {
                            $join->on('status_histories.t_ID', '=', 'latest_statuses.max_id');
                        })
                        ->where('latest_statuses.max_id', '=', DB::raw('status_histories.t_ID'))
                        ->where('status_histories.sh_status', '=', 'OPENED')
                        ->whereDate('tickets.t_datetime', '=', $day)
                        ->where('tickets.t_priority','=',$request->priority)
                        ->get();

                        return app()->call([$this,'generateReportByFilter'],['reportdata'=>$reportData, 'request'=>$request]);
                    }

                    if($request->priority != "All" && $request->assigned != "All"){
                        $reportData = DB::table('tickets')
                        ->select('tickets.t_ID', 'tickets.t_title','tickets.t_priority','tickets.t_datetime', 'tickets.t_status','tickets.t_assignedTo', 'status_histories.sh_status',
                        'status_histories.sh_datetime as opened_date')
                        ->join('status_histories', 'tickets.t_ID', '=', 'status_histories.t_ID')
                        ->join(DB::raw('(SELECT t_ID, MAX(t_ID) as max_id FROM status_histories GROUP BY t_ID) latest_statuses'), function ($join) {
                            $join->on('status_histories.t_ID', '=', 'latest_statuses.max_id');
                        })
                        ->where('latest_statuses.max_id', '=', DB::raw('status_histories.t_ID'))
                        ->where('status_histories.sh_status', '=', 'OPENED')
                        ->whereDate('tickets.t_datetime', '=', $day)
                        ->where('tickets.t_priority','=',$request->priority)
                        ->where('tickets.t_assignedTo','=',$request->assigned)
                        ->get();

                        return app()->call([$this,'generateReportByFilter'],['reportdata'=>$reportData, 'request'=>$request]);
                    }

                    if($request->priority == "All" && $request->assigned != "All"){
                        $reportData = DB::table('tickets')
                        ->select('tickets.t_ID', 'tickets.t_title','tickets.t_priority','tickets.t_datetime', 'tickets.t_status','tickets.t_assignedTo', 'status_histories.sh_status',
                        'status_histories.sh_datetime as opened_date')
                        ->join('status_histories', 'tickets.t_ID', '=', 'status_histories.t_ID')
                        ->join(DB::raw('(SELECT t_ID, MAX(t_ID) as max_id FROM status_histories GROUP BY t_ID) latest_statuses'), function ($join) {
                            $join->on('status_histories.t_ID', '=', 'latest_statuses.max_id');
                        })
                        ->where('latest_statuses.max_id', '=', DB::raw('status_histories.t_ID'))
                        ->where('status_histories.sh_status', '=', 'OPENED')
                        ->whereDate('tickets.t_datetime', '=', $day)
                        ->where('tickets.t_assignedTo','=',$request->assigned)
                        ->get();

                        return app()->call([$this,'generateReportByFilter'],['reportdata'=>$reportData, 'request'=>$request]);
                    }

                }










            }elseif($request->dateRange == "Week"){

                $year = $request->weekYearDate;
                $week = $request->weekDate;

                if($week == "" || $year == "" ){

                    Alert::warning('Incomplete Argument', 'Select a Date Range/Date');
                    return redirect()->route('generateReport');

                }else{

                    $startDate = Carbon::parse("{$year}-W".str_pad($week, 2, '0', STR_PAD_LEFT))->startOfWeek();
                    $endDate = Carbon::parse("{$year}-W".str_pad($week, 2, '0', STR_PAD_LEFT))->endOfWeek();

                    if($request->priority == "All" && $request->assigned == "All"){

                        $reportData = DB::table('tickets')
                        ->select('tickets.t_ID', 'tickets.t_title','tickets.t_datetime', 'tickets.t_status','tickets.t_assignedTo', 'status_histories.sh_status',
                        'status_histories.sh_datetime as opened_date')
                        ->join('status_histories', 'tickets.t_ID', '=', 'status_histories.t_ID')
                        ->join(DB::raw('(SELECT t_ID, MAX(t_ID) as max_id FROM status_histories GROUP BY t_ID) latest_statuses'), function ($join) {
                            $join->on('status_histories.t_ID', '=', 'latest_statuses.max_id');
                        })
                        ->where('latest_statuses.max_id', '=', DB::raw('status_histories.t_ID'))
                        ->where('status_histories.sh_status', '=', 'OPENED')
                        ->whereBetween('tickets.t_datetime', [$startDate, $endDate])
                        ->get();

                        return app()->call([$this,'generateReportByFilter'],['reportdata'=>$reportData, 'request'=>$request]);
                    }

                    if($request->priority != "All" && $request->assigned != "All"){

                        $reportData = DB::table('tickets')
                        ->select('tickets.t_ID', 'tickets.t_title','tickets.t_priority','tickets.t_datetime', 'tickets.t_status','tickets.t_assignedTo', 'status_histories.sh_status',
                        'status_histories.sh_datetime as opened_date')
                        ->join('status_histories', 'tickets.t_ID', '=', 'status_histories.t_ID')
                        ->join(DB::raw('(SELECT t_ID, MAX(t_ID) as max_id FROM status_histories GROUP BY t_ID) latest_statuses'), function ($join) {
                            $join->on('status_histories.t_ID', '=', 'latest_statuses.max_id');
                        })
                        ->where('latest_statuses.max_id', '=', DB::raw('status_histories.t_ID'))
                        ->where('status_histories.sh_status', '=', 'OPENED')
                        ->whereBetween('tickets.t_datetime', [$startDate, $endDate])
                        ->where('tickets.t_priority','=',$request->priority)
                        ->where('tickets.t_assignedTo','=',$request->assigned)
                        ->get();

                        return app()->call([$this,'generateReportByFilter'],['reportdata'=>$reportData, 'request'=>$request]);
                    }

                    if($request->priority != "All" && $request->assigned == "All"){

                        $reportData = DB::table('tickets')
                        ->select('tickets.t_ID', 'tickets.t_title','tickets.t_priority','tickets.t_datetime', 'tickets.t_status','tickets.t_assignedTo', 'status_histories.sh_status',
                        'status_histories.sh_datetime as opened_date')
                        ->join('status_histories', 'tickets.t_ID', '=', 'status_histories.t_ID')
                        ->join(DB::raw('(SELECT t_ID, MAX(t_ID) as max_id FROM status_histories GROUP BY t_ID) latest_statuses'), function ($join) {
                            $join->on('status_histories.t_ID', '=', 'latest_statuses.max_id');
                        })
                        ->where('latest_statuses.max_id', '=', DB::raw('status_histories.t_ID'))
                        ->where('status_histories.sh_status', '=', 'OPENED')
                        ->whereBetween('tickets.t_datetime', [$startDate, $endDate])
                        ->where('tickets.t_priority','=',$request->priority)
                        ->get();

                        return app()->call([$this,'generateReportByFilter'],['reportdata'=>$reportData, 'request'=>$request]);
                    }

                    if($request->priority == "All" && $request->assigned != "All"){

                        $reportData = DB::table('tickets')
                        ->select('tickets.t_ID', 'tickets.t_title','tickets.t_priority','tickets.t_datetime', 'tickets.t_status','tickets.t_assignedTo', 'status_histories.sh_status',
                        'status_histories.sh_datetime as opened_date')
                        ->join('status_histories', 'tickets.t_ID', '=', 'status_histories.t_ID')
                        ->join(DB::raw('(SELECT t_ID, MAX(t_ID) as max_id FROM status_histories GROUP BY t_ID) latest_statuses'), function ($join) {
                            $join->on('status_histories.t_ID', '=', 'latest_statuses.max_id');
                        })
                        ->where('latest_statuses.max_id', '=', DB::raw('status_histories.t_ID'))
                        ->where('status_histories.sh_status', '=', 'OPENED')
                        ->whereBetween('tickets.t_datetime', [$startDate, $endDate])
                        ->where('tickets.t_assignedTo','=',$request->assigned)
                        ->get();

                        return app()->call([$this,'generateReportByFilter'],['reportdata'=>$reportData, 'request'=>$request]);
                    }






                }










            }elseif($request->dateRange == "Month"){

                if($request->monthDate == "" || $request->monthYearDate == "" ){
                    Alert::warning('Incomplete Argument', 'Select a Date Range/Date');
                    return back();
                }else{

                    $month = $request->monthDate;
                    $year = $request->monthYearDate;


                    if($request->priority == "All" && $request->assigned == "All"){
                        $reportData = DB::table('tickets')
                        ->select('tickets.t_ID', 'tickets.t_title','tickets.t_datetime', 'tickets.t_status','tickets.t_assignedTo', 'status_histories.sh_status',
                        'status_histories.sh_datetime as opened_date')
                        ->join('status_histories', 'tickets.t_ID', '=', 'status_histories.t_ID')
                        ->join(DB::raw('(SELECT t_ID, MAX(t_ID) as max_id FROM status_histories GROUP BY t_ID) latest_statuses'), function ($join) {
                            $join->on('status_histories.t_ID', '=', 'latest_statuses.max_id');
                        })
                        ->where('latest_statuses.max_id', '=', DB::raw('status_histories.t_ID'))
                        ->where('status_histories.sh_status', '=', 'OPENED')
                        ->whereMonth('tickets.t_datetime', '=', $month)
                        ->whereYear('tickets.t_datetime', '=', $year)
                        ->get();

                        return app()->call([$this,'generateReportByFilter'],['reportdata'=>$reportData, 'request'=>$request]);
                    }

                    if($request->priority != "All" && $request->assigned != "All"){
                        $reportData = DB::table('tickets')
                        ->select('tickets.t_ID', 'tickets.t_title','tickets.t_datetime', 'tickets.t_priority', 'tickets.t_status','tickets.t_assignedTo', 'status_histories.sh_status',
                        'status_histories.sh_datetime as opened_date')
                        ->join('status_histories', 'tickets.t_ID', '=', 'status_histories.t_ID')
                        ->join(DB::raw('(SELECT t_ID, MAX(t_ID) as max_id FROM status_histories GROUP BY t_ID) latest_statuses'), function ($join) {
                            $join->on('status_histories.t_ID', '=', 'latest_statuses.max_id');
                        })
                        ->where('latest_statuses.max_id', '=', DB::raw('status_histories.t_ID'))
                        ->where('status_histories.sh_status', '=', 'OPENED')
                        ->whereMonth('tickets.t_datetime', '=', $month)
                        ->whereYear('tickets.t_datetime', '=', $year)
                        ->where('tickets.t_priority','=',$request->priority)
                        ->where('tickets.t_assignedTo','=',$request->assigned)
                        ->get();

                        return app()->call([$this,'generateReportByFilter'],['reportdata'=>$reportData, 'request'=>$request]);
                    }

                    if($request->priority != "All" && $request->assigned == "All"){
                        $reportData = DB::table('tickets')
                        ->select('tickets.t_ID', 'tickets.t_title','tickets.t_datetime', 'tickets.t_priority', 'tickets.t_status','tickets.t_assignedTo', 'status_histories.sh_status',
                        'status_histories.sh_datetime as opened_date')
                        ->join('status_histories', 'tickets.t_ID', '=', 'status_histories.t_ID')
                        ->join(DB::raw('(SELECT t_ID, MAX(t_ID) as max_id FROM status_histories GROUP BY t_ID) latest_statuses'), function ($join) {
                            $join->on('status_histories.t_ID', '=', 'latest_statuses.max_id');
                        })
                        ->where('latest_statuses.max_id', '=', DB::raw('status_histories.t_ID'))
                        ->where('status_histories.sh_status', '=', 'OPENED')
                        ->whereMonth('tickets.t_datetime', '=', $month)
                        ->whereYear('tickets.t_datetime', '=', $year)
                        ->where('tickets.t_priority','=',$request->priority)
                        ->get();

                        return app()->call([$this,'generateReportByFilter'],['reportdata'=>$reportData, 'request'=>$request]);
                    }

                    if($request->priority == "All" && $request->assigned != "All"){
                        $reportData = DB::table('tickets')
                        ->select('tickets.t_ID', 'tickets.t_title','tickets.t_datetime', 'tickets.t_priority', 'tickets.t_status','tickets.t_assignedTo', 'status_histories.sh_status',
                        'status_histories.sh_datetime as opened_date')
                        ->join('status_histories', 'tickets.t_ID', '=', 'status_histories.t_ID')
                        ->join(DB::raw('(SELECT t_ID, MAX(t_ID) as max_id FROM status_histories GROUP BY t_ID) latest_statuses'), function ($join) {
                            $join->on('status_histories.t_ID', '=', 'latest_statuses.max_id');
                        })
                        ->where('latest_statuses.max_id', '=', DB::raw('status_histories.t_ID'))
                        ->where('status_histories.sh_status', '=', 'OPENED')
                        ->whereMonth('tickets.t_datetime', '=', $month)
                        ->whereYear('tickets.t_datetime', '=', $year)
                        ->where('tickets.t_assignedTo','=',$request->assigned)
                        ->get();

                        return app()->call([$this,'generateReportByFilter'],['reportdata'=>$reportData, 'request'=>$request]);
                    }
                }



            }else{
                if($request->yearDate == "" ){

                    Alert::warning('Incomplete Argument', 'Select a Date Range/Date');
                    return back();
                }else{
                    $year = $request->yearDate;

                    if($request->priority == "All" && $request->assigned == "All"){
                        $reportData = DB::table('tickets')
                        ->select('tickets.t_ID', 'tickets.t_title','tickets.t_datetime', 'tickets.t_status','tickets.t_assignedTo', 'status_histories.sh_status',
                        'status_histories.sh_datetime as opened_date')
                        ->join('status_histories', 'tickets.t_ID', '=', 'status_histories.t_ID')
                        ->join(DB::raw('(SELECT t_ID, MAX(t_ID) as max_id FROM status_histories GROUP BY t_ID) latest_statuses'), function ($join) {
                            $join->on('status_histories.t_ID', '=', 'latest_statuses.max_id');
                        })
                        ->where('latest_statuses.max_id', '=', DB::raw('status_histories.t_ID'))
                        ->where('status_histories.sh_status', '=', 'OPENED')
                        ->whereYear('tickets.t_datetime', '=', $year)
                        ->get();

                        return app()->call([$this,'generateReportByFilter'],['reportdata'=>$reportData, 'request'=>$request]);
                    }

                    if($request->priority != "All" && $request->assigned != "All"){
                        $reportData = DB::table('tickets')
                        ->select('tickets.t_ID', 'tickets.t_title','tickets.t_datetime','tickets.t_priority', 'tickets.t_status','tickets.t_assignedTo', 'status_histories.sh_status',
                        'status_histories.sh_datetime as opened_date')
                        ->join('status_histories', 'tickets.t_ID', '=', 'status_histories.t_ID')
                        ->join(DB::raw('(SELECT t_ID, MAX(t_ID) as max_id FROM status_histories GROUP BY t_ID) latest_statuses'), function ($join) {
                            $join->on('status_histories.t_ID', '=', 'latest_statuses.max_id');
                        })
                        ->where('latest_statuses.max_id', '=', DB::raw('status_histories.t_ID'))
                        ->where('status_histories.sh_status', '=', 'OPENED')
                        ->whereYear('tickets.t_datetime', '=', $year)
                        ->where('tickets.t_priority','=',$request->priority)
                        ->where('tickets.t_assignedTo','=',$request->assigned)
                        ->get();

                        return app()->call([$this,'generateReportByFilter'],['reportdata'=>$reportData, 'request'=>$request]);
                    }

                    if($request->priority == "All" && $request->assigned != "All"){
                        $reportData = DB::table('tickets')
                        ->select('tickets.t_ID', 'tickets.t_title','tickets.t_datetime','tickets.t_priority', 'tickets.t_status','tickets.t_assignedTo', 'status_histories.sh_status',
                        'status_histories.sh_datetime as opened_date')
                        ->join('status_histories', 'tickets.t_ID', '=', 'status_histories.t_ID')
                        ->join(DB::raw('(SELECT t_ID, MAX(t_ID) as max_id FROM status_histories GROUP BY t_ID) latest_statuses'), function ($join) {
                            $join->on('status_histories.t_ID', '=', 'latest_statuses.max_id');
                        })
                        ->where('latest_statuses.max_id', '=', DB::raw('status_histories.t_ID'))
                        ->where('status_histories.sh_status', '=', 'OPENED')
                        ->whereYear('tickets.t_datetime', '=', $year)
                        ->where('tickets.t_assignedTo','=',$request->assigned)
                        ->get();

                        return app()->call([$this,'generateReportByFilter'],['reportdata'=>$reportData, 'request'=>$request]);
                    }

                    if($request->priority != "All" && $request->assigned == "All"){
                        $reportData = DB::table('tickets')
                        ->select('tickets.t_ID', 'tickets.t_title','tickets.t_datetime','tickets.t_priority', 'tickets.t_status','tickets.t_assignedTo', 'status_histories.sh_status',
                        'status_histories.sh_datetime as opened_date')
                        ->join('status_histories', 'tickets.t_ID', '=', 'status_histories.t_ID')
                        ->join(DB::raw('(SELECT t_ID, MAX(t_ID) as max_id FROM status_histories GROUP BY t_ID) latest_statuses'), function ($join) {
                            $join->on('status_histories.t_ID', '=', 'latest_statuses.max_id');
                        })
                        ->where('latest_statuses.max_id', '=', DB::raw('status_histories.t_ID'))
                        ->where('status_histories.sh_status', '=', 'OPENED')
                        ->whereYear('tickets.t_datetime', '=', $year)
                        ->where('tickets.t_priority','=',$request->priority)
                        ->get();

                        return app()->call([$this,'generateReportByFilter'],['reportdata'=>$reportData, 'request'=>$request]);
                    }
                }


            }
        }
    }

    public function summaryReport(){
        //average tickets
        //daily for past 30 days
        // $user = Auth::user();

        // if($user == null){
        //     Alert::warning('Warning!!!', 'You are not authorized!');
        //     return redirect()->route('loginPage');
        // }

        // $user_info = Reporter::where('u_ID', $user->u_ID)->get();

            $avgDailyTickets = DB::table('tickets')
            ->select(DB::raw('AVG(tickets_per_day) as avg_daily_tickets'))
            ->from(function ($query) {
                $query->select(DB::raw('COUNT(*) as tickets_per_day'))
                    ->from('tickets')
                    ->where('t_datetime', '>=', DB::raw('DATE_SUB(CURDATE(), INTERVAL 30 DAY)'))
                    ->groupBy(DB::raw('DATE(t_datetime)'));
            }, 'daily_counts')
            ->first()
            ->avg_daily_tickets;




            $avgWeeklyTickets = DB::table('tickets')
            ->select(DB::raw('AVG(tickets_per_week) as avg_weekly_tickets'))
            ->from(function ($query) {
                $query->select(DB::raw('COUNT(*) as tickets_per_week'))
                      ->from('tickets')
                      ->where('t_datetime', '>=', DB::raw('DATE_SUB(CURDATE(), INTERVAL 12 WEEK)'))
                      ->groupBy(DB::raw('YEAR(t_datetime), WEEK(t_datetime)'));
            }, 'weekly_counts')
            ->first()
            ->avg_weekly_tickets;


            $avgMonthlyTickets = DB::table('tickets')
            ->select(DB::raw('AVG(tickets_per_month) as avg_monthly_tickets'))
            ->from(function ($query) {
                $query->select(DB::raw('COUNT(*) as tickets_per_month'))
                      ->from('tickets')
                      ->where('t_datetime', '>=', DB::raw('DATE_SUB(CURDATE(), INTERVAL 12 MONTH)'))
                      ->groupBy(DB::raw('YEAR(t_datetime), MONTH(t_datetime)'));
            }, 'monthly_counts')
            ->first()
            ->avg_monthly_tickets;

            $avgYearlyTickets = DB::table('tickets')
                ->select(DB::raw('AVG(tickets_per_year) as avg_yearly_tickets'))
                ->from(function ($query) {
                    $query->select(DB::raw('COUNT(*) as tickets_per_year'))
                        ->from('tickets')
                        ->where('t_datetime', '>=', DB::raw('DATE_SUB(CURDATE(), INTERVAL 3 YEAR)'))
                        ->groupBy(DB::raw('YEAR(t_datetime)'));
                }, 'yearly_counts')
                ->first()
                ->avg_yearly_tickets;



                $all = Ticket::where('u_ID', 13)->get()->count();
                $new = Ticket::where('t_status', 'NEW')->where('u_ID', 13)->get()->count();
                $opened = Ticket::where('t_status', 'OPENED')->where('u_ID', 13)->get()->count();
                $pending = Ticket::where('t_status', 'PENDING')->where('u_ID', 13)->get()->count();
                $ongoing = Ticket::where('t_status', 'ONGOING')->where('u_ID', 13)->get()->count();
                $resolved = Ticket::where('t_status', 'RESOLVED')->where('u_ID', 13)->get()->count();
                $closed = Ticket::where('t_status', 'CLOSED')->where('u_ID', 13)->get()->count();
                $reopened = Ticket::where('t_status', 'REOPENED')->where('u_ID', 13)->get()->count();
                $rejected = Ticket::where('t_status', 'REJECTED')->where('u_ID', 13)->get()->count();
                $cancelled = Ticket::where('t_status', 'CANCELLED')->where('u_ID', 13)->get()->count();
                $escalated = Ticket::where('t_status', 'ESCALATED')->where('u_ID', 13)->get()->count();

                // dd($cancelled);
                // dd($avgDailyTickets.'Daily'.$avgWeeklyTickets.'Weekly'.$avgMonthlyTickets.'Monthly'.$avgYearlyTickets.' Yearly');




                $tickets = Ticket::select('t_status', 't_due')
                ->get()
                ->map(function ($ticket) {
                    $dueDate = Carbon::parse($ticket->t_due);
                    $now = Carbon::now();
                    $isOverdue = $dueDate->isPast();
                    $ticket->breaches = $isOverdue ? ($now->diffInMinutes($dueDate) > 0 ? true : false) : false;
                    return $ticket;
                });

                dd($tickets);


    }
}
