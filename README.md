## Sobre o projeto

Esse projeto é uma API com objetivo de cadastrar dados de um fornecedor somente com o CNPJ do mesmo.

## Guia de instalação

Para iniciarmos a instalação do projetos iremos precisar ter as seguintes dependencias instaladas:

- Docker
- Composer 2

E agora com o terminal aberto, iremos rodar os seguintes comandos:

> Iremos instalar as dependencias do projeto com o comando:
>> - composer install
> 
> Agora iremos subir os containers com o seguinte comando:
>> - docker-compose up -d
> 
> Vamos dar as permissões para o projeto
>> - cd..
>> - sudo chmod 775 -R revendamais-api/*
>> 
> Também iremos realizar a instação das dependencias do projeto dentro do container com o seguinte comando:
>> docker exec -it revendamais-app composer install

## Configuração do .env

> Primeiro passo iremos copiar o .env.example com o comando:
>> - cp .env.example .env
> 
> Já deixei as informações fixadas no .env.example para facilitar o teste da aplicação. (Sendo uma prática não utilizada no mercado, apenas para facilita o teste da aplicação)

## Execução das migrations

> Para executar as migrations, vamos acessar a bash do container e rodar diretamente por lá com o seguinte comando:
>> docker exec -it revendamais-app php artisan migrate

## Guia de utilização das rotas

> **POST** /api/salvarFornecedor - Essa rota é resposável pela criação de um novo fornecedor.
>> Body Example: { "documento": "00.000.000/0000-00" }
>
> **PUT** /api/atualizarFornecedor - Essa rota é resposável pela atualização de um fornecedor.
>> Body Example: { "documento": "00.000.000/0000-00", "razao_social": "Teste realizado", "telefone": "4100000000", "cep": "00000000", "natureza_juridica": "Teste de natureza juridica", "situacao_cadastral": "INAPTA" }
>
> **DELETE** /api/deletarFornecedor - Essa rota é resposável pela exclusão de um fornecedor.
>> Body Example: { "documento": "00.000.000/0000-00" }
>
> **GET** /api/listarFornecedores - Essa rota é resposável pela listagem de todos fornecedores, podendo enviar um body com filtros.
>> Body Example: { "documento": "00.000.000/0000-00", "razao_social": "Teste realizado", "telefone": "4100000000", "cep": "00000000", "natureza_juridica": "Teste de natureza juridica", "situacao_cadastral": "INAPTA" }
>

