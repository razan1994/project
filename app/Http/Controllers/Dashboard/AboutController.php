<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\SupportTicket;
use App\Traits\SharedMethod;
use App\Traits\UploadImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Route;
use Illuminate\Support\Str;

class AboutController extends Controller
{
    use UploadImageTrait;
    use SharedMethod;

    public function index(Route $route)
    {
        try {
            $about = About::first();
            return view('admin.about-us.index', compact('about'));
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
            $about = About::first();
            if (!$about) {
                $about = new About();
                $about->save();
            }
            return view('admin.about-us.edit', compact('about'));
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
            // about_us_image can be an image or a video (mp4)
            'about_us_image' => 'nullable|mimes:jpeg,png,jpg,gif,svg,mp4|max:10240',
        ]);
        try {
            $data = $request->only([
                'title_en',
                'title_ar',
                'description_en',
                'description_ar',
            ]);

            $about = About::first();

            if (!$about) {
                $about = new About();
            }
            $old_about_us_image = $about->about_us_image;

            // About Us Image
            if ($request->hasFile('about_us_image')) {
                $file = $request->file('about_us_image');
                $path = $file->store('about_us', 'public');
                $data['about_us_image'] = "storage/" . $path;
            }

            // --------------Update Data----------------
            $about->update($data);
            // -----------------------------------------

            // Delete Old Images
            if ($request->hasFile('about_us_image') && file_exists($old_about_us_image)) {
                unlink($old_about_us_image);
            }
            return redirect()->route('dashboard.aboutUs.index')->with('success', 'About Us Updated Successfully');
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
