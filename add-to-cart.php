<?php
session_start();
header('Content-Type: application/json');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'] ?? '';
    $product_id = intval($_POST['product_id'] ?? 0);
    
    if($action == 'update' && isset($_POST['quantity'])) {
        $quantity = intval($_POST['quantity']);
        
        // Update quantity
        foreach($_SESSION['cart'] as &$item) {
            if($item['id'] == $product_id) {
                $item['quantity'] = $quantity;
                break;
            }
        }
    } elseif($action == 'remove') {
        // Remove item
        foreach($_SESSION['cart'] as $key => $item) {
            if($item['id'] == $product_id) {
                unset($_SESSION['cart'][$key]);
                $_SESSION['cart'] = array_values($_SESSION['cart']); // Re-index
                break;
            }
        }
    }
    
    // Hitung total item
    $cart_count = 0;
    if(isset($_SESSION['cart'])) {
        foreach($_SESSION['cart'] as $item) {
            $cart_count += $item['quantity'];
        }
    }
    
    echo json_encode([
        'success' => true,
        'cart_count' => $cart_count
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request'
    ]);
}
?>