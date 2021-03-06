<?php

namespace App\Http\Livewire\Frontend;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use Livewire\Component;

class Sinscrire extends Component{
    public $form = [
        'name' => '',
        'email' => '',
        'tel' => '',
        'password' => '',
        'agree' => '',
    ];

    protected $rules = [
        'form.name' => 'required|min:6',
        'form.email' => 'required|email',
        'form.tel' => 'required',
        'form.agree' => 'required',
    ];

    public function mount(){
        if(Auth::user()){
            return redirect()->to('/');
        }
    }

    public function sendPassword(){
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->Mailer = "smtp";

        $mail->SMTPDebug  = 0;
        $mail->SMTPAuth   = TRUE;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
        $mail->Host       = "smtp.gmail.com";
        $mail->Username   = "erp2am@gmail.com";
        $mail->Password   = "erp2am@21";

        $mail->IsHTML(true);
        $mail->AddAddress($this->form['email'], $this->form['name']);
        $mail->SetFrom("contact@flouka.ma", "Flouka");
        $mail->AddReplyTo("contact@flouka.ma", "Flouka");
        $mail->AddCC("contact@flouka.ma", "Flouka");
        $mail->Subject = "Account Verification in Flouka";
        $content = view('tpl')->with([
            'name' => $this->form['name'],
            'password' => $this->form['password'],
        ]);

        $mail->MsgHTML($content);
        if(!$mail->Send()){
            // dd($mail->ErrorInfo);
            var_dump($mail);
        }else{
            return redirect(route('connexion'));
        }
    }

    public function submit(){
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $this->form['password'] = substr(str_shuffle($chars),0,10);

        $this->validate();
        $this->createClient();
    }

    public function createClient(){
        $checkEmail = User::select()->where('email', $this->form['email'])->get();
        $checkTel = User::select()->where('tel', $this->form['tel'])->get();

        if(count($checkEmail) === 0 && count($checkTel) === 0){
            $item = new User();
            $item->name = $this->form['name'];
            $item->tel = $this->form['tel'];
            $item->email = $this->form['email'];
            $item->password = bcrypt($this->form['password']);
            $item->profil_client_id = 1;
            $item->type = 'client';
            $item->save();

            session()->flash('success-message', 'Votre compte a ??t?? cr???? avec succ??s');
            $this->sendPassword();
        }elseif(count($checkEmail) > 0){
            session()->flash('warning-message', 'Existe d??j?? un compte poss??de cette adresse e-mail');
        }elseif(count($checkTel) > 0){
            session()->flash('warning-message', 'Existe d??j?? un compte poss??de ce num??ro de t??l??phone');
        }
    }

    public function render(){
        return view('livewire.frontend.sinscrire')->layout('layouts.frontend.app');
    }
}
