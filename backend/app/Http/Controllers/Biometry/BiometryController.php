<?php

namespace App\Http\Controllers\Biometry;

use App\Http\Controllers\Controller;
use App\Models\BiometryModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BiometryController extends Controller
{
    protected $request;

    public function registerBiometry(Request $request)
    {
        $now = Carbon::now();
        
        $interval = $now->copy()->addMinutes(10)->format('d/m/Y H:i:s');

        $data = [
            'company_id' => $request->header('__company_id'),
            'employee_id' => $request->employee_id,
            'finger' => $request->finger,
            'timestamp' => $interval
        ];

        $verifyHaveBiometry = $this->verifyIfEmployeeHaveABiometry($data['employee_id']);

        if(! $verifyHaveBiometry)
            return $this->saveNewFinger($data) ? true : false;

        return $this->updateFinger($data) ? true : false;
    }

    protected function verifyIfEmployeeHaveABiometry(int $employee_id)
    {
        $biometry = new BiometryModel();

        $biometry = $biometry->where('employee_id', $employee_id)->first();

        if(! $biometry)
            return false;

        return true;
    }

    protected function saveNewFinger($fingerData)
    {
        $biometry = new BiometryModel();

        $saveFinger = $biometry->create($fingerData);

        if(! $saveFinger)
            return false;

        return true;
    }

    protected function updateFinger($data)
    {
        foreach ($data as $key => $value) {
            DB::table('biometry')
              ->where('employee_id', $data['employee_id'])
              ->where('company_id', $data['company_id'])
              ->update([
                $key => $value !== null ? $value : ''
              ]);
          }

        return true;
    }

}
