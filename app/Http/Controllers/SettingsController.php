<?php

namespace App\Http\Controllers;

use App\CustomField;
use App\Mail\EmailTest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SettingsController extends Controller
{
    public function index()
    {
        $user = \Auth::user();
        if($user->can('manage-setting'))
        {
            $lang         = $user->languages();
            $customFields = CustomField::orderBy('order')->get();

            return view('admin.users.setting', compact('lang', 'customFields'));
        }
        else
        {
            return view('403');
        }
    }

    public function store(Request $request)
    {
        $user = \Auth::user();
        if($user->can('manage-setting'))
        {
            if($request->favicon)
            {
                $request->validate(['favicon' => 'required|image|mimes:jpeg,jpg,png|max:204800']);
                $request->favicon->storeAs('logo', 'favicon.png');
            }
            if($request->logo)
            {
                $request->validate(['logo' => 'required|image|mimes:jpeg,jpg,png|max:204800']);
                $request->logo->storeAs('logo', 'logo.png');
            }

            if($request->white_logo)
            {
                $request->validate(['white_logo' => 'required|image|mimes:jpeg,jpg,png|max:204800']);
                $request->white_logo->storeAs('logo', 'white.png');
            }

            $rules = [
                'app_name' => 'required|string|max:50',
                'default_language' => 'required|string|max:50',
                'footer_text' => 'required|string|max:50',
            ];

            $validator = \Validator::make(
                $request->all(), $rules
            );
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $arrEnv = [
                'APP_NAME' => $request->app_name,
                'DEFAULT_LANG' => $request->default_language,
                'FOOTER_TEXT' => $request->footer_text,
            ];

            if($this->setEnvironmentValue($arrEnv))
            {
                return redirect()->back()->with('success', __('Setting updated successfully'));
            }
            else
            {
                return redirect()->back()->with('error', __('Something is wrong'));
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Something is wrong'));
        }
    }

    public function emailSettingStore(Request $request)
    {
        $user = \Auth::user();
        if($user->can('manage-setting'))
        {
            $rules = [
                'mail_driver' => 'required|string|max:50',
                'mail_host' => 'required|string|max:50',
                'mail_port' => 'required|string|max:50',
                'mail_username' => 'required|string|max:50',
                'mail_password' => 'required|string|max:255',
                'mail_encryption' => 'required|string|max:50',
                'mail_from_address' => 'required|string|max:50',
                'mail_from_name' => 'required|string|max:50',
            ];

            $validator = \Validator::make(
                $request->all(), $rules
            );
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $arrEnv = [
                'MAIL_DRIVER' => $request->mail_driver,
                'MAIL_HOST' => $request->mail_host,
                'MAIL_PORT' => $request->mail_port,
                'MAIL_USERNAME' => $request->mail_username,
                'MAIL_PASSWORD' => $request->mail_password,
                'MAIL_ENCRYPTION' => $request->mail_encryption,
                'MAIL_FROM_ADDRESS' => $request->mail_from_address,
                'MAIL_FROM_NAME' => $request->mail_from_name,
            ];

            if($this->setEnvironmentValue($arrEnv))
            {
                return redirect()->back()->with('success', __('Email Settings updated successfully'));
            }
            else
            {
                return redirect()->back()->with('error', __('Something is wrong'));
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Something is wrong'));
        }
    }

    public function recaptchaSettingStore(Request $request)
    {
        $user = \Auth::user();
        if($user->can('manage-setting'))
        {
            $rules = [];

            if($request->recaptcha_module == 'yes')
            {
                $rules['google_recaptcha_key'] = 'required|string|max:50';
                $rules['google_recaptcha_key'] = 'required|string|max:50';
            }

            $validator = \Validator::make(
                $request->all(), $rules
            );
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $arrEnv = [
                'RECAPTCHA_MODULE' => $request->recaptcha_module ?? 'no',
                'NOCAPTCHA_SITEKEY' => $request->google_recaptcha_key,
                'NOCAPTCHA_SECRET' => $request->google_recaptcha_key,
            ];

            if($this->setEnvironmentValue($arrEnv))
            {
                return redirect()->back()->with('success', __('Recaptcha Settings updated successfully'));
            }
            else
            {
                return redirect()->back()->with('error', __('Something is wrong'));
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Something is wrong'));
        }
    }

    public function pusherSettingStore(Request $request)
    {
        $user = \Auth::user();
        if($user->can('manage-setting'))
        {
            $rules = [];

            if($request->enable_chat == 'yes')
            {
                $rules['pusher_app_id']      = 'required|string|max:50';
                $rules['pusher_app_key']     = 'required|string|max:50';
                $rules['pusher_app_secret']  = 'required|string|max:50';
                $rules['pusher_app_cluster'] = 'required|string|max:50';
            }

            $validator = \Validator::make(
                $request->all(), $rules
            );
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $arrEnv = [
                'CHAT_MODULE' => $request->enable_chat ?? 'no',
                'PUSHER_APP_ID' => $request->pusher_app_id,
                'PUSHER_APP_KEY' => $request->pusher_app_key,
                'PUSHER_APP_SECRET' => $request->pusher_app_secret,
                'PUSHER_APP_CLUSTER' => $request->pusher_app_cluster,
            ];

            if($this->setEnvironmentValue($arrEnv))
            {
                return redirect()->back()->with('success', __('Pusher Settings updated successfully'));
            }
            else
            {
                return redirect()->back()->with('error', __('Something is wrong'));
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Something is wrong'));
        }
    }

    public static function setEnvironmentValue(array $values)
    {
        $envFile = app()->environmentFilePath();
        $str     = file_get_contents($envFile);
        if(count($values) > 0)
        {
            foreach($values as $envKey => $envValue)
            {
                $keyPosition       = strpos($str, "{$envKey}=");
                $endOfLinePosition = strpos($str, "\n", $keyPosition);
                $oldLine           = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);

                // If key does not exist, add it
                if(!$keyPosition || !$endOfLinePosition || !$oldLine)
                {
                    $str .= "{$envKey}='{$envValue}'\n";
                }
                else
                {
                    $str = str_replace($oldLine, "{$envKey}='{$envValue}'", $str);
                }
            }
        }
        $str = substr($str, 0, -1);
        $str .= "\n";

        return file_put_contents($envFile, $str) ? true : false;
    }

    public function testEmail(Request $request)
    {
        $user = \Auth::user();
        if($user->can('manage-setting'))
        {
            $data                      = [];
            $data['mail_driver']       = $request->mail_driver;
            $data['mail_host']         = $request->mail_host;
            $data['mail_port']         = $request->mail_port;
            $data['mail_username']     = $request->mail_username;
            $data['mail_password']     = $request->mail_password;
            $data['mail_encryption']   = $request->mail_encryption;
            $data['mail_from_address'] = $request->mail_from_address;
            $data['mail_from_name']    = $request->mail_from_name;

            return view('admin.users.test_email', compact('data'));
        }
        else
        {
            return response()->json(['error' => __('Permission Denied.')], 401);
        }
    }

    public function testEmailSend(Request $request)
    {
        $validator = \Validator::make(
            $request->all(), [
                               'email' => 'required|email',
                               'mail_driver' => 'required',
                               'mail_host' => 'required',
                               'mail_port' => 'required',
                               'mail_username' => 'required',
                               'mail_password' => 'required',
                               'mail_from_address' => 'required',
                               'mail_from_name' => 'required',
                           ]
        );
        if($validator->fails())
        {
            $messages = $validator->getMessageBag();

            return redirect()->back()->with('error', $messages->first());
        }

        try
        {
            config(
                [
                    'mail.driver' => $request->mail_driver,
                    'mail.host' => $request->mail_host,
                    'mail.port' => $request->mail_port,
                    'mail.encryption' => $request->mail_encryption,
                    'mail.username' => $request->mail_username,
                    'mail.password' => $request->mail_password,
                    'mail.from.address' => $request->mail_from_address,
                    'mail.from.name' => $request->mail_from_name,
                ]
            );
            Mail::to($request->email)->send(new EmailTest());
        }
        catch(\Exception $e)
        {
            return response()->json(
                [
                    'is_success' => false,
                    'message' => $e->getMessage(),
                ]
            );
        }

        return response()->json(
            [
                'is_success' => true,
                'message' => __('Email send Successfully'),
            ]
        );
    }

    public function storeCustomFields(Request $request)
    {
        $rules      = [
            'fields' => 'required|present|array',
        ];
        $attributes = [];

        if($request->fields)
        {
            foreach($request->fields as $key => $val)
            {
                $rules['fields.' . $key . '.name']      = 'required|max:255';
                $attributes['fields.' . $key . '.name'] = __('Field Name');
            }
        }

        $validator = \Validator::make($request->all(), $rules, [], $attributes);
        if($validator->fails())
        {
            $messages = $validator->getMessageBag();

            return redirect()->back()->with('error', $messages->first());
        }

        $field_ids = CustomField::orderBy('order')->pluck('id')->toArray();

        $order = 0;

        foreach($request->fields as $key => $field)
        {
            $fieldObj = new CustomField();
            if(isset($field['id']) && !empty($field['id']))
            {
                $fieldObj = CustomField::find($field['id']);
                if(($key = array_search($fieldObj->id, $field_ids)) !== false)
                {
                    unset($field_ids[$key]);
                }
            }
            $fieldObj->name        = $field['name'];
            $fieldObj->placeholder = $field['placeholder'];
            if(isset($field['type']) && !empty($field['type']))
            {
                if(isset($fieldObj->id) && $fieldObj->id > 6)
                {
                    $fieldObj->type = $field['type'];
                }
                elseif(!isset($fieldObj->id))
                {
                    $fieldObj->type = $field['type'];
                }
            }
            $fieldObj->width  = (isset($field['width'])) ? $field['width'] : '12';
            $fieldObj->status = 1;
            if(isset($field['is_required']))
            {
                if(isset($fieldObj->id) && $fieldObj->id > 6)
                {
                    $fieldObj->is_required = $field['is_required'];
                }
                elseif(!isset($fieldObj->id))
                {
                    $fieldObj->is_required = $field['is_required'];
                }
            }
            $fieldObj->created_by = Auth::id();
            $fieldObj->order      = $order++;
            $fieldObj->save();
        }

        if(!empty($field_ids) && count($field_ids) > 0)
        {
            CustomField::whereIn('id', $field_ids)->where('status', 1)->delete();
        }

        return redirect()->back()->with('success', __('Fields Saves Successfully.!'));
    }
}
