# Painel Jurídico (Legal Dashboard)

O Painel Jurídico é uma aplicação moderna e robusta para gerenciamento de escritórios de advocacia, permitindo o controle de clientes, processos e prazos de forma eficiente. Construído com Laravel, este sistema segue uma arquitetura em camadas limpa e utiliza componentes modernos para uma excelente experiência do usuário.

## 🚀 Funcionalidades Principais

*   **Gestão de Clientes:** Cadastro completo, edição e listagem de clientes com busca e paginação.
*   **Gestão de Processos:** Controle de processos jurídicos vinculados a clientes, com status, valores e número do processo (máscara CNJ).
*   **Controle de Prazos:** Acompanhamento de datas importantes, audiências e entregas, com vínculo direto aos processos.
*   **Dashboard Inteligente:**
    *   **Métricas em Tempo Real:** Total de clientes, processos ativos e prazos pendentes.
    *   **Próximos Prazos:** Lista dinâmica dos 5 prazos mais urgentes.
    *   **Integração com Banco de Dados:** Utiliza Views e Stored Procedures para performance.
*   **Segurança:**
    *   **Autenticação:** Sistema de login seguro.
    *   **Autorização por Policy:** Usuários acessam apenas seus próprios dados.

## 🛠️ Tecnologias Utilizadas

*   **Backend:** PHP 8.2+, Laravel 10+
*   **Frontend:** Blade Templates, Bootstrap 5.3 (CDN), Ícones Bootstrap
*   **Banco de Dados:** MySQL / SQLite
*   **Testes:** PHPUnit (Feature Tests completos)
*   **Ferramentas:** Docker (opcional), Composer, NPM

## 🏗️ Arquitetura do Projeto

O projeto segue princípios de **Clean Code** e **SOLID**, organizado em camadas específicas para garantir manutenibilidade e testabilidade:

*   **Models:** Representação das entidades do banco deados (`App\Models`).
*   **DTOs (Data Transfer Objects):** Transferência de dados tipados entre camadas (`App\DTOs`).
*   **Repositories:** Abstração da camada de dados (`App\Repositories`), utilizando paginação.
*   **Actions:** Classes de responsabilidade única para regras de negócio (`App\Actions`).
*   **Services:** Orquestração entre Repositories e Actions (`App\Services`).
*   **Controllers:**  Responsáveis apenas por receber requisições e devolver respostas (`App\Http\Controllers`).
*   **Policies:** Lógica de autorização (`App\Policies`).

## 📦 Instalação e Configuração

Siga os passos abaixo para rodar o projeto em sua máquina local:

1.  **Clone o repositório:**
    ```bash
    git clone https://github.com/seu-usuario/legal-dashboard.git
    cd legal-dashboard
    ```

2.  **Instale as dependências do PHP:**
    ```bash
    composer install
    ```

3.  **Instale as dependências do Frontend:**
    ```bash
    npm install
    npm run build
    ```

4.  **Configure o ambiente:**
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
    *   Configure as credenciais do seu banco de dados no arquivo `.env`.

5.  **Execute as Migrations e Seeds:**
    Este comando cria as tabelas, views, procedures, triggers e popula o banco com dados de teste.
    ```bash
    php artisan migrate:refresh --seed
    ```

6.  **Inicie o Servidor:**
    ```bash
    php artisan serve
    ```
    Acesse http://localhost:8000.

## 👤 Login de Teste

A execução do `db:seed` cria um usuário padrão para testes imediatos:

*   **E-mail:** `advogado@example.com`
*   **Senha:** `password`

## ✅ Testes Automatizados

O sistema possui uma suíte completa de testes de funcionalidade (Feature Tests) que cobrem todos os fluxos críticos. Para executar os testes:

```bash
php artisan test
```

Testes específicos incluem:
*   `ClientFlowTest`: Fluxo completo de CRUD de clientes.
*   `ProcessFlowTest`: Gestão de processos e vínculos.
*   `DeadlineFlowTest`: Criação e atualização de prazos.
*   `UserFlowTest`: Autenticação e perfil.

## 📚 Documentação da API

A aplicação também expõe uma API RESTful completa.

*   **OpenAPI / Swagger:** A definição da API encontra-se em `docs/openapi.yaml`. Você pode visualizar este arquivo em qualquer editor Swagger.
*   **Postman Collection:** Importe o arquivo `docs/postman_collection.json` no Postman para testar as requisições prontamente.

## 💾 Funcionalidades de Banco de Dados

O sistema utiliza recursos avançados de banco de dados (MySQL):
*   **View (`v_client_summary`):** Agrega dados de processos e prazos por cliente.
*   **Stored Procedure (`sp_get_dashboard_stats`):** Retorna contagens eficientes para o dashboard.
*   **Trigger (`tr_touch_process_update`):** Atualiza automaticamente o `updated_at` do processo quando um prazo vinculado é alterado.

---
Desenvolvido como parte do Deep Challenge.
