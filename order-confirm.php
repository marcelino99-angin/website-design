<?php 
include 'includes/config.php';
include 'includes/functions.php';

// Redirect jika tidak ada data customer
if(!isset($_SESSION['customer_data']) || getCartItemCount() == 0) {
    header("Location: checkout.php");
    exit();
}

$customer_data = $_SESSION['customer_data'];
$order_total = $_SESSION['order_total'];
$order_number = 'ORD-' . date('Ymd') . '-' . strtoupper(uniqid());

$page_title = "Konfirmasi Pesanan - Modest Elegance";
?>
<?php include 'includes/header.php'; ?>

<div class="container">
    <div class="confirmation-container">
        <div class="confirmation-icon">
            <i class="fas fa-check-circle"></i>
        </div>
        
        <h1 class="page-title">Pesanan Berhasil Dibuat!</h1>
        <p class="confirmation-subtitle">Terima kasih telah berbelanja di Modest Elegance</p>
        
        <div class="order-summary-card">
            <div class="order-header">
                <h2>Detail Pesanan</h2>
                <span class="order-number">#<?php echo $order_number; ?></span>
            </div>
            
            <div class="order-details">
                <div class="detail-section">
                    <h3><i class="fas fa-user"></i> Informasi Pelanggan</h3>
                    <div class="detail-grid">
                        <div class="detail-item">
                            <span class="detail-label">Nama:</span>
                            <span class="detail-value"><?php echo htmlspecialchars($customer_data['name']); ?></span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Email:</span>
                            <span class="detail-value"><?php echo htmlspecialchars($customer_data['email']); ?></span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Telepon:</span>
                            <span class="detail-value"><?php echo htmlspecialchars($customer_data['phone']); ?></span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Alamat:</span>
                            <span class="detail-value"><?php echo htmlspecialchars($customer_data['address']); ?>, <?php echo htmlspecialchars($customer_data['city']); ?></span>
                        </div>
                    </div>
                </div>
                
                <div class="detail-section">
                    <h3><i class="fas fa-shopping-bag"></i> Ringkasan Pembelian</h3>
                    <div class="items-list">
                        <?php foreach($_SESSION['cart'] as $item): ?>
                        <div class="order-item">
                            <div class="item-info">
                                <span class="item-name"><?php echo $item['name']; ?></span>
                                <span class="item-qty">x<?php echo $item['quantity']; ?></span>
                            </div>
                            <span class="item-total">Rp <?php echo number_format($item['price'] * $item['quantity'], 0, ',', '.'); ?></span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                
                <div class="detail-section">
                    <h3><i class="fas fa-credit-card"></i> Informasi Pembayaran</h3>
                    <div class="payment-info">
                        <div class="detail-item">
                            <span class="detail-label">Metode Pembayaran:</span>
                            <span class="detail-value">
                                <?php 
                                $payment_methods = [
                                    'bank_transfer' => 'Transfer Bank',
                                    'cod' => 'Cash on Delivery (COD)',
                                    'ewallet' => 'E-Wallet'
                                ];
                                echo $payment_methods[$customer_data['payment_method']] ?? 'Transfer Bank';
                                ?>
                            </span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Total Pembayaran:</span>
                            <span class="detail-value total-price">Rp <?php echo number_format($order_total, 0, ',', '.'); ?></span>
                        </div>
                    </div>
                    
                    <?php if($customer_data['payment_method'] == 'bank_transfer'): ?>
                    <div class="bank-instructions">
                        <h4>Instruksi Transfer Bank:</h4>
                        <p>Silakan transfer ke rekening berikut:</p>
                        <div class="bank-details">
                            <div class="bank-item">
                                <strong>BCA:</strong> 123-456-7890 (a.n. Modest Elegance)
                            </div>
                            <div class="bank-item">
                                <strong>Mandiri:</strong> 098-765-4321 (a.n. Modest Elegance)
                            </div>
                        </div>
                        <p class="note">Harap transfer dalam waktu 24 jam setelah pesanan dibuat.</p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="order-actions">
                <a href="index.php" class="btn btn-primary">
                    <i class="fas fa-home"></i> Kembali ke Beranda
                </a>
                <button onclick="window.print()" class="btn btn-secondary">
                    <i class="fas fa-print"></i> Cetak Invoice
                </button>
                <a href="products.php" class="btn btn-primary">
                    <i class="fas fa-shopping-bag"></i> Lanjutkan Belanja
                </a>
            </div>
            
            <div class="order-note">
                <p><i class="fas fa-info-circle"></i> Kami akan mengirimkan konfirmasi pesanan dan detail pengiriman ke email Anda.</p>
            </div>
        </div>
    </div>
</div>

<?php 
// Kosongkan keranjang setelah konfirmasi
$_SESSION['cart'] = [];
unset($_SESSION['customer_data']);
unset($_SESSION['order_total']);
?>

<?php include 'includes/footer.php'; ?>     