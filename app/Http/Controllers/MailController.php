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
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = env('MAIL_USERNAME');
            $mail->Password = env('MAIL_PASSWORD');
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            $mail->CharSet = 'UTF-8';

            // Recipients
            $mail->setFrom($request->email, $request->name); // Remetente (pessoa que está enviando)
            $mail->addAddress('sepae.paranagua@ifpr.edu.br', 'SEPAE Paranaguá'); // Destinatário fixo

            // Content
            $mail->isHTML(true);
            $mail->Subject = $request->subject;
            
            // Corpo do email formatado
            $emailBody = "
                <h2>Novo contato do site</h2>
                <p><strong>Nome:</strong> {$request->name}</p>
                <p><strong>Email:</strong> {$request->email}</p>
                <p><strong>Assunto:</strong> {$request->subject}</p>
                <p><strong>Mensagem:</strong></p>
                <p>{$request->message}</p>
            ";
            
            $mail->Body = $emailBody;
            $mail->AltBody = strip_tags($emailBody);

            $mail->send();
            return redirect()->back()->with('success', 'Email enviado com sucesso! Entraremos em contato em breve.');

        } catch (Exception $e) {
            \Log::error("Mail error: " . $mail->ErrorInfo);
            return redirect()->back()->with('error', "Erro ao enviar email. Por favor, tente novamente mais tarde.");
        }
    }

    public function sendWelcomeEmail(User $user)
    {
        try {
            $mail = new PHPMailer(true);

            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = env('MAIL_USERNAME');
            $mail->Password = env('MAIL_PASSWORD');
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
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
