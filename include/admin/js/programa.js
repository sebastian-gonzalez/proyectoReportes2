$(document).ready(function () {
  var id_programa, opcion;
  opcion = 4;

  tablaProgramas = $("#tablaProgramas").DataTable({
    ajax: {
      url: "../include/admin/crud_programas.php",
      method: "POST", //usamos el metodo POST
      data: { opcion: opcion }, //enviamos opcion 4 para que haga un SELECT
      dataSrc: "",
    },
    columns: [
      { data: "id_programa" },
      { data: "nombre_pro" },
      { data: "titulo_pro" },
      { data: "nombre_facultad" },

      {
        defaultContent:
          "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btnEditar'><i class='material-icons'>edit</i></button><button class='btn btn-danger btn-sm btnBorrar'><i class='material-icons'>delete</i></button></div></div>",
      },
    ],
  });

  var fila; //captura la fila, para editar o eliminar
  //submit para el Alta y Actualización
  $("#formProgramas").submit(function (e) {
    e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página

    nombre_pro = $.trim($("#nombre_pro").val());
    titulo_pro = $.trim($("#titulo_pro").val());
    id_facultad_pro = $.trim($("#id_facultad_pro").val());

    $.ajax({
      url: "../include/admin/crud_programas.php",
      type: "POST",
      datatype: "json",
      data: {
        id_programa: id_programa,
        nombre_pro: nombre_pro,
        titulo_pro: titulo_pro,
        id_facultad_pro: id_facultad_pro,
        opcion: opcion,
      },
      success: function (data) {
        tablaProgramas.ajax.reload(null, false);
      },
    });
    $("#modalCRUD").modal("hide");
  });

  //para limpiar los campos antes de dar de Alta una Persona
  $("#btnNuevo").click(function () {
    opcion = 1; //alta
    id_programa = null;
    $("#formProgramas").trigger("reset");
    $(".modal-header").css("background-color", "#0050a0");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Agregar Programa");
    $("#modalCRUD").modal("show");
  });

  //Editar
  $(document).on("click", ".btnEditar", function () {
    opcion = 2; //editar
    fila = $(this).closest("tr");
    id_programa = parseInt(fila.find("td:eq(0)").text()); //capturo el ID
    nombre_pro = fila.find("td:eq(1)").text();
    titulo_pro = fila.find("td:eq(2)").text();
    id_facultad_pro = fila.find("td:eq(3)").text();

    $("#nombre_pro").val(nombre_pro);
    $("#titulo_pro").val(titulo_pro);
    $("#id_facultad_pro").val(id_facultad_pro);
    $(".modal-header").css("background-color", "#0050a0");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar Programa");
    $("#modalCRUD").modal("show");
  });

  //Borrar
  $(document).on("click", ".btnBorrar", function () {
    fila = $(this);
    id_programa = parseInt($(this).closest("tr").find("td:eq(0)").text());
    opcion = 3; //eliminar
    var respuesta = confirm(
      "¿Está seguro de borrar el registro " + id_programa + "?"
    );
    if (respuesta) {
      $.ajax({
        url: "../include/admin/crud_programas.php",
        type: "POST",
        datatype: "json",
        data: { opcion: opcion, id_programa: id_programa },
        success: function () {
          tablaProgramas.row(fila.parents("tr")).remove().draw();
        },
      });
    }
  });
});
