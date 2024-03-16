<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Companies;
use App\Models\Notify;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($uuid)
    {
        $user = new User();
        $user = $user->find($uuid);

        if (!$user)
            return response()->json(['error' => true], 404);

        $company = new Companies();
        $company = $company->find($user->company_id);

        if (!$company)
            return response()->json(['error' => true, 'msg' => 'Empresa não encontrada'], 404);

        return response()->json($company);
    }

    public function confirmIfExists($companyUuid)
    {
        $company = new Companies();
        $company = $company->find($companyUuid);

        if (!$company)
            return response()->json(['error' => true], 404);

        return response()->json($company);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $company = new Companies();

        $new = $company->create($request->all());

        if (!$new)
            return response()->json(['error' => true]);

        return response()->json(['success' => true]);
    }

    public function getNotificationData($id) 
    {
        $notifications = new Notify();

        $data = $notifications->where('user_id', $id)->first();

        if(! $data)
            return response()->json(['error' => true], 404);

        return response()->json($data);
    }

    public function registerNotificationsInfo(Request $request)
    {
        $notification = new Notify();

        $find = $notification->where('user_id', $request->user_id)->first();

        if($find) {
            foreach ($request->all() as $key => $value) {
                DB::table('notify_email')
                    ->where('user_id', $request->user_id)
                    ->update([
                        $key => $value ? $value : ''
                    ]);
            }
            return response()->json(['success' => true]);    
        }

        $notification = $notification->create($request->all());

        if(! $notification)
            return response()->json(['error' => true]);
        
        return response()->json(['success' => true]);
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
        $user = new User();
        $user = $user->find($id);

        $company = new Companies();
        $company = $company->find($user->company_id);

        foreach ($request->all() as $key => $value) {
            DB::table('companies')
                ->whereId($company->id)
                ->update([
                    $key => $value
                ]);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
