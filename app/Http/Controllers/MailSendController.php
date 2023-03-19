<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use App\Mail\SendMail;
use App\Services\MailService;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use stdClass;

class MailSendController extends Controller
{

    public function index()
    {
        return view('sendMail.sendMail');
    }


    public function send(Request $request)
    {
        $start = microtime(true);
        $request->validate([
            'message' => 'required|max:500',
        ]);
        if ($request->email) {
            $data = new stdClass();
            $data->message = $request->message;

            $obMailService = new MailService();
            $users = $obMailService->getUsers($request->addressee);
            foreach ($users as $user) {
                dispatch(new SendEmailJob(
                    [
                        'user' => $user->email,
                        'data' => $data
                    ]
                ));
                $time = microtime(true) - $start;
                $userTime = round($time, 4);
                $request->session()->put('time', $userTime);

                // Mail::to($this->details['user'])->send(new SendMail($this->details['data']));
                // Mail::to($user)->send(new SendMail($data));
            }
        } elseif ($request->telegramm) {
            $client = new Client();
            try {
                $client->post('https://api.telegram.org/bot1617689359:AAEMBaqhumYqs1qCBjdsP1aI19jXqbKNhGE/sendMessage', [
                    RequestOptions::JSON => [
                        'chat_id' => -833719373,
                        'text' => $request->message,
                    ]
                ]);
            } catch (\Exception $e) {
                dd($e->getMessage());
            }
        }
        return redirect()->route('admin.send.index')
            ->with('success', 'Ваше сообщение успешно отправлено');
    }
}
