<?php
session_start();
include("head.php");
include("connect.php");
include("data.php");
include("fetch_Product.php");


$search = $_GET['search'];
$filter = $_GET['filter'];
$sort = $_GET['sort'];

$search = trim(strtolower($search));
echo $search;
echo $filter;
echo $sort;

$sql = "SELECT * FROM products";

if (empty($sort)) {
    $sort = 'price';
}
if (empty($search)) {
    $sql = "SELECT * FROM products";
}

if (!empty($search)) {
    $sql .= " WHERE " . "name LIKE '%" . $search . "%'";
}


if (!empty($filter)) {
    if (empty($search)) {
        $sql .= " WHERE product_type='" . $filter . "'";
    } else
        $sql .= " AND product_type='" . $filter . "'";
}

if ($sort === 'name') {
    $sql .= " ORDER BY " . $sort;
} else {
    $sql .= " ORDER BY " . $sort . " DESC";
}


echo $sql;
$stmt = $pdo->query($sql);
$products = $stmt->fetchALL(PDO::FETCH_ASSOC);
// searching categories
switch ($search) {
    case 'kitchen knives':
    case 'kitchen knife':
    case 'knife':
    case 'knive':
    case 'knives': {
            echo 'type match';
            $products = getProductsByType($pdo, 'knives');
            break;
        }

    case 'pots':
    case 'pans':
    case 'cookware': {
            echo 'type match';
            $products = getProductsByType($pdo, 'cookware');
            break;
        }
    case 'appliances':
    case 'appliance':
    case 'kitchen appliances':
    case 'kitchen appliance': {
            echo 'type match';
            $products = getProductsByType($pdo, 'appliances');
            break;
        }
    case 'accessories':
    case 'accessory':
    case 'kitchen accessories':
    case 'kitchen accessory': {
            echo 'type match';
            $products = getProductsByType($pdo, 'accessories');
            break;
        }
    default:
}
$_SESSION['search_result'] = $products;
$_SESSION['last_search'] = $search;
header('Location: search_page.php');
