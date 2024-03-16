<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\BiometryModel;
use App\Models\Employee;
use App\Models\Itens;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ItensController;
use App\Models\Reports;

class DashboardController extends Controller
{
  protected $chartColor = [
    '#3399FF',
    '#66CC99',
    '#FF6666',
    '#FFCC66',
    '#FF99CC'
  ];
  protected $itenController;
  protected $itensRequested = [];
  protected $request;
  protected $employee;
  protected $itens;
  protected $biometry;

  public function __construct(ItensController $iten, Itens $itens, Request $request)
  {
    $this->itenController = $iten;
    $this->itens = $itens;
    $this->request = $request;
  }

  public function newWithdraw()
  {
    $employees = new Employee();

    $iten = $this->checkItens();
    $this->employee = $employees->find($this->request->employee['id']);

    if (! $iten || ! $this->employee)
      return response()->json([
        'error' => true, 
        'msg' => 'Item ou funcionário não encontrado!'
      ], 404);

    $inventory = $this->checkStock();

    if(! $inventory)
      return response()->json([
        'error' => true, 
        'msg' => 'Você não possui itens no estoque suficiente!'
      ], 400);

    $biometry = $this->checkBiometry();

    if(is_null($biometry))
      return response()->json([
        'error' => true,
        'msg' => 'Funcionário não possui digital cadastrada!'
      ], 400);

    if(! $biometry)
      return response()->json([
        'error' => true, 
        'msg' => 'Digital do funcionário expirada!'
      ], 400);

    $newWithdraw = $this->registerRetreat();

    if (!$newWithdraw)
      return response()->json(['error' => true], 400);

    $this->decrementItem();
    $this->saveItensRequestedToReport();
    
    return response()->json([
      'success' => true
    ]);
  }

  protected function decrementItem()
  {
    foreach ($this->request->item as $key => $value) {
      $dec = $this->itenController->decrementItenInventory($value['id']);

      if(! $dec)
        return false;
    }

    return true;
  }

  protected function saveItensRequestedToReport()
  {
    $itensRequestedByWithdraw = new Reports();

    $itensRequestedByWithdraw->create([
      'employee_id' => $this->request->employee['id'],
      'itens_requested' => json_encode($this->itensRequested),
      'company_id' => $this->request->company_id
    ]);

    return true;
  }

  protected function registerRetreat()
  {
    $new = new Dashboard();

    $addWithdrawId = [];
    foreach ($this->request->item as $key => $value) {
      $addWithdrawId = $value;
      $addWithdrawId['withdraw_id'] = null;

      $retreatRegister = $new->create([
        'employee_id' => $this->request->employee['id'],
        'item_id' => $value['id'],
        'reason' => $this->request->reason ? $this->request->reason : 'NÃO INFORMADO',
        'company_id' => $this->request->company_id
      ]);

      if(! $retreatRegister)
        return false;

      $addWithdrawId['withdraw_id'] = $retreatRegister->id;
      $this->itensRequested[$key] = $addWithdrawId;
    }
    return true;
  }

  protected function checkStock()
  {
    foreach ($this->request->item as $key => $value) {
      $inventory = $this->itenController->checkInventory($value['id']);

      if(! $inventory)
        return false;
    }

    return true;
  }

  protected function checkItens()
  {
    foreach ($this->request->item as $key => $value) {
      $itenExists = $this->getItenById(
        $this->itens->all(), 
        $value['id']
      );

      if(is_null($itenExists))
        return false;
    }

    return true;
  }

  protected function getItenById($collect, $itenId)
  {
    foreach ($collect as $key => $value) {
      if($value['id'] == $itenId)
        return true;
    }
    return null;
  }

  protected function checkBiometry()
  {
    $biometry = new BiometryModel();
    $biometry = $biometry
      ->where('employee_id', $this->request->employee['id'])
      ->first();
    
    if (! $biometry)
      return null;

    $this->biometry = $biometry;
    
    $now = Carbon::now();

    $biometryTimestamp = Carbon::createFromFormat('d/m/Y H:i:s', $biometry->timestamp);

    if ($now->greaterThan($biometryTimestamp))
      return false;

    return true;
  }

  protected function getEmployeeById($collect, $employeeId)
  {
    foreach ($collect as $key => $value) {
      if($value['id'] == $employeeId)
        return $value;
    }
    return null;
  }

  public function retreatChampions()
  {
    $dataChart = [];
    $employees = new Employee();
    $withdraws = Dashboard::query()
      ->select('employee_id', DB::raw('COUNT(employee_id) as count'))
      ->groupBy('employee_id')
      ->orderByDesc('count')
      ->limit(5)
      ->get();

    $employeeCollect = $employees::withTrashed()->get();

    foreach ($withdraws as $key => $value) {
      $employee = $this->getEmployeeById($employeeCollect, $value->employee_id);

      $dataChart[] = [
        'name' => $employee->name,
        'photo' => $employee->image,
        'amount' => $value->count,
        'colorStatus' => $this->chartColor[$key]
      ];
    }

    return response()->json($dataChart);
  }

  public function recentWithdrawals()
  {
    $recent = new Dashboard();
    $employee = new Employee();
    $iten = new Itens();

    $data = [];

    $recent = $recent->orderBy('id', 'DESC')->get();

    foreach ($recent as $key => $value) {
      $dataEmployee = $employee::withTrashed()->where('id', $value->employee_id)->first();
      $dataIten = $iten::withTrashed()->where('id', $value->item_id)->first();

      $data[] = [
        'name' => $dataEmployee->name,
        'photo' => $dataEmployee->image,
        'role' => $dataEmployee->role,
        'iten' => $dataIten->name,
        'validity' => $dataIten->validity,
        'reason' => $value->reason,
        'created' => Carbon::parse($value->created_at)->format('Y-m-d')
      ];
    }

    return response()->json($data);
  }

  public function lowStock()
  {
    $itens = new Itens();

    $iten = $itens->where('inventory', '<=', 30)->orderBy('inventory', 'DESC')->limit(4)->get();

    return response()->json($iten);
  }

  public function allLowStock()
  {
    $itens = new Itens();

    $iten = $itens->where('inventory', '<=', 8)->get();

    return response()->json($iten);
  }
}
