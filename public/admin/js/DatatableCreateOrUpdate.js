function DatatableCreateOrUpdate({
    dom_elements = 'Blfrtip', 
    order_column = 0, 
    primary_key = 'id', 
    order_type = 'desc', 
    title_report = 'Report', 
    enter_key = false,
    scroll_X = false,
    server_side = true, 
    route_index, 
    data_columns, 
    route_edit, 
    values_edit, 
    values_edit_add,
    values_edit_remove,
    route_store, 
    route_add,
    route_remove, 
    route_delete, 
    route_destroy
}){
    $(function () {   
       //TABLA
       var table = $('.data-table').DataTable({
           "pagingType": "full_numbers",
           "order": [[ order_column, order_type ]],
           "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json"
        },
           processing: true,
           search: {
            return: enter_key
            },
           searchDelay: 0,
           serverSide: server_side,
           responsive: true,
           scrollX: scroll_X,
           dom: dom_elements,
   
           buttons: [
           {
           extend: 'copy',
           footer: true,
           text: '<i class="far fa-copy"></i> Copiar a portapapeles',
           title: title_report,
           messageTop: null,
           messageBottom: null,
           titleAttr: 'Copiar a portapapeles',
           exportOptions: {
           columns: ':visible'
           },
           },
           {
           extend: 'excelHtml5',
           footer: true,
           text: '<i class="fas fa-file-excel"></i> Exportar a Excel',
           title: title_report,
           messageTop: null,
           messageBottom: null,
           titleAttr: 'Exportar a Excel',
           exportOptions: {
           columns: ':visible'
           },
           },
           {
           extend: 'colvis',
           text: '<i class="fa fa-columns" aria-hidden="true"></i> Remover Columnas',
   
           },
           ],
           
           
           
           ajax: route_index,
           columns: data_columns
           });
    
       // EDITAR VER
       $('body').on('click', '#store', function () {
           let id = $(this).data(primary_key);
   
           
           $.get(route_edit+'/'+id , function (data) {
               $('#modal-store').modal('show');
             //RECUPERA INFORMACION
             datatableData.values_edit(data);
           })
           if (id != undefined)
               {   
                   $('#title').text('Editar');
                   $('#save').text('Actualizar');
               }
               $('#title').text('Crear');
               $('#save').text('Guardar');
       });

       // EDITAR AGREGAR PRODUCTOS
       $('body').on('click', '#product_add', function () {
        let id = $(this).data(primary_key);

        
        $.get(route_edit+'/'+id , function (data) {
            $('#modal-add').modal('show');
          //RECUPERA INFORMACION
          datatableData.values_edit_add(data);
        })
    });

    // EDITAR REMOVER PRODUCTOS
    $('body').on('click', '#product_remove', function () {
        let id = $(this).data(primary_key);

        
        $.get(route_edit+'/'+id , function (data) {
            $('#modal-remove').modal('show');
          //RECUPERA INFORMACION
          datatableData.values_edit_remove(data);
        })
    });




       // CREAR
       $('#save').click(function (e) {
           e.preventDefault();
           $.ajax({
               data: $('#formulario_store').serialize(),
               url: route_store,
               type: "POST",
               dataType: 'json',
               beforeSend:function(){
                   $(".btn").prop('disabled', true);
               },
               complete: function() {
                   $(".btn").prop('disabled', false);
               },
               success: function (data) {
                   $('#modal-store').modal('hide');
                   const Toast = Swal.mixin({
                   toast: true,
                   position: 'top-end',
                   showConfirmButton: false,
                   timer: 3666,
                   timerProgressBar: true,
                   didOpen: (toast) => {
                       toast.addEventListener('mouseenter', Swal.stopTimer)
                       toast.addEventListener('mouseleave', Swal.resumeTimer)
                   }
                   });
                   Toast.fire({
                   icon: 'success',
                   title: 'Correcto',
                   text: 'El registro ha sido un éxito.',
                   });
                   table.draw('page');
               },
               error: function (data) {
                   console.log('Errorddds:', data.responseJSON.errors);
                   $.each(data.responseJSON.errors, function (key, value) {
                       let input = '#formulario_store input, select';
                       $(".invalid-feedback").text('');
                       $(input).removeClass('invalid-feedback');
                       $(input).removeClass('is-invalid');
                       $(input).addClass('is-valid');
                   });
                   $.each(data.responseJSON.errors, function (key, value) {
                    
                       let input = '#formulario_store input[name=' + key + '], select[name=' + key + ']';
                       $(input).addClass('is-invalid');
                       $('#error_'+ key).text(value[0]).addClass('invalid-feedback');
                       $('.selectpicker').selectpicker('refresh');
                   });
               }
           });
   
       });

              // ADD PRODUCT
              $('#save_add').click(function (e) {
                e.preventDefault();
                $.ajax({
                    data: $('#formulario_add').serialize(),
                    url: route_add,
                    type: "POST",
                    dataType: 'json',
                    beforeSend:function(){
                        $(".btn").prop('disabled', true);
                    },
                    complete: function() {
                        $(".btn").prop('disabled', false);
                    },
                    success: function (data) {
                        $('#modal-add').modal('hide');
                        const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3666,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                        });
                        Toast.fire({
                        icon: 'success',
                        title: 'Correcto',
                        text: 'El registro ha sido un éxito.',
                        });
                        table.draw('page');
                    },
                    error: function (data) {
                        console.log('Errorddds:', data.responseJSON.errors);
                        $.each(data.responseJSON.errors, function (key, value) {
                            let input = '#formulario_add input, select';
                            $(".invalid-feedback").text('');
                            $(input).removeClass('invalid-feedback');
                            $(input).removeClass('is-invalid');
                            $(input).addClass('is-valid');
                        });
                        $.each(data.responseJSON.errors, function (key, value) {
                         
                            let input = '#formulario_add input[name=' + key + '], select[name=' + key + ']';
                            $(input).addClass('is-invalid');
                            $('#error_'+ key).text(value[0]).addClass('invalid-feedback');
                            $('.selectpicker').selectpicker('refresh');
                        });
                    }
                });
        
            });


                   // REMOVE PRODUCT
       $('#save_remove').click(function (e) {
        e.preventDefault();
        $.ajax({
            data: $('#formulario_remove').serialize(),
            url: route_remove,
            type: "POST",
            dataType: 'json',
            beforeSend:function(){
                $(".btn").prop('disabled', true);
            },
            complete: function() {
                $(".btn").prop('disabled', false);
            },
            success: function (data) {
                $('#modal-remove').modal('hide');
                const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3666,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
                });
                Toast.fire({
                icon: 'success',
                title: 'Correcto',
                text: 'El registro ha sido un éxito.',
                });
                table.draw('page');
            },
            error: function (data) {
                console.log('Errorddds:', data.responseJSON.errors);
                $.each(data.responseJSON.errors, function (key, value) {
                    let input = '#formulario_remove input, select';
                    $(".invalid-feedback").text('');
                    $(input).removeClass('invalid-feedback');
                    $(input).removeClass('is-invalid');
                    $(input).addClass('is-valid');
                });
                $.each(data.responseJSON.errors, function (key, value) {
                 
                    let input = '#formulario_remove input[name=' + key + '], select[name=' + key + ']';
                    $(input).addClass('is-invalid');
                    $('#error_'+ key).text(value[0]).addClass('invalid-feedback');
                    $('.selectpicker').selectpicker('refresh');
                });
            }
        });

    });


   
   // ELIMINAR UN REGISTRO
       $(document).on('click', '#borrar', function(){
       let id = $(this).data(primary_key);
   
       const swalWithBootstrapButtons = Swal.mixin({
       customClass: {
           confirmButton: 'btn btn-danger',
           cancelButton: 'btn btn-outline-secondary'
       },
       buttonsStyling: false
       })
   
       swalWithBootstrapButtons.fire({
       title: '¿Seguro?',
       text: "No podrás revertir esto!",
       icon: 'warning',
       showCancelButton: true,
       confirmButtonText: '¡Sí, bórralo!',
       cancelButtonText: '¡No, cancela!',
       reverseButtons: true
       }).then((result) => {
       if (result.isConfirmed) {
           $.ajax({
           url: route_delete+'/'+id,
   
               beforeSend:function(){
                   $('#btn-eliminar').text('Eliminando...');
               },
               success:function(data){
                   setTimeout(function(){
                       $('#modal-eliminar').modal('hide');
                       swalWithBootstrapButtons.fire(
                        '¡Borrado!',
                        'El registro se ha eliminado correctamente',
                       'success'
                       );
                       table.draw();
                   }, 700);
               }
           });
   
       } else if (
           result.dismiss === Swal.DismissReason.cancel
       ) {
           swalWithBootstrapButtons.fire(
            'Cancelado',
            'Su registro está a salvo :)',
           'error'
           )
       }
       })
   
   
       });
   
   
       // borrado de clases validaciones en modal
       $(".modal").on("hidden.bs.modal", function () {  
           $(".modal .bootstrap-select, input, select").each(function() {
               $(this).removeClass('is-valid');
               $(this).removeClass('is-invalid');
               $(this).removeClass('invalid-feedback');
           });
           $(".invalid-feedback").text('');
           $(".btn").prop('disabled', false);
           $('#formulario_store')[0].reset();
           $('#id').val('')
           $('.selectpicker').selectpicker('refresh');
       }); 
   
     });
   };