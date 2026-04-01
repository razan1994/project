<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\ConsultationRequestEmail;
use App\Mail\ContactUsEmail;
use App\Models\ContactUs;
use App\Models\ContactUsRequest;
use App\Models\SeoPage;
use App\Models\Blog;
use App\Models\ConsultationRequest;
use App\Models\Service;
use App\Models\SupportTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Log;

class FrontendController extends Controller
{

    public function index(Route $route)
    {
        try {
            $seoData = SeoPage::where('name', 'home')->first();
            $contact = ContactUs::query()->first();
            return view('frontend.index', compact('seoData', 'contact'));
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

    public function aboutUs(Route $route)
    {
        try {
            $seoData = SeoPage::where('name', 'about_us')->first();

            return view('frontend.about-us', compact('seoData'));
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

    public function services(Route $route)
    {
        try {
            $seoData = SeoPage::where('name', 'services')->first();

            return view('frontend.services', compact('seoData'));
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

    public function serviceDetails(Route $route, string $slug)
    {
        try {
            $service = Service::query()
                ->where('status', 1)
                ->where(function ($query) use ($slug) {
                    $query->where('alias_name_en', $slug)
                        ->orWhere('alias_name_ar', $slug);
                })
                ->first();

            if (!$service && is_numeric($slug)) {
                $service = Service::query()
                    ->where('status', 1)
                    ->find((int) $slug);
            }

            if (!$service) {
                abort(404);
            }

            return view('frontend.service-details', compact('service'));
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

    public function designBuildProject(Route $route)
    {
        try {

            $seoData = SeoPage::whereIn('name', ['design_build_projects', 'design_build_project'])->first();
            return view('frontend.design-build-project', compact('seoData'));
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

    public function contactUs(Route $route)
    {
        try {
            $seoData = SeoPage::where('name', 'contact_us')->first();
            $contact = ContactUs::query()->first();

            return view('frontend.contact-us', compact('seoData', 'contact'));
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

    public function submitContactUs(Request $request)
    {

        if ($request->filled('website')) {
            return redirect()->back()
                ->withInput([])
                ->with('error', 'Spam detected.');
        }

        $validator = Validator::make($request->all(), [
            'full_name' => ['required', 'string', 'min:2', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->withFragment('contact-section')
                ->with('contact_error', 'Please fix the highlighted fields and try again.');
        }

        $validated = $validator->validated();

        try {
            ContactUsRequest::query()->create($validated);
        } catch (\Throwable $e) {
            Log::error('ContactUsRequest DB error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'data' => $validated
            ]);
            return back()
                ->withFragment('contact-section')
                ->with('contact_error', 'Database error: ' . $e->getMessage());
        }

        try {
            Mail::to(config('mail.from.address'))->send(new ContactUsEmail(
                $validated['full_name'],
                $validated['email'],
                $validated['phone'],
                $validated['subject'],
                $validated['message']
            ));
        } catch (\Throwable $e) {
            Log::error('ContactUsRequest mail error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'data' => $validated
            ]);
            return back()
                ->withFragment('contact-section')
                ->with('contact_error', 'Mail error: ' . $e->getMessage());
        }

        return back()
            ->withFragment('contact-section')
            ->with('contact_success', 'Your message has been sent successfully.');
    }


    public function submitConsultationRequest(Request $request)
    {

        if ($request->filled('website')) {
            return redirect()->back()
                ->withInput([])
                ->with('error', 'Spam detected.');
        }
        try {
            $validated = $request->validate([
                'client_name' => 'required|string|max:255',
                'contact_number' => 'required|string|max:255',
                'preferred_time' => 'nullable|string|max:255',
                'building_type' => 'required|string|max:255',
                'approved_design' => 'required|string|max:255',
                'land_area' => 'required|string|max:255',
                'construction_area' => 'required|string|max:255',
                'attachments' => 'nullable|file|max:10240',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->validator)
                ->withInput()
                ->with('consultation_error', true);
        }


        if ($request->hasFile('attachments')) {
            $filePath = $request->file('attachments')->store('consultation_attachments', 'public');
            $validated['attachments'] = $filePath;
        } else {
            $validated['attachments'] = null;
        }

        ConsultationRequest::create($validated);

        Mail::to(config('mail.admin_address', config('mail.from.address')))
            ->send(new ConsultationRequestEmail($validated));

        return back()->with('consultation_success', 'Your consultation request has been submitted successfully.');
    }


    public function blogs(Route $route)
    {
        try {
            $blogs = Blog::query()
                ->where('status', 1)
                ->orderByDesc('id')
                ->paginate(9);

            return view('frontend.blogs', compact('blogs'));
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

    public function blogDetails(Route $route, string $slug)
    {
        try {
            $blog = Blog::query()
                ->where(function ($query) use ($slug) {
                    $query->where('alias_name_en', $slug)
                        ->orWhere('alias_name_ar', $slug);
                })
                ->first();

            if (!$blog) {
                abort(404);
            }

            return view('frontend.blog-details', compact('blog'));
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

    public function faqs(Route $route)
    {
        try {
            return view('frontend.faqs');
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

    public function termsAndConditions(Route $route)
    {
        try {
            return view('frontend.terms-and-conditions');
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

    public function privacyPolicy(Route $route)
    {
        try {
            return view('frontend.privacy-policy');
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

    public function gallery(Route $route)
    {
        try {
            $seoData = SeoPage::where('name', 'gallery')->first();

            // Get the main gallery with images
            $gallery = \App\Models\Gallery::with('images')->first();
            $images = $gallery ? $gallery->images()->latest()->get() : collect();

            return view('frontend.gallery', compact('seoData', 'images'));
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
