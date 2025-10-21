# 🗳️ Laravel New Order Group

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12.X-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel 12.0">
  <img src="https://img.shields.io/badge/PHP-8.4-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP 8.4">
  <img src="https://img.shields.io/badge/Bootstrap-5-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white" alt="Bootstrap 5">
  <img src="https://img.shields.io/badge/License-MIT-green?style=for-the-badge" alt="MIT License">
</p>

> **Учебный проект на Laravel** для управления выборами в сатирическом стиле.

**Laravel New Order Group** - ваше спасение от демократии

---

## 📋 Содержание

- [Особенности](#-особенности)
- [Технологии](#-технологии)
- [Структура базы данных](#-структура-базы-данных)
- [Установка](#-установка)
- [Функциональность](#-функциональность)
- [API Routes](#-api-routes)
- [Роли и права доступа](#-роли-и-права-доступа)
- [Разработка](#-разработка)

---

## ✨ Особенности

- 🎨 **Современный UI/UX** - адаптивный дизайн с Bootstrap 5 и FontAwesome
- 🌓 **Темная тема** - автоматическое переключение между светлой и темной темой
- 🔐 **Система авторизации** - защищенные роуты с middleware
- 👥 **Управление ролями** - разделение прав доступа (admin/user)
- 📱 **Полная адаптивность** - работает на всех устройствах
- ♻️ **Пагинация с настройками** - выбор количества элементов на странице

---

## 🛠️ Технологии

### Backend
- **Laravel 12.0** - PHP фреймворк
- **PHP 8.4** - последняя версия языка
- **MariaDB/MySQL/PostgreSQL** - база данных
- **Eloquent ORM** - работа с БД

### Frontend
- **Bootstrap 5** - UI фреймворк
- **SCSS** - препроцессор CSS
- **FontAwesome** - иконки
- **Vite** - сборщик модулей

### Dev Tools
- **PHPStan** - статический анализатор (Larastan)
- **Laravel Pint** - форматирование кода
- **Pest PHP** - тестирование
- **IDE Helper** - автодополнение для IDE

---

## 🗄️ Структура базы данных

### Таблицы

#### `users`
Пользователи системы с ролями
```
- id (primary key)
- name (string)
- email (string, unique)
- password (hashed)
- role (enum: 'admin', 'user')
- timestamps
```

#### `regions`
Регионы
```
- id (primary key)
- name (string)
- timestamps
```

#### `polling_stations`
Избирательные участки
```
- id (primary key)
- region_id (foreign key → regions)
- stage_number (integer, уникальный номер участка)
- number_of_voters (integer, количество избирателей)
- timestamps
```

#### `candidates`
Кандидаты на выборах
```
- id (primary key)
- name (string)
- timestamps
```

#### `polling_station_results`
Результаты голосования (many-to-many)
```
- id (primary key)
- polling_station_id (foreign key → polling_stations)
- candidate_id (foreign key → candidates)
- number_of_voters (integer, количество голосов)
- timestamps
```

### Связи

- **Region** → hasMany → **PollingStation**
- **PollingStation** → belongsTo → **Region**
- **PollingStation** → belongsToMany → **Candidate** (через polling_station_results)
- **Candidate** → belongsToMany → **PollingStation** (через polling_station_results)

---

## 🚀 Установка

### Требования

- PHP >= 8.4
- Composer
- Node.js >= 18.x
- MariaDB/MySQL/PostgreSQL
- npm или yarn

### Шаги установки

1. **Клонируйте репозиторий**
```bash
git clone https://github.com/GreyStekl0/laravel-new-order-group
cd laravel-city-elections
```

2. **Установите зависимости PHP**
```bash
composer install
```

3. **Установите зависимости Node.js**
```bash
npm install
```

4. **Создайте файл окружения**
```bash
cp .env.example .env
```

5. **Настройте базу данных в `.env`**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_elections
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

6. **Сгенерируйте ключ приложения**
```bash
php artisan key:generate
```

7. **Выполните миграции**
```bash
php artisan migrate
```

8. **Заполните БД тестовыми данными (опционально)**
```bash
php artisan db:seed
```

9. **Скомпилируйте фронтенд ресурсы**
```bash
npm run build
# Или для разработки с hot-reload:
npm run dev
```

10. **Запустите сервер**
```bash
php artisan serve
```

Приложение будет доступно по адресу: `http://localhost:8000`

### Тестовые аккаунты

После выполнения сидеров:
- **Admin**: admin@email.com / adminPassword
- **User**: user@email.com / userPassword

---

## 📱 Функциональность

### Публичные страницы

#### 🏠 Главная страница (Welcome)
- Презентация проекта в фирменном стиле
- Автоматическое переключение темы
- Кнопки входа и навигации

#### 🔑 Авторизация
- Вход в систему с валидацией
- Сообщения об ошибках
- Защита от несанкционированного доступа
- Выход из системы

### Защищенные страницы (требуется авторизация)

#### 🧭 Навигация
- Центральная панель навигации
- Карточки разделов с иконками
- Индикация разделов в разработке

#### 🗺️ Регионы
- **Список регионов** - карточки с информацией
- **Детальная страница региона** - список участков, статистика
- Адаптивная сетка отображения

#### 📍 Участки для голосования
- **Список участков** с пагинацией
- **Детальная информация** - результаты голосования, явка
- **Создание участка** (только admin)
- **Редактирование** (только admin)
- **Удаление** с подтверждением (только admin)
- Визуализация результатов прогресс-барами
- Выбор количества элементов на странице (5, 10, 15, 20, 25, 50)

### Страницы ошибок

#### ⛔ 403 - Доступ запрещён
- Красивая страница с объяснением причин
- Кнопки навигации

#### 🔍 404 - Страница не найдена
- Информативное сообщение
- Быстрые ссылки на популярные разделы
- Юмористическая подпись

---

## 🛣️ API Routes

### Публичные маршруты
```
GET  /                  # Главная страница
GET  /login             # Страница авторизации
POST /auth              # Обработка входа
```

### Защищенные маршруты (auth middleware)
```
GET  /navigation        # Навигационная панель
POST /logout            # Выход из системы

# Регионы
GET  /region            # Список регионов
GET  /region/{id}       # Детальная страница региона

# Участки для голосования
GET    /pollingstation              # Список участков
GET    /pollingstation/create       # Форма создания (admin)
POST   /pollingstation              # Сохранение участка (admin)
GET    /pollingstation/{id}         # Детальная страница
GET    /pollingstation/edit/{id}    # Форма редактирования (admin)
PATCH  /pollingstation/update/{id}  # Обновление участка (admin)
DELETE /pollingstation/destroy/{id} # Удаление участка (admin)
```

---

## 🔐 Роли и права доступа

### Роли пользователей

#### 👤 User (обычный пользователь)
- ✅ Просмотр всех разделов
- ✅ Просмотр статистики
- ❌ Создание/редактирование/удаление

#### 👑 Admin (администратор)
- ✅ Все права пользователя
- ✅ Создание участков
- ✅ Редактирование участков
- ✅ Удаление участков
- ✅ Управление кандидатами (в разработке)
- ✅ Управление результатами (в разработке)

### Gates (настроены в AppServiceProvider)
```php
'manage-polling-stations'        # Управление участками
'manage-candidates'              # Управление кандидатами
'manage-regions'                 # Управление регионами
'manage-polling-station-results' # Управление результатами
```

Использование в Blade:
```blade
@can('manage-polling-stations')
    <!-- Контент для admin -->
@endcan
```

---

## 💻 Разработка

### Запуск в режиме разработки

```bash
# Терминал 1: Laravel сервер
php artisan serve

# Терминал 2: Vite hot-reload
npm run dev
```

### Статический анализ кода

```bash
# PHPStan (Larastan)
./vendor/bin/phpstan analyse

# Laravel Pint (форматирование)
./vendor/bin/pint
```

### Тестирование

```bash
# Запуск всех тестов
php artisan test

# Или с Pest
./vendor/bin/pest
```

### Генерация IDE Helper

```bash
# Автодополнение для моделей
php artisan ide-helper:models

# Общий helper
php artisan ide-helper:generate
```

### Компиляция ресурсов

```bash
# Для production
npm run build

# Для разработки с watch
npm run dev
```

---

## 🤝 Вклад в проект

Проект создан в образовательных целях. Pull requests приветствуются!

1. Fork проекта
2. Создайте feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit изменения (`git commit -m 'Add some AmazingFeature'`)
4. Push в branch (`git push origin feature/AmazingFeature`)
5. Откройте Pull Request

---

<p align="center">
  <sub>Сделано с ❤️ и чувством юмора</sub><br>
  <sub>⚠️ Проект носит сатирический характер и создан исключительно в образовательных целях</sub>
</p>

