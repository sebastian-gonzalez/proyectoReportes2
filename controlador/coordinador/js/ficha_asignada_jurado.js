$(document).ready(function () {
    var id_ficha, opcion;
    opcion = 4;
  
    tablaFichas = $("#tablaFichas").DataTable({
      ajax: {
        url: "../../controlador/coordinador/asignar_fichas_jurado.php",
        method: "POST", //usamos el metodo POST
        data: { opcion: opcion }, //enviamos opcion 4 para que haga un SELECT
        dataSrc: "",
      },
      columns: [
        { data: "id_ficha" },
        { data: "titulo_ficha" },
        { data: "descripcion_ficha" },
        { data: "nombre_pro" },
        { data: "nombre_estado" },
        { data: "evaluacion_ficha" },
        { data: "fecha_ficha" },
        {
          defaultContent:
            "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btnParticipantes margin-boton'  tooltip-dir='top' title='Integrantes'><i class='material-icons'>groups</i></button></button><button class='btn btn-primary btn-sm btnRevision1 margin-boton'  tooltip-dir='top' title='Ver mas'><i class='material-icons'>control_point</i></button></div></div>",
        },
      ],
    });
  
    var fila; //captura la fila, para editar o eliminar
    //submit para el Alta y Actualización
    $("#formFichas").submit(function (e) {
      e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
  
      
      titulo_ficha = $.trim($("#titulo_ficha").val());
      descripcion_ficha = $.trim($("#descripcion_ficha").val());
      id_programa_ficha = $.trim($("#id_programa_ficha").val());
      id_estado_ficha = $.trim($("#id_estado_ficha").val());
      evaluacion_ficha = $.trim($("#evaluacion_ficha").val());
      archivo = "#archivo";
      $.ajax({
        url: "../../controlador/coordinador/asignar_fichas_jurado.php",
        type: "POST",
        datatype: "json",
        data: {
           
          id_ficha: id_ficha,
          titulo_ficha: titulo_ficha,
          descripcion_ficha: descripcion_ficha,
          id_programa_ficha: id_programa_ficha,
          id_estado_ficha: id_estado_ficha,
          evaluacion_ficha: evaluacion_ficha,
  
          opcion: opcion,
        },
        success: function (data) {
          tablaFichas.ajax.reload(null, false);
        },
      });
      $("#modalCRUD").modal("hide");
    });
  
    //para limpiar los campos antes de dar de Alta una Persona
    $("#btnNuevo").click(function () {
      opcion = 1; //alta
      id_ficha = null;
      $("#formFichas").trigger("reset");
      $(".modal-header").css("background-color", "#0050a0");
      $(".modal-header").css("color", "white");
      $(".modal-title").text("Agregar Ficha");
      $("#modalCRUD").modal("show");
    });
  


    
  $("#btneditarusuarios").click(function () {
   
    $("#formFichas").trigger("reset");
    $(".modal-header").css("background-color", "#0050a0");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Agregar Ficha");
    $("#modalCRUD1").modal("show");
  });
  
    $(document).on("click", ".btnParticipantes", function () {
      fila = $(this);
      id_ficha = parseInt($(this).closest("tr").find("td:eq(0)").text());
      $.ajax({
        url: "../../controlador/coordinador/captador_Datos.php",
        
        type: "POST",
        data: { 
          "id_fichas": id_ficha,
        },
       success: function (data) {
     
        $("#id").html(data)
          $(".modal-header").css("background-color", "#0050a0");
          $(".modal-header").css("color", "white");
          $(".modal-title").text("Participantes de esta ficha");
          $("#modalParticipantes").modal("show");
        },
      });
      $("#modalParticipantes").modal("hide");
    });
    
  

    
//TEXTO FLOTANTE BOTON
document.addEventListener('DOMContentLoaded', function() {
  let button = document.getElementById('btnParticipantes');
  button.setAttribute('tooltip-dir', top);
});


    //Editar
    $(document).on("click", ".btnEditar", function () {
      opcion = 2; //editar
      fila = $(this).closest("tr");
      id_ficha = parseInt(fila.find("td:eq(0)").text()); //capturo el ID
      titulo_ficha = fila.find("td:eq(1)").text();
      descripcion_ficha = fila.find("td:eq(2)").text();
      id_programa_ficha = fila.find("td:eq(3)").text();
      id_estado_ficha = fila.find("td:eq(4)").text();
      evaluacion_ficha = fila.find("td:eq(5)").text();
  
      $("#titulo_ficha").val(titulo_ficha);
      $("#descripcion_ficha").val(descripcion_ficha);
      $("#id_programa_ficha").val(id_programa_ficha);
      $("#id_estado_ficha").val(id_estado_ficha);
      $("#evaluacion_ficha").val(evaluacion_ficha);
  
      $(".modal-header").css("background-color", "#0050a0");
      $(".modal-header").css("color", "white");
      $(".modal-title").text("Editar Ficha");
      $("#modalCRUD").modal("show");
    });
  
   //Revisar Ficha
  
   $(document).on("click", ".btnRevision1", function () {
    fila = $(this);
    id_ficha = parseInt($(this).closest("tr").find("td:eq(0)").text());
    opcion = 3; //eliminar
    location.href = "info_ficha.php?ficha=" + id_ficha + " ";
  });

  $(document).on("click", ".btninhabilitar", function() {


		Swal.fire({
			title: 'Inactivar ficha',
			text: "deseas Inactivar esta ficha?!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'si , inactivar'
		}).then((result) => {
			if (result.isConfirmed) {

				location.href = "inicio_estudiante.php";


			}
			Swal.fire(
				'Inabilitada!',
				'La ficha fue inabilitada.',
				'success'
			)

		})

	});

});
  

  