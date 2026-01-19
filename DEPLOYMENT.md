# 🚀 Panduan Deployment Aplikasi SIPP3M

## Deployment ke Production Server

### 1. Server Requirements
- PHP >= 8.2
- MySQL >= 8.0
- Nginx atau Apache
- Composer
- Node.js & NPM
- Git

### 2. Langkah Deployment

#### A. Clone Repository
```bash
cd /var/www/
git clone <repository-url> sipp3m
cd sipp3m
```

#### B. Install Dependencies
```bash
composer install --optimize-autoloader --no-dev
npm install
npm run build
```

#### C. Environment Configuration
```bash
cp .env.example .env
nano .env
```

Konfigurasi file `.env` untuk production:
```env
APP_NAME="SIPP3M"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://ppm.domain.ac.id

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sipp3m_prod
DB_USERNAME=sipp3m_user
DB_PASSWORD=strong_password_here

MAIL_MAILER=smtp
MAIL_HOST=smtp.domain.ac.id
MAIL_PORT=587
MAIL_USERNAME=noreply@domain.ac.id
MAIL_PASSWORD=mail_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@domain.ac.id
MAIL_FROM_NAME="${APP_NAME}"
```

#### D. Generate Application Key
```bash
php artisan key:generate
```

#### E. Database Setup
```bash
php artisan migrate --force
php artisan db:seed --force
```

#### F. Storage & Permissions
```bash
php artisan storage:link
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

#### G. Cache Optimization
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 3. Nginx Configuration

Buat file konfigurasi Nginx:
```bash
sudo nano /etc/nginx/sites-available/sipp3m
```

Isi konfigurasi:
```nginx
server {
    listen 80;
    listen [::]:80;
    server_name ppm.domain.ac.id;
    root /var/www/sipp3m/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

Aktifkan konfigurasi:
```bash
sudo ln -s /etc/nginx/sites-available/sipp3m /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl reload nginx
```

### 4. SSL Certificate (Let's Encrypt)

```bash
sudo apt install certbot python3-certbot-nginx
sudo certbot --nginx -d ppm.domain.ac.id
```

### 5. Setup Cron Job

Edit crontab:
```bash
crontab -e
```

Tambahkan:
```
* * * * * cd /var/www/sipp3m && php artisan schedule:run >> /dev/null 2>&1
```

### 6. Supervisor (Optional - untuk Queue)

Install Supervisor:
```bash
sudo apt install supervisor
```

Buat file konfigurasi:
```bash
sudo nano /etc/supervisor/conf.d/sipp3m.conf
```

Isi:
```ini
[program:sipp3m-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /var/www/sipp3m/artisan queue:work --sleep=3 --tries=3
autostart=true
autorestart=true
user=www-data
numprocs=2
redirect_stderr=true
stdout_logfile=/var/www/sipp3m/storage/logs/worker.log
```

Reload Supervisor:
```bash
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start sipp3m-worker:*
```

## Update Aplikasi

Untuk update aplikasi di production:

```bash
cd /var/www/sipp3m

# Pull perubahan terbaru
git pull origin main

# Update dependencies
composer install --optimize-autoloader --no-dev
npm install
npm run build

# Jalankan migrations (jika ada)
php artisan migrate --force

# Clear & rebuild cache
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Restart services
sudo systemctl reload php8.2-fpm
sudo systemctl reload nginx
```

## Backup Database

Setup backup otomatis:

```bash
# Buat script backup
nano /usr/local/bin/backup-sipp3m.sh
```

Isi script:
```bash
#!/bin/bash
BACKUP_DIR="/backup/sipp3m"
DATE=$(date +%Y%m%d_%H%M%S)
DB_NAME="sipp3m_prod"
DB_USER="sipp3m_user"
DB_PASS="strong_password_here"

# Create backup directory if not exists
mkdir -p $BACKUP_DIR

# Backup database
mysqldump -u $DB_USER -p$DB_PASS $DB_NAME > $BACKUP_DIR/db_backup_$DATE.sql

# Backup files
tar -czf $BACKUP_DIR/files_backup_$DATE.tar.gz /var/www/sipp3m/storage/app/public

# Keep only last 7 days backup
find $BACKUP_DIR -name "*.sql" -mtime +7 -delete
find $BACKUP_DIR -name "*.tar.gz" -mtime +7 -delete
```

Buat executable dan tambahkan ke cron:
```bash
chmod +x /usr/local/bin/backup-sipp3m.sh

# Tambahkan ke crontab (backup setiap hari jam 2 pagi)
0 2 * * * /usr/local/bin/backup-sipp3m.sh
```

## Monitoring & Maintenance

### Check Logs
```bash
tail -f /var/www/sipp3m/storage/logs/laravel.log
```

### Monitor Disk Space
```bash
df -h
du -sh /var/www/sipp3m/storage/app/public/*
```

### Database Optimization
```bash
php artisan optimize:clear
mysql -u root -p
USE sipp3m_prod;
OPTIMIZE TABLE news;
OPTIMIZE TABLE research_products;
```

## Security Checklist

- ✅ APP_DEBUG=false di production
- ✅ Strong database password
- ✅ SSL Certificate aktif
- ✅ File permissions correct (775 untuk storage)
- ✅ .env file tidak accessible dari web
- ✅ Backup rutin setup
- ✅ Update Laravel & dependencies secara berkala
- ✅ Monitor logs untuk suspicious activity
- ✅ Ganti default password admin
- ✅ Setup firewall (ufw)

## Troubleshooting

### 500 Internal Server Error
```bash
php artisan optimize:clear
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

### Storage Link Broken
```bash
rm public/storage
php artisan storage:link
```

### Permission Denied
```bash
sudo chown -R www-data:www-data /var/www/sipp3m
sudo chmod -R 775 storage bootstrap/cache
```

### Database Connection Error
- Check database credentials di `.env`
- Verify MySQL service running: `sudo systemctl status mysql`
- Check database exists: `mysql -u root -p -e "SHOW DATABASES;"`

---

Untuk bantuan lebih lanjut, hubungi tim developer atau baca dokumentasi Laravel official.
