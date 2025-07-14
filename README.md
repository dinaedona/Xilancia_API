# PHP API with MySQL CRUD Using Stored Procedures

## **Technologies Used**

- **PHP 8.2**  
- **Laravel 10**  
- **MySQL 8**  
- **Docker & Docker Compose**  
- **Postman (for testing)**  

---

## **Project Overview**

This is a RESTful API that performs full CRUD (Create, Read, Update, Delete) operations on a `users` table using **MySQL stored procedures**.

### **Endpoints:**

| Method | Endpoint         | Stored Procedure |
|---------|-----------------|------------------|
| POST    | `/api/users`     | `create_user`    |
| GET     | `/api/users/{id}`| `get_user_by_id` |
| GET     | `/api/users`     | `get_all_users`  |
| PUT     | `/api/users/{id}`| `update_user`    |
| DELETE  | `/api/users/{id}`| `delete_user`    |

---

## **Setup Instructions**

### **1️⃣ Clone the project**

```bash
git clone https://github.com/dinaedona/Xilancia_API.git
cd <project-folder>
```

---

### **2️⃣ Build & Run with Docker**

```bash
docker-compose up --build
```

This will:

- Start the **Laravel API** on `http://127.0.0.1:8000`
- Start **MySQL** on port `3306`

---

### **3️⃣ Environment Configuration**

`.env`:

Ensure this DB configuration matches Docker:

```env
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=company_db
DB_USERNAME=xilancia
DB_PASSWORD=xilancia

CACHE_STORE=file
SESSION_DRIVER=file
```

---

### **4️⃣ Install dependencies**

```bash
docker-compose exec app composer install
```

---

### **5️⃣ Generate App Key**

```bash
docker-compose exec app php artisan key:generate
```

---

### **6️⃣Run Migrations and Import Stored Procedures**

Run Laravel Migrations
This will create the users table and other required tables:

```bash
docker-compose exec app php artisan migrate
```

## **Postman Collection**

A **Postman collection** is provided  `user_api_postman_collection.json`.

You can import it into Postman for easy testing.

---

## **Submission Checklist**
PHP API source code -> `app/Http/Controllers/UserController.php` (check the other dependencies)

SQL File with table and stored procedures -> check migrations `2025_07_12_210546_create_users_table.php` and `2025_07_12_221004_create_user_stored_procedures.php`

Dockerfile and docker-compose.yml  -> in git repository `Dockerfile` and `docker-compose.yml`

README.md  -> this

Postman Collection -> in git repository `user_api_postman_collection.json`

