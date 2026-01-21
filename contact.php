<?php 
$page_title = "Hubungi Kami - Modest Elegance";
include 'includes/header.php'; 
?>

<div class="container">
    <h1 class="page-title">Hubungi Kami</h1>
    <p class="page-subtitle">Kami siap membantu Anda. Jangan ragu untuk menghubungi kami!</p>
    
    <div class="contact-container">
        <!-- Informasi Kontak -->
        <div class="contact-info">
            <div class="info-card">
                <div class="info-icon">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <h3>Alamat Kantor</h3>
                <p>Jl. Fashion No. 123<br>Kebayoran Baru<br>Jakarta Selatan 12120</p>
            </div>
            
            <div class="info-card">
                <div class="info-icon">
                    <i class="fas fa-phone"></i>
                </div>
                <h3>Telepon</h3>
                <p>(021) 1234-5678<br>0812-3456-7890 (WhatsApp)</p>
            </div>
            
            <div class="info-card">
                <div class="info-icon">
                    <i class="fas fa-envelope"></i>
                </div>
                <h3>Email</h3>
                <p>info@modestelegance.com<br>cs@modestelegance.com</p>
            </div>
            
            <div class="info-card">
                <div class="info-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <h3>Jam Operasional</h3>
                <p>Senin - Jumat: 09:00 - 17:00<br>Sabtu: 09:00 - 15:00<br>Minggu: Tutup</p>
            </div>
        </div>
        
        <!-- Form Kontak -->
        <div class="contact-form-container">
            <div class="form-card">
                <h2>Kirim Pesan</h2>
                <p>Isi formulir di bawah ini dan kami akan segera menghubungi Anda.</p>
                
                <form class="contact-form" method="POST" action="send-message.php">
                    <div class="form-group">
                        <label for="name">Nama Lengkap *</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email *</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="phone">Nomor Telepon</label>
                        <input type="tel" id="phone" name="phone">
                    </div>
                    
                    <div class="form-group">
                        <label for="subject">Subjek *</label>
                        <select id="subject" name="subject" required>
                            <option value="">Pilih Subjek</option>
                            <option value="pertanyaan">Pertanyaan Produk</option>
                            <option value="pemesanan">Status Pemesanan</option>
                            <option value="pengembalian">Pengembalian Barang</option>
                            <option value="kerjasama">Kerjasama Bisnis</option>
                            <option value="lainnya">Lainnya</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="message">Pesan *</label>
                        <textarea id="message" name="message" rows="5" required></textarea>
                    </div>
                    
                    <button type="submit" class="btn-submit">
                        <i class="fas fa-paper-plane"></i> Kirim Pesan
                    </button>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Peta -->
    <div class="map-section">
        <h2 class="section-title">Lokasi Kami</h2>
        <div class="map-container">
            <div class="map-placeholder">
                <i class="fas fa-map-marked-alt fa-3x"></i>
                <p>Peta akan ditampilkan di sini</p>
                <small>(Dalam implementasi nyata, Anda dapat menambahkan Google Maps)</small>
            </div>
        </div>
    </div>
    
    <!-- FAQ Section -->
    <div class="faq-section">
        <h2 class="section-title">Pertanyaan yang Sering Diajukan</h2>
        
        <div class="faq-container">
            <div class="faq-item">
                <button class="faq-question">
                    Berapa lama waktu pengiriman?
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="faq-answer">
                    <p>Waktu pengiriman bervariasi tergantung lokasi:<br>
                    • Jakarta: 1-2 hari kerja<br>
                    • Jawa: 2-4 hari kerja<br>
                    • Luar Jawa: 3-7 hari kerja<br>
                    • Papua: 7-14 hari kerja</p>
                </div>
            </div>
            
            <div class="faq-item">
                <button class="faq-question">
                    Apakah bisa mengembalikan produk?
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="faq-answer">
                    <p>Ya, Anda dapat mengembalikan produk dalam waktu 7 hari setelah penerimaan dengan syarat:<br>
                    1. Produk belum dicuci atau digunakan<br>
                    2. Label masih terpasang<br>
                    3. Kemasan asli masih utuh<br>
                    4. Disertai bukti pembelian</p>
                </div>
            </div>
            
            <div class="faq-item">
                <button class="faq-question">
                    Bagaimana cara mengecek ukuran?
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="faq-answer">
                    <p>Setiap produk memiliki panduan ukuran di halaman detail. Anda juga dapat menghubungi customer service kami untuk konsultasi ukuran. Kami sarankan untuk mengukur badan Anda dan membandingkannya dengan tabel ukuran yang tersedia.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <button class="faq-question">
                    Apakah tersedia COD (Cash on Delivery)?
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="faq-answer">
                    <p>Ya, kami menyediakan layanan COD untuk area Jabodetabek dengan tambahan biaya layanan sebesar Rp 10.000. Untuk area lainnya, silakan cek ketersediaan saat checkout.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>