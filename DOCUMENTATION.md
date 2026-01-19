# 📚 Struktur & Dokumentasi Aplikasi SIPP3M

## 📂 Struktur Direktori

```
sipp3m/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/           # Backend Admin Controllers
│   │   │   │   ├── DashboardController.php
│   │   │   │   ├── NewsController.php
│   │   │   │   ├── NewsCategoryController.php
│   │   │   │   ├── ResearchProductController.php
│   │   │   │   ├── AnnouncementController.php
│   │   │   │   ├── DownloadController.php
│   │   │   │   ├── DownloadCategoryController.php
│   │   │   │   ├── HeaderController.php
│   │   │   │   ├── ResearchStatisticController.php
│   │   │   │   ├── ServiceStatisticController.php
│   │   │   │   └── UserController.php
│   │   │   └── Frontend/        # Frontend Public Controllers
│   │   │       ├── HomeController.php
│   │   │       ├── NewsController.php
│   │   │       ├── ResearchProductController.php
│   │   │       ├── AnnouncementController.php
│   │   │       ├── DownloadController.php
│   │   │       └── ChartController.php
│   │   └── Middleware/
│   │       ├── AdminMiddleware.php
│   │       └── AdminOrOperatorMiddleware.php
│   └── Models/                  # Database Models
│       ├── User.php
│       ├── Header.php
│       ├── NewsCategory.php
│       ├── News.php
│       ├── ResearchProduct.php
│       ├── Announcement.php
│       ├── DownloadCategory.php
│       ├── Download.php
│       ├── ResearchStatistic.php
│       └── ServiceStatistic.php
├── database/
│   ├── migrations/              # Database Migrations
│   └── seeders/                 # Database Seeders
│       ├── DatabaseSeeder.php
│       ├── AdminSeeder.php
│       ├── NewsCategorySeeder.php
│       ├── DownloadCategorySeeder.php
│       └── HeaderSeeder.php
├── resources/
│   └── views/
│       ├── layouts/             # Layout Templates
│       │   ├── admin.blade.php
│       │   └── frontend.blade.php
│       ├── admin/               # Backend Views
│       │   ├── dashboard.blade.php
│       │   └── news/
│       │       └── index.blade.php
│       └── frontend/            # Frontend Views
│           ├── home.blade.php
│           └── charts/
│               └── index.blade.php
└── routes/
    └── web.php                  # Routes Definition
```

## 🗄️ Database Schema

### Users Table
```sql
- id (PK)
- name
- email (unique)
- password
- role (enum: admin, operator)
- timestamps
```

### Headers Table
```sql
- id (PK)
- logo (nullable)
- institution_name
- menu_items (JSON)
- is_active (boolean)
- timestamps
- deleted_at (soft delete)
```

### News Categories Table
```sql
- id (PK)
- name
- slug (unique)
- description (nullable)
- timestamps
- deleted_at
```

### News Table
```sql
- id (PK)
- news_category_id (FK)
- user_id (FK)
- title
- slug (unique)
- content (text)
- image (nullable)
- status (enum: draft, published)
- published_at (nullable)
- views (integer, default: 0)
- timestamps
- deleted_at
```

### Research Products Table
```sql
- id (PK)
- title
- slug (unique)
- description (text)
- researcher
- year
- type (enum: penelitian, pengabdian)
- image (nullable)
- file (nullable)
- link (nullable)
- timestamps
- deleted_at
```

### Announcements Table
```sql
- id (PK)
- title
- content (text)
- start_date
- end_date
- is_important (boolean)
- is_active (boolean)
- timestamps
- deleted_at
```

### Download Categories Table
```sql
- id (PK)
- name
- slug (unique)
- description (nullable)
- timestamps
- deleted_at
```

### Downloads Table
```sql
- id (PK)
- download_category_id (FK)
- title
- description (nullable)
- file
- file_type (nullable)
- file_size (nullable)
- download_count (integer, default: 0)
- timestamps
- deleted_at
```

### Research Statistics Table
```sql
- id (PK)
- year
- count (integer)
- category (nullable)
- timestamps
- deleted_at
```

### Service Statistics Table
```sql
- id (PK)
- prodi
- count (integer)
- year (nullable)
- timestamps
- deleted_at
```

## 🔗 Model Relationships

### User Model
```php
hasMany: News
methods: isAdmin(), isOperator()
```

### NewsCategory Model
```php
hasMany: News
```

### News Model
```php
belongsTo: NewsCategory (category)
belongsTo: User (author)
scopes: published()
```

### DownloadCategory Model
```php
hasMany: Download
```

### Download Model
```php
belongsTo: DownloadCategory (category)
methods: incrementDownloadCount()
```

### Announcement Model
```php
scopes: active(), important()
```

