@extends('admin.layout.template')
@section('title', 'Roles - Permissions')
@section('content')

<div class="row py-3 mb-4">
    <div class="col-md">
        <h4 class="fw-bold"><span class="text-muted fw-light">Users / Roles / </span> <label class="text-primary">Permissions</label></h4>
    </div>
    <div class="col-md-6 d-flex flex-row-reverse bd-highlight">
       
    </div>
</div>

<!-- Basic Bootstrap Table -->
<div class="card">
<div class="card-body">
    <div class="table-responsive">
    <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th class="text-primary"> Permission name </th>
                    <th class="text-primary"> Add / Remove </th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0" id="tableInspectionReports">
                @foreach($permissions as $permission)
                <tr>
                    <td>
                        <strong>{{$permission->name}}</strong>
                    </td>
                    <td>
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input set-status" type="checkbox" id="{{$permission->id}}" data-status="{{ $permissions_by_role->contains('id', $permission->id) ? 1 : 0 }}" data-permission-id="{{ $permission->id }}" {{ $permissions_by_role->contains('id', $permission->id) ? "checked='checked'" : "" }}>
                        <label class="form-check-label" for="{{$permission->id}}"></label>
                    </div>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
         </div>  
</div>
   

</div>
@stop

@section('javascript') 

<script>
    $(document).ready(function() {
        $(".set-status").on('click', function() {
            let selector = $(this).attr('id');
            let status = $("#"+selector).data('status');
            $.ajax({
                url: '{{URL("/admin/users/roles/permissions/store/".$id."")}}',
                dataType: 'json',
                data: {
                    permission_id: $(this).data('permission-id'),
                    status: status,
                },
                beforeSend: function() {
                },
                complete: function() {
                },
                success: function(json) {
                    $("#"+selector).removeData('status');
                    $("#"+selector).attr('data-status', (status == 1 ? 0 : 1));
                }
            });
        });
    });
</script>

@stop 
