# 🚌 نظام حجز رحلات "الرحالة" (Al-Rahhala Bus Booking API)

نظام API متكامل لبناء وتسهيل حجز الرحلات بين المحافظات وتجنب حجز المقاعد المضاعفة، مبني باستخدام **Laravel 13** و **MySQL 9.5** وفق أفضل الممارسات المعمارية.

---

## 🏗️ المعمارية والحلول التقنية (Architecture Highlights)

1. **API بالكامل (RESTful API Only):**
   الاعتماد الكلي على `routes/api.php` وإرجاع استجابات JSON موحدة، دون استخدام أي Blade Views.

2. **الاستخدام المبرر لـ Service Container & Contextual Binding:**
    - تم استخدام **Strategy Pattern** لتحديد استراتيجيات التسعير عبر الواجهة `PricingStrategyInterface`.
    - تم تطبيق **Contextual Binding** في `AppServiceProvider`:
        - الربط الافتراضي يوجه لـ `StandardPricingService`.
        - الربط السياقي يوجه لـ `VipPricingService` حصراً عند طلب الحجز عبر `VipTripController`.

3. **Controllers نحيفة (Thin Controllers & Form Requests):**
    - نقل منطق التحقق من البيانات إلى `StoreBookingRequest` و `StoreTripRequest`.
    - نقل منطق الأعمال والمعاملات المالية والـ Database Transactions إلى `BookingService`.

4. **معالجة الأخطاء وحماية البيانات:**
    - إنشاء **Custom Exceptions** (`SeatNotAvailableException`, `TripNotFoundException`).
    - ضبط معالج الأخطاء في `bootstrap/app.php` لترجمة أي خطأ في النظام إلى JSON حصراً مع رموز حالة HTTP مناسبة (`400`, `404`, `422`, `500`).

5. **استخدام PHP Enums & Traits:**
    - حصر حالات الحجز في `BookingStatus` Enum (`pending`, `confirmed`, `cancelled`).
    - تسجيل وتتبع الأحداث عبر `LoggableTrait`.

---

## 🚀 تشغيل المشروع محلياً

```bash
# 1. التثبيت وتوليد مفتاح البيئة
composer install
cp .env.example .env
php artisan key:generate

# 2. إعداد قاعدة البيانات وتغذية البيانات
php artisan migrate:fresh --seed


```
