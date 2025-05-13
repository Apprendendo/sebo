# Glossario do PHP

1. Sempre inicio o script com ```<?php ?>``` para indicar que estou codificando uma página com a linguagem PHP.

2. Em ``namespace App/Config``, estou indicando que o arquivo pertence ao objeto/classe de configuração de meu sistema web.

3. Observe o trecho abaixo:
```php
use PDO;
use PDOException;
```
Aqui, informo que usarei as bibliotecas padrões de conexão. O PDO (sigla para PHP Data Objects) é uma extensão do PHP que fornece uma camada de abstração para acesso a bancos de dados relacionais.

4. Em ``public function __construct()``, estou informando que há um construtor responsável pela inicialização da classe no ato de instanciação. Ou seja, quando o operador **new** for invocado juntamente com o nome da classe, **__construct** é chamado implicitamente para fazer as operações que foram definidas.

5. Em Routes/Web: o construtor da classe vai receber um valor, no caso, a página a qual será lida e para onde devemos encaminhar (via Twig e Controller).

        Exemplo: exibir o login caso o usuário não esteja logado ou exibir a interface de cadastro de produto quando eu clico no botão "Novo Produto". 

6. Em Model/Produto: As operações de CRUD são preparadas através de funções que interagirão com a Base de Dados, mas sua ação só pode ser efetiva mediante um chamado do Controller (ou seja, requer a nossa ação na View).

7. Em Controller/Produto: Ele receberá o Model correspondente como parametro para a realização das operações CRUD e a preparação para a view após a mesma.

Fontes e onde estudar mais sobre PHP:

- [MZN - Mozilla](https://developer.mozilla.org/pt-BR/docs/Glossary/PHP)

- [PHP](https://www.php.net/manual/pt_BR/language.oop5.php)
    
    - Ler de Operadores a Namespaces
    - Trazer duvidas para a professora ao longo das aulas
