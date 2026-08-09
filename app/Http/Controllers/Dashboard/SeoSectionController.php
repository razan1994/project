<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\SeoSection;
use App\Models\SupportTicket;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class SeoSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Route $route)
    {
        try {

            return view('admin.seo-sections.index');
        } catch (\Throwable $th) {

            $function_name = $route->getActionName();

            $check_old_errors = new SupportTicket();

            $check_old_errors = $check_old_errors
                ->select('*')
                ->where([
                    'error_location' => $th->getFile(),
                    'error_description' => $th->getMessage(),
                    'function_name' => $function_name,
                    'error_line' => $th->getLine(),
                ])
                ->get();


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


            return view(
                'errors.support_tickets',
                compact(
                    'th',
                    'function_name',
                    'end_error_ticket'
                )
            );
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Route $route)
    {
        try {

            return view('admin.seo-sections.create');
        } catch (\Throwable $th) {

            $function_name = $route->getActionName();

            $check_old_errors = new SupportTicket();

            $check_old_errors = $check_old_errors
                ->select('*')
                ->where([
                    'error_location' => $th->getFile(),
                    'error_description' => $th->getMessage(),
                    'function_name' => $function_name,
                    'error_line' => $th->getLine(),
                ])
                ->get();


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


            return view(
                'errors.support_tickets',
                compact(
                    'th',
                    'function_name',
                    'end_error_ticket'
                )
            );
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, Route $route)
    {
        try {

            $seoSection = SeoSection::find($id);

            if (!$seoSection) {

                return redirect()
                    ->back()
                    ->with(
                        'error',
                        'SEO Section not found'
                    );
            }


            return view(
                'admin.seo-sections.edit',
                compact('seoSection')
            );
        } catch (\Throwable $th) {

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


            return view(
                'errors.support_tickets',
                compact(
                    'th',
                    'function_name',
                    'end_error_ticket'
                )
            );
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
