<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Mission;
use App\Models\SupportTicket;
use App\Traits\SharedMethod;
use App\Traits\UploadImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Route;
use Illuminate\Support\Str;

class MissionController extends Controller
{
    use UploadImageTrait;
    use SharedMethod;

    public function index(Route $route)
    {
        try {
            $mission = Mission::first();
            return view('admin.mission.index', compact('mission'));
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
            $mission = Mission::first();
            if (!$mission) {
                $mission = new Mission();
                $mission->save();
            }
            return view('admin.mission.edit', compact('mission'));
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
        try {
            $data = $request->only([
                'title_en',
                'title_ar',
                'description_en',
                'description_ar',
            ]);

            $mission = Mission::first();

            if (!$mission) {
                $mission = new Mission();
            }
            $old_mission_image = $mission->mission_image;

            // Vision Us Image
            if ($request->hasFile('mission_image')) {
                $file = $request->file('mission_image');
                $path = $file->store('our_mission', 'public');
                $data['mission_image'] = "storage/" . $path;
            }

            // --------------Update Data----------------
            $mission->update($data);
            // -----------------------------------------

            // Delete Old Images
            if ($request->hasFile('mission_image') && file_exists($old_mission_image)) {
                unlink($old_mission_image);
            }
            return redirect()->route('dashboard.Mission.index')->with('success', 'Mission Updated Successfully');
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
