<div class="text-end">
    @if (Auth::user()->hasRole('super_admin') || Auth::user()->ownsContent($row->id))
        <div class="btn-group" role="group">
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                </button>
                <ul class="dropdown-menu">
                    <li>
                        <a target="_blank" href="/admin/products/{{ $row->id }}" class="dropdown-item btn btn-outline-primary">
                            <i class="fa-regular fa-eye"></i> Ver detalle
                        </a>
                    </li>
                    
                    <li>
                        <button type="button" href="javascript:void(0)" data-id="{{ $row->id }}" class="dropdown-item btn btn-outline-success" id="store">
                            <i class="fa-regular fa-pen-to-square"></i> Editar
                        </button>
                    </li>

                    <li>
                        <button type="button" href="javascript:void(0)" data-id="{{ $row->id }}" class="dropdown-item btn btn-outline-success" id="product_add">
                            <i class="fa-regular fa-plus"></i> Agregar producto
                        </button>
                    </li>

                    <li>
                        <button type="button" href="javascript:void(0)" data-id="{{ $row->id }}" class="dropdown-item btn btn-outline-success" id="product_remove">
                            <i class="fa-regular fa-minus"></i> Retirar Producto
                        </button>
                    </li>
                   
                    <li>
                        <button type="button" href="javascript:void(0)" data-id="{{ $row->id }}" class="dropdown-item btn btn-outline-danger" id="borrar">
                            <i class="fa-solid fa-trash"></i> Borrar
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    @else
        <div class="btn-group" role="group">
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" disabled>
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                </button>
            </div>
        </div>
    @endif
</div>