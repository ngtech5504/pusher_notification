# 🔔 Generic Notification Addon (Laravel 12 + Pusher)

A **plug & play, reusable notification addon** for Laravel 12 projects.  
Designed to be **project-independent**, **override-friendly**, and **mobile-ready** (Flutter / React Native).

---

## 🎯 Features

- ✅ Real-time notifications using **Pusher**
- ✅ Generic & reusable (drop-in any project)
- ✅ Addon-based architecture (no core pollution)
- ✅ Migrations included inside addon
- ✅ Config & migration **publish / override support**
- ✅ Supports **User / Expert / Admin** via morph relations
- ✅ Mobile-friendly payload structure

---

## 📂 Folder Structure

```
app/
 └── Addons/
     └── Notification/
         ├── Contracts/
         ├── Events/
         ├── Helpers/
         ├── Models/
         ├── Services/
         ├── database/
         │   └── migrations/
         ├── routes.php
         ├── config/
         │   └── notification.php
         ├── NotificationServiceProvider.php
         └── README.md
```

---

## ⚙️ Requirements

- PHP 8.2+
- Laravel **12.x**
- Pusher account
- Broadcasting enabled

---

## 🚀 Installation (Any Laravel 12 Project)

### 1️⃣ Copy Addon Folder

Copy the addon into your project:

```
app/Addons/Notification
```

---

### 2️⃣ Register Service Provider (Laravel 12)

📂 Open:
```
bootstrap/app.php
```

Add provider using `withProviders()`:

```php
use App\Addons\Notification\NotificationServiceProvider;

->withProviders([
    NotificationServiceProvider::class,
])
```

⚠️ **Do NOT register services or models here**

---

### 3️⃣ Environment Configuration

Add Pusher keys to `.env`:

```env
BROADCAST_DRIVER=pusher

PUSHER_APP_ID=xxxx
PUSHER_APP_KEY=xxxx
PUSHER_APP_SECRET=xxxx
PUSHER_APP_CLUSTER=ap2
```

---

### 4️⃣ Run Migrations

```bash
php artisan migrate
```

✔ Addon migrations are auto-loaded

---

## 🧩 Optional: Publish & Override

To customize config or migration:

```bash
php artisan vendor:publish --tag=notification-addon
```

This will publish:

```
config/notification.php
database/migrations/*_create_notifications_table.php
```

You may freely modify these files.

---

## 🧠 How It Works

```
Action (Booking / Payment)
        ↓
NotificationService
        ↓
Database Save
        ↓
Pusher Event
        ↓
Mobile App Listener
```

---

## 🔥 Sending a Notification

Use the global helper anywhere:

```php
sendNotification([
    'notifiable_type' => \App\Models\User::class,
    'notifiable_id'   => 1,
    'title'           => 'Booking Confirmed',
    'body'            => 'Your booking is confirmed',
    'type'            => 'booking',
    'data'            => [
        'booking_id' => 10
    ]
]);
```

---

## 📡 Channel Naming Convention

| Receiver | Channel |
|--------|--------|
| User | `private-user-{id}` |
| Expert | `private-expert-{id}` |
| Admin | `admin-global` |

---

## 📱 Mobile Event Payload

Event Name:
```
notification.received
```

Payload:

```json
{
  "id": 1,
  "title": "Payment Received",
  "body": "You received Rs 2000",
  "type": "payment",
  "data": {
    "amount": 2000
  }
}
```

---

## 📥 API Endpoints

### Get Notifications
```
GET /api/notifications
```

### Mark as Read
```
POST /api/notifications/{id}/read
```

---

## 🧠 Best Practices

- ✔ Always use `sendNotification()` helper
- ✔ Keep `type` values short & fixed
- ✔ Use `data` only for navigation
- ❌ Do not call Pusher directly

---

## 🧯 Common Issues

### ❌ `isDeferred()` Error

Cause: Registering a **Service** instead of **ServiceProvider**

Fix:
- Register only `NotificationServiceProvider`
- Clear cache:

```bash
php artisan optimize:clear
```

---

## 🚧 Roadmap (Optional Enhancements)

- Queue support
- Firebase push fallback
- Notification preferences
- Admin UI panel
- Composer package version

---

## 👩‍💻 Maintained By

**NeticSoul**  
Reusable internal framework module

---

## 📄 License

Internal / Proprietary (customize as needed)

