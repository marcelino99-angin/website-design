<?php
include 'includes/config.php';
include 'includes/functions.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    
    // Insert into database (you need to create this table)
    $query = "INSERT INTO messages (name, email, phone, subject, message, created_at) 
              VALUES (?, ?, ?, ?, ?, NOW())";
    
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'sssss', $name, $email, $phone, $subject, $message);
    
    if(mysqli_stmt_execute($stmt)) {
        // Success - show thank you message
        $success = true;
    } else {
        $error = "Terjadi kesalahan. Silakan coba lagi.";
    }
} else {
    header("Location: contact.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terima Kasih - Modest Elegance</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    
    <div class="container">
        <div class="message-container">
            <?php if(isset($success)): ?>
            <div class="message-success">
                <div class="success-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h2>Pesan Terkirim!</h2>
                <p>Terima kasih <strong><?php echo htmlspecialchars($name); ?></strong> telah menghubungi kami.</p>
                <p>Kami akan membalas pesan Anda melalui email dalam waktu 1-2 hari kerja.</p>
                <div class="message-actions">
                    <a href="index.php" class="btn">
                        <i class="fas fa-home"></i> Kembali ke Beranda
                    </a>
                    <a href="contact.php" class="btn btn-secondary">
                        <i class="fas fa-envelope"></i> Kirim Pesan Lain
                    </a>
                </div>
            </div>
            <?php elseif(isset($error)): ?>
            <div class="message-error">
                <div class="error-icon">
                    <i class="fas fa-exclamation-circle"></i>
                </div>
                <h2>Terjadi Kesalahan</h2>
                <p><?php echo $error; ?></p>
                <div class="message-actions">
                    <a href="contact.php" class="btn">
                        <i class="fas fa-arrow-left"></i> Kembali ke Halaman Kontak
                    </a>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
    
    <?php include 'includes/footer.php'; ?>
</body>
</html>