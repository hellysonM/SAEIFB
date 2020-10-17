$(document).ready(function(){

     var HOME_URL = window.location.pathname

     $("#passwordConfirm").on("keyup", function (e) {
        if ($("#password").val() != $(this).val()) {
            $(this).removeClass("valid").addClass("invalid");
        } else {
            $(this).removeClass("invalid").addClass("valid");
        }
    });

    $("#buscar").click(function () {

        $("#menu").css("display", "none");
        $("#barra_buscar").css("display", "inline");
        $("#search").focus();

        $("#search").blur(function () {

            $("#barra_buscar").fadeOut("slow").css("display", "none");
            $("#menu").fadeIn("slow");

        });

    });
       
    $("a").on('click', function (event) {
        if (this.hash !== "") {
            event.preventDefault();
            var hash = this.hash;
            $('html, body').animate({
                scrollTop: $(hash).offset().top
            }, 800, function () {
                window.location.hash = hash;
            });
        }
    });
                  
    var $seuCampoCpf = $(".cpf");
    $seuCampoCpf.mask('000.000.000-00', {reverse: true});                 
          
    $('.modal').modal({
    dismissible:false,
    inDuration:300
    });


    $('.slider').slider();
    $('.parallax').parallax('');
    $('.sidenav').sidenav();
    $("#password").on("focusout", function (e) {
        if ($(this).val() != $("#passwordConfirm").val()) {
            $("#passwordConfirm").removeClass("valid").addClass("invalid");
        } else {
            $("#passwordConfirm").removeClass("invalid").addClass("valid");
        }
    });


    $(function () {
        $('#logar').submit(function (event) {
            event.preventDefault();
            var form = $(this);
            
            $.ajax({
                type: form.attr('method'),
                url: form.attr('action'),
                data: form.serialize(),
                dataType: 'json',
                
                beforeSend: function () {
                    $("#loading").removeClass("hide");
                },
                
                success: function (response) {
    
                    if (response.codigo == "0") {
                        window.location.href = HOME_URL+"Dashboard";
                    } else {

                        $.dialog({
                            columnClass: 'col s12 m3 offset-m4',
                            icon: 'fa fa-warning',
                            title: 'Erro ao processar',
                            content: response.mensagem,
                        });                                              
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

    $(function () {
        $('#cadastrar').submit(function (event) {
            event.preventDefault();
            var form = $(this);

            $.ajax({
                type: form.attr('method'),
                url: form.attr('action'),
                data: form.serialize(),
                dataType: 'json',

                success: function (response) {

                    console.log(response.mensagem);

                    if (response.codigo == 1) {
                        $.dialog({
                            columnClass: 'col s12 m3 offset-m4',
                            icon: 'fa fa-warning',
                            title: 'Erro ao processar',
                            content: response.mensagem,
                        });
                        
                    }else {
                        window.location.href = HOME_URL+"Dashboard/Usuario/Welcome";
                    }

                },
                error: function (data) {
                    console.log('An error occurred.');
                }
            })
        });
    });
    
    $("#esqueceu_senha").click(function () {

        $.confirm({
            columnClass: 'col s12 m6 offset-m3',
            title: 'Recuperar Senha',
            content: 'Digite seu E-mail para uma nova senha gerada ser enviada' +
                    '<form action="'+HOME_URL+'Usuario/NovaSenha" method="POST" class="formName" id="recuperar_senha">' +
                    '<div class="form-group">' +
                    '<input type="email" placeholder="Seu E-mail" class="name form-control" name="email" required />' +
                    '</div>' +
                    '</form>',

            buttons: {

                formSubmit: {
                    text: 'Enviar',
                    btnClass: 'btn-green',
                    action: function () {

                        var form = $("#recuperar_senha");
                        
                        $.ajax({
                            type: form.attr('method'),
                            url: form.attr('action'),
                            data: form.serialize(),
                            dataType: 'json',
                            
                            success: function (response) {
                               
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
                                    $.dialog({
                                        columnClass: 'col s12 m3 offset-m4',
                                        
                                        title: 'Sucesso',
                                        content: response.mensagem,
                                    });
                                }
                            },
                            error: function (data) {
                                console.log('An error occurred.');
                                $.alert("Um erro ocorreu");

                            }                          
                        })
                    }
                },
                cancelar: function () {
             
                },
            },
            onContentReady: function () {   
                var jc = this;
                this.$content.find('form').on('submit', function (e) {
                  
                    e.preventDefault();
                    jc.$$formSubmit.trigger('click'); 
                });
            }
        });
    });

});