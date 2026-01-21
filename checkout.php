<?php 
include 'includes/config.php';
include 'includes/functions.php';

// Redirect jika keranjang kosong
if(getCartItemCount() == 0) {
    header("Location: cart.php");
    exit();
}

// Proses form checkout
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Simpan data customer (dalam implementasi real, ini akan disimpan ke database)
    $customer_data = [
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'phone' => $_POST['phone'],
        'address' => $_POST['address'],
        'city' => $_POST['city'],
        'postal_code' => $_POST['postal_code'],
        'payment_method' => $_POST['payment_method'],
        'notes' => $_POST['notes']
    ];
    
    // Simpan di session untuk ditampilkan di halaman konfirmasi
    $_SESSION['customer_data'] = $customer_data;
    $_SESSION['order_total'] = getCartTotal() + 25000; // Total + ongkir
    
    // Redirect ke halaman konfirmasi
    header("Location: order-confirm.php");
    exit();
}

$page_title = "Checkout - Modest Elegance";
?>
<?php include 'includes/header.php'; ?>

<div class="container">
    <h1 class="page-title">Checkout</h1>
    
    <div class="checkout-container">
        <form method="POST" action="checkout.php" class="checkout-form">
            <div class="checkout-sections">
                <!-- Informasi Pengiriman -->
                <div class="checkout-section">
                    <h2 class="section-title-small">
                        <i class="fas fa-user-circle"></i> Informasi Pelanggan
                    </h2>
                    
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="name">Nama Lengkap *</label>
                            <input type="text" id="name" name="name" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="email">Email *</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="phone">Nomor Telepon *</label>
                            <input type="tel" id="phone" name="phone" required>
                        </div>
                        
                        <div class="form-group full-width">
                            <label for="address">Alamat Lengkap *</label>
                            <textarea id="address" name="address" rows="3" required></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label for="city">Kota *</label>
                            <input type="text" id="city" name="city" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="postal_code">Kode Pos</label>
                            <input type="text" id="postal_code" name="postal_code">
                        </div>
                    </div>
                </div>

                <!-- Metode Pembayaran -->
                <div class="checkout-section">
                    <h2 class="section-title-small">
                        <i class="fas fa-credit-card"></i> Metode Pembayaran
                    </h2>
                    
                    <div class="payment-methods-checkout">
                        <div class="payment-option">
                            <input type="radio" id="bank_transfer" name="payment_method" value="bank_transfer" checked>
                            <label for="bank_transfer">
                                <i class="fas fa-university"></i>
                                <div>
                                    <h4>Transfer Bank</h4>
                                    <p>Transfer ke rekening BCA, Mandiri, atau BNI</p>
                                </div>
                            </label>
                        </div>
                        
                        <div class="payment-option">
                            <input type="radio" id="cod" name="payment_method" value="cod">
                            <label for="cod">
                                <i class="fas fa-money-bill-wave"></i>
                                <div>
                                    <h4>Cash on Delivery (COD)</h4>
                                    <p>Bayar saat barang diterima</p>
                                </div>
                            </label>
                        </div>
                        
                        <div class="payment-option">
                            <input type="radio" id="ewallet" name="payment_method" value="ewallet">
                            <label for="ewallet">
                                <i class="fas fa-mobile-alt"></i>
                                <div>
                                    <h4>E-Wallet</h4>
                                    <p>OVO, GoPay, Dana, atau ShopeePay</p>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Catatan Pesanan -->
                <div class="checkout-section">
                    <h2 class="section-title-small">
                        <i class="fas fa-sticky-note"></i> Catatan Pesanan
                    </h2>
                    
                    <div class="form-group">
                        <label for="notes">Catatan untuk penjual (opsional)</label>
                        <textarea id="notes" name="notes" rows="3" placeholder="Contoh: Warna preferensi, ukuran khusus, dll."></textarea>
                    </div>
                </div>
            </div>

            <!-- Order Summary Sidebar -->
            <div class="order-summary-sidebar">
                <div class="summary-box">
                    <h3>Ringkasan Pesanan</h3>
                    
                    <div class="summary-items">
                        <?php 
                        $subtotal = getCartTotal();
                        $shipping = 25000;
                        $total = $subtotal + $shipping;
                        ?>
                        
                        <div class="summary-item">
                            <span>Subtotal (<?php echo getCartItemCount(); ?> item)</span>
                            <span>Rp <?php echo number_format($subtotal, 0, ',', '.'); ?></span>
                        </div>
                        
                        <div class="summary-item">
                            <span>Ongkos Kirim</span>
                            <span>Rp <?php echo number_format($shipping, 0, ',', '.'); ?></span>
                        </div>
                        
                        <div class="summary-total">
                            <span>Total Pembayaran</span>
                            <span class="total-amount">Rp <?php echo number_format($total, 0, ',', '.'); ?></span>
                        </div>
                    </div>
                    
                    <div class="terms-agreement">
                        <input type="checkbox" id="terms" required>
                        <label for="terms">Saya menyetujui <a href="#">Syarat dan Ketentuan</a> yang berlaku</label>
                    </div>
                    
                    <button type="submit" class="btn-checkout-full">
                        <i class="fas fa-lock"></i> Buat Pesanan
                    </button>
                    
                    <div class="secure-payment">
                        <i class="fas fa-shield-alt"></i>
                        <span>Pembayaran Aman & Terenkripsi</span>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<?php include 'includes/footer.php'; ?>     