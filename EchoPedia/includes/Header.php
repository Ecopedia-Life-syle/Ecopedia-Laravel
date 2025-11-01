<?php
    // Menentukan halaman aktif dari URL, default ke 'beranda'
    $active_page = isset($_GET['page']) ? $_GET['page'] : 'beranda';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecopedia - <?php echo ucfirst($active_page); ?></title>
    <meta name="description" content="Bergabunglah dengan Ecopedia untuk melacak jejak karbon, ikuti tantangan, belanja di marketplace ramah lingkungan, dan jadilah bagian dari solusi.">
    
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <header class="main-header">
        <nav class="navbar">
            <a href="index.php?page=beranda" class="nav-logo <?php echo ($active_page == 'beranda') ? 'active' : ''; ?>">Ecopedia</a>
            <ul class="nav-menu">
                <?php include 'includes/nav-items.php'; ?>
            </ul>
            <div class="hamburger">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
        </nav>
    </header>

    <main id="app-container">