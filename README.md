# 🧩 Projeto Base – Laravel 12 DDD Clean Architecture

Este projeto é uma base estruturada em **Laravel 12** seguindo princípios de **Clean Code, SOLID, TDD (Pest)** e **Domain-Driven Design (DDD Pragmático)**.  
A arquitetura é pensada para aplicações escaláveis, testáveis e de fácil manutenção, separando as responsabilidades entre camadas claras.

---

## ⚙️ 1. Estrutura de Pastas (DDD)

```
app/
 ├── Domain/                 # Regras de negócio e contratos
 │    ├── Entities/          # Modelos e entidades do domínio
 │    ├── ValueObjects/      # Objetos de valor (imutáveis, sem identidade)
 │    └── Repositories/      # Interfaces (contratos) de persistência
 │
 ├── Application/            # Casos de uso e DTOs
 │    ├── DTOs/              # Objetos de transporte de dados
 │    ├── Services/          # Serviços de aplicação (coordenam regras de negócio)
 │    └── UseCases/          # Casos de uso isolados (ex: CriarEmpreendimento)
 │
 ├── Infrastructure/         # Implementações técnicas
 │    ├── Persistence/       # Repositórios Eloquent, migrations, factories
 │    ├── Clients/           # Integrações externas (APIs, filas, etc.)
 │    └── Providers/         # Providers para registrar binds e dependências
 │
 ├── Drivers/                # Interfaces de entrada/saída (Delivery Mechanisms)
 │    ├── Http/              # Camada HTTP (Controllers, Requests, Resources)
 │    │    ├── Controllers/  # Controllers finos, apenas orquestram casos de uso
 │    │    ├── Requests/     # Validação via FormRequest
 │    │    └── Resources/    # Transformadores de resposta JSON
 │    ├── Console/           # Comandos Artisan (opcional)
 │    ├── Queue/             # Jobs, Consumers e Listeners (opcional)
 │    └── Events/            # Handlers/Eventos de domínio (opcional)
 │
 ├── Providers/              # Service Providers globais da aplicação
 └── Swagger/                # Schemas e documentação OpenAPI (L5-Swagger)
```

📦 **Benefício:** facilita testes, isolamento de domínios, e segue o padrão **Clean Architecture / DDD pragmático**.

---

## 🧠 2. Padrões e Boas Práticas

| Princípio                     | Aplicação                                                     |
| ----------------------------- | ------------------------------------------------------------- |
| **S – Single Responsibility** | Cada classe com uma única responsabilidade                    |
| **O – Open/Closed**           | Código aberto a extensão e fechado a modificação              |
| **L – Liskov**                | Entidades respeitam herança e polimorfismo                    |
| **I – Interface Segregation** | Interfaces com contratos específicos                          |
| **D – Dependency Inversion**  | Use injeção de dependência e binds em `DomainServiceProvider` |

---

## 🧱 3. Camadas de Negócio

-   **Controllers:** finos, apenas orquestram fluxo (Request → UseCase → Response)
-   **UseCases:** concentram a regra de negócio da aplicação
-   **Repositories:** abstraem o acesso ao banco
-   **DTOs:** transportam dados limpos e tipados entre camadas

---

## 🧩 4. Respostas e Validação

-   Validação via **Form Request**
-   Respostas padronizadas com **Response Macros**

```php
Response::macro('success', fn($data = null, int $status = 200, ?string $message = null) =>
    response()->json(['success' => true, 'message' => $message, 'data' => $data], $status)
);

Response::macro('error', fn(string $message, int $status = 400, $errors = null) =>
    response()->json(['success' => false, 'message' => $message, 'errors' => $errors], $status)
);
```

-   Logs centralizados com `Log::info()` e `Log::error()`

---

## 🧰 5. Ferramentas e Qualidade de Código

| Ferramenta             | Função                                  |
| ---------------------- | --------------------------------------- |
| **Pest**               | Testes unitários e de integração (TDD)  |
| **Larastan (PHPStan)** | Análise estática e verificação de tipos |
| **Laravel Pint**       | Padronização automática do código       |
| **L5-Swagger**         | Documentação OpenAPI 3 integrada        |
| **Response Macros**    | Padrão unificado para respostas JSON    |

### 🔧 Comandos úteis

```bash
# Testes
php artisan test
vendor/bin/pest

# Qualidade de código
vendor/bin/pint
vendor/bin/phpstan analyse

# Limpar caches
php artisan optimize:clear
```

---

## 🧱 6. Banco de Dados

### 🗂️ Convenções Gerais

-   Nomes **no singular** para Models (`Empreendimento`)
-   Nomes **no plural** para tabelas (`empreendimentos`)
-   Use **Eloquent Scopes** para filtros padrão
-   **Factories/Seeders** organizados por domínio

### 🧾 Padrões de Nomenclatura (Laravel + Aurora MySQL)

