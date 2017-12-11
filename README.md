# [Projeto de Leitura de XML com PHP](http://projeto.3sg.com.br/index.php)

Este projeto tem a estrutura necessária para uma simples leitura de um arquivo XML.

**[Demostração Online](http://projeto.3sg.com.br)**

## Configuração do Projeto

Para começar, você irá precisar das seguintes ferramentas:
* NetBeans IDE 8.0.2 ou Eclipse
* XAMPP Control Panel V3.2.2

## Criação do Projeto no NetBeans

### Etapa 1

Com o NetBeans aberto, Clique em `Arquivo`->`Novo Projeto`. Na categoria, selecione `PHP` e em seguida `Aplicação PHP com Códigos-fonte Existentes` e clique em "Próximo"

![Print 1](http://projeto.3sg.com.br/prints/etapa1.png)


### Etapa 2

Nesta etapa vamos definir o nome e localização do projeto.

![Print 1](http://projeto.3sg.com.br/prints/etapa2.png)

Pasta de Fonte - Este deverá apontar o diretório baixado deste repositório

Pasta de Metadados - Recomendo que seja criação na pasta onde foi instalado o "XAMPP"

Depois de definir tudo, clique em "Próximo".

### Etapa 3

Estamos quase lá!

![Print 1](http://projeto.3sg.com.br/prints/etapa3.png)

Clicando em "Finalizar", seu projeto estará pronto para ser executado.

## Configuração no XAMPP

Para a excecução deste projeto é necessário a inclusão de suas dependências.
Esta inclusão é realizada no arquivo `php.ini`

Obs: Neste arquivo readme, vamos considerar que o "XAMPP" esta instalado no diretório "C:\xampp\htdocs\"

* Adicione as seguintes linhas no final do aqui:

 `auto_prepend_file= "C:\xampp\htdocs\projeto.3sg.com.br\WEB-INF\config.header.php"`
 
 `auto_append_file= "C:\xampp\htdocs\projeto.3sg.com.br\WEB-INF\config.footer.php"`
 
 ![Print 1](http://projeto.3sg.com.br/prints/etapa4.png)
 
 Depois de adicionar as 2 linhas no final do arquivo, é necessário a reinicialização do Apache.
 
 Parabêns ! Agora é só voltar para a janela do NetBeans e Executar o projeto 
 

## Sobre

  Optei pela linguagem PHP por ser uma linguagem de programação leve e por já possuir funções nativas para tratar arquivos XML.

Copyright 2017 Guilherme Oliveira Toccacelli



