<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Reports\DompdfController;
use App\Models\BiometryModel;
use App\Models\Companies;
use App\Models\Dashboard;
use App\Models\Employee;
use App\Models\Itens;
use App\Models\Reports;

class WithdrawController extends Controller
{
    protected $domPdf;
    protected $request;
    protected $itens;
    protected $employee;
    protected $company;

    public function __construct(Request $request)
    {
        $this->domPdf = new DompdfController();
        $this->request = $request;
    }

    public function generateReport($id) 
    {
        $reports = new Reports();

        $report = $reports->find($id);

        $collect = json_decode($report->itens_requested, 1);

        $itenReportData = $this->getReasonAndItenNameByItenRequested($collect);
        $employeeReportData = $this->getEmployeeData($report['employee_id']);
        $companyReportData = $this->getCompanydata();

        $page = view('reports.simple.withdraw')->with([
            'itens' => $itenReportData,
            'employee' => $employeeReportData,
            'company' => $companyReportData
        ])->render();

        return $page;
    }

    protected function getReasonAndItenNameByItenRequested(Array $collect)
    {
        $withdrawItens = new Dashboard();
        $arr = [];

        foreach ($collect as $key => $value) {
            $getItenReason = $withdrawItens->find($value['withdraw_id'])->reason;
            $getItenName = $value['name'];

            $arr[] = [
                'name' => $getItenName,
                'reason' => $getItenReason
            ];
        }

        return $arr;
    }

    protected function findNameByItenId($id) // remove
    {
        $itens = new Itens();
        $iten = $itens::withTrashed()->find($id);

        return $iten->name;
    }

    public function getEmployeeData($id)
    {
        $employee = new Employee();

        $employee = $employee::withTrashed()->find($id);

        if(! $employee)
            return false;

        $this->employee = [
            'name' => $employee['name'],
            'role' =>$employee['role'],
            'registered' => $employee['registered'],
            'signature' => $this->getBiometry($id),
        ];

        return $this->employee;
    }

    protected function getBiometry($employee_id)
    {
        $biometry = new BiometryModel();

        $biometry = $biometry->where('employee_id', $employee_id)->first('finger');

        return env('IMAGE_SERVE_URL') . 'storage/' .  $biometry->finger;
    }

    public function getCompanydata()
    {
        $company = new Companies();

        $companyData = $company->where('id', $this->request->header('__company_id'))->first(['id', 'photo', 'name']);
        
        $checkIfExistsLogo = $companyData->photo 
            ? env('IMAGE_SERVE_URL') . 'storage/' . $companyData->photo 
            : 'https://protege.wolftechti.com.br/img/protege.73495e67.png';

        $company = [
            'logo' => str_replace('\/', '/', $checkIfExistsLogo),
            'name' => $companyData->name
        ];

        return $company;
    }
}
