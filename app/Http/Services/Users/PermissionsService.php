<?php

namespace App\Http\Services\Users;

use App\Http\Requests\Users\PermissionsRequest;
use App\Models\Permissions;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use DataTables;

class PermissionsService
{
    public function index()
    {
        $data = Permissions::All();

        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('Actions', function($row){
                  $btn = '
                    <div class="btn-group" role="group">
                      <div class="btn-group" role="group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        Actions
                        </button>
                        <ul class="dropdown-menu">
                          <li><button type="button" href="javascript:void(0)" data-id="'.$row->id.'" class="dropdown-item btn btn-outline-success" id="store"><i class="fa-regular fa-pen-to-square"></i> Edit</button></li>
                          <li><button type="button" href="javascript:void(0)" data-id="'.$row->id.'" class="dropdown-item btn btn-outline-danger" id="borrar"><i class="fa-solid fa-trash"></i> Delete</button></li>
                        </ul>
                      </div>
                    </div>
                  ';

                        return $btn;
                })
                ->rawColumns(['Actions'])
                ->make(true); 
    }


    public function create (PermissionsRequest $request): Permissions
    {
        $data = Permissions::updateOrCreate(
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