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
            $mail->addAddress($request->email);  // Add recipient's email

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Teste de Email';
            $mail->Body = 'Este é um <b>teste</b> de email usando PHPMailer com Mailtrap!';
            $mail->AltBody = 'Este é um teste de email usando PHPMailer com Mailtrap!';

            $mail->send();
            return response()->json(['message' => 'Email enviado com sucesso!'], 200);

        } catch (Exception $e) {
            return response()->json(['error' => "Erro ao enviar email: {$mail->ErrorInfo}"], 500);
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
