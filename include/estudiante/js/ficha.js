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
      { data: "fecha_ficha" },
      {
        defaultContent:
          "<div class='text-center'><div class='btn-group'><button class='btn btn-primary vermas' title='Ver mas'    ><i class='material-icons'>control_point</i></button><button class='btn btn-danger btn-sm btnBorrar' tooltip-dir='top' title='Borrar'><i class='material-icons'>delete</i></button></div></div>",
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

  $("#btnParticipantes").click(function () {
    opcion = 1; //alta
    id_ficha = null;
    $("#formFichas").trigger("reset");
    $(".modal-header").css("background-color", "#0050a0");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Agregar Participantes");
    $("#modalParticipantes").modal("show");
    $(document).ready(function () {
      $('#id_lista_usuario').select2();
    })
  });

  $("#btnDirector").click(function () {
    opcion = 1; //alta
    id_ficha = null;
    $("#formFichas").trigger("reset");
    $(".modal-header").css("background-color", "#0050a0");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Agregar Director");
    $("#modalDirector").modal("show");
    $(document).ready(function () {
      $('#id_lista_usuario_director').select2();
    })
  });

  $("#btnMostrar_P").click(function () {
    opcion = 1; //alta
    id_ficha = null;
    $(".modal-header").css("background-color", "#0050a0");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Participantes");
    $("#modal_Mostrar_P").modal("show");
  });


  $('#delete').click(function () {
    alert('xd');

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



  $("#btneditarusuarios").click(function () {

    $("#formFichas").trigger("reset");
    $(".modal-header").css("background-color", "#0050a0");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Agregar Ficha");
    $("#modalCRUD1").modal("show");
  });

  $("#btneditarficha").click(function () {

    $(".modal-header").css("background-color", "#0050a0");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Agregar Ficha");
    $("#modalCRUD").modal("show");
  });



  // agregar pregunta sistematizadora
  $(document).ready(function () {
    
    var i = 1;
    $('#addspreg').click(function () {
      i++;
      $('#dynamic_field').append('<tr id="row' + i + '"><td><textarea type="text" rows="" cols="100" name="addspreg[]" placeholder="Ingrese pregunta sistematizadora" class="form-control" ></textarea></td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button> </td> <br/> <br/> </tr> ');
    });

    $(document).on('click', '.btn_remove', function () {
      var button_id = $(this).attr("id");
      $('#row' + button_id + '').remove();
    });

   

  });

  // agregar objetivos especificos
  $(document).ready(function () {
    
    var i = 100;
    $('#addsobj').click(function () {
      i++;
      $('#dynamic_fieldobj').append('<tr id="row' + i + '"><td><textarea type="text" rows="" cols="100" name="addsobj[]" placeholder="Ingrese objetivo especificos" class="form-control" ></textarea></td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button> </td> <br/> <br/> </tr> ');
    });

    $(document).on('click', '.btn_remove', function () {
      var button_id = $(this).attr("id");
      $('#row' + button_id + '').remove();
    });

   

  });





  //TEXTO FLOTANTE BOTON
  document.addEventListener('DOMContentLoaded', function () {
    let button = document.getElementById('btnParticipantes');
    button.setAttribute('tooltip-dir', top);
  });



  //boton enviar datos 
  $(document).on("click", ".btnEditar1", function () {

    fila = $(this).closest("tr");
    id_ficha = parseInt(fila.find("td:eq(0)").text()); //capturo el ID
    $.ajax({
      url: "info_ficha.php",

      type: "POST",
      data: {
        "id_de_ficha": id_ficha,
      },
      success: function (data) {

        $(".modal-header").css("background-color", "#0050a0");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Editar Ficha");
        $("#modalCRUD").modal("show");
      },
    });
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
          location.href = "fichas.php";
        },
      });
    }
  });



  $(document).on("click", ".vermas", function () {
    location.href = "info_ficha.php";

  });
});
