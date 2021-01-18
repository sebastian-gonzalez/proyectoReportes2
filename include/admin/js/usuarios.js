$(document).ready(function () {
  var id_usuario, opcion;
  opcion = 4;

  tablaUsuarios = $("#tablaUsuarios").DataTable({
    ajax: {
      url: "../include/admin/crud_usuarios.php",
      method: "POST", //usamos el metodo POST
      data: { opcion: opcion }, //enviamos opcion 4 para que haga un SELECT
      dataSrc: "",
    },
    columns: [
      { data: "id_usuario"  ,className:"hide_column"},
      { data: "cedula_usu" },
      { data: "nombre_usu" },
      { data: "apellido_usu" },
      { data: "correo_usu" },
      { data: "contrasena_usu" },
      { data: "nombre_rol" },
      { data: "nombre_pro" },
      {
        defaultContent:
          "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btnEditar'><i class='material-icons'>edit</i></button><button class='btn btn-danger btn-sm btnBorrar'><i class='material-icons'>delete</i></button></div></div>",
      },
    ],
  });

  var fila; //captura la fila, para editar o eliminar
  //submit para el Alta y Actualización
  $("#formUsuarios").submit(function (e) {
    e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página

    cedula_usu = $.trim($("#cedula_usu").val());
    nombre_usu = $.trim($("#nombre_usu").val());
    apellido_usu = $.trim($("#apellido_usu").val());
    correo_usu = $.trim($("#correo_usu").val());
    contrasena_usu = $.trim($("#contrasena_usu").val());
    id_rol_usu = $.trim($("#id_rol_usu").val());
    id_programa_usu = $.trim($("#id_programa_usu").val());
    $.ajax({
      url: "../include/admin/crud_usuarios.php",
      type: "POST",
      datatype: "json",
      data: {
        id_usuario: id_usuario,
        cedula_usu: cedula_usu,
        nombre_usu: nombre_usu,
        apellido_usu: apellido_usu,
        correo_usu: correo_usu,
        contrasena_usu: contrasena_usu,
        id_rol_usu: id_rol_usu,
        id_programa_usu: id_programa_usu,
        opcion: opcion,
      },
      success: function (data) {
        tablaUsuarios.ajax.reload(null, false);
      },
    });
    $("#modalCRUD").modal("hide");
  });

  //para limpiar los campos antes de dar de Alta una Persona
  $("#btnNuevo").click(function () {
    opcion = 1; //alta
    id_usuario = null;
    $("#formUsuarios").trigger("reset");
    $(".modal-header").css("background-color", "#0050a0");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Agregar Usuario");
    $("#modalCRUD").modal("show");
  });

  //Editar
  $(document).on("click", ".btnEditar", function () {
    opcion = 2; //editar
    fila = $(this).closest("tr");
    id_usuario = parseInt(fila.find("td:eq(0)").text()); //capturo el ID
    cedula_usu = fila.find("td:eq(1)").text();
    nombre_usu = fila.find("td:eq(2)").text();
    apellido_usu = fila.find("td:eq(3)").text();
    correo_usu = fila.find("td:eq(4)").text();
    contrasena_usu = fila.find("td:eq(5)").text();
    id_rol_usu = fila.find("td:eq(6)").text();
    id_programa_usu = fila.find("td:eq(7)").text();
    $("#cedula_usu").val(cedula_usu);
    $("#nombre_usu").val(nombre_usu);
    $("#apellido_usu").val(apellido_usu);
    $("#correo_usu").val(correo_usu);
    $("#contrasena_usu").val(contrasena_usu);
    $("#id_rol_usu").val(id_rol_usu);
    $("#id_programa_usu").val(id_programa_usu);
    $(".modal-header").css("background-color", "#0050a0");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar Usuario");
    $("#modalCRUD").modal("show");
  });

  //Borrar
  $(document).on("click", ".btnBorrar", function () {
    fila = $(this);
    id_usuario = parseInt($(this).closest("tr").find("td:eq(0)").text());
    opcion = 3; //eliminar
    var respuesta = confirm(
      "¿Está seguro de borrar el registro " + id_usuario + "?"
    );
    if (respuesta) {
      $.ajax({
        url: "../include/admin/crud_usuarios.php",
        type: "POST",
        datatype: "json",
        data: { opcion: opcion, id_usuario: id_usuario },
        success: function () {
          tablaUsuarios.row(fila.parents("tr")).remove().draw();
        },
      });
    }
  });
});
