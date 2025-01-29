<?php 
$host = 'localhost';
$user = 'root';
$password = 'mysql';
$database = 'shop_database';

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    http_response_code(500);
    die(json_encode(['error' => 'Ошибка подключения к базе данных']));
}

// Устанавливаем кодировку соединения
$conn->set_charset("utf8mb4");

$category = $_GET['category'] ?? '';
$query = $_GET['query'] ?? '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$itemsPerPage = isset($_GET['itemsPerPage']) ? (int)$_GET['itemsPerPage'] : 16;
$sortOrder = $_GET['sortOrder'] ?? 'oldest';

$offset = ($page - 1) * $itemsPerPage;

$sql = "SELECT * FROM products2 WHERE 1=1";
$params = [];
$types = '';

if ($category) {
    $sql .= " AND category = ?";
    $params[] = $category;
    $types .= "s";
}

if ($query) {
    $words = explode(' ', $query);
    foreach ($words as $word) {
        $sql .= " AND name LIKE ? COLLATE utf8mb4_general_ci"; // Регистронезависимый поиск
        $params[] = '%' . $word . '%';
        $types .= "s";
    }
}

// Добавляем сортировку
switch ($sortOrder) {
    case 'price_asc':
        $sql .= " ORDER BY price ASC";
        break;
    case 'price_desc':
        $sql .= " ORDER BY price DESC";
        break;
    case 'newest':
        $sql .= " ORDER BY id DESC"; // Предполагается, что id увеличивается с добавлением новых товаров
        break;
    case 'oldest':
    default:
        $sql .= " ORDER BY id ASC";
        break;
}

$sql .= " LIMIT ? OFFSET ?";
$params[] = $itemsPerPage;
$params[] = $offset;
$types .= "ii";

$stmt = $conn->prepare($sql);

if ($params) {
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();

$products = [];
while ($row = $result->fetch_assoc()) {
    $images = json_decode($row['images'], true);
    $sizes = json_decode($row['sizes'], true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        $images = [];
        $sizes = [];
    }

    $products[] = [
        'name' => $row['name'],
        'price' => (float)$row['price'],
        'description' => $row['description'],
        'images' => $images,
        'sizes' => $sizes,
    ];
}

header('Content-Type: application/json');
echo json_encode($products, JSON_UNESCAPED_UNICODE);

$stmt->close();
$conn->close();
?>
