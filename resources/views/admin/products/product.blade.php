@extends('admin.layout.template')
@section('title', 'Productos')
@section('content')
 <!-- Page Heading -->
 <div class="d-sm-flex align-items-center justify-content-between mb-4">
<h4 class="fw-bold"><span class="text-muted fw-light">Dashboard /</span> <label class="text-primary"> Producto </label></h4>
</div>

<!-- Basic Bootstrap Table -->
<div class="card">
<div class="card-body">
  
   <h3> Producto: {{ $data->name }} </h3>
   <h3> Descripión: {{ $data->description }} </h3>
   <h3> Precio: {{ $data->price }} </h3>
   <h3> Cantidad: {{ $data->quantity }} </h3>
</div>
   

</div>




@endsection
