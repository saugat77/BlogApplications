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

<div class="container">
    <h1 class="mb-4">Blog Application - User Manual</h1>

    <h2>1. Login</h2>
    <p>To access the admin features, login using the admin account:</p>
    <ul>
        <li>Email: <code>admin@example.com</code></li>
        <li>Password: <code>password123</code></li>
    </ul>

    <h2>2. Dashboard Overview</h2>
    <p>After login, you will see the list of posts with the following information:</p>
    <ul>
        <li>Post Title</li>
        <li>Author Name</li>
        <li>Category Name</li>
        <li>Thumbnail & Body preview</li>
        <li>Comment count</li>
    </ul>

    <h2>3. Managing Posts</h2>
    <ol>
        <li><strong>Create a Post:</strong> Click the <code>New Post</code> button. Fill out the title, body, thumbnail, select a category, and choose tags. Click <code>Create</code> to save.</li>
        <li><strong>Edit a Post:</strong> Click <code>Edit</code> on a post card. Update any field and click <code>Update</code>.</li>
        <li><strong>Delete a Post:</strong> Click <code>Delete</code> on a post card. Confirm deletion to remove the post.</li>
    </ol>

    <h2>4. Categories & Tags</h2>
    <p>These are managed by admin only:</p>
    <ul>
        <li>Categories: single-select per post</li>
        <li>Tags: multi-select per post</li>
    </ul>

    <h2>5. Comments</h2>
    <p>Each post can have comments. Features include:</p>
    <ul>
        <li>Click <code>Show Comments</code> to expand comments</li>
        <li>View the total number of comments per post</li>
        <li>Add a comment in the input box and click <code>Send</code></li>
        <li>Edit or delete a comment (for your own comments)</li>
    </ul>

    <h2>6. Searching and Filtering Posts</h2>
    <p>Use the search/filter panel at the top to narrow down posts:</p>
    <ul>
        <li>Filter by Title</li>
        <li>Filter by Author</li>
        <li>Filter by Category</li>
        <li>Filter by Tags</li>
        <li>Click <code>Search</code> to apply filters or <code>Reset</code> to clear them</li>
    </ul>

    <h2>7. Pagination</h2>
    <p>Posts are paginated. Use the pagination controls at the bottom of the page to navigate between pages.</p>

    <h2>8. Modal Forms</h2>
    <p>Creating or editing a post opens a modal form (popup) for entering details. Features include:</p>
    <ul>
        <li>Title input</li>
        <li>Body textarea</li>
        <li>Thumbnail textarea</li>
        <li>Category selection (single-select)</li>
        <li>Tags selection (multi-select)</li>
        <li><code>Create</code> or <code>Update</code> button</li>
        <li><code>Cancel</code> button to close modal without saving</li>
    </ul>

    <h2>9. Soft Deletes</h2>
    <p>Posts, categories, tags, and comments are not permanently deleted. They are soft-deleted, meaning they can be restored if needed (currently handled in backend).</p>

    <h2>10. Notes</h2>
    <ul>
        <li>Only admin can manage posts, categories, and tags.</li>
        <li>Comments can be added by any authenticated user.</li>
        <li>Filters are case-insensitive.</li>
        <li>Character limit for comments is enforced (max 200 characters).</li>
    </ul>

    <h2>11. Support</h2>
    <p>If you encounter any issues, contact the developer or refer to the documentation.</p>

</div>

<h2>Features</h2>

<h3>Posts</h3>
<ul>
    <li>Create, edit, delete posts</li>
    <li>Assign categories and tags (multi-select)</li>
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
