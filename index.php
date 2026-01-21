<?php 
// Hapus include config.php karena sudah ada di header
// include 'includes/config.php'; 
?>
<?php include 'includes/header.php'; ?>

<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <h2>Koleksi Fashion Muslim Modern</h2>
        <p>Temukan gaya elegan dengan koleksi terbaru kami yang menggabungkan kesopanan dan fashion modern.</p>
        <a href="products.php" class="btn">Lihat Koleksi</a>
    </div>
</section>

<!-- Produk Unggulan -->
<section id="produk" class="products-section">
    <div class="container">
        <h2 class="section-title">Produk Unggulan</h2>
        <div class="products-grid">
            <?php
            // Include config untuk koneksi database
            include 'includes/config.php';
            
            // Query untuk mendapatkan produk unggulan
            $query = "SELECT * FROM products WHERE is_featured = 1 LIMIT 4";
            $result = mysqli_query($conn, $query);
            
            if(mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
            ?>
            <div class="product-card">
                <div class="product-image">
                    <img src="<?php echo $row['image_url'] ?: 'assets/images/default-product.jpg'; ?>" alt="<?php echo $row['name']; ?>">
                </div>
                <div class="product-info">
                    <h3><?php echo $row['name']; ?></h3>
                    <p class="product-price">Rp <?php echo number_format($row['price'], 0, ',', '.'); ?></p>
                    <button class="btn btn-sm" onclick="addToCart(<?php echo $row['id']; ?>)">Tambah ke Keranjang</button>
                </div>
            </div>
            <?php
                }
            } else {
                echo "<p style='text-align:center; width:100%;'>Belum ada produk unggulan.</p>";
            }
            ?>
        </div>
    </div>
</section>

<!-- Tentang Kami -->
<section id="tentang" class="about-section">
    <div class="container">
        <h2 class="section-title">Tentang Modest Elegance</h2>
        <div class="about-content">
            <p>Modest Elegance adalah brand fashion muslim yang berkomitmen menghadirkan pakaian modern dengan sentuhan elegan. Setiap koleksi kami didesain dengan memperhatikan detail, kualitas bahan, dan kenyamanan pengguna.</p>
            <p>Kami percaya bahwa fashion muslim tidak hanya tentang kesopanan, tetapi juga tentang mengekspresikan diri dengan gaya yang modern dan stylish.</p>
            <a href="about.php" class="btn">Selengkapnya Tentang Kami</a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>