| Tipo                         | Padrão                                   | Exemplo                                         | Observações                                                              |
| ---------------------------- | ---------------------------------------- | ----------------------------------------------- | ------------------------------------------------------------------------ |
| **Schema (Database)**        | `snake_case` minúsculo                   | `app_core`, `financeiro_db`                     | Use nomes curtos e descritivos. Evite maiúsculas e caracteres especiais. |
| **Tabelas**                  | plural `snake_case`                      | `empreendimentos`, `clientes_enderecos`         | Laravel mapeia `Empreendimento` → `empreendimentos` automaticamente.     |
| **Colunas**                  | `snake_case` minúsculo                   | `data_lancamento`, `qtd_unidades`, `created_at` | Nomes claros e sem abreviações desnecessárias.                           |
| **Chave primária (PK)**      | `id`                                     | `id`                                            | Laravel usa `id` como padrão.                                            |
| **Chaves estrangeiras (FK)** | `{entidade}_id`                          | `cliente_id`, `empreendimento_id`               | Mantém coerência com Eloquent e facilita joins.                          |
| **Índices**                  | `idx_{tabela}_{coluna}`                  | `idx_empreendimentos_nome`                      | Nome explícito facilita manutenção e debugging no Aurora.                |
| **Chaves únicas (unique)**   | `uk_{tabela}_{coluna}`                   | `uk_clientes_cpf`                               | Segue a mesma convenção de índices.                                      |
| **Tabelas pivot (N:N)**      | ordem alfabética singular                | `cliente_empreendimento`                        | Laravel detecta automaticamente em `belongsToMany`.                      |
| **Enums / status**           | prefixo claro + tipo                     | `status_pagamento`, `tipo_contrato`             | Evite siglas e números “mágicos”.                                        |
| **Campos booleanos**         | prefixo `is_`, `has_`, `was_`            | `is_ativo`, `has_contrato`, `was_enviado`       | Melhora legibilidade e semântica.                                        |
| **Timestamps padrão**        | `created_at`, `updated_at`, `deleted_at` | –                                               | Laravel gerencia automaticamente.                                        |
| **Views (Aurora)**           | `vw_{contexto}`                          | `vw_recebiveis_detalhados`                      | Use prefixo `vw_` para identificar views.                                |
| **Procedures (Aurora)**      | `sp_{contexto}_{acao}`                   | `sp_financeiro_calcular_recebiveis`             | Padrão comum em integrações ou rotinas batch.                            |
| **Triggers**                 | `tr_{tabela}_{acao}`                     | `tr_empreendimentos_after_insert`               | Use apenas para ações simples; prefira lógica na aplicação.              |

#### ⚙️ Configurações recomendadas (Aurora)

-   **Charset:** `utf8mb4`
-   **Collation:** `utf8mb4_unicode_ci`
-   **Engine:** `InnoDB`
-   **Time zone:** `UTC`
-   **Replication safe:** mantenha migrations pequenas e atômicas.
-   **Evite nomes reservados** do MySQL (`order`, `group`, `key`, etc).

#### 🧩 Exemplo de Migration

```php
Schema::create('empreendimentos', function (Blueprint $table) {
    $table->id();
    $table->string('nome', 200);
    $table->string('endereco', 255);
    $table->unsignedInteger('qtd_unidades');
    $table->date('data_lancamento');
    $table->boolean('is_ativo')->default(true);
    $table->timestamps();
    $table->softDeletes();

    $table->index('nome', 'idx_empreendimentos_nome');
});
```

---

## 📄 7. Documentação (Swagger)

A documentação da API é gerada via **L5-Swagger**:

```bash
php artisan l5-swagger:generate
```

Acesse via navegador:

```
/api/documentation
```

Schemas ficam em:

```
app/Swagger/Schemas/
```

---

## 🧪 8. Testes com Pest

```
tests/
 ├── Feature/
 │    └── CreateEmpreendimentoTest.php
 └── Unit/
```

Executar testes:

```bash
vendor/bin/pest
vendor/bin/pest tests/Feature/CreateEmpreendimentoTest.php
```

---

## 🐳 9. Uso com Docker (serviço `app`)

### 🧰 Criação do ambiente

```bash
# Subir containers
docker compose up -d

# Instalar dependências Laravel
docker compose exec app composer install

# Copiar .env de exemplo
docker compose exec app cp .env.example .env

# Gerar chave da aplicação
docker compose exec app php artisan key:generate

# Rodar migrations e seeders
docker compose exec app php artisan migrate --seed
```

### 🧹 Manutenção e limpeza de cache/config

```bash
docker compose exec app bash -c "composer dump-autoload && php artisan config:clear && php artisan cache:clear && php artisan route:clear && php artisan view:clear && php artisan optimize:clear"
```

### 🧪 Testes

```bash
docker compose exec app bash -c "vendor/bin/pest"
docker compose exec app bash -c "vendor/bin/pest tests/Feature/CreateEmpreendimentoTest.php"
```

### 🧾 Qualidade de código

```bash
docker compose exec app bash -c "vendor/bin/pint --test"
docker compose exec app bash -c "vendor/bin/phpstan analyse"
```

---

## 📦 10. Dependências principais

| Tipo | Pacote                    | Descrição                            |
| ---- | ------------------------- | ------------------------------------ |
| Core | `laravel/framework:^12.0` | Framework principal                  |
| Dev  | `pestphp/pest`            | Test runner moderno                  |
| Dev  | `nunomaduro/larastan`     | Análise estática (PHPStan + Laravel) |
| Dev  | `laravel/pint`            | Formatter e linter                   |
| API  | `darkaonline/l5-swagger`  | Documentação OpenAPI 3               |

---

## 🚀 11. Padrões de Commit e Branch

| Convenção     | Exemplo                                                 |
| ------------- | ------------------------------------------------------- |
| **feat/**     | `feat: adicionar endpoint de criação de Empreendimento` |
| **fix/**      | `fix: corrigir erro no DTO`                             |
| **refactor/** | `refactor: mover repositório para Infrastructure`       |
| **test/**     | `test: adicionar teste Pest para caso de uso`           |
