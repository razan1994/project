<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\SubService;
use App\Models\SupportTicket;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class SubServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Route $route)
    {
        try {
            return view('admin.sub-services.index');
        } catch (\Throwable $th) {
            $function_name = $route->getActionName();
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
                    'error_line' => $th->getLine(),
                ]);
                $end_error_ticket = $new_error_ticket;
            } else {
                $end_error_ticket = $check_old_errors->first();
            }
            return view('errors.support_tickets', compact('th', 'function_name', 'end_error_ticket'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Route $route)
    {
        try {
            return view('admin.sub-services.create');
        } catch (\Throwable $th) {
            $function_name = $route->getActionName();
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
                    'error_line' => $th->getLine(),
                ]);
                $end_error_ticket = $new_error_ticket;
            } else {
                $end_error_ticket = $check_old_errors->first();
            }
            return view('errors.support_tickets', compact('th', 'function_name', 'end_error_ticket'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, Route $route)
    {
        try {
            $subService = SubService::find($id);
            if (!$subService) {
                return redirect()->route('sub-services.index')->with('error', 'Sub Service not found');
            }

            return view('admin.sub-services.edit', compact('subService'));
        } catch (\Throwable $th) {
            // Error logging and support ticket creation
            $function_name = $route->getActionName();
            $check_old_errors = SupportTicket::where([
                'error_location' => $th->getFile(),
                'error_description' => $th->getMessage(),
                'function_name' => $function_name,
                'error_line' => $th->getLine(),
            ])->get();

            if ($check_old_errors->isEmpty()) {
                $new_error_ticket = SupportTicket::create([
                    'error_location' => $th->getFile(),
                    'error_description' => $th->getMessage(),
                    'function_name' => $function_name,
                    'error_line' => $th->getLine(),
                ]);
                $end_error_ticket = $new_error_ticket;
            } else {
                $end_error_ticket = $check_old_errors->first();
            }

            return view('errors.support_tickets', compact('th', 'function_name', 'end_error_ticket'));
        }
    }

}
