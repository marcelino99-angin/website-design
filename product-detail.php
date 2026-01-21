<?php include 'includes/config.php'; ?>

<?php
// Cek apakah ada parameter id
if(!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: products.php");
    exit();
}

$product_id = intval($_GET['id']);

// Query produk
$query = "SELECT p.*, c.name as category_name 
          FROM products p 
          LEFT JOIN categories c ON p.category_id = c.id 
          WHERE p.id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 'i', $product_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if(mysqli_num_rows($result) == 0) {
    header("Location: products.php");
    exit();
}

$product = mysqli_fetch_assoc($result);

// Query produk terkait
$related_query = "SELECT * FROM products 
                  WHERE category_id = ? AND id != ? 
                  LIMIT 4";
$related_stmt = mysqli_prepare($conn, $related_query);
mysqli_stmt_bind_param($related_stmt, 'ii', $product['category_id'], $product_id);
mysqli_stmt_execute($related_stmt);
$related_result = mysqli_stmt_get_result($related_stmt);

$page_title = $product['name'] . " - Modest Elegance";
?>

<?php include 'includes/header.php'; ?>

<div class="container">
    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <a href="index.php">Beranda</a> &gt;
        <a href="products.php">Produk</a> &gt;
        <a href="products.php?category=<?php echo $product['category_id']; ?>"><?php echo $product['category_name']; ?></a> &gt;
        <span><?php echo $product['name']; ?></span>
    </div>

    <!-- Detail Produk -->
    <div class="product-detail-container">
        <div class="product-images">
            <div class="main-image">
                <img src="<?php echo $product['image_url'] ?: 'assets/images/default-product.jpg'; ?>" alt="<?php echo $product['name']; ?>" id="mainProductImage">
            </div>
            <!-- Bisa ditambahkan gambar thumbnail di sini -->
        </div>

        <div class="product-info">
            <h1><?php echo $product['name']; ?></h1>
            
            <div class="product-meta">
                <span class="category">Kategori: <?php echo $product['category_name']; ?></span>
                <?php if($product['is_featured']) { ?>
                <span class="featured-tag"><i class="fas fa-star"></i> Produk Unggulan</span>
                <?php } ?>
            </div>

            <div class="price-section">
                <h2 class="price">Rp <?php echo number_format($product['price'], 0, ',', '.'); ?></h2>
                <div class="stock-info">
                    <?php if($product['stock'] > 0) { ?>
                    <span class="in-stock"><i class="fas fa-check-circle"></i> Stok Tersedia</span>
                    <?php } else { ?>
                    <span class="out-of-stock"><i class="fas fa-times-circle"></i> Stok Habis</span>
                    <?php } ?>
                </div>
            </div>

            <div class="product-description">
                <h3>Deskripsi Produk</h3>
                <p><?php echo nl2br($product['description']); ?></p>
            </div>

            <div class="product-actions">
                <div class="quantity-selector">
                    <button onclick="decreaseQuantity()">-</button>
                    <input type="number" id="quantity" value="1" min="1" max="<?php echo $product['stock']; ?>">
                    <button onclick="increaseQuantity()">+</button>
                </div>
                
                <button class="btn btn-add-to-cart" 
                        onclick="addToCartDetail(<?php echo $product['id']; ?>, document.getElementById('quantity').value)"
                        <?php echo $product['stock'] == 0 ? 'disabled' : ''; ?>>
                    <i class="fas fa-cart-plus"></i> Tambah ke Keranjang
                </button>
                
                <button class="btn btn-wishlist">
                    <i class="far fa-heart"></i> Wishlist
                </button>
            </div>

            <div class="product-specs">
                <h3>Informasi Produk</h3>
                <ul>
                    <li><strong>ID Produk:</strong> ME<?php echo str_pad($product['id'], 4, '0', STR_PAD_LEFT); ?></li>
                    <li><strong>Tanggal Ditambahkan:</strong> <?php echo date('d F Y', strtotime($product['created_at'])); ?></li>
                    <li><strong>Stok Tersedia:</strong> <?php echo $product['stock']; ?> unit</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Produk Terkait -->
    <?php if(mysqli_num_rows($related_result) > 0) { ?>
    <div class="related-products">
        <h2 class="section-title">Produk Terkait</h2>
        <div class="related-grid">
            <?php while($related = mysqli_fetch_assoc($related_result)) { ?>
            <div class="related-item">
                <img src="<?php echo $related['image_url'] ?: 'assets/images/default-product.jpg'; ?>" alt="<?php echo $related['name']; ?>">
                <h4><?php echo $related['name']; ?></h4>
                <p class="price">Rp <?php echo number_format($related['price'], 0, ',', '.'); ?></p>
                <a href="product-detail.php?id=<?php echo $related['id']; ?>" class="btn btn-sm">Lihat Detail</a>
            </div>
            <?php } ?>
        </div>
    </div>
    <?php } ?>
</div>

<?php include 'includes/footer.php'; ?>