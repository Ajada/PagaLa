<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Roles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function index($uuid)
    {
        $me = new User();
        $roles = new Roles();

        $me = $me->find($uuid);

        if (!$me)
            return response()->json(['error' => 'Usuario não encontrado!'], 404);

        $me->roles_id = $roles->where('id', $me->roles_id)->first()->name;

        return response()->json($me);
    }

    public function store(Request $request)
    {
    }

    public function show(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        foreach ($request->all() as $key => $value) {
            if($key != 'role')
                DB::table('users')
                    ->whereId($id)
                    ->update([
                        $key => $value
                    ]);
        }

        return response()->json(['success' => true]);
    }

    public function destroy(string $id)
    {
        //
    }
}
