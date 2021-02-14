$(document).ready(function () {
    var id_ficha, opcion;
    opcion = 4;
  
    tablaFichas = $("#tablaFichas").DataTable({
      ajax: {
        url: "../../controlador/coordinador/revision_fichas_director.php",
        method: "POST", //usamos el metodo POST
        data: { opcion: opcion }, //enviamos opcion 4 para que haga un SELECT
        dataSrc: "",
        'responsive':true,
        'scrollX':false,
        'scrollCollapse': false,
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
            "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btnDirector'  tooltip-dir='top' title='Agregar Director'><i class='material-icons'>person_add</i></button><button class='btn btn-primary btn-sm btnEditar'  tooltip-dir='top' title='Integrantes'><i class='material-icons'>groups</i></button><button class='btn btn-primary btn-sm btnRevision'  tooltip-dir='top' title='PDF'><i class='material-icons'>picture_as_pdf</i></button></div></div>",
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
        url: "../../controlador/coordinador/revision_fichas_coordinador.php",
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

  

    $("#btnMostrar_P").click(function () {
      opcion = 1; //alta
      id_ficha = null;
      $(".modal-header").css("background-color", "#0050a0");
      $(".modal-header").css("color", "white");
      $(".modal-title").text("Participantes");
      $("#modal_Mostrar_P").modal("show");
    });

   


   
    
  

    
//TEXTO FLOTANTE BOTON
document.addEventListener('DOMContentLoaded', function() {
  let button = document.getElementById('btnParticipantes');
  button.setAttribute('tooltip-dir', top);
});



 
    //Revisar Ficha
  
    $(document).on("click", ".btnRevision", function () {
      fila = $(this);
      id_ficha = parseInt($(this).closest("tr").find("td:eq(0)").text());
      opcion = 3; //eliminar
      location.href="revision_documento_coor.php?ficha=" + id_ficha + " ";
    });
    
    $(document).on("click", ".btnJurado", function (){
      fila = $(this);
      id_ficha = parseInt($(this).closest("tr").find("td:eq(0)").text());
      $.ajax({
        url: "revision_fichas_coordinador.php",
        
        type: "POST",
        data: { 
          "id_fichas_jurado": id_ficha,
        },
        success: function (data) {
      $("#formJurado").trigger("reset");
      $(".modal-header").css("background-color", "#0050a0");
      $(".modal-header").css("color", "white");
      $(".modal-title").text("Jurado");
      $("#modalJurado").modal("show");
      $(document).ready(function() {
        $('#id_lista_usuario_ju').select2();
      });
    },
  });
  });

  $(document).on("click", ".btnDirector", function (){
    fila = $(this);
      id_ficha = parseInt($(this).closest("tr").find("td:eq(0)").text());
      $.ajax({
        url: "revision_fichas_coordinador.php",
        
        type: "POST",
        data: { 
          "id_fichas_evaluador": id_ficha,
        },
        success: function (data) {
         
    $("#formEvaluador").trigger("reset");
    $(".modal-header").css("background-color", "#0050a0");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Evaluador");
    $("#modalEvaluador").modal("show");
    $(document).ready(function() {
      $('#id_lista_usuario_ev').select2();
  });
  },
});
});
  
  
    $(document).on("click", ".btnEditar", function () {
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
          $("#modalCRUD").modal("show");
        },
      });
      $("#modalCRUD").modal("hide");
    });






  });
  