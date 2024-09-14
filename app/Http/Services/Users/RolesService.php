<?php

namespace App\Http\Services\Users;

use App\Http\Requests\Users\RolesRequest;
use App\Models\Roles;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use DataTables;

class RolesService
{
    public function index()
    {
        $data = Roles::All();

        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('actions', function($row){
                  $btn = '
                    <div class="btn-group" role="group">
                      <div class="btn-group" role="group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        Actions
                        </button>
                        <ul class="dropdown-menu">
                          <li><button type="button" href="javascript:void(0)" data-id="'.$row->id.'" class="dropdown-item btn btn-outline-success" id="store"><i class="fa-regular fa-pen-to-square"></i> Edit</button></li>
                          <li><a href="/admin/users/roles/permissions/'.$row->id.'" class="dropdown-item btn btn-outline-warning"><i class="fa-regular fa-pen-to-square"></i> Permissions</a></li>
                          <li><button type="button" href="javascript:void(0)" data-id="'.$row->id.'" class="dropdown-item btn btn-outline-danger" id="borrar"><i class="fa-solid fa-trash"></i> Delete</button></li>
                        </ul>
                      </div>
                    </div>
                  ';

                        return $btn;
                })
                ->rawColumns(['actions'])
                ->make(true); 
    }


    public function create (RolesRequest $request): Roles
    {
        $data = Roles::updateOrCreate(
            [ 
            'id' => $request->id
            ],
            [ 
            'name' => $request->name,
            'guard_name' => "web"
            ]
            );

            return $data;
    }
}