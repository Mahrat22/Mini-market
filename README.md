# Mini Market 🛒

A Laravel 11 mini-market application where you can:

- Add new products  
- See all products  
- Search and filter  
- Sort by name, price, stock, or date  
- View product details  
- Edit or delete products  
- Add products to cart  
- Update or remove items from cart  
- Clear the entire cart  
- Flash messages for all actions  

---

## 🚀 Tech Stack
- PHP 8.3  
- Laravel 11  
- MySQL (via Laragon)  
- Bootstrap 5 (UI)  
- Blade templates  

---

## ⚙️ Setup Instructions

Clone the repo:  
```bash
git clone https://github.com/Mahrat22/Mini-market.git
cd Mini-market
```

Install dependencies:  
```bash
composer install
```

Set up environment:  
```bash
cp .env.example .env
```

Configure `.env` database section:  
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mini_market
DB_USERNAME=root
DB_PASSWORD=
```

Generate app key:  
```bash
php artisan key:generate
```

Run migrations:  
```bash
php artisan migrate
```

Start local server:  
```bash
php artisan serve
```

Visit:  
[http://127.0.0.1:8000](http://127.0.0.1:8000)

---

## 👤 Author
**Mohamad Mahrat**
