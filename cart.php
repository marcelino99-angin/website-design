<?php include 'includes/header.php'; ?>

<div class="container">
    <h1 class="page-title">Keranjang Belanja</h1>
    
    <?php
    // Simulasi data keranjang (dari session)
    $cart_items = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
    
    if(empty($cart_items)) {
    ?>
    <div class="empty-cart">
        <div class="empty-cart-icon">
            <i class="fas fa-shopping-cart fa-4x"></i>
        </div>
        <h2>Keranjang Belanja Kosong</h2>
        <p>Belum ada produk di keranjang belanja Anda</p>
        <a href="products.php" class="btn">Mulai Belanja</a>
    </div>
    <?php } else { ?>
    
    <div class="cart-container">
        <div class="cart-items">
            <div class="cart-header">
                <div class="header-product">Produk</div>
                <div class="header-price">Harga</div>
                <div class="header-quantity">Jumlah</div>
                <div class="header-subtotal">Subtotal</div>
                <div class="header-action">Aksi</div>
            </div>
            
            <?php 
            $total = 0;
            foreach($cart_items as $item) { 
                $subtotal = $item['price'] * $item['quantity'];
                $total += $subtotal;
            ?>
            <div class="cart-item">
                <div class="item-product">
                    <img src="<?php echo isset($item['image']) ? $item['image'] : 'assets/images/default-product.jpg'; ?>" 
                         alt="<?php echo $item['name']; ?>">
                    <div class="product-info">
                        <h3><?php echo $item['name']; ?></h3>
                        <p class="product-sku">SKU: ME<?php echo str_pad($item['id'], 4, '0', STR_PAD_LEFT); ?></p>
                    </div>
                </div>
                <div class="item-price">
                    Rp <?php echo number_format($item['price'], 0, ',', '.'); ?>
                </div>
                <div class="item-quantity">
                    <div class="quantity-control">
                        <button class="qty-btn minus" onclick="updateQuantity(<?php echo $item['id']; ?>, -1)">-</button>
                        <input type="number" value="<?php echo $item['quantity']; ?>" min="1" class="qty-input" id="qty-<?php echo $item['id']; ?>">
                        <button class="qty-btn plus" onclick="updateQuantity(<?php echo $item['id']; ?>, 1)">+</button>
                    </div>
                </div>
                <div class="item-subtotal">
                    Rp <?php echo number_format($subtotal, 0, ',', '.'); ?>
                </div>
                <div class="item-action">
                    <button class="btn-remove" onclick="removeFromCart(<?php echo $item['id']; ?>)">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
            <?php } ?>
        </div>
        
        <div class="cart-summary">
            <div class="summary-header">
                <h3>Ringkasan Belanja</h3>
            </div>
            
            <div class="summary-details">
                <div class="summary-row">
                    <span>Subtotal</span>
                    <span>Rp <?php echo number_format($total, 0, ',', '.'); ?></span>
                </div>
                <div class="summary-row">
                    <span>Ongkos Kirim</span>
                    <span>Rp 25.000</span>
                </div>
                <div class="summary-row total">
                    <span>Total</span>
                    <span>Rp <?php echo number_format($total + 25000, 0, ',', '.'); ?></span>
                </div>
            </div>
            
            <div class="summary-actions">
                <a href="products.php" class="btn-continue">
                    <i class="fas fa-arrow-left"></i> Lanjutkan Belanja
                </a>
                <a href="checkout.php" class="btn-checkout">
                    Proses Checkout <i class="fas fa-arrow-right"></i>
                </a>
            </div>
            
            <div class="payment-methods">
                <h4>Metode Pembayaran</h4>
                <div class="payment-icons">
                    <i class="fab fa-cc-visa" title="Visa"></i>
                    <i class="fab fa-cc-mastercard" title="Mastercard"></i>
                    <i class="fab fa-cc-paypal" title="PayPal"></i>
                    <i class="fas fa-university" title="Transfer Bank"></i>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</div>

<?php include 'includes/footer.php'; ?>