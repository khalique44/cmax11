<?php

namespace App\Http\Controllers;

use App\Contest;
use App\Registration_fee;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use PHPMailer\PHPMailer\PHPMailer;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function sendEmail($to,$subject,$view)
    {
        $mail = new PHPMailer();
		try{
       $mail->isSMTP();
 
        //dd(\Config::get('values.mail_user_name'));
        $mail = new PHPMailer;
		$mail->isSMTP();
		$mail->Debugoutput = 'html';
        
		$mail->Host = \Config::get('values.mail_host');//'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = \Config::get('values.mail_user_name');//"no-reply@npcworldwide-register.com";
        $mail->Password = \Config::get('values.mail_password');//"Responsival50brown!";
        $mail->Port = \Config::get('values.mail_port');//465;
		$mail->SMTPSecure = \Config::get('values.mail_encryption');//'ssl';
	    $mail->SMTPDebug = 0;
        $from = \Config::get('values.mail_from_address');
        $from_name = \Config::get('values.mail_from_name');

        $mail->setFrom($from, $from_name);
        $mail->addReplyTo($from, $from_name);
        $mail->addAddress($to);

        $mail->isHTML(true);

        $mail->Subject = $subject;
        $mail->Body    = $view;
        if($mail->send()){
		//	echo "sent!!!";
		}
		 
	
		}catch (phpmailerException $e) {
 // echo $e->errorMessage(); //Pretty error messages from PHPMailer
} catch (Exception $e) {
 // echo $e->getMessage(); //Boring error messages from anything else!
}
 //exit;
    }

    public function sendEmailThroughMailable($to,$subject,$view){
        $mail = new PHPMailer;

        $mail->isSMTP();                            // Set mailer to use SMTP
        $mail->Host = 'smtp.mailtrap.io';             // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                     // Enable SMTP authentication
        $mail->Username = '03e6081a151ce7';          // SMTP username
        $mail->Password = '';        // SMTP password
        $mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;
        $from = \Config::get('values.mail_from_address');
        $from_name = \Config::get('values.mail_from_name');

        $mail->setFrom($from, $from_name);
        $mail->addReplyTo($from, $from_name);
        $mail->addAddress($to);   // Add a recipient

        $mail->isHTML(true);  // Set email format to HTML
        $bodyContent = $view;

        $mail->Subject = $subject;
        $mail->Body    = $bodyContent;

        if(!$mail->send()) {
            return false;
        } else {
            return true;
        }
    }

    public function uploadFile($destinationPath,$file)
    {
        $pathSections = explode('/',$destinationPath);

        $count = 0; $tempPath = '';
        while ($count != count($pathSections)){
            if($count < count($pathSections)){
                if($count > 0){
                    $tempPath .= '/';
                }
                $tempPath .= $pathSections[$count];

                if(!is_dir(public_path($tempPath)))
                    mkdir(public_path($tempPath));

                ++$count;
            }
        }

        $fileUrl = null;

        $fileName = time().'_'.rand(100,999);
        $fileExtension = $file->getClientOriginalExtension();
        $fileName .= ".".$fileExtension;

        if($file->move(public_path($destinationPath), $fileName)){
            $fileUrl = $destinationPath.'/'.$fileName;
        }

        return $fileUrl;
    }

    public function removeFile($path)
    {
        $path = public_path(str_replace(url('public'),'',$path));
        if(file_exists($path))
            unlink($path);
    }

    public function addRemoveJudges(Contest $contest, Request $request){

        $judge = \DB::table('attendees')->where('contest_id',$contest->id)->where('save_for','judges');
        $judgeUser_ids = $judge->pluck('user_id')->toArray();
        $judgeExist = $judge->count();

        if($request->has('judge_ids') && count($request->judge_ids) > 0){

            $this->validate($request,[
                'judge_ids' => 'required|array'
            ]);
            \DB::table('attendees')->where('contest_id',$contest->id)
                ->where('save_for','judges')
                ->whereNotIn('user_id',$request->judge_ids)->delete();

            foreach($request->judge_ids as $judge_id){

                //for email only
                /*if (auth('admin')->check()) {
                    $user = User::find($judge_id);
                    $to = $user->email;
                    $subject = "NPC Admin approved Your account for Judge";
                    $view = (string)view('admin.email.admin_email_after_edit_judge_and_promoter', compact('user', 'contest'));

                    $is_sendEmail = $this->sendEmailThroughMailable($to, $subject, $view);
                    if ($is_sendEmail == false) {
                        return redirect()->back()->with('error', 'Could not send email please retry!');
                    }
                }*/
                //end for email

                if(in_array($judge_id, $judgeUser_ids)) {
                    // update
                    $myExpediters = \DB::table('attendees')->where('contest_id',$contest->id)
                        ->where('save_for','judges')
                        ->where('user_id',$judge_id)->get();
                    foreach($myExpediters as $ex){
                        \DB::table('attendees')
                            ->where('user_id',$judge_id)
                            ->where('contest_id',$contest->id)
                            ->where('save_for','judges')
                            ->update([
                                'status' => $ex->status,
                                'is_verify' => $ex->is_verify,
                                'save_for' => $ex->save_for,
                                'qr_code' => $ex->qr_code,
                                'is_attendee' => $ex->is_attendee
                            ]);
                    }
                }
                else{
                    //insert
                    \DB::table('attendees')->insert(
                        [
                            'user_id' => $judge_id,
                            'contest_id' => $contest->id,
                            'save_for' => 'judges',
                            'qr_code' => str_random(60) . $contest->id . time() . '-' . $contest->slug . '-' . $judge_id,
                            'is_verify' => true
                        ]);
                }
            }
        }else{
            if($judgeExist > 0){
                $judge->delete();
            }
        }
    }

    public function addRemoveContestants(Contest $contest, Request $request){

        $contestant = \DB::table('attendees')->where('contest_id',$contest->id)->where('save_for','contestants');
        $contestantUser_ids = $contestant->pluck('user_id')->toArray();
        $contestantExist = $contestant->count();

        if($request->has('contestant_ids') && count($request->contestant_ids) > 0){

            $this->validate($request,[
                'contestant_ids' => 'required|array'
            ]);
            \DB::table('attendees')->where('contest_id',$contest->id)
                ->where('save_for','contestants')
                ->whereNotIn('user_id',$request->contestant_ids)->delete();

            foreach($request->contestant_ids as $contestant_id){

                //for email only
                /*if (auth('admin')->check()) {
                    $user = User::find($contestant_id);
                    $to = $user->email;
                    $subject = "NPC Admin approved Your account for Contestants";
                    $view = (string)view('admin.email.admin_email_after_edit_judge_and_promoter', compact('user', 'contest'));

                    $is_sendEmail = $this->sendEmailThroughMailable($to, $subject, $view);
                    if ($is_sendEmail == false) {
                        return redirect()->back()->with('error', 'Could not send email please retry!');
                    }
                }*/
                //end for email

                if(in_array($contestant_id, $contestantUser_ids)) {
                    // update
                    $myExpediters = \DB::table('attendees')->where('contest_id',$contest->id)
                        ->where('save_for','contestants')
                        ->where('user_id',$contestant_id)->get();
                    foreach($myExpediters as $ex){
                        \DB::table('attendees')
                            ->where('user_id',$contestant_id)
                            ->where('contest_id',$contest->id)
                            ->where('save_for','contestants')
                            ->update([
                                'status' => $ex->status,
                                'is_verify' => $ex->is_verify,
                                'save_for' => $ex->save_for,
                                'qr_code' => $ex->qr_code,
                                'is_attendee' => $ex->is_attendee
                            ]);
                    }
                }
                else{
                    //insert
                    \DB::table('attendees')->insert(
                        [
                            'user_id' => $contestant_id,
                            'contest_id' => $contest->id,
                            'save_for' => 'contestants',
                            'qr_code' => str_random(60) . $contest->id . time() . '-' . $contest->slug . '-' . $contestant_id,
                            'is_verify' => true
                        ]);
                }
            }
        }else{
            if($contestantExist > 0){
                $contestant->delete();
            }
        }
    }

    public function addRemoveExpediters(Contest $contest, Request $request){

        $expediter = \DB::table('attendees')->where('contest_id',$contest->id)->where('save_for','expediters');
        $expediterUser_ids = $expediter->pluck('user_id')->toArray();
        $expediterExist = $expediter->count();

        if($request->has('expediter_ids') && count($request->expediter_ids) > 0){

            $this->validate($request,[
                'expediter_ids' => 'required|array'
            ]);
            \DB::table('attendees')->where('contest_id',$contest->id)
                ->where('save_for','expediters')
                ->whereNotIn('user_id',$request->expediter_ids)->delete();

            /*if (auth('admin')->check()) {
                foreach($request->expediters as $expediter){
                    $user = User::find($expediter);
                    $to = $user->email;
                    $subject = "NPC Admin approved Your account for Expediter";
                    $view = (string)view('admin.email.admin_email_after_edit_judge_and_promoter', compact('user','contest'));

                    $is_sendEmail = $this->sendEmailThroughMailable($to,$subject,$view);
                    if($is_sendEmail == false){
                        return redirect()->back()->with('error','Could not send email please retry!');
                    }
                }
             }
            */

            foreach($request->expediter_ids as $expediter_id){

                //for email only
                /*if (auth('admin')->check()) {
                    $user = User::find($expediter_id);
                    $to = $user->email;
                    $subject = "NPC Admin approved Your account for Expediter";
                    $view = (string)view('admin.email.admin_email_after_edit_judge_and_promoter', compact('user','contest'));

                    $is_sendEmail = $this->sendEmailThroughMailable($to,$subject,$view);
                    if($is_sendEmail == false){
                        return redirect()->back()->with('error','Could not send email please retry!');
                    }
                }*/
                //end for email

                if(in_array($expediter_id, $expediterUser_ids)) {
                    // update
                    $myExpediters = \DB::table('attendees')->where('contest_id',$contest->id)
                        ->where('save_for','expediters')
                        ->where('user_id',$expediter_id)->get();
                    foreach($myExpediters as $ex){
                        \DB::table('attendees')
                            ->where('user_id',$expediter_id)
                            ->where('contest_id',$contest->id)
                            ->where('save_for','expediters')
                            ->update([
                                'status' => $ex->status,
                                'is_verify' => $ex->is_verify,
                                'save_for' => $ex->save_for,
                                'qr_code' => $ex->qr_code,
                                'is_attendee' => $ex->is_attendee
                            ]);
                    }
                }
                else{
                    //insert
                    \DB::table('attendees')->insert(
                        [
                            'user_id' => $expediter_id,
                            'contest_id' => $contest->id,
                            'save_for' => 'expediters',
                            'qr_code' => str_random(60) . $contest->id . time() . '-' . $contest->slug . '-' . $expediter_id,
                            'is_verify' => true
                        ]);
                }
            }
        }else{
            if($expediterExist > 0){
                $expediter->delete();
            }
        }
    }

    public function addRemoveTrainers(Contest $contest, Request $request){

        $trainer = \DB::table('attendees')->where('contest_id',$contest->id)->where('save_for','trainers');
        $trainerUser_ids = $trainer->pluck('user_id')->toArray();
        $trainerExist = $trainer->count();

        if($request->has('trainer_ids') && count($request->trainer_ids) > 0){

            $this->validate($request,[
                'trainer_ids' => 'required|array'
            ]);
            \DB::table('attendees')->where('contest_id',$contest->id)
                ->where('save_for','trainers')
                ->whereNotIn('user_id',$request->trainer_ids)->delete();

            foreach($request->trainer_ids as $trainer_id){

                //for email only
                /*if (auth('admin')->check()) {
                    $user = User::find($trainer_id);
                    $to = $user->email;
                    $subject = "NPC Admin approved Your account for Trainer";
                    $view = (string)view('admin.email.admin_email_after_edit_judge_and_promoter', compact('user', 'contest'));

                    $is_sendEmail = $this->sendEmailThroughMailable($to, $subject, $view);
                    if ($is_sendEmail == false) {
                        return redirect()->back()->with('error', 'Could not send email please retry!');
                    }
                }*/
                //end for email

                if(in_array($trainer_id, $trainerUser_ids)) {
                    // update
                    $myExpediters = \DB::table('attendees')->where('contest_id',$contest->id)
                        ->where('save_for','trainers')
                        ->where('user_id',$trainer_id)->get();
                    foreach($myExpediters as $ex){
                        \DB::table('attendees')
                            ->where('user_id',$trainer_id)
                            ->where('contest_id',$contest->id)
                            ->where('save_for','trainers')
                            ->update([
                                'status' => $ex->status,
                                'is_verify' => $ex->is_verify,
                                'save_for' => $ex->save_for,
                                'qr_code' => $ex->qr_code,
                                'is_attendee' => $ex->is_attendee
                            ]);
                    }
                }
                else{
                    //insert
                    \DB::table('attendees')->insert(
                        [
                            'user_id' => $trainer_id,
                            'contest_id' => $contest->id,
                            'save_for' => 'trainers',
                            'qr_code' => str_random(60) . $contest->id . time() . '-' . $contest->slug . '-' . $trainer_id,
                            'is_verify' => true
                        ]);
                }
            }
        }else{
            if($trainerExist > 0){
                $trainer->delete();
            }
        }
    }

    public function addRemovePromoters(Contest $contest, Request $request){

        $promoter = \DB::table('attendees')->where('contest_id',$contest->id)->where('save_for','promoters');
        $promoterUser_ids = $promoter->pluck('user_id')->toArray();
        $promoterExist = $promoter->count();

        if($request->has('promoter_ids') && count($request->promoter_ids) > 0){

            $this->validate($request,[
                'promoter_ids' => 'required|array'
            ]);
            \DB::table('attendees')->where('contest_id',$contest->id)
                ->where('save_for','promoters')
                ->whereNotIn('user_id',$request->promoter_ids)->delete();

            foreach($request->promoter_ids as $promoter_id){

                //for email only
                /*if (auth('admin')->check()) {
                    $user = User::find($promoter_id);
                    $to = $user->email;
                    $subject = "NPC Admin approved Your account for Trainer";
                    $view = (string)view('admin.email.admin_email_after_edit_judge_and_promoter', compact('user', 'contest'));

                    $is_sendEmail = $this->sendEmailThroughMailable($to, $subject, $view);
                    if ($is_sendEmail == false) {
                        return redirect()->back()->with('error', 'Could not send email please retry!');
                    }
                }*/
                //end for email

                if(in_array($promoter_id, $promoterUser_ids)) {
                    // update
                    $myExpediters = \DB::table('attendees')->where('contest_id',$contest->id)
                        ->where('save_for','promoters')
                        ->where('user_id',$promoter_id)->get();
                    foreach($myExpediters as $ex){
                        \DB::table('attendees')
                            ->where('user_id',$promoter_id)
                            ->where('contest_id',$contest->id)
                            ->where('save_for','promoters')
                            ->update([
                                'status' => $ex->status,
                                'is_verify' => $ex->is_verify,
                                'save_for' => $ex->save_for,
                                'qr_code' => $ex->qr_code,
                                'is_attendee' => $ex->is_attendee
                            ]);
                    }
                }
                else{
                    //insert
                    \DB::table('attendees')->insert(
                        [
                            'user_id' => $promoter_id,
                            'contest_id' => $contest->id,
                            'save_for' => 'promoters',
                            'qr_code' => str_random(60) . $contest->id . time() . '-' . $contest->slug . '-' . $promoter_id,
                            'is_verify' => true
                        ]);
                }
            }
        }else{
            if($promoterExist > 0){
                $promoter->delete();
            }
        }
    }

    public function addDefaultRegistrationFee($year){
        $data = [
            'country_id' => 1,
            'name' => 'Fee',
            'year' => $year,
            'athlete_fee' => 1,
            'non_athlete_fee' => 1,
            'pro_athlete_fee' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $registrationFee_id = Registration_fee::insertGetId($data);
        return Registration_fee::find($registrationFee_id);
    }
}
