<?php

namespace App\Http\Controllers;
use App\Models\StatusHistory;
use App\Models\Ticket;
use App\Models\Reporter;
use RealRashid\SweetAlert\Facades\Alert;
use App\Notifications\TicketUpdatedNotification;
use App\Models\Notification;
use PHPMailer\PHPMailer\PHPMailer;

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
    //         $users = Reporter::wherenotIn('u_role', ['Client']);
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


        // if($request->urgency == 1 && $request->impact ==1){
        //     $priority = 1;

        // }else if($request->urgency == 1 && $request->impact ==2){
        //     $priority = 2;

        // }else if($request->urgency == 1 && $request->impact ==3){
        //     $priority = 2;

        // }else  if($request->urgency == 2 && $request->impact ==1){
        //     $priority = 1;

        // }else if($request->urgency == 2 && $request->impact ==2){
        //     $priority = 2;

        // }else if($request->urgency == 2 && $request->impact ==3){
        //     $priority = 3;

        // }else if($request->urgency == 3 && $request->impact ==1){
        //     $priority = 2;

        // }else if($request->urgency == 3 && $request->impact ==2){
        //     $priority = 2;

        // }else if($request->urgency == 3 && $request->impact ==3){
        //     $priority = 3;

        // }else{
        //     $priority = 3;

        // }




        Ticket::create( [
            "u_ID"=>$user_ID->u_ID,
            // "t_urgency"=>$request->urgency,
            // "t_impact"=>$request->impact,
            // "t_priority"=>$priority,
            "t_category"=>strtoupper($request->category),
            "t_cc"=>$request->cc,
            "t_title"=>$request->title,
            "t_description"=>$request->content,
            "t_image"=>$filename
        ]);

        $get_uID = $user_ID->u_ID;
        $get_tID = Ticket::where("u_ID", $get_uID)->get()->last()->t_ID;



        StatusHistory::create( [
            "t_ID"=>$get_tID

        ]);


        $recipients = Reporter::wherenotIn('u_role',['Client'])->get();
        foreach ($recipients as $recipient) {
        Notification::create([
            "user_id"=> $recipient->u_ID,
            "ticket_id" => $get_tID,
            "n_message" => 'A new ticket is awaiting for your response!'

        ]);
    }

    $allStaff = Reporter::whereNotIn('u_role', ['Client'])->get();


    foreach($allStaff as $staffs){
    $mail = new PHPMailer(true);     // Passing true enables exceptions
    //email to
    $emailSendTo = Reporter::where('u_ID', $staffs->u_ID)->first();
    // Email server settings
    $mail->SMTPDebug = 0;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';             //  smtp host
    $mail->SMTPAuth = true;
    $mail->Username = 'rthrmorallos@gmail.com';   //  sender username
    $mail->Password = 'huydgcioffkgmcld';       // sender password
    $mail->SMTPSecure = 'tls';                  // encryption - ssl/tls
    $mail->Port = 587;                          // port - 587/465
    $mail->setFrom($mail->Username, 'RAMs CORNER - ITRO TICKETING SERVICE');


    $mail->addAddress($emailSendTo->email); //from line 275
    $message  = '<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <style>body{h2{color: #111;margin-bottom: 50px;border-left: 5px solid red;padding-left: 10px;line-height: 1em}.inputbox{margin-bottom: 50px}.inputbox input{position:absolute;width: 300px;background:transparent}.inputbox input:focus{color: #495057;background-color: #fff;border-color: #e54b38;outline: 0;box-shadow: none}.inputbox span{position: relative;top: 7px;left: 1px;padding-left: 10px;display: inline-block;transition: 0.5s}.inputbox input:focus ~ span{transform: translateX(-10px) translateY(-32px);font-size: 12px}.inputbox input:valid ~ span{transform: translateX(-10px) translateY(-32px);font-size: 12px}</style>
    </head>
    <body>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous">
    </script>
    <div class="card">
        <img src="https://scontent.fmnl9-2.fna.fbcdn.net/v/t39.30808-6/327170947_916431936156153_7827086269525719389_n.png?stp=dst-jpg&_nc_cat=101&ccb=1-7&_nc_sid=174925&_nc_eui2=AeGt0qx-UDhrzFHDIm3BNSLH1VPS4lRjPArVU9LiVGM8ChUuZNXg-htZJzUqKOSgV0_VzdAuPJQzQGlUHSajBcG-&_nc_ohc=_shXTm7uIf8AX8IMXek&_nc_zt=23&_nc_ht=scontent.fmnl9-2.fna&oh=00_AfDC1RtBmfmwbpwIdl1h3VHSydopXHL-WduU8wV16ukjpQ&oe=64180B80" alt="apc"  class="rounded float-start" style= "width:175px" >
        <h2 class="mb-0">ONLINE TICKET UPDATE</h2>
        <p>Hi <strong>' . $emailSendTo->u_name . '</strong><br>,
<br> This email is to inform you that there is a new ticket awaiting for your response. Please check out the details below.<br><hr>
        <p>Ticket Short Description: ' . $request->title    . '</p>

<p>Ticket #: <strong>INC'.$get_tID.' </strong></p>
        <p>Status:  <strong>NEW</strong></p>
        </p>
<hr>
<p>Thank you.</p><br><br>
<p>Best regards,</p>
<p>RAMS ITRO Ticketing Service System</p>
<br>



<p style="color:rgb(32,31,30); font-family:Calibri,sans-serif; font-size:11pt; text-align:start; background-color:rgb(255,255,255); margin:0px"><b><span lang="en-US" style="font-size:10pt; font-family:&quot;Adobe Garamond Pro&quot;; margin:0px">Information Technology Resource Office</span></b></p>

<p style="margin-top:0px; margin-bottom:0px; margin-top:0px; margin-bottom:0px; color:rgb(32,31,30); font-family:Calibri,sans-serif; font-size:11pt; text-align:start; background-color:rgb(255,255,255); margin:0px"><b><span lang="en-US" style="font-size:10pt; font-family:&quot;Adobe Garamond Pro&quot;; margin:0px">NU - Asia Pacific College</span></b></p>

<p style="margin-top:0px; margin-bottom:0px; margin-top:0px; margin-bottom:0px; color:rgb(32,31,30); font-family:Calibri,sans-serif; font-size:11pt; text-align:start; background-color:rgb(255,255,255); margin:0px"><span lang="en-US" style="font-size:10pt; font-family:&quot;Adobe Garamond Pro&quot;; margin:0px">&nbsp;</span></p>

<p style="margin-top:0px; margin-bottom:0px; margin-top:0px; margin-bottom:0px; color:rgb(32,31,30); font-family:Calibri,sans-serif; font-size:11pt; text-align:start; background-color:rgb(255,255,255); margin:0px"><span lang="en-US" style="font-size:10pt; font-family:&quot;Adobe Garamond Pro&quot;; margin:0px">3 Humabon Place, Magallanes</span></p>

<p style="margin-top:0px; margin-bottom:0px; margin-top:0px; margin-bottom:0px; color:rgb(32,31,30); font-family:Calibri,sans-serif; font-size:11pt; text-align:start; background-color:rgb(255,255,255); margin:0px"><span lang="en-US" style="font-size:10pt; font-family:&quot;Adobe Garamond Pro&quot;; margin:0px">Makati City 1232, Philippines</span></p>

<p style="margin-top:0px; margin-bottom:0px; margin-top:0px; margin-bottom:0px; color:rgb(32,31,30); font-family:Calibri,sans-serif; font-size:11pt; text-align:start; background-color:rgb(255,255,255); margin:0px"><span lang="en-US" style="font-size:10pt; font-family:&quot;Adobe Garamond Pro&quot;; margin:0px">Tel No. (632) 8852-9232 loc. 114</span></p>

<br><br><hr>
<div style="font-size:12px; font-family:"Calibri"; background-color:#e8e8e8; border-top:1px solid gray; padding:10px; color:#5e5e5e; border-bottom-left-radius:5px; border-bottom-right-radius:5px">    <span style="font-size:14px; font-weight:bold">        COMMUNICATION CONFIDENTIALITY NOTICE
</span>    <br aria-hidden="true">    <p style="font-size:10px; line-height:10pt; font-family:"Calibri"; font-style:italic">        This message, its thread, and any attachments are privileged, confidential and intended for the specified recipient only. No part of this message may be shared in any form or manner without the consent of the sender. If you are not the intended recipient of this message, please inform the sender immediately and delete the message from your inbox.
</p></div>
        </div>
    </body>
    </html>';

            $mail->isHTML(true);                // Set email content format to HTML
            $mail->Subject = "New Ticket";
            $mail->Body    = $message;
                // $mail->AltBody = plain text version of email body;
                if (!$mail->send()) {
                    return back()->with("failed", "Email not sent.")->withErrors($mail->ErrorInfo);
                }
    }



        Alert::success("Success!", "Your ticket was sent successfully. Please wait for the notification of status updates of your ticket.");
        if($user_ID->u_role == "Admin"){
            return redirect()->route('adminHome');
        }elseif($user_ID->u_role == "Staff"){
            return redirect()->route('staffHome');
        }else{
            return redirect()->route('clientHome');
        }

    }


    //reopen


    public function reopenTicket(Request $request, $tid){


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
            // "t_urgency"=>$request->urgency,
            // "t_impact"=>$request->impact,
            // "t_priority"=>$priority,
            "t_category"=>strtoupper($request->category),
            "t_cc"=>$request->cc,
            "t_title"=>$request->title,
            "t_description"=>$request->content,
            "t_image"=>$filename
        ]);

        $get_uID = $user_ID->u_ID;
        $get_tID = Ticket::where("u_ID", $get_uID)->get()->last()->t_ID;
        StatusHistory::create( [
            "t_ID"=>$get_tID,
            "sh_Status" => 'REOPENED']);



        $ticketss = Ticket::find($tid);

        $ticketss->t_status = 'REOPENED';
        $ticketss->update();

        StatusHistory::create( [
            "t_ID"=>$tid,
            "sh_Status" => 'REOPENED',
            "sh_message" => 'This ticket is Reopened by the Client'

        ]);


        $recipients = Reporter::wherenotIn('u_role',['Client'])->get();
        foreach ($recipients as $recipient) {
        Notification::create([
            "user_id"=> $recipient->u_ID,
            "ticket_id" => $get_tID,
            "n_message" => 'A new reopened ticket is awaiting for your response!'

        ]);
    }
         $allStaff = Reporter::whereNotIn('u_role', ['Client'])->get();


    foreach($allStaff as $staffs){
    $mail = new PHPMailer(true);     // Passing true enables exceptions
    //email to
    $emailSendTo = Reporter::where('u_ID', $staffs->u_ID)->first();
    // Email server settings
    $mail->SMTPDebug = 0;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';             //  smtp host
    $mail->SMTPAuth = true;
    $mail->Username = 'rthrmorallos@gmail.com';   //  sender username
    $mail->Password = 'huydgcioffkgmcld';       // sender password
    $mail->SMTPSecure = 'tls';                  // encryption - ssl/tls
    $mail->Port = 587;                          // port - 587/465
    $mail->setFrom($mail->Username, 'RAMs CORNER - ITRO TICKETING SERVICE');


    $mail->addAddress($emailSendTo->email); //from line 275
    $message  = '<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <style>body{h2{color: #111;margin-bottom: 50px;border-left: 5px solid red;padding-left: 10px;line-height: 1em}.inputbox{margin-bottom: 50px}.inputbox input{position:absolute;width: 300px;background:transparent}.inputbox input:focus{color: #495057;background-color: #fff;border-color: #e54b38;outline: 0;box-shadow: none}.inputbox span{position: relative;top: 7px;left: 1px;padding-left: 10px;display: inline-block;transition: 0.5s}.inputbox input:focus ~ span{transform: translateX(-10px) translateY(-32px);font-size: 12px}.inputbox input:valid ~ span{transform: translateX(-10px) translateY(-32px);font-size: 12px}</style>
    </head>
    <body>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous">
    </script>
    <div class="card">
        <img src="https://scontent.fmnl9-2.fna.fbcdn.net/v/t39.30808-6/327170947_916431936156153_7827086269525719389_n.png?stp=dst-jpg&_nc_cat=101&ccb=1-7&_nc_sid=174925&_nc_eui2=AeGt0qx-UDhrzFHDIm3BNSLH1VPS4lRjPArVU9LiVGM8ChUuZNXg-htZJzUqKOSgV0_VzdAuPJQzQGlUHSajBcG-&_nc_ohc=_shXTm7uIf8AX8IMXek&_nc_zt=23&_nc_ht=scontent.fmnl9-2.fna&oh=00_AfDC1RtBmfmwbpwIdl1h3VHSydopXHL-WduU8wV16ukjpQ&oe=64180B80" alt="apc"  class="rounded float-start" style= "width:175px" >
        <h2 class="mb-0">ONLINE TICKET UPDATE</h2>
        <p>Hi <strong>' . $emailSendTo->u_name . '</strong><br>,
<br> This email is to inform you that there a ticket that has been reopened was awaiting for your response. Please check out the details below.<br><hr>
        <p>Ticket Short Description: ' . $request->title    . '</p>

<p>Ticket #: <strong>INC'.$get_tID.' </strong></p>
        <p>Status:  <strong>NEW</strong></p>
        </p>
<hr>
<p>Thank you.</p><br><br>
<p>Best regards,</p>
<p>RAMS ITRO Ticketing Service System</p>
<br>



<p style="color:rgb(32,31,30); font-family:Calibri,sans-serif; font-size:11pt; text-align:start; background-color:rgb(255,255,255); margin:0px"><b><span lang="en-US" style="font-size:10pt; font-family:&quot;Adobe Garamond Pro&quot;; margin:0px">Information Technology Resource Office</span></b></p>

<p style="margin-top:0px; margin-bottom:0px; margin-top:0px; margin-bottom:0px; color:rgb(32,31,30); font-family:Calibri,sans-serif; font-size:11pt; text-align:start; background-color:rgb(255,255,255); margin:0px"><b><span lang="en-US" style="font-size:10pt; font-family:&quot;Adobe Garamond Pro&quot;; margin:0px">NU - Asia Pacific College</span></b></p>

<p style="margin-top:0px; margin-bottom:0px; margin-top:0px; margin-bottom:0px; color:rgb(32,31,30); font-family:Calibri,sans-serif; font-size:11pt; text-align:start; background-color:rgb(255,255,255); margin:0px"><span lang="en-US" style="font-size:10pt; font-family:&quot;Adobe Garamond Pro&quot;; margin:0px">&nbsp;</span></p>

<p style="margin-top:0px; margin-bottom:0px; margin-top:0px; margin-bottom:0px; color:rgb(32,31,30); font-family:Calibri,sans-serif; font-size:11pt; text-align:start; background-color:rgb(255,255,255); margin:0px"><span lang="en-US" style="font-size:10pt; font-family:&quot;Adobe Garamond Pro&quot;; margin:0px">3 Humabon Place, Magallanes</span></p>

<p style="margin-top:0px; margin-bottom:0px; margin-top:0px; margin-bottom:0px; color:rgb(32,31,30); font-family:Calibri,sans-serif; font-size:11pt; text-align:start; background-color:rgb(255,255,255); margin:0px"><span lang="en-US" style="font-size:10pt; font-family:&quot;Adobe Garamond Pro&quot;; margin:0px">Makati City 1232, Philippines</span></p>

<p style="margin-top:0px; margin-bottom:0px; margin-top:0px; margin-bottom:0px; color:rgb(32,31,30); font-family:Calibri,sans-serif; font-size:11pt; text-align:start; background-color:rgb(255,255,255); margin:0px"><span lang="en-US" style="font-size:10pt; font-family:&quot;Adobe Garamond Pro&quot;; margin:0px">Tel No. (632) 8852-9232 loc. 114</span></p>

<br><br><hr>
<div style="font-size:12px; font-family:"Calibri"; background-color:#e8e8e8; border-top:1px solid gray; padding:10px; color:#5e5e5e; border-bottom-left-radius:5px; border-bottom-right-radius:5px">    <span style="font-size:14px; font-weight:bold">        COMMUNICATION CONFIDENTIALITY NOTICE
</span>    <br aria-hidden="true">    <p style="font-size:10px; line-height:10pt; font-family:"Calibri"; font-style:italic">        This message, its thread, and any attachments are privileged, confidential and intended for the specified recipient only. No part of this message may be shared in any form or manner without the consent of the sender. If you are not the intended recipient of this message, please inform the sender immediately and delete the message from your inbox.
</p></div>
        </div>
    </body>
    </html>';

            $mail->isHTML(true);                // Set email content format to HTML
            $mail->Subject = "Reopened Ticket";
            $mail->Body    = $message;
                // $mail->AltBody = plain text version of email body;
                if (!$mail->send()) {
                    return back()->with("failed", "Email not sent.")->withErrors($mail->ErrorInfo);
                }
    }
        Alert::success("Success!", "Your ticket was now Reopened. Please wait for further updates from the ITRO");
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



            if($request->assign == $ticket->t_assignedTo || $request->assign == "Not Assigned"){

            }else{
                $recipients = Reporter::where('u_name',$request->assign)->get()->first();
                Notification::create([
                    "user_id"=> $recipients->u_ID,
                    "ticket_id" =>$ticket->t_ID,
                    "n_message" => 'A ticket has been assigned to you. Check it out!'

                ]);
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
                "sh_message" => $request->message,
                "sh_doneBy"=>$user->u_name

            ]);

            $recipient = Reporter::where('u_ID',$ticket->u_ID)->get()->first();

            Notification::create([
                "user_id"=> $recipient->u_ID,
                "ticket_id" =>$ticket->t_ID,
                "n_message" => 'Your ticket has been updated!'

            ]);






            $mail = new PHPMailer(true);     // Passing true enables exceptions
            //email to
            $emailSendTo = Reporter::where('u_ID', $ticket->u_ID)->first();
            // Email server settings
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';             //  smtp host
            $mail->SMTPAuth = true;
            $mail->Username = 'rthrmorallos@gmail.com';   //  sender username
            $mail->Password = 'huydgcioffkgmcld';       // sender password
            $mail->SMTPSecure = 'tls';                  // encryption - ssl/tls
            $mail->Port = 587;                          // port - 587/465
            $mail->setFrom($mail->Username, 'RAMs CORNER - ITRO TICKETING SERVICE');
            $mail->addAddress($emailSendTo->email); //from line 275
            $message  = '<html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Document</title>
                <style>body{h2{color: #111;margin-bottom: 50px;border-left: 5px solid red;padding-left: 10px;line-height: 1em}.inputbox{margin-bottom: 50px}.inputbox input{position:absolute;width: 300px;background:transparent}.inputbox input:focus{color: #495057;background-color: #fff;border-color: #e54b38;outline: 0;box-shadow: none}.inputbox span{position: relative;top: 7px;left: 1px;padding-left: 10px;display: inline-block;transition: 0.5s}.inputbox input:focus ~ span{transform: translateX(-10px) translateY(-32px);font-size: 12px}.inputbox input:valid ~ span{transform: translateX(-10px) translateY(-32px);font-size: 12px}</style>
            </head>
            <body>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
            <script
                src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
                crossorigin="anonymous">
            </script>
            <div class="card">
                <img src="https://scontent.fmnl9-2.fna.fbcdn.net/v/t39.30808-6/327170947_916431936156153_7827086269525719389_n.png?stp=dst-jpg&_nc_cat=101&ccb=1-7&_nc_sid=174925&_nc_eui2=AeGt0qx-UDhrzFHDIm3BNSLH1VPS4lRjPArVU9LiVGM8ChUuZNXg-htZJzUqKOSgV0_VzdAuPJQzQGlUHSajBcG-&_nc_ohc=_shXTm7uIf8AX8IMXek&_nc_zt=23&_nc_ht=scontent.fmnl9-2.fna&oh=00_AfDC1RtBmfmwbpwIdl1h3VHSydopXHL-WduU8wV16ukjpQ&oe=64180B80" alt="apc"  class="rounded float-start" style= "width:175px" >
                <h2 class="mb-0">ONLINE TICKET UPDATE</h2>
                <p>Hi <strong>' . $emailSendTo->u_name . '</strong><br>,
        <br> This email is to inform you that your submitted ticket has been updated. Please check out the details below and take note of the remarks from the staff working on your ticket.<br><hr>
                <p>Ticket Short Description: ' . $ticket->t_title . '</p>

        <p>Ticket #: <strong>INC'.$tID.' </strong></p>
                <p>Status:  <strong>'.$ticket->t_status.'</strong></p>
                <p>Note from staff: ' .$request->message.' </p>
                </p>
        <hr>
    <p>Thank you for using our service.</p>
    <p>Best regards,</p>
        <p>'.$user->u_name.'</p>
        <br>



    <p style="color:rgb(32,31,30); font-family:Calibri,sans-serif; font-size:11pt; text-align:start; background-color:rgb(255,255,255); margin:0px"><b><span lang="en-US" style="font-size:10pt; font-family:&quot;Adobe Garamond Pro&quot;; margin:0px">Information Technology Resource Office</span></b></p>

    <p style="margin-top:0px; margin-bottom:0px; margin-top:0px; margin-bottom:0px; color:rgb(32,31,30); font-family:Calibri,sans-serif; font-size:11pt; text-align:start; background-color:rgb(255,255,255); margin:0px"><b><span lang="en-US" style="font-size:10pt; font-family:&quot;Adobe Garamond Pro&quot;; margin:0px">NU - Asia Pacific College</span></b></p>

    <p style="margin-top:0px; margin-bottom:0px; margin-top:0px; margin-bottom:0px; color:rgb(32,31,30); font-family:Calibri,sans-serif; font-size:11pt; text-align:start; background-color:rgb(255,255,255); margin:0px"><span lang="en-US" style="font-size:10pt; font-family:&quot;Adobe Garamond Pro&quot;; margin:0px">&nbsp;</span></p>

    <p style="margin-top:0px; margin-bottom:0px; margin-top:0px; margin-bottom:0px; color:rgb(32,31,30); font-family:Calibri,sans-serif; font-size:11pt; text-align:start; background-color:rgb(255,255,255); margin:0px"><span lang="en-US" style="font-size:10pt; font-family:&quot;Adobe Garamond Pro&quot;; margin:0px">3 Humabon Place, Magallanes</span></p>

    <p style="margin-top:0px; margin-bottom:0px; margin-top:0px; margin-bottom:0px; color:rgb(32,31,30); font-family:Calibri,sans-serif; font-size:11pt; text-align:start; background-color:rgb(255,255,255); margin:0px"><span lang="en-US" style="font-size:10pt; font-family:&quot;Adobe Garamond Pro&quot;; margin:0px">Makati City 1232, Philippines</span></p>

    <p style="margin-top:0px; margin-bottom:0px; margin-top:0px; margin-bottom:0px; color:rgb(32,31,30); font-family:Calibri,sans-serif; font-size:11pt; text-align:start; background-color:rgb(255,255,255); margin:0px"><span lang="en-US" style="font-size:10pt; font-family:&quot;Adobe Garamond Pro&quot;; margin:0px">Tel No. (632) 8852-9232 loc. 114</span></p>

    <br><br><hr>
    <div style="font-size:12px; font-family:"Calibri"; background-color:#e8e8e8; border-top:1px solid gray; padding:10px; color:#5e5e5e; border-bottom-left-radius:5px; border-bottom-right-radius:5px">    <span style="font-size:14px; font-weight:bold">        COMMUNICATION CONFIDENTIALITY NOTICE
    </span>    <br aria-hidden="true">    <p style="font-size:10px; line-height:10pt; font-family:"Calibri"; font-style:italic">        This message, its thread, and any attachments are privileged, confidential and intended for the specified recipient only. No part of this message may be shared in any form or manner without the consent of the sender. If you are not the intended recipient of this message, please inform the sender immediately and delete the message from your inbox.
    </p></div>
                </div>
            </body>
            </html>';

                    $mail->isHTML(true);                // Set email content format to HTML
                    $mail->Subject = "Your ticket has been updated";

                    $mail->Body    = $message;

                        // $mail->AltBody = plain text version of email body;
                        if (!$mail->send()) {
                            return back()->with("failed", "Email not sent.")->withErrors($mail->ErrorInfo);
                        }



            Alert::success("Success!", "Ticket details has been updated");

            if($user->u_role == "Admin" ){
                return back();
            }elseif($user->u_role == "Staff" ){
                return back();
            }else{
                Alert::warning('Unathorized access!');
                return back();
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
    $user_info = Reporter::where('u_ID', $user->u_ID)->get();


    $ticket = Ticket::find($tID);
    // $ticket->t_status = 'RESOLVED';
    $ticket->t_resolution = $request->resolution;
    $ticket->save();

    // StatusHistory::create( [
    //     "t_ID"=>$tID,
    //     "sh_Status" => 'RESOLVED',
    //     "sh_AssignedTo" => $ticket->t_assignedTo,
    //     "sh_doneBy" => $user->u_name

    // ]);
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
    $user_info = Reporter::where('u_ID', $user->u_ID)->get();



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
    $user_info = Reporter::where('u_ID', $users->u_ID)->get();
    $tickets = DB::table('tickets')
    ->join('reporters', 'reporters.u_ID', '=', 'tickets.u_ID')
    ->select('tickets.*', 'reporters.u_name','reporters.email')
    ->where('tickets.t_cc', $users->u_name)
    ->get();

    $tixCount = $tickets->count();
        $ticketss = DB::table('tickets')
        ->join('reporters', 'reporters.u_ID', '=', 'tickets.u_ID')
        ->select('tickets.*', 'reporters.u_name','reporters.email')
        ->where('tickets.t_cc', $users->u_name)
        ->get()->first();









    // $tixCount = Ticket::where('t_cc', $users->u_name)->get()->count();
    $notifCount = Notification::where('user_id', $users->u_ID)->where('read_at', null)->get()->count();

    if($users->u_role == "Admin"){
        return view('admin_tags', ['notif'=>$notifCount,'tixCount'=>$tixCount,'sample'=>$ticketss, 'ticket' => $tickets, "user"=>$user_info, "admin"=>$user_info,  'display'=>'block']);
    }else if ($users->u_role == "Staff"){
        return view('staff_tags', ['notif'=>$notifCount,'sample'=>$ticketss,'ticket' => $tickets, "user"=>$user_info, "staff"=>$user_info, 'tixCount'=>$tixCount, 'display'=>'block']);
    }else{
        return view('client_tags', ['notif'=>$notifCount,'sample'=>$ticketss,'ticket' => $tickets, "user"=>$user_info, "client"=>$user_info, 'tixCount'=>$tixCount, 'display'=>'block']);
    }
   }

   public function getTicketData($id){

    $users = Auth::user();
    if($users == null){
        Alert::warning('Warning!!!', 'You are not authorized!');
        return redirect()->route('loginPage');
    }
    $user_info = Reporter::where('u_ID', $users->u_ID)->get();
    $tixCount = Ticket::where('t_cc', $users->u_name)->get()->count();


    $ticket= DB::table('tickets')
    ->join('reporters', 'reporters.u_ID', '=', 'tickets.u_ID')
    ->select('tickets.*', 'reporters.u_name','reporters.email')
    ->where('tickets.t_cc', $users->u_name)
    ->get();

    $ticketss = DB::table('tickets')
    ->join('reporters', 'reporters.u_ID', '=', 'tickets.u_ID')
    ->select('tickets.*', 'reporters.u_name','reporters.email')
    ->where('tickets.t_cc', $users->u_name)
    ->where('tickets.t_ID',$id)
    ->get()->first();




    $notifCount = Notification::where('user_id', $users->u_ID)->where('read_at', null)->get()->count();

    if($users->u_role == "Admin"){

        return view('admin_tags', ['notif'=>$notifCount,'ticket'=>$ticket,'sample'=>$ticketss, "user"=>$user_info, "admin"=>$user_info, 'tixCount'=>$tixCount, 'display'=>'block']);
    }else if ($users->u_role == "Staff"){
        return view('staff_tags', ['notif'=>$notifCount,'ticket'=>$ticket, 'sample'=>$ticketss, "user"=>$user_info, "staff"=>$user_info, 'tixCount'=>$tixCount, 'display'=>'block']);
    }else{
        return view('client_tags', ['notif'=>$notifCount,'ticket'=>$ticket,'sample'=>$ticketss, "user"=>$user_info, "client"=>$user_info, 'tixCount'=>$tixCount, 'display'=>'block']);
    }
   }




}
