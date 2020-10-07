$(document).ready(function () {

    const PATH_NAME = window.location.pathname
    const HOME_URL = PATH_NAME.replace(/\/Dashboard.*/,'')

  $('.collapsible-header').click(function () {
        var parent_child = $(this);
        parent_child.toggleClass('collapsed');
        if (parent_child.hasClass('collapsed')) {
            parent_child.children('i.arrow-change').text('arrow_drop_up');
        } else {
            parent_child.children('i.arrow-change').text('arrow_drop_down');
        }
    }); 
    
    $('.slider').slider();
    $('select').formSelect();

    $('.modal').modal();

    $('input#input_text, textarea#textarea2').characterCounter();


    $('.tabs').tabs();

    $('.sidenav').sidenav();

    $('.collapsible').collapsible();

    $('.dropdown-trigger').dropdown();

    $('.datepicker').datepicker({

        format: 'dd-mm-yyyy',

        i18n: {
            cancel: 'Cancelar',
            clear: 'Limpar',
            done: 'Ok',
            months: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"],
            monthsShort: ["Jan", "Feb", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"],
            weekdays: ["Domingo", "Segunda", "Terça", "Quarta", "Quinta", "Sexta", "Sábado"],
            weekdaysShort: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sab"],
            weekdaysAbbrev: ["D", "S", "T", "Q", "Q", "S", "S"]
        }



    });



(function (window, document, undefined) {

    var factory = function ($, DataTable) {
        "use strict";

        $('.search-toggle').click(function () {
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
        DataTable.ext.renderer.pageButton.material = function (settings, host, idx, buttons, page, pages) {
            var api = new DataTable.Api(settings);
            var classes = settings.oClasses;
            var lang = settings.oLanguage.oPaginate;
            var btnDisplay, btnClass, counter = 0;

            var attach = function (container, buttons) {
                var i, ien, node, button;
                var clickHandler = function (e) {
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
            } catch (e) {
            }

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

    $('#nova_solicitacao').dataTable({
        "oLanguage": {
            "sStripClasses": "",
            "sSearch": "",
            "sSearchPlaceholder": "Busque por nome do curso ou aluno",
            "sInfo": "_START_ -_END_ de _TOTAL_",
            "sLengthMenu": '<span>Linhas por página</span><select class="browser-default">' +
                    '<option value="10">10</option>' +
                    '<option value="20">20</option>' +
                    '<option value="30">30</option>' +
                    '<option value="40">40</option>' +
                    '<option value="50">50</option>' +
                   
                    '</select></div>'
        },
        "sZeroRecords":"Nenhum registro encontrado",
        "columnDefs": [
    { "orderable": false, "targets": -1 }
  ],
        "responsive": true,
       
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": HOME_URL+"/Professor/ListarSolicitacao/",
            "type": "POST"
        },
        bAutoWidth: false,
        'columns': [

            {data: 'Curso'},
            {data: 'Nome'},
            {data: 'Data'},
            {data: 'Avaliar'},
        ]
    });


    $(document).on('click', '#avaliar', function () {

        $.confirm({
            title: 'Solicitação',
            content: 'Finalizar solicitação?',
            type: 'green',
            typeAnimated: true,
            buttons: {
                tryAgain: {
                    text: 'Sim',
                    btnClass: 'btn-green',
                    action: function () {

                        var form_data = new FormData(document.getElementById("avaliar_solicitacao"));


                        var id = $("#url").val();

                        $.ajax({
                            type: 'POST',
                            url: HOME_URL+'/Professor/avaliarSolicitacao/' + id,
                            data: form_data,

                            contentType: false,
                            processData: false,
                            beforeSend: function () {
                            },
                            success: function (response) {
                                console.log('Submission was successful.');
                                window.location.href = HOME_URL+"/Dashboard/Professor/NovasSolicitacoes";

                            },
                            error: function (data) {
                                console.log('An error occurred.');

                            },
                            complete: function () {
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


    $(document).on('click', '#documentacao_incompleta', function () {

        $.confirm({
            title: 'Solicitação',
            content: 'Finalizar solicitação como documentação incompleta?',
            type: 'red',
            typeAnimated: true,
            buttons: {
                tryAgain: {
                    text: 'Sim',
                    btnClass: 'btn-red',
                    action: function () {


                        var form_data = new FormData(document.getElementById("avaliar_solicitacao"));

                        var id = $("#url").val();

                        $.ajax({
                            type: 'POST',
                            url: HOME_URL+'/Professor/avaliarSolicitacaoDocInc/' + id,
                            data: form_data,

                            contentType: false,
                            processData: false,
                            beforeSend: function () {
                            },
                            success: function (response) {
                                console.log('Submission was successful.');
                                window.location.href = HOME_URL+"/Dashboard/Professor/NovasSolicitacoes";

                            },
                            error: function (data) {
                                console.log('An error occurred.');

                            },
                            complete: function () {
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



   $(document).on('click', '.perfil_ajax', function () {
        var file = $(this).attr('id');

        $.ajax({
            type: 'POST',
            url: HOME_URL+'/Professor/Perfil/' + file,

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

});









































