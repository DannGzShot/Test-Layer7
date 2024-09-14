<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;

use App\Http\Requests\Users\PermissionsRequest;
use App\Http\Services\Users\PermissionsService;

use App\Models\User;
use App\Models\Permissions;

use Illuminate\Http\Request;

use Auth;
use Illuminate\Support\Facades\Response;
use Spatie\Permission\Exceptions\UnauthorizedException;

class PermissionsController extends Controller
{
    
    public function index(Request $request, PermissionsService $service)
    {
        if(!auth()->user()->hasAnyRole([
            'super_admin'
            ])){
                throw new UnauthorizedException(401, "You don't have access");
            }
        
        if ($request->ajax()) {
            return $service->index();
        }
        return view('admin.users.permissions');
    }

    // CREAR / EDITAR
    public function store(PermissionsRequest $request, PermissionsService $service)
    {
        $service->create($request);
        return response()->json(['success'=>'Guardado Correctamente.']);
    }
    

    // EDITAR VER
    public function edit($id)
    {
        $data = Permissions::find($id);
        return response()->json($data);
    }


    // BORRADO PERMANENTE
    public function destroy($id)
    {
        Permissions::destroy($id);
        return response()->json(['success'=>'Borrado Correctamente.']);
    }

}
