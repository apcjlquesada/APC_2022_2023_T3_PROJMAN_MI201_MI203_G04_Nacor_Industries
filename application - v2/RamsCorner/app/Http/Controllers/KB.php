<?php

namespace App\Http\Controllers;


use App\Models\k_b_s;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use App\Models\Reporter;
use App\Models\Notification;
class KB extends Controller


{
    public function admin_KB()
    {

        $admin = Auth::user();
        if($admin == null){
            Alert::warning('Warning!!!', 'You are not authorized!');
            return redirect()->route('loginPage');


        }

        if($admin->u_role != "Admin"){
            Alert::warning('Warning!!!', 'Unauthorized Access!');
            if($admin->u_role == "Staff"){
                return redirect()->route('staffHome');
            }else{
                return redirect()->route('clientHome');
            }
        }

        $user_info = Reporter::where('u_ID', $admin->u_ID)->get();
        $kb_info = k_b_s::get();


        $unapproved = k_b_s::where('kb_approved',0)->get();
        $unapproved_count = $unapproved->count();

        $approved = k_b_s::where('kb_approved',1)->get();
        $approved_count = $approved->count();

        $notifCount = Notification::where('user_id', $admin->u_ID)->where('read_at', null)->get()->count();

        return view('admin_KB',['notif'=>$notifCount,
                                'kb_info' => $kb_info,
                                'admin'=>$user_info,
                                'app_count'=>$approved_count,
                                'unapp_count'=>$unapproved_count,
                                'approved'=>$approved,
                                'unapproved'=>$unapproved] );
    }

    public function user_KB()
    {
        $client = Auth::user();
        if($client == null){
            Alert::warning('Warning!!!', 'You are not authorized!');
            return redirect()->route('loginPage');


        }


        if($client->u_role != "Client"){
            Alert::warning('Warning!!!', 'Unauthorized Access!');
            if($client->u_role == "Staff"){
                return redirect()->route('staffHome');
            }else{
                return redirect()->route('adminHome');
            }
        }
        $user_info = Reporter::where('u_ID', $client->u_ID)->get();
        $kb_info = k_b_s::where('kb_approved', 1)
                        ->where('kb_view', 1)
                        ->get();
        $notifCount = Notification::where('user_id', $client->u_ID)->where('read_at', null)->get()->count();
        return view('user_KB',['notif'=>$notifCount,'kb_info' => $kb_info, 'client'=>$user_info]);
    }

