<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\SupportTicket;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Route $route)
    {
        try {
            return view('admin.projects.index');
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

    /**
     * Show the form for creating a new resource.
     */
    public function create(Route $route)
    {
        try {
            return view('admin.projects.create');
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


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, Route $route)
    {
        try {
            $project = Project::find($id);
            if (!$project) {
                return redirect()->back()->with('error', 'Project not found');
            }

            return view('admin.projects.edit', compact('project'));
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


    public function gallery($id)
    {
        $project = Project::with('media')->find($id);
        if (!$project) {
            return redirect()->back()->with('error', 'Project not found');
        }
        return view('admin.projects.gallery', compact('project'));
    }
}
