# SAEIFB-1.0-BETA por Hellyson M.

### Programa Web Para Gestão escolar para o Insitituto Federal de Brasília Utilizando PHP MVC OO JQUERY JAVASCRIPT CSS3 HTML5 PHPMAILER DOMPDF E MATERIALIZE FRAMEWORK
Dependências Materialize, CSS ,JQUERY PHP MAILER, DOMPDF.
10.4.13-MariaDB UTF-8 Unicode (utf8mb4)
Apache/2.4.43 (Win64) OpenSSL/1.1.1g PHP/7.2.31

# INSTALAÇÃO 

IMPORTE O ARQUIVO SQL PARA SEU BANCO DE DADOS.

CONFIGURE O NOME DO SEU BANCO DE DADOS COM USUARIO E SENHA EM /lib/ini-config.ini, o sistema de roteamento e as chaves da API Google Maps(obrigátorio).

REGISTRE-SE COMO USUÁRIO. Mude o campo Usuario.Tipo do banco de dados para 4(Usuário administrador). 

OBS : TIPO 1 (USUARIO COMUM) TIPO 2 (ALUNO) - TIPO 3 (PROFESSOR) - TIPO 4 (ADMINISTRADOR) - TIPO 5 (SERVIDOR).

Certifique-se que o strict mode do mysql esteja desabilitado.
Do contrário, execute a seguinte linha no terminal do mysql:
```
SET GLOBAL sql_mode = '';

```
## SMTP

Configure seu servidor SMTP em => /lib/classes/Functions.class.php
Sua configuração não é obrigatória, mas algumas funcionalidades dependem de um servidor de SMTP corretamente configurado.
