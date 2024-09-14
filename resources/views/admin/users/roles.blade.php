@extends('admin.layout.template')
@section('title', 'Roles')
@section('content')

<div class="row py-3 mb-4">
    <div class="col-md">
        <h4 class="fw-bold"><span class="text-muted fw-light">Users / </span> <label class="text-primary">Roles</label></h4>
    </div>
    <div class="col-md-6 d-flex flex-row-reverse bd-highlight">
        @if(!Auth::user()->hasrole(['']))
        <a class="btn btn-success" href="javascript:void(0)" id="store"><i class="fa-solid fa-plus"></i> Create </span></a> 
        @endif
    </div>
</div>

<!-- Basic Bootstrap Table -->
<div class="card">
<div class="card-body">
    <div class="table-responsive">
        <table class="table table-hover table-striped data-table">
              <thead>
                <tr>
                <th class="text-primary"> Role Name </th>
                  <th class="text-primary" width="113px"><i class="fa fa-filter" aria-hidden="true"></i> Actions </th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0">
              </tbody>
              <tfoot>

                <tr>
                <th class="text-primary"> Role Name </th>
                  <th class="text-primary"><i class="fa fa-filter" aria-hidden="true"></i> Actions </th>
                </tr>
              </tfoot>
         </table>
         </div>  
</div>
   

</div>

          <!-- MODAL CREAR -->

          <div class="modal fade" id="modal-store" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary"><span id="title"></span> </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form id="formulario_store" name="formulario_store">
                    @csrf
                    <input type="hidden" name="id" id="id">
                        <div class="mb-3 position-relative">
                            <label class="form-label">Rol Name <b class="text-danger">*</b></label>
                            <input type="text" id="name" name="name" class="form-control rounded-md shadow-sm border-gray-300" placeholder="Role Name" maxlength="55" required>
                            <div id="error_name"></div>
                        </div>
                      </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    @if(!Auth::user()->hasrole(['']))
                        <button type="submit" class="btn btn-success" id="save">Save</button>
                    @endif
                </div>
            </div>
        </div>
    </div>

@stop

@section('javascript') 

<script type="text/javascript">
const datatableData = {
    dom_elements: 'Blfrtip',
    order: 0,
    order_type: 'ASC',
    title_report: 'Report Roles',
    route_index: '{{ route('roles.index') }}', 
    data_columns: [
            {data: 'name'},
            {data: 'actions'},
        ], 
    route_edit: '{{ route('roles.edit') }}', 
    values_edit: function(data) {
        $('#id').val(data.id); 
        $('#name').val(data.name);
    },
    route_store: '{{ route('roles.store') }}', 
    route_destroy: '{{ route('roles.destroy') }}'


};
DatatableCreateOrUpdate(datatableData);

</script>

@stop 