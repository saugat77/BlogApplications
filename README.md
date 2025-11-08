<h1>Blog Application</h1>
A full-stack blog application built with Laravel 10 (backend) and Vue 3 + Bootstrap 5 (frontend), supporting posts, categories, tags, comments, and dynamic filtering with pagination.

<h1>Requirements</h1>
PHP = 8.3
Laravel = 10
Node.js = 20
Vue 3
Bootstrap 5
Composer
npm

<h1>Installations</h1>
git clone https://github.com/yourusername/blog-application.git
cd blog-application
composer install
npm install
npm run dev (to run frontend)
cp .env.example .env

<h3>check mysql path because i am using sqlite.</h3>
php artisan key:generate
php artisan migrate --seed
php artisan serve

<h3>for admin login </h3>
email- admin@example.com
password - password123






Features
<h1>Posts</h1>
Create, edit, delete posts
Assign categories and multiple tags
Post body with truncated preview and full view
Thumbnail support
<h1>Categories & Tags (Only Handled by Admin)</h1>
Categories are single-select while creating post
Tags are multi-select per post

<h1>Comments</h1>
Add comments in post
Real-time comment count display
Filter posts by title, author, category, or tags

Pagination
Server-side pagination with a reusable Pagination component
Modal Forms
Bootstrap modals for creating/editing posts
Soft Deletes
