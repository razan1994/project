<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\PrivacyAndPolicy;
use Illuminate\Http\Request;
use App\Models\SupportTicket;
use Illuminate\Routing\Route;

class PrivacyPolicyController extends Controller
{
    public function index(Route $route)
    {
        try {
            $privacy = PrivacyAndPolicy::first();
            if (!$privacy) {
                $privacy = new PrivacyAndPolicy();
                $privacy->save();
            }
            return view('admin.privacy-policy.index', compact('privacy'));
        } catch (\Throwable $th) {
            $function_name =  $route->getActionName();
            $check_old_errors = new SupportTicket();
            $check_old_errors = $check_old_errors->select('*')->where([
                'error_location' => $th->getFile(),
                'error_description' => $th->getMessage(),
                'function_name' => $function_name,
                'error_line' => $th->getLine(),
            ])->get();

            if ($check_old_errors->count() == 0) {
                $new_error_ticket = SupportTicket::create([
                    'error_location' => $th->getFile(),
                    'error_description' => $th->getMessage(),
                    'function_name' => $function_name,
                    'error_line' =>  $th->getLine(),
                ]);
                $end_error_ticket = $new_error_ticket;
            } else {
                $end_error_ticket = $check_old_errors->first();
            }
            return view('errors.support_tickets', compact('th', 'function_name', 'end_error_ticket'));
        }
    }

    public function edit(Route $route)
    {
        try {
            $privacy = PrivacyAndPolicy::first();
            if (!$privacy) {
                $privacy = new PrivacyAndPolicy();
                $privacy->save();
            }
            return view('admin.privacy-policy.edit', compact('privacy'));
        } catch (\Throwable $th) {
            $function_name =  $route->getActionName();
            $check_old_errors = new SupportTicket();
            $check_old_errors = $check_old_errors->select('*')->where([
                'error_location' => $th->getFile(),
                'error_description' => $th->getMessage(),
                'function_name' => $function_name,
                'error_line' => $th->getLine(),
            ])->get();

            if ($check_old_errors->count() == 0) {
                $new_error_ticket = SupportTicket::create([
                    'error_location' => $th->getFile(),
                    'error_description' => $th->getMessage(),
                    'function_name' => $function_name,
                    'error_line' =>  $th->getLine(),
                ]);
                $end_error_ticket = $new_error_ticket;
            } else {
                $end_error_ticket = $check_old_errors->first();
            }
            return view('errors.support_tickets', compact('th', 'function_name', 'end_error_ticket'));
        }
    }

    public function update(Request $request, Route $route)
    {
        $request->validate([
            'title_en' => 'required|string',
            'title_ar' => 'required|string',
        ]);
        try {
            $data = $request->only([
                'title_en',
                'title_ar',
                'description_en',
                'description_ar',
            ]);

            $privacy = PrivacyAndPolicy::first();

            if (!$privacy) {
                $privacy = new PrivacyAndPolicy();
            }
            // --------------Update Data----------------
            $privacy->update($data);
            // -----------------------------------------
            return redirect()->route('dashboard.privacyPolicy.index')->with('success', 'Privacy Policy Updated Successfully');
        } catch (\Throwable $th) {
            $function_name =  $route->getActionName();
            $check_old_errors = new SupportTicket();
            $check_old_errors = $check_old_errors->select('*')->where([
                'error_location' => $th->getFile(),
                'error_description' => $th->getMessage(),
                'function_name' => $function_name,
                'error_line' => $th->getLine(),
            ])->get();

            if ($check_old_errors->count() == 0) {
                $new_error_ticket = SupportTicket::create([
                    'error_location' => $th->getFile(),
                    'error_description' => $th->getMessage(),
                    'function_name' => $function_name,
                    'error_line' =>  $th->getLine(),
                ]);
                $end_error_ticket = $new_error_ticket;
            } else {
                $end_error_ticket = $check_old_errors->first();
            }
            return view('errors.support_tickets', compact('th', 'function_name', 'end_error_ticket'));
        }
    }
}
