<?php
// Connect to database
$conn = new mysqli('localhost', 'root', '', 'nubooklaunch');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch books
$sql = "SELECT * FROM books ORDER BY added_on DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>NUBookLaunch - Available Books</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

    <div class="container mx-auto p-8">
        <h1 class="text-4xl font-bold text-center mb-8 text-blue-700">📚 NUBookLaunch - Available Books</h1>

        <div class="flex justify-center mb-6">
            <a href="add_book.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg">
                ➕ Add / Delete Books
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="py-3 px-6 text-left">ID</th>
                        <th class="py-3 px-6 text-left">Title</th>
                        <th class="py-3 px-6 text-left">Author</th>
                        <th class="py-3 px-6 text-left">Category</th>
                        <th class="py-3 px-6 text-left">Added On</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    <?php if ($result->num_rows > 0): ?>
                        <?php while($row = $result->fetch_assoc()): ?>
                            <tr class="border-b hover:bg-gray-100">
                                <td class="py-4 px-6"><?= htmlspecialchars($row['id']) ?></td>
                                <td class="py-4 px-6"><?= htmlspecialchars($row['title']) ?></td>
                                <td class="py-4 px-6"><?= htmlspecialchars($row['author']) ?></td>
                                <td class="py-4 px-6"><?= htmlspecialchars($row['category']) ?></td>
                                <td class="py-4 px-6"><?= htmlspecialchars($row['added_on']) ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center py-6 text-gray-500">No books available.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>

<?php $conn->close(); ?>
