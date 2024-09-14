<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;

use App\Http\Requests\Users\RolesRequest;
use App\Http\Services\Users\RolesService;

use App\Models\User;
use App\Models\Roles;
use App\Models\Permissions;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Response;
use Spatie\Permission\Exceptions\UnauthorizedException;

class RolesController extends Controller
{
   
    public function index(Request $request, RolesService $service)
    {
        if(!auth()->user()->hasAnyRole([
            'super_admin'
            ])){
                throw new UnauthorizedException(401, "You don't have access");
            }

        if ($request->ajax()) {
            return $service->index();
        }
        return view('admin.users.roles');
    }
    
    public function store(RolesRequest $request, RolesService $service)
    {
        $service->create($request);
        return response()->json(['success'=>'Guardado Correctamente.']);
    }

    // EDITAR VER
    public function edit($id)
    {
        $data = Roles::find($id);
        return response()->json($data);
    }
    

    // BORRADO PERMANENTE
    public function destroy($id)
    {
        Roles::destroy($id);
        return response()->json(['success'=>'Borrado Correctamente.']);
    }

    // INDEX DE PERMISOS EN ROLES
    public function index_roles_permission($id){
        if(!auth()->user()->hasAnyRole([
            'super_admin'
            ])){
                throw new UnauthorizedException(401, "You don't have access");
            }


        $permissions = Permissions::get();
        $permissions_by_role = Role::find($id)->permissions;
        
        return view('admin.users.roles_permissions', compact('permissions', 'permissions_by_role', 'id'));
    }


    // ASIGNAR PERMISOS A ROLES
    public function roles_permission_store(Request $request, $id){
        
        $role = Role::find($id);
        $permission = Permission::find($request->permission_id);
        if($request->status == 1){
           $role->revokePermissionTo($permission);
        }else if($request->status == 0){
           $role->givePermissionTo($permission);
        }

        return response()->json(['success'=>'Guardado Correctamente.']);
    }

    
}
