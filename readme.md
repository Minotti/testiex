## Instalação

Execute os seguintes passos para concluir a instalação

1 - Baixe o projeto **git clone https://github.com/Minotti/testiex.git** e acesse a pasta criada </br>
2 - Execute o comando **composer install** </br>
3 - Copie o .env.example e renomeie para .env </br>
4 - Crie um database e adicione as credenciais em .env </br>
5 - Adicione o Token publishable da API IEXCloud em **IEX_TOKEN** dentro de .env (se utilizar sandbox marque **IEX_SANDBOX** como **true**) </br>
6 - Rode o comando **php artisan key:generate** </br>
7 - Execute **php artisan migrate** </br>
8 - Execute **php artisan serve** para testar a aplicação 
