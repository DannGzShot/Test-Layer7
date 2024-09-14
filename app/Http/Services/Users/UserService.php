<?php

namespace App\Http\Services\Users;

use App\Http\Requests\Users\UserRequest;
use App\Models\User;
use Spatie\Permission\Models\Role;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\Registered;
use DataTables;

class UserService
{
    public function index()
    {
        $data = User::all();

        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('actions', function($row) {
                  return view('admin.actions.editar_borrar', compact('row'));
                })
                ->rawColumns(['actions'])
                ->make(true); 
    }

    public function create(UserRequest $request): User
    {
        // Buscar si ya existe un usuario con el mismo id
        $existing_user = User::find($request->id);
    
        // Si el usuario no existe, crear uno nuevo
        if (!$existing_user) {
            $data = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'id_supplier' => $request->id_supplier,
                'id_branch' => $request->id_branch
            ]);
    
            // Asignar el rol al nuevo usuario
            $role_user = Role::findById($request->id_role);
            $data->assignRole($role_user->name);
    
            // Disparar el evento Registered
            event(new Registered($data));
    
            return $data;
        }
    
        // Si el usuario ya existe, simplemente actualizar sus datos
        $updates = [
          'name' => $request->name,
          'email' => $request->email
      ];
      
      if ($request->filled('password')) {
          $updates['password'] = Hash::make($request->password);
      }
      $existing_user->update($updates);
        // Actualizar el rol del usuario
        $role_user = Role::findById($request->id_role);
        $existing_user->syncRoles([$role_user->name]);
    
        return $existing_user;
    }
    
}