 $(document).ready(function(){

    $('.dropchange .head').on('click', function () {
      $(this)
        .find('.changed')
        .toggleClass('fa-angle-down')
        .toggleClass('fa-angle-right');
    });
    
    
  

  
    $('select').formSelect();
  
    $('.modal').modal();
    
    $('input#input_text, textarea#textarea2').characterCounter();
  
     
    $('.tabs').tabs();
    
    $('.sidenav').sidenav();
   
    $('.collapsible').collapsible();
    
    $('.dropdown-trigger').dropdown();

     $('.datepicker').datepicker({
         
        format: 'yyyy-mm-dd',
        
        i18n: {
            cancel: 'Cancelar',
            clear: 'Limpar',
            done: 'Ok',
                months: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"],
                monthsShort: ["Jan", "Feb", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"],
                weekdays: ["Domingo","Segunda", "Terça", "Quarta", "Quinta", "Sexta", "Sábado"],
                weekdaysShort: ["Dom","Seg", "Ter", "Qua", "Qui", "Sex", "Sab"],
                weekdaysAbbrev: ["D","S", "T", "Q", "Q", "S", "S"]
            }
            
            
            
     });
    
    
});
       
(function(window, document, undefined) {

  var factory = function($, DataTable) {
    "use strict";

    $('.search-toggle').click(function() {
      if ($('.hiddensearch').css('display') == 'none')
        $('.hiddensearch').slideDown();
      else
        $('.hiddensearch').slideUp();
    });

    /* Set the defaults for DataTables initialisation */
    $.extend(true, DataTable.defaults, {
      dom: "<'hiddensearch'f'>" +
        "tr" +
        "<'table-footer'lip'>",
      renderer: 'material'
    });

    /* Default class modification */
    $.extend(DataTable.ext.classes, {
      sWrapper: "dataTables_wrapper",
      sFilterInput: "form-control input-sm",
      sLengthSelect: "form-control input-sm"
    });

    /* Bootstrap paging button renderer */
    DataTable.ext.renderer.pageButton.material = function(settings, host, idx, buttons, page, pages) {
      var api = new DataTable.Api(settings);
      var classes = settings.oClasses;
      var lang = settings.oLanguage.oPaginate;
      var btnDisplay, btnClass, counter = 0;

      var attach = function(container, buttons) {
        var i, ien, node, button;
        var clickHandler = function(e) {
          e.preventDefault();
          if (!$(e.currentTarget).hasClass('disabled')) {
            api.page(e.data.action).draw(false);
          }
        };

        for (i = 0, ien = buttons.length; i < ien; i++) {
          button = buttons[i];

          if ($.isArray(button)) {
            attach(container, button);
          } else {
            btnDisplay = '';
            btnClass = '';

            switch (button) {

              case 'first':
                btnDisplay = lang.sFirst;
                btnClass = button + (page > 0 ?
                  '' : ' disabled');
                break;

              case 'previous':
                btnDisplay = '<i class="material-icons">chevron_left</i>';
                btnClass = button + (page > 0 ?
                  '' : ' disabled');
                break;

              case 'next':
                btnDisplay = '<i class="material-icons">chevron_right</i>';
                btnClass = button + (page < pages - 1 ?
                  '' : ' disabled');
                break;

              case 'last':
                btnDisplay = lang.sLast;
                btnClass = button + (page < pages - 1 ?
                  '' : ' disabled');
                break;

            }

            if (btnDisplay) {
              node = $('<li>', {
                  'class': classes.sPageButton + ' ' + btnClass,
                  'id': idx === 0 && typeof button === 'string' ?
                    settings.sTableId + '_' + button : null
                })
                .append($('<a>', {
                    'href': '#',
                    'aria-controls': settings.sTableId,
                    'data-dt-idx': counter,
                    'tabindex': settings.iTabIndex
                  })
                  .html(btnDisplay)
                )
                .appendTo(container);

              settings.oApi._fnBindAction(
                node, {
                  action: button
                }, clickHandler
              );

              counter++;
            }
          }
        }
      };

      // IE9 throws an 'unknown error' if document.activeElement is used
      // inside an iframe or frame. 
      var activeEl;

      try {
        // Because this approach is destroying and recreating the paging
        // elements, focus is lost on the select button which is bad for
        // accessibility. So we want to restore focus once the draw has
        // completed
        activeEl = $(document.activeElement).data('dt-idx');
      } catch (e) {}

      attach(
        $(host).empty().html('<ul class="material-pagination"/>').children('ul'),
        buttons
      );

      if (activeEl) {
        $(host).find('[data-dt-idx=' + activeEl + ']').focus();
      }
    };

    /*
     * TableTools Bootstrap compatibility
     * Required TableTools 2.1+
     */
    if (DataTable.TableTools) {
      // Set the classes that TableTools uses to something suitable for Bootstrap
      $.extend(true, DataTable.TableTools.classes, {
        "container": "DTTT btn-group",
        "buttons": {
          "normal": "btn btn-default",
          "disabled": "disabled"
        },
        "collection": {
          "container": "DTTT_dropdown dropdown-menu",
          "buttons": {
            "normal": "",
            "disabled": "disabled"
          }
        },
        "print": {
          "info": "DTTT_print_info"
        },
        "select": {
          "row": "active"
        }
      });

      // Have the collection use a material compatible drop down
      $.extend(true, DataTable.TableTools.DEFAULTS.oTags, {
        "collection": {
          "container": "ul",
          "button": "li",
          "liner": "a"
        }
      });
    }

  }; // /factory

  // Define as an AMD module if possible
  if (typeof define === 'function' && define.amd) {
    define(['jquery', 'datatables'], factory);
  } else if (typeof exports === 'object') {
    // Node/CommonJS
    factory(require('jquery'), require('datatables'));
  } else if (jQuery) {
    // Otherwise simply initialise as normal, stopping multiple evaluation
    factory(jQuery, jQuery.fn.dataTable);
  }

})(window, document);

$(document).ready(function() {
    
    
    
  $('#usuario').dataTable({
    "oLanguage": {
      "sStripClasses": "",
      "sSearch": "",
      "sSearchPlaceholder": "Insira sua busca aqui",
      "sInfo": "_START_ -_END_ of _TOTAL_",
      "sLengthMenu": '<span>Linhas por página</span><select class="browser-default">' +
        '<option value="10">10</option>' +
        '<option value="20">20</option>' +
        '<option value="30">30</option>' +
        '<option value="40">40</option>' +
        '<option value="50">50</option>' +
        '<option value="-1">All</option>' +
        '</select></div>'
    },
     "processing": true,
    "serverSide": true,
    "ajax": {
        "url": "/Admin/ListarUsuarios",
        "type": "POST"
    },
    bAutoWidth: false,
    'columns': [
      //{ data: 'ID' },
      { data: 'Nome' },
      //{ data: 'Senha' },
      { data: 'Email' },
      { data: 'CPF' },
      { data: 'DataRegistro' },
      /*
      { data: 'DataUltimoLogin' },
      { data: 'Logado' },
      { data: 'IP' },
             * */
       
      { data: 'Tipo' },
      { data: 'Alterar' },

   ]
  });






  $('#curso').dataTable({
    "oLanguage": {
      "sStripClasses": "",
      "sSearch": "",
      "sSearchPlaceholder": "Insira sua busca aqui",
      "sInfo": "_START_ -_END_ of _TOTAL_",
      "sLengthMenu": '<span>Linhas por página</span><select class="browser-default">' +
        '<option value="10">10</option>' +
        '<option value="20">20</option>' +
        '<option value="30">30</option>' +
        '<option value="40">40</option>' +
        '<option value="50">50</option>' +
        '<option value="-1">All</option>' +
        '</select></div>'
    },
     "processing": true,
    "serverSide": true,
    "ajax": {
        "url": "/Admin/ListarCurso",
        "type": "POST"
    },
    bAutoWidth: false,
    'columns': [
      
      { data: 'Nome' },
      { data: 'Descricao' },
      { data: 'Numero_materias' },
      { data: 'Semestres' },
      { data: 'Tipo' },

      { data: 'Excluir' },
      { data: 'Alterar' }


   ]
  });

$('#materia').dataTable({
    "oLanguage": {
      "sStripClasses": "",
      "sSearch": "",
      "sSearchPlaceholder": "Insira sua busca aqui",
      "sInfo": "_START_ -_END_ of _TOTAL_",
      "sLengthMenu": '<span>Linhas por página</span><select class="browser-default">' +
        '<option value="10">10</option>' +
        '<option value="20">20</option>' +
        '<option value="30">30</option>' +
        '<option value="40">40</option>' +
        '<option value="50">50</option>' +
        '<option value="-1">All</option>' +
        '</select></div>'
    },
     "processing": true,
    "serverSide": true,
    "ajax": {
        "url": "/Admin/ListarMateria",
        "type": "POST"
    },
    bAutoWidth: false,
    'columns': [
      
      { data: 'Nome' },
      { data: 'IDCurso' },
      { data: 'Semestre' },
      
      { data: 'Excluir' },
      { data: 'Alterar' }


   ]
  });
  
    $('#inserircurso').submit(function(event) {
      event.preventDefault(); // Prevent the form from submitting via the browser
      var form = $(this);
      $.ajax({
        type: "POST",
        url: form.attr('action'),
        data: form.serialize(),
        
        beforeSend: function(){
           

         },
        success: function (response) {

          M.toast({html: 'Curso inserido'})

          $('#modal1').modal('close');
          $('#curso').DataTable().ajax.reload();

            
        },
        error: function (data) {
            console.log('An error occurred.');
           
        },
        complete: function(){
            $("#loading").addClass("hide");
         }
      })
    });
    
    
    
    $('#inserirmateria').submit(function(event) {
      event.preventDefault(); // Prevent the form from submitting via the browser
      var form = $(this);
      $.ajax({
        type: "POST",
        url: form.attr('action'),
        data: form.serialize(),
        
        beforeSend: function(){
           

         },
        success: function (response) {

          M.toast({html: 'Materia inserida'})

          $('#modal2').modal('close');
          $('#materia').DataTable().ajax.reload();
          $('#curso').DataTable().ajax.reload();
          
          
          

            
        },
        error: function (data) {
            console.log('An error occurred.');
           
        },
        complete: function(){
            $("#loading").addClass("hide");
         }
      })
    });
  

  $(document).on('click','.excluir', function(){
    var ID = $(this).attr('id');

    $.confirm({
      title: 'Deletar curso',
      content: 'Você quer deletar esse curso?',
      type: 'red',
      typeAnimated: true,
      buttons: {
          tryAgain: {
              text: 'Sim',
              btnClass: 'btn-red',
              action: function(){

                $.ajax({
                  url:"/Admin/DeletarCurso",
                  method:"POST",
                  data:{ID:ID},
                  
                  success:function(data)
                  {
                    
                    M.toast({html: 'Curso deletado'});
                    $('#curso').DataTable().ajax.reload();

                  },
                  error: function (data) {
                    console.log('An error occurred.');
                   
                }
                });

              }
          },
          Cancelar: function () {
          }
      }
  });
		
	});
        
        
        $(document).on('click','.excluir_materia', function(){
    var ID = $(this).attr('id');

    $.confirm({
      title: 'Deletar materia',
      content: 'Você quer deletar essa Materia?',
      type: 'red',
      typeAnimated: true,
      buttons: {
          tryAgain: {
              text: 'Sim',
              btnClass: 'btn-red',
              action: function(){

                $.ajax({
                  url:"/Admin/DeletarMateria",
                  method:"POST",
                  data:{ID:ID},
                  
                  success:function(data)
                  {
                    
                    M.toast({html: 'Materia deletada'});
                    $('#materia').DataTable().ajax.reload();

                  },
                  error: function (data) {
                    console.log('An error occurred.');
                   
                }
                });

              }
          },
          Cancelar: function () {
          }
      }
  });
		
	});

  



  $(document).on('click', '.alterar', function(){
    var ID = $(this).attr('id');
    
		$.ajax({
			url:"/Admin/ListarCursoModal",
			method:"POST",
			data:{ID:ID},
			dataType:"json",
			success:function(data)
			{
        $("#Nome").click();
        $("#textarea2").click();
        
				$("#Nome").val(data.Nome);
          $("#textarea2").val(data.Descricao);				
      },
      error: function (data) {
        console.log('An error occurred.');
       
    }
    });

    $('#alterarcurso').submit(function(event) {
      event.preventDefault(); 
      var form = $(this);
      $.ajax({
        type: form.attr('method'),
        url: form.attr('action'),
        data: form.serialize()+"&ID="+ID,      
        beforeSend: function(){
         },
        success: function (response) {
          M.toast({html: 'Curso alterado'})
          $('#modal3').modal('close');
          $('#curso').DataTable().ajax.reload();            
        },
        error: function (data) {
            console.log('An error occurred.');           
        },
        complete: function(){
            $("#loading").addClass("hide");
         }
      })
    });


    

    
	});
        
        
        
         $(document).on('click', '.alterar_materia', function(){
    var ID = $(this).attr('id');
    
		$.ajax({
			url:"/Admin/ListarMateriaModal",
			method:"POST",
			data:{ID:ID},
			dataType:"json",
			success:function(data)
			{
                            
        
                            $("#nome_materia").val(data.Nome);
                            $("#semestre").val(data.Semestre);
                            //$("#idcurso").val(data.IDCurso).prop('selected', true);
                            
                            
      },
      error: function (data) {
        console.log('An error occurred.');
       
    }
    });

    $('#alterar_materia').submit(function(event) {
      event.preventDefault(); 
      var form = $(this);
      $.ajax({
        type: form.attr('method'),
        url: form.attr('action'),
        data: form.serialize()+"&ID="+ID,      
        beforeSend: function(){
         },
        success: function (response) {
          M.toast({html: 'Materia alterada'})
          $('#modal4').modal('close');
          $('#materia').DataTable().ajax.reload();            
        },
        error: function (data) {
            console.log('An error occurred.');           
        },
        complete: function(){
            $("#loading").addClass("hide");
         }
      })
    });


    

    
	});
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        $(document).on('click', '.alterar_usuario', function(){
    var ID = $(this).attr('id');
    
		$.ajax({
			url:"/Admin/listarUsuarioModal",
			method:"POST",
			data:{ID:ID},
			dataType:"json",
			success:function(data)
			{
                       
                           $("#nome").val(data.Nome); 
                           $("#email").val(data.Email); 
                           $("#cpf").val(data.CPF);
                           
                           $("#tipo").val(data.Tipo).change();

                           
                           //$("#tipo select").val(data.Tipo);

                           //(`#tipo option[value=${data.Tipo}]`).attr('selected','selected');


                            
        			
      },
      error: function (data) {
        console.log('An error occurred.');
       
    }
    });

    $('#alterar_usuario').submit(function(event) {
      event.preventDefault(); 
      var form = $(this);
      $.ajax({
        type: form.attr('method'),
        url: form.attr('action'),
        data: form.serialize()+"&ID="+ID,      
        beforeSend: function(){
         },
        success: function (response) {
            
            
          M.toast({html: 'Usuario alterado'})
          $('#modal').modal('close');
          $('#usuario').DataTable().ajax.reload();  
          
          
        },
        error: function (data) {
            console.log('An error occurred.');           
        },
        complete: function(){
            $("#loading").addClass("hide");
         }
      })
    });


    

    
	});
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        $('#solicitacao').dataTable({
    "oLanguage": {
      "sStripClasses": "",
      "sSearch": "",
      "sSearchPlaceholder": "Insira sua busca aqui",
      "sInfo": "_START_ -_END_ of _TOTAL_",
      "sLengthMenu": '<span>Linhas por página</span><select class="browser-default">' +
        '<option value="10">10</option>' +
        '<option value="20">20</option>' +
        '<option value="30">30</option>' +
        '<option value="40">40</option>' +
        '<option value="50">50</option>' +
        '<option value="-1">All</option>' +
        '</select></div>'
    },
     "processing": true,
    "serverSide": true,
    "ajax": {
        "url": "/Admin/ListarSolicitacaoAvaliada",
        "type": "POST"
    },
    bAutoWidth: false,
    'columns': [
      
      
      { data: 'Curso' },
      { data: 'Nome' },
      { data: 'Data' },
      { data: 'DataProfessor' },
      { data: 'Professor' },
      { data: 'Finalizar' },
      
      
      
      /*
      { data: 'DataUltimoLogin' },
      { data: 'Logado' },
      { data: 'IP' },
             * */
       
      
      

   ]
  });
  
  
  
  
  
  
  
  
$(document).on('click','#finalizar', function(){
    

    $.confirm({
      title: 'Solicitação',
      content: 'Aprovar solicitação',
      type: 'green',
      typeAnimated: true,
      buttons: {
          tryAgain: {
              text: 'Sim',
              btnClass: 'btn-green',
              action: function(){
                  
                  
                  
                  
                


           var id = $("#url").val();

          $.ajax({
            type:   'POST',
            url: '/Admin/avaliarSolicitacaoFinalizar/'+id,

            
            beforeSend: function(){

             },
            success: function (response) {
                console.log('Submission was successful.');
               window.location.href = "/Dashboard/Admin/SolicitacoesAvaliadas"; 
            
            },
            error: function (data) {
                console.log('An error occurred.');
               
            },
            complete: function(){
                $("#loading").addClass("hide");
             }
          })
        
                          
                

              }
          },
          Cancelar: function () {
          }
      }
  });
		
	});
        
        
      
        
        
        $(document).on('click','#retornar', function(){
    

    $.confirm({
      title: 'Solicitação',
      content: 'Retornar ao professor para uma re-avaliação?',
      type: 'red',
      typeAnimated: true,
      buttons: {
          tryAgain: {
              text: 'Sim',
              btnClass: 'btn-red',
              action: function(){
                  
                  
       


           var id = $("#url").val();

          $.ajax({
            type:   'POST',
            url: '/Admin/avaliarSolicitacaoRetornarProfessor/'+id,
            
           
            beforeSend: function(){


             },
            success: function (response) {
                console.log('Submission was successful.');
                window.location.href = "/Dashboard/Admin/SolicitacoesAvaliadas"; 
    

                
            },
            error: function (data) {
                console.log('An error occurred.');
               
            },
            complete: function(){
                $("#loading").addClass("hide");
             }
          })
                  
 
              }
          },
          Cancelar: function () {
          }
      }
  });
		
	});
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
   $('#solicitacao_aprovada').dataTable({
    "oLanguage": {
      "sStripClasses": "",
      "sSearch": "",
      "sSearchPlaceholder": "Insira sua busca aqui",
      "sInfo": "_START_ -_END_ of _TOTAL_",
      "sLengthMenu": '<span>Linhas por página</span><select class="browser-default">' +
        '<option value="2">2</option>' +
        '<option value="5">5</option>' +
        '<option value="30">30</option>' +
        '<option value="40">40</option>' +
        '<option value="50">50</option>' +
        '<option value="-1">All</option>' +
        '</select></div>'
    },
     "processing": true,
    "serverSide": true,
    "ajax": {
        "url": "/Admin/listarSolicitacoesAprovadas",
        "type": "POST"
    },
    bAutoWidth: false,
    'columns': [
      
      { data: 'Nome' },
      { data: 'Curso' },
      { data: 'Servidor' },

     
      { data: 'DataServidor' },
            { data: 'Relatório' },
      
      
      
      /*
      { data: 'DataUltimoLogin' },
      { data: 'Logado' },
      { data: 'IP' },
             * */
       
      
      

   ]
  });
  
  
  
  
  
  
  
  
  
  
  
  
  
 

        
        
        
        
        
        
        
        
        
        
        
        





  
});