### ResearchProduct Model
```php
scopes: byYear(), byType()
```

## 🛣️ Routes Summary

### Public Routes
- `GET /` - Homepage
- `GET /berita` - News index
- `GET /berita/{slug}` - News detail
- `GET /produk-penelitian` - Research products
- `GET /pengumuman` - Announcements
- `GET /download` - Downloads
- `GET /grafik` - Charts

### Admin Routes (Protected)
- `GET /admin/dashboard` - Dashboard
- Resource routes untuk:
  - `/admin/news`
  - `/admin/news-categories`
  - `/admin/research-products`
  - `/admin/announcements`
  - `/admin/downloads`
  - `/admin/download-categories`
  - `/admin/research-statistics`
  - `/admin/service-statistics`
  - `/admin/users` (Admin only)

### API Routes (for Charts)
- `GET /api/chart/research` - Research statistics data (JSON)
- `GET /api/chart/service` - Service statistics data (JSON)

## 🔒 Middleware

### AdminMiddleware
- Memastikan user adalah admin
- Digunakan untuk routes yang hanya boleh diakses admin

### AdminOrOperatorMiddleware
- Memastikan user adalah admin atau operator
- Digunakan untuk sebagian besar admin routes

## 🎨 Frontend Components

### Layout
- Responsive navbar dengan Bootstrap 5
- Sticky header
- Footer dengan informasi kontak
- Mobile-friendly navigation

### Home Page
- Hero section
- Latest news cards (6 items)
- Latest research products (6 items)
- Important announcements alert
- Quick links section

### News Page
- Grid layout dengan cards
- Category badges
- Search functionality
- Pagination
- Related news

### Charts Page
- Bar chart untuk penelitian per tahun
- Pie chart untuk pengabdian per prodi
- Responsive charts dengan Chart.js

## 🎛️ Admin Interface

### Dashboard
- Statistics cards (berita, penelitian, pengumuman, downloads)
- Recent news list dengan thumbnail
- Recent research products
- Quick actions

### CRUD Operations
- Consistent UI across all modules
- Form validation
- Image/file upload
- Soft deletes
- Pagination
- Search/filter

## 📝 Coding Standards

### Naming Conventions
- Models: Singular, PascalCase (News, ResearchProduct)
- Controllers: PascalCase + Controller suffix
- Methods: camelCase (index, store, update)
- Variables: camelCase ($latestNews, $categories)
- Database: snake_case (news_categories, research_products)

### Comments
```php
/**
 * Brief description of the method.
 * 
 * @param Type $param Description
 * @return Type Description
 */
```

### Validation
Semua input divalidasi menggunakan Laravel validation rules

### Security
- CSRF protection enabled
- XSS prevention dengan `{{ }}` escaping
- SQL injection prevention dengan Eloquent ORM
- File upload validation
- Role-based access control

## 🔧 Konfigurasi

### Environment Variables
```env
APP_NAME=SIPP3M
APP_ENV=production
APP_DEBUG=false
APP_URL=https://ppm.domain.ac.id

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_DATABASE=sipp3m
```

### Storage
- Public disk untuk uploaded files
- Symbolic link: `public/storage` → `storage/app/public`
- Upload directories:
  - `storage/app/public/news/` - Gambar berita
  - `storage/app/public/research/` - File penelitian
  - `storage/app/public/downloads/` - File download

## 📊 Performance

### Caching
- Config cache: `php artisan config:cache`
- Route cache: `php artisan route:cache`
- View cache: `php artisan view:cache`

### Optimization
- Eager loading untuk relationships
- Pagination untuk large datasets
- Image optimization recommended
- CDN untuk Bootstrap & Chart.js

## 🧪 Testing

### Manual Testing Checklist
- [ ] Registration & Login
- [ ] Create/Edit/Delete berita
- [ ] Upload images & files
- [ ] View frontend pages
- [ ] Check responsive design
- [ ] Test charts display
- [ ] Test search functionality
- [ ] Test pagination
- [ ] Test role permissions
- [ ] Test file downloads

### Unit Testing (Future)
```bash
php artisan test
```

## 🚀 Deployment Checklist

- [ ] Update .env untuk production
- [ ] Run migrations
- [ ] Run seeders
- [ ] Storage link
- [ ] Cache optimization
- [ ] File permissions
- [ ] SSL certificate
- [ ] Backup setup
- [ ] Monitoring setup

---

## 📞 Support & Maintenance

### Regular Maintenance
1. Check logs: `storage/logs/laravel.log`
2. Monitor disk space
3. Database backup
4. Update dependencies
5. Security updates

### Common Issues & Solutions
Lihat [DEPLOYMENT.md](DEPLOYMENT.md) untuk troubleshooting guide.

---

Dokumentasi ini akan diupdate seiring dengan perkembangan aplikasi.
