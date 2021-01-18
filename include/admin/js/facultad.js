$(document).ready(function () {
  var id_facultad, opcion;
  opcion = 4;

  tablaFacultades = $("#tablaFacultades").DataTable({
    ajax: {
      url: "../include/admin/crud_facultades.php",
      method: "POST", //usamos el metodo POST
      data: { opcion: opcion }, //enviamos opcion 4 para que haga un SELECT
      dataSrc: "",
    },
    columns: [
      { data: "id_facultad" ,className:"hide_column"},
      { data: "nombre_facultad" },
      {
        defaultContent:
          "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btnEditar'><i class='material-icons'>edit</i></button><button class='btn btn-danger btn-sm btnBorrar'><i class='material-icons'>delete</i></button></div></div>",
      },
    ],
  });

  var fila; //captura la fila, para editar o eliminar
  //submit para el Alta y Actualización
  $("#formFacultades").submit(function (e) {
    e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página

    nombre_facultad = $.trim($("#nombre_facultad").val());

    $.ajax({
      url: "../include/admin/crud_facultades.php",
      type: "POST",
      datatype: "json",
      data: {
        id_facultad: id_facultad,
        nombre_facultad: nombre_facultad,
        opcion: opcion,
      },
      success: function (data) {
        tablaFacultades.ajax.reload(null, false);
      },
    });
    $("#modalCRUD").modal("hide");
  });

  //para limpiar los campos antes de dar de Alta una Persona
  $("#btnNuevo").click(function () {
    opcion = 1; //alta
    id_facultad = null;
    $("#formFacultades").trigger("reset");
    $(".modal-header").css("background-color", "#0050a0");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Agregar Facultad");
    $("#modalCRUD").modal("show");
  });

  //Editar
  $(document).on("click", ".btnEditar", function () {
    opcion = 2; //editar
    fila = $(this).closest("tr");
    id_facultad = parseInt(fila.find("td:eq(0)").text()); //capturo el ID
    nombre_facultad = fila.find("td:eq(1)").text();

    $("#nombre_facultad").val(nombre_facultad);
    $(".modal-header").css("background-color", "#0050a0");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar Facultad");
    $("#modalCRUD").modal("show");
  });

  //Borrar
  $(document).on("click", ".btnBorrar", function () {
    fila = $(this);
    id_facultad = parseInt($(this).closest("tr").find("td:eq(0)").text());
    opcion = 3; //eliminar
    var respuesta = confirm(
      "¿Está seguro de borrar el registro " + id_facultad + "?"
    );
    if (respuesta) {
      $.ajax({
        url: "../include/admin/crud_facultades.php",
        type: "POST",
        datatype: "json",
        data: { opcion: opcion, id_facultad: id_facultad },
        success: function () {
          tablaFacultades.row(fila.parents("tr")).remove().draw();
        },
      });
    }
  });
});
