<?php
// browse_records.php
// Przeglądanie płyt winylowych: tabela 10/s + Podgląd na tej samej stronie

require_once __DIR__ . '/init.php';

// Wymagaj zalogowania
requireLogin();
extendSession();

// Parametry stronicowania
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) { $page = 1; }
$per_page = 10;

// Obsługa podglądu (ta sama strona)
$view_id = isset($_GET['view']) ? (int)$_GET['view'] : 0;
$view_record = null;
$view_tracks = [];

// Zliczanie rekordów użytkownika
try {
    $count_stmt = $pdo->prepare("SELECT COUNT(*) FROM vinyl_records WHERE user_id = :uid");
    $count_stmt->bindValue(':uid', (int)$_SESSION['user_id'], PDO::PARAM_INT);
    $count_stmt->execute();
    $total_records = (int)$count_stmt->fetchColumn();
} catch (PDOException $e) {
    error_log("Browse count error: " . $e->getMessage());
    $total_records = 0;
}

$total_pages = $total_records > 0 ? (int)ceil($total_records / $per_page) : 1;
if ($page > $total_pages) { $page = $total_pages; }
$offset = ($page - 1) * $per_page;

// Pobieranie rekordów do tabeli - tylko jeśli nie ma podglądu
$records = [];
if ($view_id == 0) {
    try {
        $list_sql = "
            SELECT id, artist, title, price, release_year, cover_image, created_at
            FROM vinyl_records
            WHERE user_id = :uid
            ORDER BY created_at DESC, id DESC
            LIMIT :limit OFFSET :offset
        ";
        $list_stmt = $pdo->prepare($list_sql);
        $list_stmt->bindValue(':uid', (int)$_SESSION['user_id'], PDO::PARAM_INT);
        $list_stmt->bindValue(':limit', (int)$per_page, PDO::PARAM_INT);
        $list_stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $list_stmt->execute();
        $records = $list_stmt->fetchAll();
    } catch (PDOException $e) {
        error_log("Browse list error: " . $e->getMessage());
        $records = [];
    }
}

// Funkcja pomocnicza do sprawdzania istnienia okładki
function getCoverImagePath($cover_image) {
    if (empty($cover_image)) {
        return null;
    }
    
    $covers_dir = __DIR__ . '/uploads/covers/';
    $thumb_path = 'uploads/covers/thumb_' . $cover_image;
    $original_path = 'uploads/covers/' . $cover_image;
    
    if (file_exists($covers_dir . 'thumb_' . $cover_image)) {
        return $thumb_path;
    }
    elseif (file_exists($covers_dir . $cover_image)) {
        return $original_path;
    }
    
    return null;
}

