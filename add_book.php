<?php
// Connect to database
$conn = new mysqli('localhost', 'root', '', 'nubooklaunch');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Add Book
if (isset($_POST['add'])) {
    $title = $conn->real_escape_string($_POST['title']);
    $author = $conn->real_escape_string($_POST['author']);
    $category = $conn->real_escape_string($_POST['category']);

    $conn->query("INSERT INTO books (title, author, category) VALUES ('$title', '$author', '$category')");
    header("Location: add_book.php");
    exit();
}

// Delete Book
if (isset($_POST['delete'])) {
    $book_id = intval($_POST['book_id']);
    $conn->query("DELETE FROM books WHERE id = $book_id");
    header("Location: add_book.php");
    exit();
}

// Fetch Books
$sql = "SELECT * FROM books ORDER BY added_on DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>NUBookLaunch - Manage Books</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

    <div class="container mx-auto p-8">
        <h1 class="text-4xl font-bold text-center mb-8 text-green-700">✍️ NUBookLaunch - Manage Books</h1>

        <div class="bg-white shadow-md rounded-lg p-6 mb-8">
            <h2 class="text-2xl font-semibold mb-4 text-blue-700">➕ Add New Book</h2>
            <form method="POST" class="space-y-4">
                <div>
                    <input type="text" name="title" placeholder="Book Title" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300">
                </div>
                <div>
                    <input type="text" name="author" placeholder="Author" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300">
                </div>
                <div>
                    <input type="text" name="category" placeholder="Category" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300">
                </div>
                <button type="submit" name="add" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-6 rounded-lg">
                    Add Book
                </button>
            </form>
        </div>

        <div class="bg-white shadow-md rounded-lg p-6 mb-8">
            <h2 class="text-2xl font-semibold mb-4 text-red-700">🗑️ Delete a Book</h2>
            <form method="POST" class="space-y-4">
                <div>
                    <select name="book_id" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-300">
                        <?php while($row = $result->fetch_assoc()): ?>
                            <option value="<?= $row['id'] ?>">
                                <?= htmlspecialchars($row['title']) ?> by <?= htmlspecialchars($row['author']) ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <button type="submit" name="delete" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-6 rounded-lg">
                    Delete Selected Book
                </button>
            </form>
        </div>

        <div class="flex justify-center">
            <a href="index.php" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-6 rounded-lg">
                🔙 Back to Book List
            </a>
        </div>
    </div>

</body>
</html>

<?php $conn->close(); ?>
