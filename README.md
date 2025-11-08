<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blog Application README</title>
</head>
<body>

<h1>Blog Application</h1>
<p>A full-stack blog application built with <strong>Laravel 10</strong> (backend) and <strong>Vue 3 + Bootstrap 5</strong> (frontend), supporting posts, categories, tags, comments, and dynamic filtering with pagination.</p>

<h2>Requirements</h2>
<ul>
    <li>PHP >= 8.3</li>
    <li>Laravel >= 10</li>
    <li>Node.js >= 20</li>
    <li>Vue 3</li>
    <li>Bootstrap 5</li>
    <li>Composer</li>
    <li>npm</li>
</ul>

<h2>Installation</h2>
<ol>
    <li>Clone the repository:
        <pre>git clone https://github.com/yourusername/blog-application.git
cd blog-application</pre>
    </li>
    <li>Install PHP dependencies:
        <pre>composer install</pre>
    </li>
    <li>Install Node dependencies:
        <pre>npm install
npm run dev  <!-- to run frontend --></pre>
    </li>
    <li>Setup environment file:
        <pre>cp .env.example .env</pre>
        <p><strong>Note:</strong> Check your database path; this project uses SQLite by default.</p>
    </li>
    <li>Generate app key:
        <pre>php artisan key:generate</pre>
    </li>
    <li>Run migrations and seeders:
        <pre>php artisan migrate --seed</pre>
    </li>
    <li>Serve the application:
        <pre>php artisan serve</pre>
    </li>
</ol>

<h2>Admin Login</h2>
<ul>
    <li>Email: <code>admin@example.com</code></li>
    <li>Password: <code>password123</code></li>
</ul>

<h2>Features</h2>

<h3>Posts</h3>
<ul>
    <li>Create, edit, delete posts</li>
    <li>Assign categories (single-select) and tags (multi-select)</li>
    <li>Post body with truncated preview and full view</li>
    <li>Thumbnail support</li>
</ul>

<h3>Categories & Tags (Admin Only)</h3>
<ul>
    <li>Categories are single-select when creating a post</li>
    <li>Tags are multi-select per post</li>
</ul>

<h3>Comments</h3>
<ul>
    <li>Add comments to posts</li>
    <li>Real-time comment count display</li>
    <li>Edit and delete comments (for the comment owner)</li>
</ul>

<h3>Filters & Search</h3>
<ul>
    <li>Filter posts by title, author, category, or tags</li>
</ul>

<h3>Pagination</h3>
<ul>
    <li>Server-side pagination with a reusable Pagination component</li>
</ul>

<h3>Modal Forms</h3>
<ul>
    <li>Bootstrap modals for creating and editing posts</li>
</ul>

<h3>Soft Deletes</h3>
<ul>
    <li>Posts, categories, tags, and comments support soft deletes</li>
</ul>

</body>
</html>
