# 🚀 Modern Laravel SaaS Frontend

Bem-vindo ao repositório do projeto **Deep Challenge Frontend**. Este projeto é uma aplicação Laravel reestilizada com um visual moderno, limpo e profissional utilizando **Bootstrap 5** e componentes Blade personalizados.

## ✨ Funcionalidades Principais

*   **Design Moderno & Responsivo**: Layout limpo estilo "SaaS" com tipografia Inter, sombras suaves e bordas arredondadas.
*   **Autenticação Estilizada**: Páginas de Login e Registro com cards centralizados, ícones nos inputs e feedback visual claro.
*   **Dashboard Interativo**: Painel de boas-vindas com resumo do usuário e cards de status.
*   **Edição de Perfil Avançada**:
    *   Upload de Avatar com **Preview em Tempo Real** (sem recarregar a página).
    *   Separação clara entre dados pessoais e alteração de senha.
    *   Feedback de validação elegante.
*   **Sistema de Notificações**: Alertas flutuantes (Toasts) para mensagens de sucesso e erro que desaparecem automaticamente.

## 🛠️ Tecnologias Utilizadas

*   **Framework**: [Laravel 10/11](https://laravel.com)
*   **Frontend**: [Bootstrap 5.3](https://getbootstrap.com) (via CDN)
*   **Ícones**: [Bootstrap Icons](https://icons.getbootstrap.com)
*   **Templating**: Blade
*   **Javascript**: Vanilla JS (para interações leves)

---

## 🚀 Como Iniciar o Projeto

Siga os passos abaixo para rodar o projeto localmente em sua máquina.

### Pré-requisitos

Certifique-se de ter instalado:
*   [PHP >= 8.1](https://www.php.net/)
*   [Composer](https://getcomposer.org/)
*   [Node.js & NPM](https://nodejs.org/) (opcional, pois usamos CDN para estilos, mas útil para o ambiente Laravel)
*   Banco de Dados (MySQL, SQLite, etc.)

### 1. Clonar o Repositório

```bash
git clone https://github.com/seu-usuario/seu-repositorio.git
cd seu-repositorio
```

### 2. Instalar Dependências do Backend

```bash
composer install
```

### 3. Configurar Ambiente

Copie o arquivo de exemplo `.env.example` para `.env`:

```bash
cp .env.example .env
```

Gere a chave da aplicação:

```bash
php artisan key:generate
```

### 4. Configurar Banco de Dados

Abra o arquivo `.env` e configure suas credenciais de banco de dados:

```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nome_do_seu_banco
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha
```

### 5. Configurar Link Simbólico (Importante para Imagens)

Para que o upload de avatares funcione corretamente e as imagens sejam acessíveis publicamente, execute:

```bash
php artisan storage:link
```

### 6. Rodar Migrations

Crie as tabelas no banco de dados:

```bash
php artisan migrate
```

### 7. Iniciar o Servidor

Agora basta iniciar o servidor de desenvolvimento do Laravel:

```bash
php artisan serve
```

Acesse o projeto em: `http://localhost:8000`

---

## 📂 Estrutura de Arquivos Relevante

Abaixo estão os principais arquivos modificados para o novo design:

*   `resources/views/layouts/app.blade.php`: Layout mestre com Navbar fixa e importação do Bootstrap.
*   `resources/views/auth/login.blade.php`: Tela de login customizada.
*   `resources/views/auth/register.blade.php`: Tela de registro customizada.
*   `resources/views/dashboard.blade.php`: Painel principal do usuário.
*   `resources/views/profile/edit.blade.php`: Formulário de edição de perfil com preview de imagem.

## 📝 Notas Adicionais

*   **Customização CSS**: Todo o CSS personalizado (fontes, cores, sombras) está inline no `<head>` do `layouts/app.blade.php` para facilitar a portabilidade neste desafio. Em um projeto maior, recomenda-se mover para um arquivo `app.css` separado compilado via Vite.
*   **Avatares**: Se o usuário não tiver um avatar, é gerado um avatar automático com as iniciais usando a API `ui-avatars.com`.

---

Desenvolvido com ❤️ e Laravel.
