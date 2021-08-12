<?php

namespace App\Http\Controllers;

use App\Category;
use App\Conversion;
use App\CustomField;
use App\Faq;
use App\Mail\SendTicket;
use App\Mail\SendTicketAdmin;
use App\Mail\SendTicketReply;
use App\Ticket;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{

    public function __construct()
    {
        \App::setLocale(env('DEFAULT_LANG') ?? 'en');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(!file_exists(storage_path() . "/installed"))
        {
            return redirect('install');
        }
        if(Auth::user())
        {
            return redirect()->route('admin.dashboard');
        }

        $customFields = CustomField::orderBy('order')->get();
        $categories   = Category::get();

        return view('home', compact('categories', 'customFields'));
    }

    public function search()
    {
        return view('search');
    }

    public function faq()
    {
        $faqs = Faq::get();

        return view('faq', compact('faqs'));
    }

    public function ticketSearch(Request $request)
    {
        $validation = [
            'ticket_id' => ['required'],
            'email' => ['required'],
        ];

        $this->validate($request, $validation);
        $ticket = Ticket::where('ticket_id', '=', $request->ticket_id)->where('email', '=', $request->email)->first();

        if($ticket)
        {
            return redirect()->route('home.view', Crypt::encrypt($ticket->ticket_id));
        }
        else
        {
            return redirect()->back()->with('info', __('Invalid Ticket Number'));
        }

        return view('search');
    }

    public function store(Request $request)
    {
        $validation = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'category' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'status' => 'required|string|max:100',
            'description' => 'required',
        ];

        if(env('RECAPTCHA_MODULE') == 'yes')
        {
            $validation['g-recaptcha-response'] = 'required|captcha';
        }

        if($request->hasfile('attachments'))
        {
            $validation['attachments.*'] = 'mimes:zip,rar,jpeg,jpg,png,gif,svg,pdf,txt,doc,docx,application/octet-stream,audio/mpeg,mpga,mp3,wav|max:204800';
        }

        $this->validate($request, $validation);

        $post              = $request->all();
        $post['ticket_id'] = time();
        $data              = [];
        if($request->hasfile('attachments'))
        {
            foreach($request->file('attachments') as $file)
            {
                $name = $file->getClientOriginalName();
                $file->storeAs('/tickets/' . $post['ticket_id'], $name);
                $data[] = $name;
            }
        }
        $post['attachments'] = json_encode($data);
        $ticket              = Ticket::create($post);
        CustomField::saveData($ticket, $request->customField);

        // Send Email to User
        try
        {
            Mail::to($ticket->email)->send(new SendTicket($ticket));

            $users = User::join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')->where('model_has_roles.model_type', '=', 'App\User')->where('role_id', '=', 1)->get();
            foreach($users as $user)
            {
                Mail::to($user->email)->send(new SendTicketAdmin($user, $ticket));
            }
        }
        catch(\Exception $e)
        {
            $error_msg = __('E-Mail has been not sent due to SMTP configuration');
        }

        return redirect()->back()->with('create_ticket', __('Ticket created successfully') . ' <a href="' . route('home.view', Crypt::encrypt($ticket->ticket_id)) . '"><b>' . __('Your unique ticket link is this.') . '</b></a> ' . ((isset($error_msg)) ? '<br> <span class="text-danger">' . $error_msg . '</span>' : ''));
    }

    public function view($ticket_id)
    {
        $ticket_id = Crypt::decrypt($ticket_id);
        $ticket    = Ticket::where('ticket_id', '=', $ticket_id)->first();
        if($ticket)
        {
            return view('show', compact('ticket'));
        }
        else
        {
            return redirect()->back()->with('error', __('Some thing is wrong'));
        }
    }

    public function reply(Request $request, $ticket_id)
    {
        $ticket = Ticket::where('ticket_id', '=', $ticket_id)->first();
        if($ticket)
        {
            $validation = ['reply_description' => ['required']];
            if($request->hasfile('reply_attachments'))
            {
                $validation['reply_attachments.*'] = 'mimes:zip,rar,jpeg,jpg,png,gif,svg,pdf,txt,doc,docx,application/octet-stream,audio/mpeg,mpga,mp3,wav|max:204800';
            }
            $this->validate($request, $validation);

            $post                = [];
            $post['sender']      = 'user';
            $post['ticket_id']   = $ticket->id;
            $post['description'] = $request->reply_description;
            $data                = [];
            if($request->hasfile('reply_attachments'))
            {
                foreach($request->file('reply_attachments') as $file)
                {
                    $name = $file->getClientOriginalName();
                    $file->storeAs('/tickets/' . $ticket->ticket_id, $name);
                    $data[] = $name;
                }
            }
            $post['attachments'] = json_encode($data);
            $conversion          = Conversion::create($post);

            // Send Email to User
            try
            {
                $users = User::join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')->where('model_has_roles.model_type', '=', 'App\User')->where('role_id', '=', 1)->get();
                foreach($users as $user)
                {
                    Mail::to($user->email)->send(new SendTicketReply($user, $ticket, $conversion));
                }
            }
            catch(\Exception $e)
            {
                $error_msg = __('E-Mail has been not sent due to SMTP configuration');
            }

            return redirect()->back()->with('success', __('Reply added successfully') . ((isset($error_msg)) ? '<br> <span class="text-danger">' . $error_msg . '</span>' : ''));
        }
        else
        {
            return redirect()->back()->with('error', __('Some thing is wrong'));
        }
    }
}
