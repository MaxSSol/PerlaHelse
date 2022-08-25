# Техническое задание
### Задача: нужно сделать базовый калькулятор со стоимостью доставки заказа (посылки) Новой почты.

### Использованные технологии:
- PHP 7.4
- Laravel
- Vue.js
- Linux
- MySQL
- Laravue admin panel

### Установка
### Скопировать файл .env.example и внести изменения:
- DB_* - Ваши данные
- NOVA_POSHTA_ENDPOINT - https://api.novaposhta.ua/v2.0/json/
- NOVA_POSHTA_API_KEY - Ваш ключ

```bash
# Clone the project and run composer
composer i

# Migration and DB seeder (after changing your DB settings in .env)
php artisan migrate --seed

# Install dependency with NPM
npm install

# Build on production
npm run production

php artisan serve
```

#### Docker - Не работает сборка npm

## Реализованный функционал:
- Меню
![menu delivery](https://i.postimg.cc/WzXq1nzn/New-Project-17.jpg)
- Форма калькулятора
![form](https://i.postimg.cc/MHmKYbQQ/New-Project-18.jpg)
- Валидация полей
![form](https://i.postimg.cc/tC746PgY/New-Project-19.jpg)
- Удобный поиск городов
![form](https://i.postimg.cc/nc48WhMn/New-Project-20.jpg)
- Написаны интеграционные тесты для проверки работы back-end части

## Проверка работы
- Заполняем форму
![passed form](https://i.postimg.cc/yYRPXLnG/New-Project-21.jpg)
- Заполняем такую же форму на сайте Новой почты
![nova_poshta_form](https://i.postimg.cc/ZRDG3wjR/New-Project-22.jpg)
- Результат заполнения формы в админке
![form_result](https://i.postimg.cc/y60dB9NR/New-Project-23.jpg)
- Результат стоимости доставки на сайте Новой почты
![nova_poshta_result](https://i.postimg.cc/9f4xqc46/New-Project-24.jpg)
