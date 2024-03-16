<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Models\Dashboard;
use App\Models\Employee;
use App\Http\Controllers\Reports\DompdfController;
use App\Models\Companies;
use App\Models\Itens;
use App\Models\Reports;

class EmployeesReportController extends Controller
{
    protected $employeeData;
    protected $itens;
    protected $domPdf;

    public function __construct()
    {
        $this->domPdf = new DompdfController();
    }

    public function getAllReports()
    {
        $report = new Reports();

        $reports = $report->all();

        return response()->json($reports);
    }

    public function generateReport($employeeId) {
        $this->employeeData = $this->getEmployeesData($employeeId);
        $this->itens = $this->getItensData($employeeId);

        if(! $this->employeeData)
            return response()->json(['error' => true, 'msg' => 'Employee not found'], 404);

        $page = view('reports.simple.employee')->with([
            'employeeData' => $this->employeeData,
            'employeeDataItens' => $this->itens
        ]);

        $pdf = $this->domPdf->generatePdf(
            $page,
            'Relatório - ' . $this->employeeData['name']
        );

        return response()->json(['temp' => $pdf]);
    }

    protected function getItensData ($id) {
        $employee = new Employee();
        $withdraw = new Dashboard();
        $itens = new Itens();

        $employee = $employee->find($id);

        if(! $employee)
            return false;

        $numberItemsRemovedByEmployee = $withdraw->where('employee_id', $employee->id)->get();

        $itensGroup = [];
        foreach ($numberItemsRemovedByEmployee as $key => $value) {
            $theItem = $itens->where('id', $value->item_id)->first(['name', 'CA']);

            if(isset($itensGroup[$theItem->name]))
                $itensGroup[$theItem->name]['amount'] += 1;
            else
                $itensGroup[$theItem->name] = [
                    'iten' => $theItem->name,
                    'amount' => 1,
                    'CA' => $theItem->CA,
                    'date' => $value->created_at->format('d/m/Y')
                ];
        }

        return array_values($itensGroup);
    }

    protected function getEmployeesData ($id) {
        $employee = new Employee();

        $employee = $employee->find($id);

        if(! $employee)
            return false;

        $data = [
            'company' => $this->getLogoByCompany($employee->company_id),
            'name' => $employee->name,
            'role' => $employee->role,
            'date' => $employee->registered,
        ];

        return $data;
    }

    public function getLogoByCompany($companyId) {
        $company = new Companies();

        $companyData = $company->where('id', $companyId)->first(['photo', 'name']);
        
        $companyData = [
            'logo' => $companyData->photo ? env('IMAGE_SERVE_URL') . 'storage/' . $companyData->photo : 'https://protege.wolftechti.com.br/img/protege.73495e67.png',
            'name' => $companyData->name
        ];

        return $companyData;
    }

}
