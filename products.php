<?php include 'includes/header.php'; ?>
<?php include 'includes/config.php'; ?>

<div class="container">
    <!-- Filter dan Pencarian -->
    <div class="products-header">
        <h1 class="page-title">Koleksi Produk</h1>
        
        <div class="search-filter">
            <form action="products.php" method="GET" class="search-form">
                <input type="text" name="search" placeholder="Cari produk..." value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                <select name="category">
                    <option value="">Semua Kategori</option>
                    <?php
                    $cat_query = "SELECT * FROM categories ORDER BY name";
                    $cat_result = mysqli_query($conn, $cat_query);
                    while($cat = mysqli_fetch_assoc($cat_result)) {
                        $selected = (isset($_GET['category']) && $_GET['category'] == $cat['id']) ? 'selected' : '';
                        echo "<option value='{$cat['id']}' $selected>{$cat['name']}</option>";
                    }
                    ?>
                </select>
                <button type="submit" class="btn"><i class="fas fa-search"></i> Cari</button>
            </form>
        </div>
    </div>

    <!-- Daftar Produk -->
    <div class="products-container">
        <?php
        // Query dengan filter
        $where = "WHERE 1=1";
        $params = [];
        
        if(isset($_GET['search']) && !empty($_GET['search'])) {
            $where .= " AND (name LIKE ? OR description LIKE ?)";
            $search_term = "%{$_GET['search']}%";
            $params[] = $search_term;
            $params[] = $search_term;
        }
        
        if(isset($_GET['category']) && !empty($_GET['category'])) {
            $where .= " AND category_id = ?";
            $params[] = $_GET['category'];
        }
        
        // Query utama
        $query = "SELECT p.*, c.name as category_name 
                  FROM products p 
                  LEFT JOIN categories c ON p.category_id = c.id 
                  $where 
                  ORDER BY p.created_at DESC";
        
        $stmt = mysqli_prepare($conn, $query);
        
        if(!empty($params)) {
            $types = str_repeat('s', count($params));
            mysqli_stmt_bind_param($stmt, $types, ...$params);
        }
        
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        if(mysqli_num_rows($result) > 0) {
        ?>
        <div class="products-list">
            <?php while($row = mysqli_fetch_assoc($result)) { ?>
            <div class="product-item">
                <div class="product-img">
                    <img src="<?php echo $row['image_url'] ?: 'assets/images/default-product.jpg'; ?>" alt="<?php echo $row['name']; ?>">
                    <?php if($row['is_featured']) { ?>
                    <span class="featured-badge">Unggulan</span>
                    <?php } ?>
                </div>
                <div class="product-details">
                    <span class="product-category"><?php echo $row['category_name']; ?></span>
                    <h3><?php echo $row['name']; ?></h3>
                    <p class="product-desc"><?php echo substr($row['description'], 0, 100); ?>...</p>
                    <div class="product-footer">
                        <span class="price">Rp <?php echo number_format($row['price'], 0, ',', '.'); ?></span>
                        <div class="product-actions">
                            <a href="product-detail.php?id=<?php echo $row['id']; ?>" class="btn-detail">Detail</a>
                            <button class="btn-cart" onclick="addToCart(<?php echo $row['id']; ?>)">
                                <i class="fas fa-cart-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
        <?php } else { ?>
        <div class="no-products">
            <i class="fas fa-box-open fa-3x"></i>
            <h3>Produk tidak ditemukan</h3>
            <p>Coba gunakan kata kunci pencarian yang berbeda</p>
        </div>
        <?php } ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>