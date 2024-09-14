<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;

use App\Http\Requests\Users\UserRequest;
use App\Http\Services\Users\UserService;

use App\Models\User;
use App\Models\Roles;

use App\Http\Controllers\FiltersController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Spatie\Permission\Exceptions\UnauthorizedException;


use function PHPUnit\Framework\throwException;

class UsersController extends Controller
{
    public function index(Request $request, UserService $service)
    {
        if(!auth()->user()->hasAnyRole([
            'super_admin'
            ])){
                throw new UnauthorizedException(401, "You don't have access");
            }

        if ($request->ajax()) {
            return $service->index();
        }
        
        $roles = Roles::all();

        return view('admin.users.users',compact('roles'));
    }

    
    // CREAR / EDITAR
    public function store(UserRequest $request, UserService $service)
    {
        $service->create($request);
        return response()->json(['success'=>'Guardado Correctamente.']);
    }


    // EDITAR VER
    public function edit($id)
    {
        $data = User::with('roles')->find($id);
        return response()->json($data);
    }
    

    // BORRAR
    public function delete($id)
    {
        User::find($id)->update(['deleted_at' => now(), 'deleted_by' => auth()->user()->id]);
        return response()->json(['success'=>'Borrado Correctamente.']);
    }


    // BORRAR PERMANENTE
    public function destroy($id)
    {
        User::destroy($id);
        return response()->json(['success'=>'Borrado Correctamente.']);
    }


}
