<div class="row">
    <div class="input-field col s6 offset-s1">
        <input disabled value="<?= $_SESSION['email'] ?>" id="disabled" type="text" class="validate">
        <label for="disabled"></label>
    </div>


    <form  method="POST" action="<?=HOME_URL?>/Usuario/AlterarEmail" id="alterar_email">
        <div class="input-field col s6 offset-s1">

            <input id="password" name="Email" type="email" class="validate" required minlength="" maxlength="">
            <label for="password">Novo E-mail</label>

            <span class="helper-text" data-error="Insira um E-mail válido" data-success=""></span>
        </div>
        <div class="input-field col s6 offset-s1">
            <input id="passwordConfirm" name="Email2" type="email" required>
            <label for="passwordConfirm">Repita</label>
            <span class="helper-text" data-error="Os e-mails não coincidem" data-success="">Insira e-mails iguais</span>
        </div>



        <div class="input-field col s6 offset-s1">

            <button id="" type="" class="waves-effect waves-light btn green" name="uploadform" value=""><i class="material-icons left"></i>Alterar</button>

        </div>

    </form>

</div>

<script>

    $(document).ready(function () {

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

                        window.location.href = "Perfil/Alterado";
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




</script>