$(document).ready(function () {


    $('.dropdown-trigger').dropdown();
    $('.tabs').tabs();
    $('select').formSelect();
    $('.sidenav').sidenav();
    $('.collapsible').collapsible();
    $('.tooltipped').tooltip();
    $('.tabs').tabs();
    $('.slider').slider();
    $('input#input_text, textarea#textarea2').characterCounter();
    
    $('.collapsible-header').click(function () {
        var parent_child = $(this);
        parent_child.toggleClass('collapsed');
        if (parent_child.hasClass('collapsed')) {
            parent_child.children('i.arrow-change').text('arrow_drop_up');
        } else {
            parent_child.children('i.arrow-change').text('arrow_drop_down');
        }

    });






    $('#inserir_solicitacao').submit(function (event) {
        event.preventDefault(); 
        var form = $(this);
        var form_data = new FormData(this);

        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: form_data,
            dataType: 'json',
            contentType: false,
            processData: false,
            beforeSend: function () {


            },
            success: function (response) {
                console.log('Submission was successful.');
                console.log(response.mensagem);
                if (response.codigo == 1) {

                    $.confirm({
                        title: 'Houve um erro em sua solicitação',
                        content: response.mensagem,
                        type: 'red',
                        typeAnimated: true,
                        buttons: {
                            tryAgain: {
                                text: 'Tentar novamente',
                                btnClass: 'btn-red',
                                action: function () {
                                }
                            },

                        }
                    });
                } else {

                    window.location.href = "/Dashboard/Aluno/Acompanhar";


                }


            },
            error: function (data) {
                console.log('An error occurred.');

            },
            complete: function () {
                $("#loading").addClass("hide");
            }
        })
    });




    var max_fields = 4; //maximum input boxes allowed
    var wrapper = $("#div_adicionar"); //Fields wrapper
    var add_button = $("#btn_adicionar"); //Add button ID

    var x = 1; //initlal text box count
    $(add_button).click(function (e) { //on add input button click
        e.preventDefault();
        if (x < max_fields) { //max input box allowed
            x++; //text box increment
            $(wrapper).append(` <div class="" id="file_${x}"><div class="file-field input-field col s5"><div class="btn blue"><span><i class="material-icons">file_upload</i></span><input type="file"  name="fileToUpload[file][]" ></div><div class="file-path-wrapper "><input class="file-path validate" type="text" placeholder="Envie seu documento"></div></div><div class="input-field col s6"><input id="icon_prefix${x}" type="text" class="validate" name="fileToUpload[description][]"><label for="icon_prefix${x}">Descrição do documento</label></div><div class="col s1 input-field"><a class="btn-floating btn-small waves-effect waves-light red "><i class="material-icons tooltipped remove_field" data-id="file_${x}" data-position="right" data-tooltip="deletar arquivo">delete</i></a></div></div>`); //add input box
        }
    });

    $(wrapper).on("click", ".remove_field", function (e) {


        e.preventDefault();

        var id = $(this).attr("data-id");



        $(`#${id}`).remove();

        x--;
    })









    $(document).on('click', '.perfil_ajax', function () {
        var file = $(this).attr('id');

        $.ajax({
            type: 'POST',
            url: '/Aluno/Perfil/' + file,

            beforeSend: function () {

                $("#loader").removeClass("hide");

            },

            success: function (data) {


                $("#conteudo").html("");
                $("#conteudo").html(data);




                $("#password").on("focusout", function (e) {
                    if ($(this).val() != $("#passwordConfirm").val()) {
                        $("#passwordConfirm").removeClass("valid").addClass("invalid");
                    } else {
                        $("#passwordConfirm").removeClass("invalid").addClass("valid");
                    }
                });

                $("#passwordConfirm").on("keyup", function (e) {
                    if ($("#password").val() != $(this).val()) {
                        $(this).removeClass("valid").addClass("invalid");
                    } else {
                        $(this).removeClass("invalid").addClass("valid");
                    }
                });






            }
        });

    });







    $('#alterar_email').submit(function (event) {

        event.preventDefault(); // Prevent the form from submitting via the browser
        var form = $(this);
        $.ajax({
            type: form.attr('method'),
            url: form.attr('action'),
            data: form.serialize(),
            dataType: 'json',
            beforeSend: function () {
            },
            success: function (response) {
                console.log('Submission was successful.');
                console.log(response.mensagem);
                if (response.codigo == 1) {

                    $.confirm({
                        title: 'Houve um erro ao cadastrar',
                        content: response.mensagem,
                        type: 'red',
                        typeAnimated: true,
                        buttons: {
                            tryAgain: {
                                text: 'Tentar novamente',
                                btnClass: 'btn-red',
                                action: function () {
                                }
                            },

                        }
                    });
                } else {

                    window.location.href = "/Dashboard/Aluno/Alterado";
                }
            },
            error: function (data) {
                console.log('An error occurred.');

            },
            complete: function () {
                $("#loading").addClass("hide");
            }
        })
    });






    $('#alterar_senha').submit(function (event) {

        event.preventDefault(); // Prevent the form from submitting via the browser
        var form = $(this);
        $.ajax({
            type: form.attr('method'),
            url: form.attr('action'),
            data: form.serialize(),
            dataType: 'json',
            beforeSend: function () {
            },
            success: function (response) {
                console.log('Submission was successful.');
                console.log(response.mensagem);
                if (response.codigo == 1) {

                    $.confirm({
                        title: 'Houve um erro ao processar sua solicitação',
                        content: response.mensagem,
                        type: 'red',
                        typeAnimated: true,
                        buttons: {
                            tryAgain: {
                                text: 'Tentar novamente',
                                btnClass: 'btn-red',
                                action: function () {
                                }
                            },

                        }
                    });
                } else {

                    window.location.href = "/Dashboard/Aluno/Alterado";
                }
            },
            error: function (data) {
                console.log('An error occurred.');

            },
            complete: function () {
                $("#loading").addClass("hide");
            }
        })
    });




    $('#refazer_solicitacao').submit(function (event) {
        event.preventDefault(); // Prevent the form from submitting via the browser
        var form = $(this);


        var form_data = new FormData(this);

        /*
         var totalfiles = document.getElementById('fileToUpload').files.length;
         for (var index = 0; index < totalfiles; index++) {
         form_data.append("fileToUpload[]", document.getElementById('fileToUpload').files[index]);
         }
         
         */


        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: form_data,
            dataType: 'json',
            contentType: false,
            processData: false,
            beforeSend: function () {



            },
            success: function (response) {
                console.log('Submission was successful.');
                console.log(response.mensagem);
                if (response.codigo == 1) {

                    $.confirm({
                        title: 'Houve um erro em sua solicitação',
                        content: response.mensagem,
                        type: 'red',
                        typeAnimated: true,
                        buttons: {
                            tryAgain: {
                                text: 'Tentar novamente',
                                btnClass: 'btn-red',
                                action: function () {
                                }
                            },

                        }
                    });
                } else {

                    window.location.href = "/Dashboard/Aluno/Acompanhar";


                }




            },
            error: function (data) {
                console.log('An error occurred.');

            },
            complete: function () {
                $("#loading").addClass("hide");
            }
        })
    });




});
