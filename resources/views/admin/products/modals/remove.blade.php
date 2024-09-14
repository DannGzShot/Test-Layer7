 <!-- MODAL CREAR -->

 <div class="modal fade" id="modal-remove" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary">Retirar productos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form id="formulario_remove" name="formulario_remove">
                @csrf
                <input type="hidden" name="product_remove_id" id="product_remove_id">
                <div class="mb-3 position-relative">
                    <p> Nombre Producto: <span id="product_remove_name"></span></p>
                    <p> Cantidad Actual: <span id="product_remove_quantity"></span></p>
                </div>

                    <div class="mb-3 position-relative">
                        <label class="form-label"> Cantidad a retirar </label>
                        <input type="number" id="quantity" name="quantity" class="form-control rounded-md shadow-sm border-gray-300">
                        <div id="error_quantity"></div>
                    </div>




                  </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
               
                    <button type="submit" class="btn btn-success" id="save_remove">Guardar</button>
                
            </div>
        </div>
    </div>
</div>

