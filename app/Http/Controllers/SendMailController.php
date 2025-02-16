<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class SendMailController extends Controller
{
    public function send(Request $request)
    {
        $mail = new PHPMailer(true);
        try {
            // Configuração SMTP utilizando as variáveis do .env
            $mail->isSMTP();
            $mail->Host       = env('MAIL_HOST');
            $mail->SMTPAuth   = true;
            $mail->Username   = env('MAIL_USERNAME');
            $mail->Password   = env('MAIL_PASSWORD');
            $mail->SMTPSecure = env('MAIL_ENCRYPTION');
            $mail->Port       = env('MAIL_PORT');

            // Remetente e destinatário
            $mail->setFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            $mail->addAddress($request->input('email'));

            // Configuração do conteúdo do e-mail
            $mail->isHTML(true);
            $mail->Subject = $request->input('subject');
            $mail->Body    = $request->input('body');

            $mail->send();

            return response()->json(['success' => 'E-mail enviado com sucesso!']);
        } catch (Exception $e) {
            return response()->json(['error' => 'O e-mail não pôde ser enviado. Erro: ' . $mail->ErrorInfo]);
        }
    }
}
