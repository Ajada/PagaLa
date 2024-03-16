<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
  public function index()
  {
    $employee = new Employee();

    return response()->json($employee->all());
  }

  public function allWithTrashed()
  {
    $employee = new Employee();

    return response()->json($employee::withTrashed()->get());
  }

  public function store(Request $request) // if user exists, send update flow
  {
    $employee = new Employee();

    $new = $employee->createItem($request->all());

    if (!$new)
      return response()->json([
        'error' => true,
        'msg' => 'Erro ao adicionar functionário!'
      ]);

    return response()->json(['success' => true, 'msg' => 'Funcionário adicionado com sucesso!']);
  }

  public function show($id)
  {
    $employee = new Employee();

    $employee = $employee->find($id);

    if (!$employee)
      return response()->json([
        'error' => true,
        'msg' => 'Nenhum usuario encontrado!'
      ], 404);

    return response()->json($employee);
  }

  public function update(Request $request, $id)
  {
    $employee = new Employee();

    $formatRequest = $employee->formatBody($request->all());

    foreach ($formatRequest as $key => $value) {
      DB::table('employees')
        ->whereId($id)
        ->update([
          $key => $value !== null ? $value : ''
        ]);
    }

    return response()->json(['success' => true], 204);
  }

  public function destroy($id)
  {
    $employee = new Employee();
    $employee = $employee->find($id);

    if (!$employee)
      return response()
        ->json([
          'error' => true,
          'message' => 'Funcionário não encontrado!'
        ]);

    $employee
      ->whereId($id)
      ->delete();

    return response()->json(
      $employee ? ['success' => true] : ['error' => true]
    );
  }

  public function getCollect()
  {
    $employees = new Employee();

    $employee = $employees->all();

    return $employee;
  }

  public function findIdByCollect($collect, $id)
  {
    foreach ($collect as $key => $value) {
      if($value->id == $id)
        return $value;
    }
  }

}
