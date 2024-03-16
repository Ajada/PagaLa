<?php

namespace App\Http\Controllers;

use App\Models\Itens;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItensController extends Controller
{
  public function index()
  {
    $item = new Itens();

    return response()->json($item->all());
  }

  public function store(Request $request)
  {
    $item = new Itens();

    $data = $request->all();

    $new = $item->createItem($data);

    if (!$new)
      return response()->json([
        'error' => true,
        'msg' => 'Erro ao adicionar item!'
      ]);

    return response()->json(['success' => true, 'msg' => 'Item adicionado com sucesso!']);
  }

  public function show($id)
  {
    $item = new Itens();

    $item = $item->find($id);

    if (!$item)
      return response()->json([
        'error' => true,
        'msg' => 'Nenhum item encontrado!'
      ], 404);

    return response()->json($item);
  }

  public function update(Request $request, $id)
  {
    $iten = new Itens();
    $formatIten = $iten->formatBody($request->all());

    foreach ($formatIten as $key => $value) {
      DB::table('itens')
        ->whereId($id)
        ->update([
          $key => $value
        ]);
    }

    return response()->json(['success' => true], 204);
  }

  public function destroy($id)
  {
    $item = new Itens();
    $item = $item->find($id);

    if (!$item)
      return response()
        ->json([
          'error' => true,
          'message' => 'Item não encontrado!'
        ]);

    $item
      ->whereId($id)
      ->delete();

    return response()->json(
      $item ? ['success' => true] : ['error' => true]
    );
  }

  public function getCollect()
  {
    $item = new Itens();
  
    return $item->all();
  }

  public function checkInventory($id)
  {
    $item = new Itens();

    $inventory = $item->where('id', $id)->first();

    if($inventory->inventory <= 0)
      return false;

    return true;
  }

  public function decrementItenInventory($id, $amount = 1)
  {
    $item = new Itens();

    $iten = $item
      ->where('id', $id)
      ->decrement('inventory', $amount);

    if(! $iten)
      return false;

    return true;
  }

}
