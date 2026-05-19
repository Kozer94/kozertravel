# KozerTravel — دليل النشر على Hostinger Shared Hosting

## المتطلبات الأساسية

| المتطلب | الإصدار الأدنى |
|---------|---------------|
| PHP | 8.2+ |
| MySQL / SQLite | أي منهما |
| mod_rewrite | مفعّل (Hostinger يدعمه افتراضياً) |
| Composer | 2.x (متاح عبر SSH) |

---

## الخطوة 1 — تحضير ملفات المشروع

### على جهازك المحلي (Windows):

**إذا كان عندك Git Bash أو WSL:**
```bash
cd c:/Users/kozer/Desktop/KozerTravel
bash build.sh
```

**إذا لم يكن عندك bash، اضغط الملفات يدوياً:**
1. افتح مجلد المشروع
2. اختر كل الملفات **ما عدا**: `vendor/`، `node_modules/`، `.git/`، `.env`
3. اضغطها في ملف ZIP

> ملاحظة: لا ترفع `vendor/` — سيتم تنزيله عبر Composer على السيرفر.

---

## الخطوة 2 — رفع الملفات عبر Hostinger File Manager

1. ادخل إلى **hPanel** → **File Manager**
2. انتقل إلى مجلد `public_html/`
3. احذف الملفات الافتراضية (`index.html`, `index.php` إن وجدت)
4. اضغط **Upload** وارفع ملف الـ ZIP
5. بعد الرفع، اضغط بالزر الأيمن على الـ ZIP → **Extract**
6. تأكد أن الملفات ظهرت مباشرةً في `public_html/` (لا في مجلد فرعي)

### البنية الصحيحة المطلوبة:
```
public_html/
├── .htaccess          ← يحوّل الطلبات إلى public/
├── app/
├── bootstrap/
├── config/
├── database/
├── public/
│   ├── .htaccess      ← Laravel mod_rewrite
│   ├── index.php
│   └── build/
├── resources/
├── routes/
├── storage/
└── ...
```

---

## الخطوة 3 — تشغيل Composer عبر SSH

### تفعيل SSH في Hostinger:
1. hPanel → **SSH Access** → Enable
2. استخدم PuTTY أو Terminal للاتصال:
   ```
   ssh username@kozertravel.com -p 65002
   ```

### تثبيت التبعيات:
```bash
cd ~/public_html
composer install --no-dev --optimize-autoloader
```

> إذا لم يكن Composer موجوداً في الـ PATH:
> ```bash
> php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
> php composer-setup.php
> php composer.phar install --no-dev --optimize-autoloader
> ```

---

## الخطوة 4 — إعداد ملف .env

```bash
cp .env.production .env
nano .env
```

### القيم التي يجب تعديلها:

```env
APP_KEY=                          # سيتم توليده تلقائياً في الخطوة التالية
APP_URL=https://kozertravel.com

# SQLite (الأبسط للـ shared hosting):
DB_CONNECTION=sqlite
DB_DATABASE=/home/u123456789/public_html/database/database.sqlite

# أو MySQL إذا أنشأت قاعدة بيانات في hPanel:
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=u123456789_kozertravel
# DB_USERNAME=u123456789_user
# DB_PASSWORD=YOUR_PASSWORD

# البريد الإلكتروني (من hPanel → Email):
MAIL_USERNAME=noreply@kozertravel.com
MAIL_PASSWORD=YOUR_EMAIL_PASSWORD
```

### توليد APP_KEY:
```bash
php artisan key:generate
```

---

## الخطوة 5 — تشغيل Migrations

### إنشاء ملف SQLite (إذا استخدمت SQLite):
```bash
touch database/database.sqlite
```

### تشغيل الـ migrations:
```bash
php artisan migrate --force
```

### تشغيل الـ seeders (أول مرة فقط):
```bash
php artisan db:seed --force
```

> هذا سينشئ المستخدم الأدمن وبيانات الموقع الأساسية.

بيانات الدخول للوحة التحكم:
- **URL**: `https://kozertravel.com/admin/login`
- **Email**: `admin@skyroute.com`
- **Password**: `Admin@2026`

---

## الخطوة 6 — إعدادات نهائية

```bash
# ربط مجلد storage/app/public بـ public/storage
php artisan storage:link

# تحسين الأداء (مهم جداً للإنتاج):
php artisan config:cache
php artisan route:cache
php artisan view:cache

# التحقق من الصلاحيات:
chmod -R 755 storage bootstrap/cache
chmod -R 644 storage/logs
```

---

## الخطوة 7 — إعداد PHP Version في Hostinger

1. hPanel → **PHP Configuration**
2. اختر **PHP 8.2** أو **8.3**
3. تأكد من تفعيل هذه الامتدادات:
   - `pdo_sqlite` أو `pdo_mysql`
   - `mbstring`
   - `openssl`
   - `tokenizer`
   - `xml`
   - `ctype`
   - `fileinfo`

---

## الخطوة 8 — إعداد SSL

1. hPanel → **SSL** → **Force HTTPS** ✓
2. تأكد أن `APP_URL` في `.env` يستخدم `https://`

---

## استكشاف الأخطاء الشائعة

| المشكلة | الحل |
|---------|------|
| صفحة 500 عند الدخول | تحقق من `storage/logs/laravel.log` |
| صفحة بيضاء | تأكد `APP_DEBUG=false` والـ `.env` موجود |
| خطأ Composer | تأكد من إصدار PHP 8.2+ |
| Storage لا يعمل | شغّل `php artisan storage:link` |
| 404 على كل الصفحات | تحقق من `.htaccess` في المجلد الرئيسي |
| خطأ في قاعدة البيانات | تأكد مسار `DB_DATABASE` الكامل في SQLite |

---

## تحديث الموقع لاحقاً

```bash
# على جهازك: ارفع الملفات المعدّلة فقط
# عبر SSH:
cd ~/public_html
php artisan migrate --force          # إذا أضفت migrations جديدة
php artisan config:cache
php artisan route:cache
php artisan view:clear
```

---

## ملاحظة على الـ Cron Jobs (اختياري)

إذا أردت تشغيل Laravel Scheduler:

hPanel → **Cron Jobs** → أضف:
```
* * * * * php ~/public_html/artisan schedule:run >> /dev/null 2>&1
```
