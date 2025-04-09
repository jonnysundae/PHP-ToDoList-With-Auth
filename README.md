
# ✅ To-Do List com Autenticação - PHP & MySQL

Este projeto é uma aplicação web de lista de tarefas (**To-Do List**) com **sistema de login e cadastro de usuários**, desenvolvida usando **PHP** e **MySQL**. Ele segue boas práticas de separação de camadas (model, service, controller) e utiliza **hash de senha**, **exceções personalizadas** e **CRUD completo para tarefas** e parcial para usuários.

## 🛠️ Tecnologias Utilizadas

- PHP (Programação Orientada a Objetos)
- MySQL
- PDO (para conexões seguras)
- HTML5 + CSS3
- Sessões PHP
- Exceções customizadas

## 📦 Como Rodar o Projeto

1. Clone o repositório:
   ```bash
   https://github.com/jonnysundae/PHP-ToDoList-With-Auth
   ```

2. Importe o banco de dados:
   - Use o arquivo `database.sql` para criar o banco de dados.

3. Configure o acesso ao banco no arquivo `app/config/BancoDeDados.php`:
   ```php
   private static $bd = 'mysql:host=localhost;dbname=lista';
   private static $usuario = 'root';
   private static $senha = '';
   ```

4. Rode em um servidor local como XAMPP, WAMP, etc.



## 🧱 Estrutura de Pastas

```
(Em breve)
```


## 🧬 Histórico de Evolução do Projeto

| Data       | Versão | Alterações                                                                 |
|------------|--------|---------------------------------------------------------------------------|
| 04/04/2025 | 1.0    | Estrutura base com autenticação e listas                                 |
| 06/04/2025 | 1.1    | Inicio da atualização para POO, iniciado pelo login do usuário                  |
| 09/04/2025 | 1.2    | Atualizado o código da criação de usuário                 |


### 📦 Versão 1 (Inicial)
- Conexão com banco feita via `mysql_connect` (função obsoleta)
- Estrutura procedural, sem uso de **Programação Orientada a Objetos**
- Ausência de separação clara de responsabilidades (tudo no mesmo arquivo)
- Operações de login e cadastro com SQL direto no código (sem prepared statements)
- Sem arquitetura em camadas

### 🚀 Versão 1.1
- Parcialmente refatorado usando **PHP com POO (Programação Orientada a Objetos)**
- Conexão ao banco via **PDO**, com uso de `prepare()` e `execute()` (segurança contra SQL Injection)
- Separação clara de responsabilidades:
  - `model/` (Modelos com getters e setters)
  - `service/` (Acesso ao banco e lógica de negócio)
  - `controller/` (Controle do fluxo da aplicação)
- Sistema de autenticação com:
- Início da implementação de CRUD completo (usuários e tarefas)

### 🚀 Versão 1.2 (Atual)
- Atualizado o código da criação de usuário
- Deletado arquivos legados de login e criação de usuário
- Novas exceptions adicionadas

## 💡 Melhorias Futuras

- [ ] Montar CRUD para as listas
- [ ] Atualizar/deletar conta do usuário
- [ ] Criar interface com HTML, CSS e Javascript

## 🔐 Funcionalidades de Autenticação (CRUD de Usuário)

- [x] Cadastro de usuário com senha criptografada
- [x] Login com verificação de senha via `password_verify`
- [x] Exceções personalizadas para email e senha
- [ ] Atualizar dados do usuário (em breve)
- [ ] Deletar conta do usuário (em breve)


## 📋 Funcionalidades da Lista de Tarefas (CRUD Completo)
*Ainda não está no paradigma POO.*
- [ ] Criar nova tarefa
- [ ] Listar tarefas por usuário
- [ ] Editar título e status da tarefa
- [ ] Deletar tarefa
- [ ] Marcar tarefa como concluída
- [ ] Filtro por status (pendente/concluída)
