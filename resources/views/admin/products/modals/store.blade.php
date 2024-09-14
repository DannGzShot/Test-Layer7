 <!-- MODAL CREAR -->

 <div class="modal fade" id="modal-store" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary"><span id="title"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form id="formulario_store" name="formulario_store">
                @csrf
                <input type="hidden" name="id" id="id">
                <input type="hidden" name="created_by" id="created_by">
                    <div class="mb-3 position-relative">
                        <label class="form-label"> Nombre Producto </label>
                        <input type="text" id="name" name="name" class="form-control rounded-md shadow-sm border-gray-300">
                        <div id="error_name"></div>
                    </div>

                    <div class="mb-3 position-relative">
                        <label class="form-label"> Imagen </label>
                        <input type="file" id="img" name="img"  accept=".jpg" class="file-upload">
                    </div>


                    <div class="mb-3 position-relative">
                        <label class="form-label"> Descripción </label>
                        <input type="text" id="description" name="description" class="form-control rounded-md shadow-sm border-gray-300">
                        <div id="error_description"></div>
                    </div>

                    <div class="mb-3 position-relative">
                        <label class="form-label"> Precio </label>
                        <input type="text" id="price" name="price" class="form-control rounded-md shadow-sm border-gray-300">
                        <div id="error_price"></div>
                    </div>

                    <div class="mb-3 position-relative">
                        <label class="form-label"> Cantidad </label>
                        <input type="text" id="quantity" name="quantity" class="form-control rounded-md shadow-sm border-gray-300">
                        <div id="error_quantity"></div>
                    </div>

                    <div class="mb-3 position-relative">
                        <label class="form-label"> Cantidad Minima </label>
                        <input type="text" id="min_quantity" name="min_quantity" class="form-control rounded-md shadow-sm border-gray-300">
                        <div id="error_min_quantity"></div>
                    </div>

                    <div class="mb-3 position-relative">
                        <label class="form-label"> Cantidad Máxima </label>
                        <input type="text" id="max_quantity" name="max_quantity" class="form-control rounded-md shadow-sm border-gray-300">
                        <div id="error_max_quantity"></div>
                    </div>



                  </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
               
                    <button type="submit" class="btn btn-success" id="save">Guardar</button>
                
            </div>
        </div>
    </div>
</div>