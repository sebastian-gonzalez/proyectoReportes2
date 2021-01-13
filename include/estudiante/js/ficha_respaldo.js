$(document).ready(function () {
  var id_ficha, opcion;
  opcion = 4;

  tablaFichas = $("#tablaFichas").DataTable({
    ajax: {
      url: "../include/estudiante/crud_fichas.php",
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
      {
        defaultContent:
          "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btnEditar'><i class='material-icons'>edit</i></button><button class='btn btn-danger btn-sm btnBorrar'><i class='material-icons'>delete</i></button></div></div>",
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
      url: "../include/estudiante/crud_fichas.php",
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

  $("#btnNuevo1").click(function () {
    opcion = 1; //alta
    id_ficha = null;
    $("#formFichas").trigger("reset");
    $(".modal-header").css("background-color", "#0050a0");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Agregar Ficha");
    $("#modalCRUD1").modal("show");
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

  //Borrar

  $(document).on("click", ".btnBorrar", function () {
    fila = $(this);
    id_ficha = parseInt($(this).closest("tr").find("td:eq(0)").text());
    opcion = 3; //eliminar
    var respuesta = confirm(
      "¿Está seguro de borrar el registro " + id_ficha + "?"
    );
    if (respuesta) {
      $.ajax({
        url: "../include/estudiante/delete.php",
        type: "POST",
        datatype: "json",
        data: { opcion: opcion, id_ficha: id_ficha },
        success: function () {
          tablaFichas.row(fila.parents("tr")).remove().draw();
        },
      });
    }
  });
});
