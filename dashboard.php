<?php
// dashboard.php
// Panel główny aplikacji

require_once __DIR__ . '/init.php';

// Sprawdzenie autoryzacji
requireLogin();

// Przedłużenie sesji
extendSession();

// Pobranie statystyk
try {
    $stats = [];
    
    // Liczba płyt
    $stmt = $pdo->prepare("SELECT COUNT(*) as total FROM vinyl_records WHERE user_id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $stats['total_records'] = $stmt->fetchColumn();
    
    // Wartość kolekcji
    $stmt = $pdo->prepare("SELECT SUM(price) as total_value FROM vinyl_records WHERE user_id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $stats['total_value'] = $stmt->fetchColumn() ?? 0;
    
    // Najdroższe płyty
    $stmt = $pdo->prepare("
        SELECT artist, title, price
        FROM vinyl_records
        WHERE user_id = ?
        ORDER BY price DESC
        LIMIT 5
    ");
    $stmt->execute([$_SESSION['user_id']]);
    $stats['most_expensive'] = $stmt->fetchAll();
    
    // Ostatnio dodane
    $stmt = $pdo->prepare("
        SELECT artist, title, created_at
        FROM vinyl_records
        WHERE user_id = ?
        ORDER BY created_at DESC
        LIMIT 5
    ");
    $stmt->execute([$_SESSION['user_id']]);
    $stats['recently_added'] = $stmt->fetchAll();
    
} catch (PDOException $e) {
    error_log("Dashboard stats error: " . $e->getMessage());
    $stats = ['total_records' => 0, 'total_value' => 0, 'most_expensive' => [], 'recently_added' => []];
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Biblioteczka Płyt Winylowych</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <nav class="navbar">
        <div class="nav-container">
            <div class="nav-logo">
                <h2>🎵 Biblioteczka Płyt</h2>
            </div>
            <ul class="nav-menu">
                <li><a href="dashboard.php" class="nav-link active">Dashboard</a></li>
                <li><a href="add_record.php" class="nav-link">Dodaj płytę</a></li>
                <li><a href="browse_records.php" class="nav-link">Przeglądaj płyty</a></li>
                <li class="nav-user">
                    <span>Witaj, <?= sanitizeOutput($_SESSION['username']) ?>!</span>
                    <a href="logout.php" class="btn btn-secondary btn-small">Wyloguj</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="dashboard-header">
            <h1>Dashboard</h1>
            <p>Przegląd Twojej kolekcji płyt winylowych</p>
        </div>

        <?php displayMessages(); ?>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">📀</div>
                <div class="stat-content">
                    <h3><?= number_format($stats['total_records'], 0, ',', ' ') ?></h3>
                    <p>Płyt w kolekcji</p>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">💰</div>
                <div class="stat-content">
                    <h3><?= formatPrice($stats['total_value']) ?></h3>
                    <p>Wartość kolekcji</p>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">⭐</div>
                <div class="stat-content">
                    <h3><?= $stats['total_records'] > 0 ? formatPrice($stats['total_value'] / $stats['total_records']) : '0 zł' ?></h3>
                    <p>Średnia cena płyty</p>
                </div>
            </div>
        </div>

        <div class="dashboard-content">
            <div class="dashboard-section">
                <h2>Najdroższe płyty</h2>
                <?php if (!empty($stats['most_expensive'])): ?>
                    <div class="record-list">
                        <?php foreach ($stats['most_expensive'] as $record): ?>
                            <div class="record-item">
                                <div class="record-info">
                                    <strong><?= sanitizeOutput($record['artist']) ?></strong>
                                    <span><?= sanitizeOutput($record['title']) ?></span>
                                </div>
                                <div class="record-price">
                                    <?= formatPrice($record['price']) ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p class="no-data">Brak płyt w kolekcji</p>
                <?php endif; ?>
            </div>

            <div class="dashboard-section">
                <h2>Ostatnio dodane</h2>
                <?php if (!empty($stats['recently_added'])): ?>
                    <div class="record-list">
                        <?php foreach ($stats['recently_added'] as $record): ?>
                            <div class="record-item">
                                <div class="record-info">
                                    <strong><?= sanitizeOutput($record['artist']) ?></strong>
                                    <span><?= sanitizeOutput($record['title']) ?></span>
                                </div>
                                <div class="record-date">
                                    <?= date('d.m.Y', strtotime($record['created_at'])) ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p class="no-data">Brak płyt w kolekcji</p>
                <?php endif; ?>
            </div>
        </div>

        <div class="quick-actions">
            <h2>Szybkie akcje</h2>
            <div class="action-buttons">
                <a href="add_record.php" class="btn btn-primary">
                    ➕ Dodaj nową płytę
                </a>
                <a href="browse_records.php" class="btn btn-secondary">
                    📋 Przeglądaj kolekcję
                </a>
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2025 Biblioteczka Płyt Winylowych. Wszystkie prawa zastrzeżone.</p>
        </div>
    </footer>

    <script src="js/script.js"></script>
</body>
</html>