// Obsługa podglądu
if ($view_id > 0) {
    try {
        $rec_stmt = $pdo->prepare("
            SELECT id, artist, title, price, release_year, cover_image, created_at, updated_at
            FROM vinyl_records
            WHERE id = :id AND user_id = :uid
        ");
        $rec_stmt->bindValue(':id', $view_id, PDO::PARAM_INT);
        $rec_stmt->bindValue(':uid', (int)$_SESSION['user_id'], PDO::PARAM_INT);
        $rec_stmt->execute();
        $view_record = $rec_stmt->fetch();
        
        if ($view_record) {
            $trk_stmt = $pdo->prepare("
                SELECT track_number, track_title, duration
                FROM tracks
                WHERE record_id = :rid
                ORDER BY track_number ASC
            ");
            $trk_stmt->bindValue(':rid', $view_id, PDO::PARAM_INT);
            $trk_stmt->execute();
            $view_tracks = $trk_stmt->fetchAll();
        }
    } catch (PDOException $e) {
        error_log("Browse view error: " . $e->getMessage());
        $view_record = null;
    }
}

?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Przeglądaj płyty - Biblioteczka Płyt Winylowych</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<nav class="navbar">
    <div class="nav-container">
        <div class="nav-logo">
            <h2>🎵 Biblioteczka Płyt</h2>
        </div>
        <ul class="nav-menu">
            <li><a href="dashboard.php" class="nav-link">Dashboard</a></li>
            <li><a href="add_record.php" class="nav-link">Dodaj płytę</a></li>
            <li><a href="browse_records.php" class="nav-link active">Przeglądaj płyty</a></li>
            <li class="nav-user">
                <span>Witaj, <?= sanitizeOutput($_SESSION['username']) ?>!</span>
                <a href="logout.php" class="btn btn-secondary btn-small">Wyloguj</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container">
    <div class="page-header">
        <h1>Przeglądaj płyty</h1>
        <p>Twoja kolekcja płyt winylowych (<?= number_format($total_records, 0, ',', ' ') ?>)</p>
    </div>

    <?php displayMessages(); ?>

    <?php if ($view_id == 0): // Widok tabeli ?>
        
        <?php if (empty($records)): ?>
            <div class="no-records">
                <div class="no-records-icon">📀</div>
                <h3>Brak płyt do wyświetlenia</h3>
                <p>Dodaj pierwszą płytę do kolekcji, aby ją tutaj zobaczyć.</p>
                <a href="add_record.php" class="btn btn-primary">Dodaj pierwszą płytę</a>
            </div>
        <?php else: ?>
            <div class="pagination-info">
                <span>Pokazano <strong><?= count($records) ?></strong> z <strong><?= number_format($total_records, 0, ',', ' ') ?></strong> płyt</span>
                <span> | Strona <strong><?= $page ?></strong> z <strong><?= $total_pages ?></strong></span>
            </div>

            <div class="table-container">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Okładka</th>
                        <th>Wykonawca</th>
                        <th>Tytuł</th>
                        <th>Cena</th>
                        <th>Akcje</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($records as $row): ?>
                        <tr>
                            <td>
                                <?php $cover_path = getCoverImagePath($row['cover_image']); ?>
                                <?php if ($cover_path): ?>
                                    <img class="cover-thumb" src="<?= $cover_path ?>" alt="Okładka">
                                <?php else: ?>
                                    <div class="cover-thumb">🎵</div>
                                <?php endif; ?>
                            </td>
                            <td><strong><?= sanitizeOutput($row['artist']) ?></strong></td>
                            <td><?= sanitizeOutput($row['title']) ?></td>
                            <td><strong><?= formatPrice($row['price']) ?></strong></td>
                            <td>
                                <a class="btn btn-primary btn-small" href="browse_records.php?page=<?= $page ?>&view=<?= $row['id'] ?>">
                                    Podgląd
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Paginacja -->
            <?php if ($total_pages > 1): ?>
                <div class="pagination-container">
                    <div class="pagination">
                        <?php
                        $base = 'browse_records.php?page=';
                        if ($page > 1) {
                            echo '<a class="page-link" href="' . $base . '1">&laquo;&laquo;</a>';
                            echo '<a class="page-link" href="' . $base . ($page - 1) . '">&lsaquo;</a>';
                        } else {
                            echo '<span class="page-link disabled">&laquo;&laquo;</span>';
                            echo '<span class="page-link disabled">&lsaquo;</span>';
                        }
                        
                        $start = max(1, $page - 2);
                        $end = min($total_pages, $page + 2);

                        if ($start > 1) {
                            echo '<a class="page-link" href="' . $base . '1">1</a>';
                            if ($start > 2) echo '<span class="page-link disabled">...</span>';
                        }

                        for ($i = $start; $i <= $end; $i++) {
                            echo '<a class="page-link' . ($i === $page ? ' active' : '') . '" href="' . $base . $i . '">' . $i . '</a>';
                        }

                        if ($end < $total_pages) {
                            if ($end < $total_pages - 1) echo '<span class="page-link disabled">...</span>';
                            echo '<a class="page-link" href="' . $base . $total_pages . '">' . $total_pages . '</a>';
                        }

                        if ($page < $total_pages) {
                            echo '<a class="page-link" href="' . $base . ($page + 1) . '">&rsaquo;</a>';
                            echo '<a class="page-link" href="' . $base . $total_pages . '">&raquo;&raquo;</a>';
                        } else {
                            echo '<span class="page-link disabled">&rsaquo;</span>';
                            echo '<span class="page-link disabled">&raquo;&raquo;</span>';
                        }
                        ?>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>
        
    <?php elseif ($view_record): // Widok podglądu płyty ?>
        <div class="record-view">
            <div class="breadcrumb">
                <a href="browse_records.php?page=<?= $page ?>">← Powrót do listy</a>
            </div>
            
            <div class="record-header">
                <div class="record-main-info">
                    <h1><?= sanitizeOutput($view_record['artist']) ?></h1>
                    <h2><?= sanitizeOutput($view_record['title']) ?></h2>
                    <div class="record-meta">
                        <span>📅 <?= (int)$view_record['release_year'] ?></span>
                        <span>💰 <?= formatPrice($view_record['price']) ?></span>
                    </div>
                </div>
            </div>

            <div class="record-content">
                <div class="record-cover-section">
                    <?php $view_cover_path = getCoverImagePath($view_record['cover_image']); ?>
                    <?php if ($view_cover_path): ?>
                        <img src="<?= str_replace('thumb_', '', $view_cover_path) ?>" alt="Okładka" class="record-cover-large">
                    <?php else: ?>
                        <div class="record-cover-placeholder">
                            <div class="placeholder-icon">🎵</div>
                            <p>Brak okładki</p>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="record-tracks-section">
                    <h3>Lista utworów</h3>
                    <?php if (!empty($view_tracks)): ?>
                        <div class="tracks-list">
                            <?php foreach ($view_tracks as $t): ?>
                                <div class="track-item">
                                    <div class="track-number"><?= (int)$t['track_number'] ?>.</div>
                                    <div class="track-title"><?= sanitizeOutput($t['track_title']) ?></div>
                                    <?php if (!empty($t['duration'])): ?>
                                        <div class="track-duration"><?= sanitizeOutput($t['duration']) ?></div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="no-tracks">
                            <p>Brak dodanych utworów dla tej płyty.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="record-actions">
                <a href="browse_records.php?page=<?= $page ?>" class="btn btn-secondary">Powrót</a>
                <a href="view_record.php?id=<?= $view_record['id'] ?>" class="btn btn-primary">Pełny widok</a>
            </div>
        </div>
    <?php else: // Jeśli nie znaleziono płyty do podglądu ?>
        <div class="message message-error">
            Nie znaleziono płyty o podanym ID.
        </div>
        <a href="browse_records.php" class="btn btn-secondary">Powrót do listy</a>
    <?php endif; ?>
</div>

<footer class="footer">
    <div class="container">
        <p>&copy; <?= date('Y') ?> Biblioteczka Płyt Winylowych. Wszelkie prawa zastrzeżone.</p>
    </div>
</footer>

</body>
</html>
