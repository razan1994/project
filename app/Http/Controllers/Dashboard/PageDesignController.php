<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\PageDesign;
use App\Models\SupportTicket;
use App\Traits\SharedMethod;
use App\Traits\UploadImageTrait;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class PageDesignController extends Controller
{
    use UploadImageTrait;
    use SharedMethod;

    public function index(Route $route)
    {
        try {
            $pageDesign = PageDesign::first();
            return view('admin.page-design.index', compact('pageDesign'));
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
            $pageDesign = PageDesign::first();
            if (!$pageDesign) {
                $pageDesign = new PageDesign();
                $pageDesign->save();
            }
            return view('admin.page-design.edit', compact('pageDesign'));
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
            'title_en' => 'required|string|max:255',
            'title_ar' => 'nullable|string|max:255',
            'description_en' => 'required|string',
            'description_ar' => 'nullable|string',
            // image can be an image or a video (mp4)
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg,mp4|max:10240',
        ]);
        try {
            $data = $request->only([
                'title_en',
                'title_ar',
                'description_en',
                'description_ar',
            ]);

            $pageDesign = PageDesign::first();

            if (!$pageDesign) {
                $pageDesign = new PageDesign();
            }
            $old_image = $pageDesign->image;

            // Image
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $path = $file->store('page_design', 'public');
                $data['image'] = "storage/" . $path;
            }

            // --------------Update Data----------------
            $pageDesign->update($data);
            // -----------------------------------------

            // Delete Old Images
            if ($request->hasFile('image') && file_exists($old_image)) {
                unlink($old_image);
            }
            return redirect()->route('dashboard.pageDesign.index')->with('success', 'Page Design Updated Successfully');
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
