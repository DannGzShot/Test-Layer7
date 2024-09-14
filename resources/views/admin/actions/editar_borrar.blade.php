<div class="text-end">
    <div class="btn-group" role="group">
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-ellipsis-vertical"></i>
            </button>
            <ul class="dropdown-menu">
                <li>
                    <button type="button" href="javascript:void(0)" data-id="{{ $row->id }}" class="dropdown-item btn btn-outline-success" id="store">
                        <i class="fa-regular fa-pen-to-square"></i> Editar
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
</div>