    public function staff_KB()
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
        $user_info = Reporter::where('u_ID', $staff->u_ID)->get();
        $kb_info = k_b_s::where('kb_approved', 1)->get();
        $notifCount = Notification::where('user_id', $staff->u_ID)->where('read_at', null)->get()->count();
        return view('staff_KB',['notif'=>$notifCount,'kb_info' => $kb_info, 'staff'=>$user_info]);
    }

    public function createKB(Request $request)
    {

        $user = Auth::user();
        if($user == null){
            Alert::warning('Warning!!!', 'You are not authorized!');
            return redirect()->route('loginPage');


        }
        $user_info = Reporter::where('u_ID', $user->u_ID)->get();
        // dd($request);

        if($request->userview){
            $userview = 1;
        }else{
            $userview = 0;
        }

        if($request->account_info){
            $acctinfo = 1;
        }else{
            $acctinfo = 0;
        }


        k_b_s::create([
            'kb_title' => $request->title,
            'kb_content' => $request->content,
            'kb_resolution' => $request->resolution,
            'kb_category' => $request->category,
            'kb_modify' => $user->u_name,
            'kb_view'=>$userview


        ]);
        alert('KB Created', 'KB Succesfully added', 'Success')->showConfirmButton('Confirm', '#0d6efd');


        if($user->u_role == "Admin"){
            return redirect()->route('admin_KB');
        }else{
            return redirect()->route('staff_KB');
        }

    }

    public function adminkbView($id)
    {

        $kid = intval($id);

        $admin = Auth::user();
        if($admin == null){
            Alert::warning('Warning!!!', 'You are not authorized!');
            return redirect()->route('loginPage');
        }

        if($admin->u_role != "Admin"){
            Alert::warning('Warning!!!', 'Unauthorized Access!');
            if($admin->u_role == "Staff"){
                return redirect()->route('staffHome');
            }else{
                return redirect()->route('clientHome');
            }
        }

        $user_info = Reporter::where('u_ID', $admin->u_ID)->get();
        $kb_info = k_b_s::where('kb_ID', $kid)->get()->first();


        if($kb_info->kb_approved == 1){
            k_b_s::where('kb_ID', $kid)->update([
                    'kb_watch'=>($kb_info->kb_watch) + 1
                ]);


        }



        $notifCount = Notification::where('user_id', $admin->u_ID)->where('read_at', null)->get()->count();
        return view('adminkbView',['notif'=>$notifCount,'kb_info' => $kb_info, 'admin'=>$user_info]);
    }

    public function staffkbView($id)
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
        $user_info = Reporter::where('u_ID', $staff->u_ID)->get();
        $kb_info = k_b_s::where('kb_ID', $id)->get()->first();
        if($kb_info->kb_approved == 1){
            k_b_s::where('kb_ID', $id)->update([
                    'kb_watch'=>($kb_info->kb_watch) + 1
                ]);


        }
        $notifCount = Notification::where('user_id', $staff->u_ID)->where('read_at', null)->get()->count();
        return view('staffkbView',['notif'=>$notifCount,'kb_info' => $kb_info, 'staff'=>$user_info]);
    }

    public function userkbView($id)
    {
        $client = Auth::user();
        if($client == null){
            Alert::warning('Warning!!!', 'You are not authorized!');
            return redirect()->route('loginPage');


        }

        if($client->u_role != "Client"){
            Alert::warning('Warning!!!', 'Unauthorized Access!');
            if($client->u_role == "Staff"){
                return redirect()->route('staffHome');
            }else{
                return redirect()->route('adminHome');
            }
        }
        $user_info = Reporter::where('u_ID', $client->u_ID)->get();
        $kb_info = k_b_s::where('kb_ID', $id)->get()->first();
        if($kb_info->kb_approved == 1){
            k_b_s::where('kb_ID', $id)->update([
                    'kb_watch'=>($kb_info->kb_watch) + 1
                ]);


        }
        $notifCount = Notification::where('user_id', $client->u_ID)->where('read_at', null)->get()->count();
        return view('userkbView',['notif'=>$notifCount,'kb_info' => $kb_info, 'client'=>$user_info]);
    }

    public function updateKB(Request $request)
    {
        $user = Auth::user();
        if($user == null){
            Alert::warning('Warning!!!', 'You are not authorized!');
            return redirect()->route('loginPage');


        }
        $user_info = Reporter::where('u_ID', $user->u_ID)->get();

        $approval = k_b_s::where('kb_ID', $request->id)->get()->first();
        if($approval->kb_approved == 0){
            k_b_s::where('kb_ID',$request->id)->update(
                [
                    'kb_title' => $request->title,
                    'kb_content' => $request->content,
                    'kb_resolution' => $request->resolution,
                    'kb_category' => $request->category,
                    'kb_modify' => $user->u_name,
                    'kb_approved'=> 1
                ]

                );
        }else{
            k_b_s::where('kb_ID',$request->id)->update(
                [
                    'kb_title' => $request->title,
                    'kb_content' => $request->content,
                    'kb_resolution' => $request->resolution,
                    'kb_category' => $request->category,
                    'kb_modify' => $user->u_name,
                    'kb_approved'=> 0
                ]

                );
        }


      $message = "Ticket # " .$request->id. " Has been successfully updated";
      Alert::success($message);

      if($user->u_role == "Admin"){
        return redirect()->route('admin_KB');
    }else{
        return redirect()->route('staff_KB');
    }
    }

}
