<div class="row">

    <form  method="POST" action="<?=HOME_URL?>/Usuario/AlterarSenha" id="alterar_senha">
        <div class="input-field col s6 offset-s1">
            <input value="" id="disabled" type="password" class="validate" name="senha_atual" required>
            <label for="disabled">Senha atual</label>
        </div>



        <div class="input-field col s6 offset-s1">

            <input id="password" name="nova_senha" type="password" class="validate"  minlength="8" maxlength="50" required>
            <label for="password">Senha</label>

            <span class="helper-text" data-error="Insira uma Senha válida" data-success="">Deve possuir 8 caracteres </span>
        </div>
        <div class="input-field col s6 offset-s1">
            <input id="passwordConfirm" type="password" required>
            <label for="passwordConfirm">Repita</label>
            <span class="helper-text" data-error="As senhas não coincidem" data-success="">Insira senhas iguais</span>
        </div>



        <div class="input-field col s6 offset-s1">

            <button id="" type="" class="waves-effect waves-light btn green" name="uploadform" value=""><i class="material-icons left"></i>Alterar</button>

        </div>
    </form>
</div>


<script>

    $(document).ready(function () {

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
                            title: 'Houve um erro ao solicitar',
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