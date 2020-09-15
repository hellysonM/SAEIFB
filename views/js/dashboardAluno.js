$(document).ready(function () {

/*
$(window).on('load', function() {
            $('.progress').delay(300).fadeOut('slow');
            $('.indeterminate').delay(300).fadeOut();
            $('section').delay(300).fadeIn('slow');
        });*/

    $('.dropdown-trigger').dropdown();
    $('.tabs').tabs();
    $('select').formSelect();
    $('.sidenav').sidenav();
    $('.collapsible').collapsible();
    $('.tooltipped').tooltip();
    $('.tabs').tabs();
    $('.slider').slider();
    $('textarea').characterCounter();
    
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




    var max_fields = 5; 
    var wrapper = $("#div_adicionar"); 
    var add_button = $("#btn_adicionar"); 

    var x = 1; 
    $(add_button).click(function (e) { 
        e.preventDefault();
        if (x < max_fields) { 
            x++; 
            $(wrapper).append(` <div class="" id="file_${x}"><div class="file-field input-field col s5"><div class="btn blue"><span><i class="material-icons">file_upload</i></span><input type="file"  name="fileToUpload[file][]" ></div><div class="file-path-wrapper "><input class="file-path validate" type="text" placeholder="Envie seu documento"></div></div><div class="input-field col s6"><input id="icon_prefix${x}" type="text" class="validate" name="fileToUpload[description][]"><label for="icon_prefix${x}">descrição</label></div><div class="col s1 input-field"><a class="btn-floating btn-small waves-effect waves-light red "><i class="material-icons tooltipped remove_field" data-id="file_${x}" data-position="right" data-tooltip="deletar arquivo">delete</i></a></div></div>`); //add input box
        }
    });

    $(wrapper).on("click", ".remove_field", function (e) {


        e.preventDefault();

        var id = $(this).attr("data-id");



        $(`#${id}`).remove();

        x--;
    });

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
        
        
       
function toogleCheckBox() {
    
     var checkboxId = $(this).attr('id');
     var checkboxName = $(this).attr('name');
     
    if($(this).is(':checked')) {
       

      $(`#abaixo_do_${checkboxId}`).removeClass("hide");
      $(`#abaixo_do_${checkboxId} input`).attr('required','required');
 
        
    } else {
        
        $(`#abaixo_do_${checkboxId}`).addClass("hide");
        $(`#abaixo_do_${checkboxId} input`).removeAttr('required');
       
    }
}

    $('input[type=checkbox]').each(toogleCheckBox).change(toogleCheckBox);


});


function anyThing(destroyFeedback) {
    
  setTimeout(function(){ destroyFeedback(true); }, 1500);
   
}

function noThing(destroyFeedback) {
    
    $(`#fileToUpload`).attr('required','required');
    
  setTimeout(function(){ destroyFeedback(true); }, 10000);
}


function validationFunction(stepperForm, activeStepContent) {
   
    
    
   var validation = true;
   var itens = document.querySelectorAll('input[type=checkbox]:checked');
  
  if(itens.length==0){
      
        $.confirm({

            title: 'Erro ao processar',
            content: 'Preencha pelo menos uma disciplina',
            type: 'red',
            typeAnimated: true,
            buttons: {
                tryAgain: {
                    text: 'Entendi',
                    btnClass: 'btn-red',
                    action: function () {
                    }
                }
            }
        });
        
      return false;
      
  }
  
  var inputs = activeStepContent.querySelectorAll('input[type=text]');
 
   for (let i = 0; i < inputs.length; i++){
       
       if (!inputs[i].checkValidity()){
          
          $.confirm({

            title: 'Erro ao processar',
            content: 'Não deixe campos em branco dos nomes das disciplinas de origem',
            type: 'red',
            typeAnimated: true,
            buttons: {
                tryAgain: {
                    text: 'Entendi',
                    btnClass: 'btn-red',
                    action: function () {
                    }
                }
            }
        });
          
          return false;
           
       }
       
   }
   
   
   
   var inputs = activeStepContent.querySelectorAll('input[type=file]');
 
   for (let i = 0; i < inputs.length; i++){
       
       if (!inputs[i].checkValidity()){
          
          $.confirm({

            title: 'Erro ao processar',
            content: 'Você deve enviar pelo menos 1 arquivo',
            type: 'red',
            typeAnimated: true,
            buttons: {
                tryAgain: {
                    text: 'Entendi',
                    btnClass: 'btn-red',
                    action: function () {
                    }
                }
            }
        });
          
          return false;
           
       }
       
   }
     
  
   return true; 
    
 
}

var stepperDiv = document.querySelector('.stepper');
console.log(stepperDiv);
var stepper = new MStepper(stepperDiv,{validationFunction: validationFunction});
