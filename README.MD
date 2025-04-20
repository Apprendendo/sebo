# Sebo Online

[![GitHub license](https://img.shields.io/github/license/apprendendo/sebo?style=for-the-badge)](https://github.com/apprendendo/sebo)
[![GitHub stars](https://img.shields.io/github/stars/apprendendo/sebo?style=for-the-badge)](https://github.com/apprendendo/sebo/stargazers)
[![GitHub forks](https://img.shields.io/github/forks/apprendendo/sebo?style=for-the-badge)](https://github.com/apprendendo/sebo/network)
[![GitHub issues](https://img.shields.io/github/issues/apprendendo/sebo?style=for-the-badge)](https://github.com/clcmo/mario_game/issues)
[![GitHub donate](https://img.shields.io/github/sponsors/clcmo?color=pink&style=for-the-badge)](https://github.com/sponsors/clcmo)

## Sobre

Este é um projeto de um sistema de gerenciamento de produtos e tipos para um Sebo Online. Ele foi desenvolvido utilizando PHP, Twig e MySQL, e pode ser executado localmente com o XAMPP ou Laragon, ou configurado para produção em um servidor web.

---

## Requisitos

- PHP 8.0 ou superior
- Composer
- MySQL 5.7 ou superior
- XAMPP ou Laragon (para ambiente local)

---

## Configuração para Ambiente Local

### 1. Clonar o repositório

Clone este repositório para o seu ambiente local:

``` bash
git clone https://github.com/apprendendo/sebo.git
cd sebo
```

### 2. Configurar o banco de dados

- Acesse o MySQL pelo terminal ou pelo phpMyAdmin.
- Crie o banco de dados: ```CREATE DATABASE app_sebo;```
- Importe o arquivo database.sql (se existir) para criar as tabelas e popular os dados:

```bash
    mysql -u root -p app_sebo < database.sql
```

### 3. Configurar o projeto

Abra o arquivo config/database.php e configure as credenciais do banco de dados:

```php
<?php
private $host = 'localhost';
private $port = 3306; // Ou a porta configurada no seu MySQL
private $dbname = 'app_sebo'; // Ou o nome configurado pelo seu provedor de hospedagem
private $username = 'root';
private $password = ''; // Adicione a senha do MySQL, se houver
```

Instale as dependências do projeto com o Composer:

```bash
composer install
```

**Com XAMPP:**

- Copie o projeto para o diretório htdocs do XAMPP: ```/Applications/XAMPP/xamppfiles/htdocs/sebo```
- Inicie o Apache e o MySQL pelo painel do XAMPP.
- Acesse o projeto no navegador: ```http://localhost/sebo/public/```

**Com Laragon:*`

- Coloque o projeto no diretório www do Laragon:
```C:\laragon\www\sebo```
- Inicie o Apache e o MySQL pelo painel do Laragon.
- Acesse o projeto no navegador ```http://sebo.test/public/```

---

### 4.Configuração para Produção

1. Configurar o servidor

- Certifique-se de que o servidor tenha suporte para PHP 8.0 ou superior e MySQL.
- Configure o servidor web (Apache ou Nginx) para apontar para o diretório public do projeto.

**Exemplo de configuração para Apache**
No arquivo de configuração do Apache, adicione:

``` htaccess
<VirtualHost *:80>
    ServerName sebo-online.com
    DocumentRoot "/caminho/para/o/projeto/public"

    <Directory "/caminho/para/o/projeto/public">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

2. Configurar o banco de dados

- Crie o banco de dados no servidor de produção.
- Importe o arquivo database.sql para o banco de dados.
- Atualize as credenciais no arquivo config/database.php para refletir o ambiente de produção.

3. Configurar permissões
- Certifique-se de que o servidor tenha permissão para gravar no diretório cache: ```chmod -R 755 cache```

---

## Funcionalidades

- Gerenciamento de produtos (criar, editar, excluir, listar).
- Gerenciamento de tipos de produtos.
- Interface amigável com Bootstrap.

---

## Contribuição

Sinta-se à vontade para contribuir com melhorias para este projeto. Faça um fork, crie uma branch e envie um pull request.

---

## Licença

Este projeto está licenciado sob a MIT License.

---

## Contato

Desenvolvedor: Camila Leite
GitHub: <https://github.com/apprendendo>
Email: <milla@apprendendo.blog>
