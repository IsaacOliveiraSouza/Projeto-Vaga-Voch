# 💼 Teste Prático para Desenvolvedor Full Stack - VochTech

Este é um sistema completo para gestão de grupos econômicos, suas bandeiras, unidades e colaboradores. Desenvolvido com Laravel 12, Livewire 3 e MySQL. 🚀

## ✨ Funcionalidades

- 🏢 CRUD completo de *Grupos Econômicos*
- 🏳️ CRUD completo de *Bandeiras* (associadas a Grupos Econômicos)
- 🏬 CRUD completo de *Unidades* (associadas a Bandeiras)
- 👥 CRUD completo de *Colaboradores* (associados a Unidades)
- 📊 Sistema de *relatórios filtráveis* de colaboradores
<!---- - 📁 Exportação de relatórios para *Excel*!-->
- 🔐 *Autenticação de usuários*
<!--- 🕵️ *Auditoria* completa (quem alterou, quando e o que)!-->
- ⚡ *Livewire 3* e *WireUI* para interações dinâmicas e responsivas
- 🎨 Interface moderna e experiência do usuário aprimorada

## 🛠️ Tecnologias Utilizadas

- 🐘 PHP 8.2+
- 🌐 Laravel 12.x
- ⚡ Livewire 3.x
- 🧩 WireUI 2.x
- 🔐 Laravel Breeze (autenticação)
- 🐳 Laravel Sail (ambiente Docker)
- 🗄️ MySQL
<!-- - 📤 Laravel Excel (para exportação)
- 📜 Laravel Activity Log (logs)!-->

## 🚧 Instalação

### 1. 🧬 Clonar o repositório

bash
git clone https://github.com/IsaacOliveiraSouza/Projeto-Vaga-Voch.git
cd Projeto-Vaga-Voch


### 2. 📝 Copiar arquivo de ambiente

bash
cp .env.example .env


### 3. 📦 Instalar dependências com Docker (Laravel Sail)

bash
docker run --rm     
-u "$(id -u):$(id -g)"     
-v "$(pwd):/var/www/html"     
-w /var/www/html"     
laravelsail/php84-composer:latest     
composer install --ignore-platform-reqs


### 4. 🧱 Subir os containers

bash
./vendor/bin/sail up --build -d


### 5. 📥 Instalar dependências do backend e frontend

bash
./vendor/bin/sail composer install
./vendor/bin/sail npm install


### 6. 🔑 Gerar a chave da aplicação

bash
./vendor/bin/sail artisan key:generate


### 7. 🧬 Rodar as migrações

bash
./vendor/bin/sail artisan migrate


### 8. 🌱 Popular base de dados com dados mínimos (opcional)

bash
./vendor/bin/sail artisan db:seed


### 9. 🖥️ Iniciar o servidor de desenvolvimento

bash
./vendor/bin/sail npm run dev

<!-- 
## 📊 Relatórios

Acesse o menu *"Colaboradores"*, clique em exportar para gerar uma tabela detalhada dos colaboradores com filtros por:

- 🔤 Nome  
- 🧾 CPF  
- 🏬 Unidade  
- 🏳️ Bandeira  
- 🏢 Grupo Econômico

A tabela pode ser exportada para *Excel* 📥

## 🕵️ Auditoria

Todas as ações de criação, edição e exclusão são registradas com:

- 👤 Nome do usuário que realizou a ação  
- 🕒 Data e hora  
- 🛠️ Tipo da ação  
- 🧱 Entidade alterada  
- 🔄 Dados antigos e novos (se aplicável)

## ⚙️ Fila

Para processar tarefas em segundo plano como exportações:

bash
./vendor/bin/sail artisan queue:work

!-->
---

Desenvolvido por Isaac Oliveira Souza. 👨‍💻
