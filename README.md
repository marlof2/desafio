# Desafio

### Pré-requisitos

Antes de começar, você vai precisar ter instalado em sua máquina as seguintes ferramentas:
[Git](https://git-scm.com), [Node.js](https://nodejs.org/en/). Além disto é bom ter um editor para trabalhar com o
código como [VSCode](https://code.visualstudio.com/)

### 🎲 Rodando o Back End (servidor)

```bash
# No disco local C crie uma pasta chamada desafio
$ dev

# Clone este repositório dentro da pasta
$ git clone <https://github.com/marlof2/desafio.git>

# Acesse a pasta do projeto no terminal/cmd
$ cd desafio

# Vá para a pasta back
$ cd back

# Instale as dependências
$ composer install

# Renomei o arquivo .env.exemple para .env
$ De: desafio/back/.env.testing
$ Para: desafio/back/.env

# Faça a conexão do banco de dados de acordo com o .env do backend
$ path: desafio/back/.env

# Execute a aplicação em modo de desenvolvimento
$ php artisan serve
  *Obs:Lembrando que deve rodar na porta 8000 por que está 
  definido no front, caso ao contrario va no .env do front e troca a porta

# Execulte o comando abaixo para rodas as migrations e as seeds
$ php artisan migrate --seed

```

[//]: # (### Para roda os tests unitários rode esse comando )

[//]: # (```bash)

[//]: # ($ php artisan test --group fluxo-adicionar)

[//]: # ($ php artisan test --group fluxo-alterar)

[//]: # ($ php artisan test --group fluxo-deletar)

[//]: # ($ Obs: Para os dados persistirem no banco comente)

[//]: # (  na linha 17 do arquivo desafio/back/tests/Feature/ClienteTest)

[//]: # (  o &#40;DatabaseTransactions&#41;)

[//]: # (```)

### 🎲 Rodando o Front End

```bash
# Acesse a pasta do projeto no terminal/cmd
$ cd desafio

# Vá para a pasta front
$ cd front

# Instale as dependências
$ npm install

# Execute a aplicação em modo de desenvolvimento
$ npm run serve

# Depois de execultar o comando acima irá aparecer assim
$  App running at:
  - Local:   http://localhost:8080/
  - Network: http://192.168.1.81:8080/
  
# Clica no link que irá abrir no navegador a página de login
$ Clica em fazer login e pronto, o usuario ja está criado no banco
```



