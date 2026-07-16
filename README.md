# Laravel Livewire Demo - Payment Gateway CRUD

A sample project using **Laravel 11** and **Livewire** to manage a CRUD 
for payment gateways, including logo upload, validation, and a Bootstrap 
modal form.

---

## ✅ Features

- Register a gateway with name, URL, API keys, fee, and logo
- Dynamic listing powered by Livewire
- Real-time edit and delete
- Responsive UI with Bootstrap 5
- Image upload with live preview in the modal

---

## 📦 Requirements

- PHP >= 8.1
- Composer
- MySQL or PostgreSQL

---

## ⚙️ Getting Started

### 1. Clone the repository

\`\`\`bash
git clone https://github.com/bragaelmo/TesteLivewire.git
cd TesteLivewire
\`\`\`

### 2. Copy the .env file and set up your database connection

\`\`\`bash
cp .env.example .env
\`\`\`

### 3. Install PHP dependencies

\`\`\`bash
composer install
\`\`\`

### 4. Generate the app key and run migrations

\`\`\`bash
php artisan key:generate
php artisan migrate
php artisan storage:link
\`\`\`

### ▶️ Running the project

\`\`\`bash
php artisan serve
\`\`\`

---

### Screenshots

**Index**
![Index](images/index.jpeg)

**Modal Example**
![Modal Example](images/Modal.jpeg)
