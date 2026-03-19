# Laravel Instagram Promotional Poster (Example)

This is a lightweight example Laravel source code snippet that demonstrates:
- Admin form to upload an image and caption.
- Controller that creates a public media URL and publishes it to an Instagram Business account using the Instagram Graph API.

**Important:** This is *example code* meant to be placed into an existing Laravel (v8/9/10) project. It is NOT a full Laravel installer.

## Files included
- routes/web.php
- app/Http/Controllers/InstagramController.php
- resources/views/instagram_form.blade.php
- .env.example

## Setup
1. Place the files into your Laravel project root (merge into existing files/folders).
2. Add environment variables from `.env.example` to your `.env`.
3. Run `composer install` and `php artisan key:generate` if needed.
4. Ensure `storage` is linked: `php artisan storage:link`.
5. Make public/uploads directory writable: `chmod -R 775 storage/`
6. Visit `/admin/instagram` to use the form.

## Notes
- Instagram posting requires an **Instagram Business/Creator** account connected to a Facebook Page, and a **long-lived Page Access Token**.
- The uploaded image must be publicly accessible. This example stores the uploaded image in `storage/app/public/uploads` and uses `asset('storage/uploads/xxx')`.
- For production, store tokens securely (database / encrypted storage), handle errors robustly, and refresh long-lived tokens as required.

## API Versions
Update Graph API version in controller if needed (e.g., v20.0 -> latest).
# PadosiAgent
