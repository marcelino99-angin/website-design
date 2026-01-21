<?php include 'includes/config.php'; ?>
<?php include 'includes/header.php'; ?>

<div class="container">
    <h1 class="page-title">Koleksi Kategori</h1>
    <p class="page-subtitle">Temukan produk berdasarkan kategori pilihan Anda</p>
    
    <div class="categories-grid">
        <?php
        // Query semua kategori
        $query = "SELECT c.*, COUNT(p.id) as product_count 
                  FROM categories c 
                  LEFT JOIN products p ON c.id = p.category_id 
                  GROUP BY c.id 
                  ORDER BY c.name";
        $result = mysqli_query($conn, $query);
        
        if(mysqli_num_rows($result) > 0) {
            while($category = mysqli_fetch_assoc($result)) {
        ?>
        <div class="category-card">
            <div class="category-image">
                <img src="assets/images/category-<?php echo strtolower($category['name']); ?>.jpg" 
                     alt="<?php echo $category['name']; ?>" 
                     onerror="this.src='assets/images/default-category.jpg'">
                <div class="category-overlay">
                    <h3><?php echo $category['name']; ?></h3>
                    <p><?php echo $category['product_count']; ?> Produk</p>
                    <a href="products.php?category=<?php echo $category['id']; ?>" class="btn btn-view">
                        Lihat Koleksi <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="category-info">
                <h3><?php echo $category['name']; ?></h3>
                <p><?php echo $category['description']; ?></p>
            </div>
        </div>
        <?php
            }
        } else {
            echo "<p class='no-data'>Belum ada kategori yang tersedia.</p>";
        }
        ?>
    </div>
    
    <!-- Featured Brands Section -->
    <div class="brands-section">
        <h2 class="section-title">Brands Terkenal</h2>
        <div class="brands-grid">
            <div class="brand-item">
                <div class="brand-logo">
                    <i class="fas fa-gem"></i>
                </div>
                <h4>Modest Collection</h4>
                <p>Koleksi eksklusif dengan bahan premium</p>
            </div>
            <div class="brand-item">
                <div class="brand-logo">
                    <i class="fas fa-leaf"></i>
                </div>
                <h4>Eco Chic</h4>
                <p>Ramah lingkungan dan sustainable</p>
            </div>
            <div class="brand-item">
                <div class="brand-logo">
                    <i class="fas fa-crown"></i>
                </div>
                <h4>Royal Style</h4>
                <p>Desain elegan dan mewah</p>
            </div>
            <div class="brand-item">
                <div class="brand-logo">
                    <i class="fas fa-sun"></i>
                </div>
                <h4>Casual Wear</h4>
                <p>Nyaman untuk aktivitas sehari-hari</p>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>