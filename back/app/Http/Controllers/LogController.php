<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $per_page = $request->per_page;
            $search = $request->search;
            $query = Log::query();
            $query->select('log_users.*');
            if ($search) {
                $query->where('log_users.name', 'LIKE', '%' . $search . '%')
                    ->orWhere('log_users.login', 'LIKE', '%' . $search . '%');
                $users = $query->paginate($per_page);
            } else {
                $users = $query->paginate($per_page);
            }
            return response()->json([$users], 200);
        } catch (\Exception $e) {
            return response()->json([
                'msg' => $e->getMessage(),
                'error_linha' => $e->getLine(),
            ], 422);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Log  $log
     * @return \Illuminate\Http\Response
     */
    public function show(Log $log)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Log  $log
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Log $log)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Log  $log
     * @return \Illuminate\Http\Response
     */
    public function destroy(Log $log)
    {
        //
    }
}
