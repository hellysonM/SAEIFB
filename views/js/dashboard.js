$(document).ready(function () {

    const PATH_NAME = window.location.pathname
    const HOME_URL = PATH_NAME.replace(/\/Dashboard.*/,'')

    $('.dropdown-trigger').dropdown();
    $('.tabs').tabs();
    $('.slider').slider(); 
    
    $('.collapsible-header').click(function () {
        var parent_child = $(this);
        parent_child.toggleClass('collapsed');
        if (parent_child.hasClass('collapsed')) {
            parent_child.children('i.arrow-change').text('arrow_drop_up');
        } else {
            parent_child.children('i.arrow-change').text('arrow_drop_down');
        }
    });

    var behavior = function (val) {
        return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
    },
            options = {
                onKeyPress: function (val, e, field, options) {
                    field.mask(behavior.apply({}, arguments), options);
                }
            };

    $('#telefone').mask(behavior, options);
    $('.sidenav').sidenav();
    $('.collapsible').collapsible();
    $('select').formSelect();


    $('#inserir_aluno').submit(function (event) {
        event.preventDefault(); 
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
                if(response.codigo==1) {

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
                }else {
                    window.location.href = HOME_URL+"/Dashboard/Aluno/Welcome";
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

    $(document).on('click', '.perfil_ajax', function () {
        var file = $(this).attr('id');

        $.ajax({
            type: 'POST',
            url: HOME_URL+'/Usuario/Perfil/' + file,
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
        
        event.preventDefault();
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

                    window.location.href = HOME_URL+"/Dashboard/Usuario/Alterado";
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
        
        event.preventDefault(); 
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
                    window.location.href =  HOME_URL+"/Dashboard/Usuario/Alterado";
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

