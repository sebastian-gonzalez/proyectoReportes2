$(document).ready(function () {
  var id_ficha, opcion;
  opcion = 4;

  tablaFichas = $("#tablaFichas").DataTable({
    ajax: {
      url: "../../controlador/docente/crud_fichas_evaluador.php",
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
          "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btnEditar'  tooltip-dir='top' title='Evaluar'><i class='material-icons'>edit</i></button><button class='btn btn-primary btn-sm btnMostrar_P'  tooltip-dir='top' title='Integrantes'><i class='material-icons'>groups</i></button><button class='btn btn-primary btn-sm btnRevision'  tooltip-dir='top' title='Ver mas'><i class='material-icons'>control_point</i></button></div></div>",


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
      url: "../../controlador/docente/crud_fichas_evaluador.php",
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

  $("#btnMostrar_P").click(function () {
    opcion = 1; //alta
    id_ficha = null;
    $(".modal-header").css("background-color", "#0050a0");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Participantes");
    $("#modal_Mostrar_P").modal("show");
  });



  $(document).on("click", ".btnMostrar_P", function () {
    fila = $(this);
    id_ficha = parseInt($(this).closest("tr").find("td:eq(0)").text());
    $.ajax({
      url: "../../controlador/docente/captador_Datos.php",
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
  document.addEventListener('DOMContentLoaded', function () {
    let button = document.getElementById('btnParticipantes');
    button.setAttribute('tooltip-dir', top);
  });


  //Editar



  $(document).on("click", ".btnEditar", function () {
    fila = $(this).closest("tr");
    id_ficha = parseInt(fila.find("td:eq(0)").text()); //capturo el ID
    evaluacion_ficha = fila.find("td:eq(5)").text();
    $("#evaluacion_ficha").val(evaluacion_ficha);
    

    $.ajax({
      url: "../../controlador/docente/editar_pdf_evaluador.php",
      type: "POST",
      data: {
        "id_fichas": id_ficha,
        "evaluacion_ficha": evaluacion_ficha,
      },
      success: function (data) {

        $("#repetir").html(data)
        $(".modal-header").css("background-color", "#0050a0");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Evaluar ficha");
        $("#modalCRUDedit").modal("show");
      },
    });
    $("#modalCRUDedit").modal("hide");

  });

  $('#deleteante').click(function () {
    alert('eliminar anteproyecto');

    var parent = $(this).parent().attr('id');
    var service = $(this).parent().attr('data');
    var dataString = 'id=' + service;
    $.ajax({
      type: "POST",
      url: "del_document.php",
      data: dataString,

      succes: function () {

      }
    });

  });

  //Revisar Ficha

  $(document).on("click", ".btnRevision", function () {
    fila = $(this);
    id_ficha = parseInt($(this).closest("tr").find("td:eq(0)").text());
    opcion = 3; //eliminar
    location.href = "info_ficha.php?ficha=" + id_ficha + " ";
  });
});

