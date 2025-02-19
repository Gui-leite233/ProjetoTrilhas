<?php

namespace App\Http\Controllers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Http\Request;
use App\Models\User;

class MailController extends Controller
{
    public function sendEmail(Request $request)
    {
        try {
            $mail = new PHPMailer(true);

            // Server settings
            $mail->isSMTP();
            $mail->Host = env('MAIL_HOST');
            $mail->SMTPAuth = true;
            $mail->Username = env('MAIL_USERNAME');
            $mail->Password = env('MAIL_PASSWORD');
            $mail->SMTPSecure = env('MAIL_ENCRYPTION', 'tls');
            $mail->Port = env('MAIL_PORT', 2525);
            $mail->CharSet = 'UTF-8';

            // Recipients
            $mail->setFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME')); 
            $mail->addReplyTo($request->email, $request->name); 
            $mail->addAddress($request->email, $request->name);

            // Content
            $mail->isHTML(true);
            $mail->Subject = $request->subject;
            $mail->Body = $request->message;
            $mail->AltBody = strip_tags($request->message);

            $mail->send();
            return redirect()->back()->with('success', 'Mensagem enviada com sucesso!');

        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Erro ao enviar mensagem. Por favor, tente novamente.');
        }
    }

    public function sendWelcomeEmail(User $user)
    {
        try {
            $mail = new PHPMailer(true);

            // Server settings
            $mail->isSMTP();
            $mail->Host = env('MAIL_HOST');
            $mail->SMTPAuth = true;
            $mail->Username = env('MAIL_USERNAME');
            $mail->Password = env('MAIL_PASSWORD');
            $mail->SMTPSecure = env('MAIL_ENCRYPTION', 'tls');
            $mail->Port = env('MAIL_PORT', 2525);
            $mail->CharSet = 'UTF-8';

            // Recipients
            $mail->setFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            $mail->addAddress($user->email, $user->nome);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Bem-vindo ao ' . config('app.name');
            
            // Render email template
            $emailContent = view('emails.welcome', ['user' => $user])->render();
            $mail->Body = $emailContent;
            $mail->AltBody = strip_tags($emailContent);

            $mail->send();
            return true;

        } catch (Exception $e) {
            \Log::error("Erro ao enviar email de boas-vindas: {$mail->ErrorInfo}");
            return false;
        }
    }
}