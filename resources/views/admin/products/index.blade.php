@extends('admin.layout.template')
@section('title', 'Productos')
@section('content')
 <!-- Page Heading -->
 <div class="d-sm-flex align-items-center justify-content-between mb-4">
<h4 class="fw-bold"><span class="text-muted fw-light">Dashboard /</span> <label class="text-primary"> Productos </label></h4>
<a href="javascript:void(0)" id="store"class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm"><i class="fa-solid fa-plus"></i> Crear </a>
</div>

<!-- Basic Bootstrap Table -->
<div class="card">
<div class="card-body">
        <table class="table table-responsive table-hover table-striped data-table">
              <thead>
                <tr>
                    <th> ID </th>
                    <th> IMAGEN </th>
                    <th> PRODUCTO </th>
                    <th> PRECIO </th>
                    <th> CANTIDAD </th>
                    <th> CANTIDAD MAXIMA </th>
                    <th> CANTIDAD MINIMA </th>
                    <th> DESCRIPCIÓN </th>
                    <th> USUARIO </th>
                    <th class="text-primary" width="113px"><i class="fa fa-filter" aria-hidden="true"></i> Acciones</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0">
              </tbody>
              <tfoot>

                <tr>
                    <th> ID </th>
                    <th> IMAGEN </th>
                    <th> PRODUCTO </th>
                    <th> PRECIO </th>
                    <th> CANTIDAD </th>
                    <th> CANTIDAD MAXIMA </th>
                    <th> CANTIDAD MINIMA </th>
                    <th> DESCRIPCIÓN </th>
                    <th> USUARIO </th>
                    <th class="text-primary"><i class="fa fa-filter" aria-hidden="true"></i> Acciones</th>
                </tr>
              </tfoot>
         </table>
</div>
   

</div>

@include('admin.products.modals.store')
@include('admin.products.modals.add')
@include('admin.products.modals.remove')


@endsection

@section('javascript') 
<script type="text/javascript">
const datatableData = {
    dom_elements: 'Blfrtip',
    order_column: 0,
    title_report: 'Reporte Reportes',
    route_index: '{{ route('products.index') }}', 
    data_columns: [
            {data: 'id'},
            {data: 'img'},
            {data: 'name'},
            {data: 'price'},
            {data: 'quantity'},
            {data: 'max_quantity'},
            {data: 'min_quantity'},
            {data: 'description'},
            {data: 'created_by.name'},
            {data: 'actions'},
        ], 
    route_edit: '{{ route('products.edit') }}', 
    values_edit: function(data) {
        $('#id').val(data.id);
        $('#created_by').val(data.created_by);
        $('#name').val(data.name);
        $('#description').val(data.description);
        $('#price').val(data.price);
        $('#quantity').val(data.quantity);
        $('#max_quantity').val(data.max_quantity);
        $('#min_quantity').val(data.min_quantity);
        $('.selectpicker').selectpicker('render');
        $('.selectpicker').selectpicker('refresh');

    },
    values_edit_add: function(data) {
        $('#product_add_id').val(data.id);
        $('#product_add_name').text(data.name);
        $('#product_add_quantity').text(data.quantity);

    },
    values_edit_remove: function(data) {
        $('#product_remove_id').val(data.id);
        $('#product_remove_name').text(data.name);
        $('#product_remove_quantity').text(data.quantity);
    },
    route_store: '{{ route('products.store') }}', 
    route_add: '{{ route('products.add') }}', 
    route_remove: '{{ route('products.remove') }}', 


};
DatatableCreateOrUpdate(datatableData);
</script>
@stop 