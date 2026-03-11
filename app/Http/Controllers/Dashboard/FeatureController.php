<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use App\Models\SupportTicket;
use App\Traits\SharedMethod;
use App\Traits\UploadImageTrait;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;


class FeatureController extends Controller
{
    use UploadImageTrait;
    use SharedMethod;

    public function index(Route $route)
    {
        try {
            $feature = Feature::first();
            return view('admin.feature.index', compact('feature'));
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
            $feature = Feature::first();
            if (!$feature) {
                $feature = new Feature();
                $feature->save();
            }
            return view('admin.feature.edit', compact('feature'));
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
            // feature_image can be an image or a video (mp4)
            'feature_image' => 'nullable|mimes:jpeg,png,jpg,gif,svg,mp4|max:10240',
        ]);
        try {
            $data = $request->only([
                'title_en',
                'title_ar',
                'description_en',
                'description_ar',
            ]);

            $feature = Feature::first();

            if (!$feature) {
                $feature = new Feature();
            }
            $old_feature_image = $feature->feature_image;

            // Feature Image
            if ($request->hasFile('feature_image')) {
                $file = $request->file('feature_image');
                $path = $file->store('feature', 'public');
                $data['feature_image'] = "storage/" . $path;
            }

            // --------------Update Data----------------
            $feature->update($data);
            // -----------------------------------------

            // Delete Old Images
            if ($request->hasFile('feature_image') && file_exists($old_feature_image)) {
                unlink($old_feature_image);
            }
            return redirect()->route('dashboard.feature.index')->with('success', 'Feature Updated Successfully');
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
