# Projeto Integrador – API REST de Alunos (PHP + SQLite)

Este repositório contém o desenvolvimento do meu Projeto Integrador IV, onde implementei uma API REST em PHP para cadastro e gerenciamento de alunos.  
Além da API, também desenvolvi um pequeno cliente em PHP para consumir os endpoints usando o navegador.

A aplicação funciona com operações de CRUD (criar, listar, editar e deletar alunos) e utiliza o banco de dados SQLite, por ser simples e fácil de usar no ambiente da disciplina.

---

## 📁 Estrutura das pastas
projeto_api/
│
├── api/
│ └── alunos.php # Arquivo principal da API REST
│
├── client_php/
│ ├── cadastrar_alunos.php
│ ├── editar_alunos.php
│ ├── deletar_aluno.php
│ └── lista_alunos.php # Tela principal do cliente PHP
│
└── db/
└── alunos.db # Banco de dados SQLite

---

## 🚀 Funcionalidades

### ✔️ API (PHP + JSON)

- `GET /alunos.php` → lista todos os alunos  
- `GET /alunos.php?id=1` → retorna um aluno específico  
- `POST /alunos.php` → cadastra um novo aluno  
- `PUT /alunos.php?id=1` → atualiza os dados de um aluno  
- `DELETE /alunos.php?id=1` → remove um aluno  

A API sempre responde em **JSON**, com mensagens claras e códigos HTTP adequados.

---

## 🖥️ Cliente PHP (interface web)

As páginas localizadas em `client_php/` permitem:

- cadastrar um aluno  
- visualizar lista completa  
- editar os dados  
- excluir um registro  

Tudo isso consumindo a API localmente, usando `file_get_contents()` e `stream_context_create`.

---

## 🗃️ Banco de Dados (SQLite)

A tabela é criada automaticamente ao acessar a API pela primeira vez.  
Estrutura:

- id (PRIMARY KEY)
- nome
- sobrenome
- email
- curso
- matricula
- criado_em (timestamp gerado automaticamente)

---

## ▶️ Como executar o projeto

1. Instale e abra o XAMPP.
2. Coloque esta pasta dentro de:
C:\xampp\htdocs\
3. Inicie o **Apache**.
4. Acesse pelo navegador:

**API:**  
http://localhost/projeto_api/api/alunos.php

**Cliente PHP:**  
http://localhost/projeto_api/client_php/lista_alunos.php

---

## 📹 Vídeo de apresentação

*(adicione aqui o link quando enviar)*  

---

## 🔗 Código-fonte no GitHub

https://github.com/ClarissaMapelli/projeto_integrador_IVB

---

## ✨ Observações finais

Este projeto foi desenvolvido para fins acadêmicos e ajudou bastante na prática com API REST, consumo de serviços, manipulação de JSON e integração com SQLite.  
Toda a estrutura foi construída passo a passo para facilitar manutenção e entendimento.

---

## 📚 Referências utilizadas

- Documentação oficial do PHP  
- Exemplos de API REST com PHP nativo  
- Material disponibilizado pelo professor  
- Pesquisas gerais em fóruns e blogs de desenvolvimento  

