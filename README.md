# Laravel Inertia Vue JS SPA

This project integrates **Laravel 12**, **Inertia.js**, and **Vue 3** to build a **Single Page Application (SPA)** for Hospital management, styled with **Tailwind CSS**.

---

## 🛠️ Features

* **Backend:**

  * **Laravel 12**: Robust PHP framework for backend development.
  * **Inertia.js**: Build SPAs without a separate API, maintaining server-side routing.
  * **Authentication**: Built-in Laravel authentication.

* **Frontend:**

  * **Vue 3**: Progressive JavaScript framework for building user interfaces.
  * **Tailwind CSS**: Utility-first CSS framework for rapid UI development.
  * **CRUD Operations**: Create, Read, Update, Delete inventory items.

---

## 🚀 Setup Instructions

### 1. Clone the Repository

```bash
git clone https://github.com/meetshahab2/laravel-inertia-vue-js.git
cd laravel-inertia-vue-js
```

### 2. Install Backend Dependencies

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
```

### 3. Install Frontend Dependencies

```bash
npm install
npm run dev
```

### 4. Run the Development Server

```bash
php artisan serve
```

Visit the app at [http://localhost:8000](http://localhost:8000).

---

## 🧪 Testing

```bash
php artisan test
```

---

## 🔗 Documentation & Resources

* **Inertia.js:** [https://inertiajs.com](https://inertiajs.com)
* **Vue 3:** [https://v3.vuejs.org](https://v3.vuejs.org)
* **Tailwind CSS:** [https://tailwindcss.com](https://tailwindcss.com)

---

## 📄 License

This project is open source and available under the [MIT License](LICENSE).

---

## 🏷️ Repository Topics (GitHub Compliant)

`laravel`, `vue`, `vue3`, `inertia-js`, `tailwind-css`, `spa`, `crud`, `php`
