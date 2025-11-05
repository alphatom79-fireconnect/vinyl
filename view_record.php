<?php
// view_record.php
// Szczegółowy podgląd płyty winylowej

require_once __DIR__ . '/init.php';

// Sprawdzenie autoryzacji
requireLogin();
extendSession();

// Pobranie ID płyty
$record_id = (int)($_GET['id'] ?? 0);

if ($record_id <= 0) {
    redirectWithMessage('browse_records.php', 'Nieprawidłowy identyfikator płyty', 'error');
}

try {
    // Pobranie danych płyty
    $stmt = $pdo->prepare("
        SELECT id, artist, title, release_year, price, cover_image, created_at, updated_at
        FROM vinyl_records 
        WHERE id = ? AND user_id = ?
    ");
    $stmt->execute([$record_id, $_SESSION['user_id']]);
    $record = $stmt->fetch();
    
    if (!$record) {
        redirectWithMessage('browse_records.php', 'Płyta nie została znaleziona', 'error');
    }
    
    // Pobranie utworów
    $tracks_stmt = $pdo->prepare("
        SELECT track_number, track_title, duration 
        FROM tracks 
        WHERE record_id = ? 
        ORDER BY track_number ASC
    ");
    $tracks_stmt->execute([$record_id]);
    $tracks = $tracks_stmt->fetchAll();
    
} catch (PDOException $e) {
    error_log("View record error: " . $e->getMessage());
    redirectWithMessage('browse_records.php', 'Błąd podczas ładowania płyty', 'error');
}

// Funkcja formatowania czasu trwania
function formatDuration($duration) {
    if (empty($duration)) return '';
    return $duration;
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= sanitizeOutput($record['artist']) ?> - <?= sanitizeOutput($record['title']) ?> - Biblioteczka Płyt</title>
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
                <li><a href="browse_records.php" class="nav-link">Przeglądaj płyty</a></li>
                <li class="nav-user">
                    <span>Witaj, <?= sanitizeOutput($_SESSION['username']) ?>!</span>
                    <a href="logout.php" class="btn btn-secondary btn-small">Wyloguj</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="breadcrumb">
            <a href="browse_records.php">← Powrót do kolekcji</a>
        </div>

        <?php displayMessages(); ?>

        <div class="record-view">
            <!-- Blok pierwszy: Podstawowe informacje -->
            <div class="record-header">
                <div class="record-main-info">
                    <h1 class="record-artist"><?= sanitizeOutput($record['artist']) ?></h1>
                    <h2 class="record-title"><?= sanitizeOutput($record['title']) ?></h2>
                    <div class="record-meta">
                        <span class="record-year">📅 <?= $record['release_year'] ?></span>
                        <span class="record-price">💰 <?= formatPrice($record['price']) ?></span>
                    </div>
                    <div class="record-dates">
                        <small>
                            Dodano: <?= date('d.m.Y H:i', strtotime($record['created_at'])) ?>
                            <?php if ($record['updated_at'] !== $record['created_at']): ?>
                                | Ostatnia edycja: <?= date('d.m.Y H:i', strtotime($record['updated_at'])) ?>
                            <?php endif; ?>
                        </small>
                    </div>
                </div>
            </div>

            <div class="record-content">
                <!-- Blok drugi: Okładka płyty -->
                <div class="record-cover-section">
                    <?php if ($record['cover_image']): ?>
                        <img src="uploads/covers/<?= sanitizeOutput($record['cover_image']) ?>" 
                             alt="Okładka <?= sanitizeOutput($record['title']) ?>"
                             class="record-cover-large"
                             onerror="this.src='css/images/no-cover-large.png'">
                    <?php else: ?>
                        <div class="record-cover-placeholder">
                            <div class="placeholder-icon">🎵</div>
                            <p>Brak okładki</p>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Blok trzeci: Lista utworów -->
                <div class="record-tracks-section">
                    <h3>Lista utworów</h3>
                    
                    <?php if (!empty($tracks)): ?>
                        <div class="tracks-list">
                            <?php foreach ($tracks as $track): ?>
                                <div class="track-item">
                                    <div class="track-number">
                                        <?= $track['track_number'] ?>.
                                    </div>
                                    <div class="track-title">
                                        <?= sanitizeOutput($track['track_title']) ?>
                                    </div>
                                    <?php if ($track['duration']): ?>
                                        <div class="track-duration">
                                            <?= formatDuration($track['duration']) ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        
                        <div class="tracks-summary">
                            <p><strong>Liczba utworów:</strong> <?= count($tracks) ?></p>
                        </div>
                    <?php else: ?>
                        <div class="no-tracks">
                            <p>Brak dodanych utworów dla tej płyty.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Akcje -->
            <div class="record-actions">
                <a href="browse_records.php" class="btn btn-secondary">
                    📋 Powrót do kolekcji
                </a>
                <button onclick="openEditModal(<?= $record['id'] ?>)" class="btn btn-primary">
                    ✏️ Edytuj płytę
                </button>
                <button onclick="deleteRecord(<?= $record['id'] ?>)" class="btn btn-danger">
                    🗑️ Usuń płytę
                </button>
            </div>
        </div>
    </div>

    <!-- Modal edycji -->
    <div id="editModal" class="modal">
        <div class="modal-content large">
            <div class="modal-header">
                <h3>Edycja płyty</h3>
                <span class="close" onclick="closeEditModal()">&times;</span>
            </div>
            <div class="modal-body">
                <form id="editRecordForm" enctype="multipart/form-data">
                    <input type="hidden" name="csrf_token" value="<?= generateCSRFToken() ?>">
                    <input type="hidden" name="record_id" value="<?= $record['id'] ?>">
                    
                    <div class="form-grid">
                        <div class="form-section">
                            <h4>Podstawowe informacje</h4>
                            
                            <div class="form-group">
                                <label for="edit_artist">Wykonawca *</label>
                                <input type="text" id="edit_artist" name="artist" 
                                       value="<?= sanitizeOutput($record['artist']) ?>" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="edit_title">Tytuł płyty *</label>
                                <input type="text" id="edit_title" name="title" 
                                       value="<?= sanitizeOutput($record['title']) ?>" required>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="edit_release_year">Rok wydania *</label>
                                    <input type="number" id="edit_release_year" name="release_year" 
                                           value="<?= $record['release_year'] ?>" 
                                           min="1900" max="<?= date('Y') ?>" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="edit_price">Cena (zł) *</label>
                                    <input type="number" id="edit_price" name="price" 
                                           value="<?= $record['price'] ?>" 
                                           min="0" step="0.01" required>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="edit_cover_image">Nowa okładka płyty</label>
                                <input type="file" id="edit_cover_image" name="cover_image" accept="image/*">
                                <small>Pozostaw puste, aby zachować obecną okładkę</small>
                                <?php if ($record['cover_image']): ?>
                                    <div class="current-cover">
                                        <p>Obecna okładka:</p>
                                        <img src="uploads/covers/thumb_<?= sanitizeOutput($record['cover_image']) ?>" 
                                             alt="Obecna okładka">
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <div class="form-section">
                            <h4>Lista utworów</h4>
                            <div id="edit-tracks-container">
                                <?php if (!empty($tracks)): ?>
                                    <?php foreach ($tracks as $index => $track): ?>
                                        <div class="track-item" data-track="<?= $index + 1 ?>">
                                            <div class="form-row">
                                                <div class="form-group track-number">
                                                    <label>Nr</label>
                                                    <input type="number" name="tracks[<?= $index + 1 ?>][number]" 
                                                           value="<?= $track['track_number'] ?>" readonly>
                                                </div>
                                                <div class="form-group track-title">
                                                    <label>Tytuł utworu</label>
                                                    <input type="text" name="tracks[<?= $index + 1 ?>][title]" 
                                                           value="<?= sanitizeOutput($track['track_title']) ?>">
                                                </div>
                                                <div class="form-group track-duration">
                                                    <label>Czas</label>
                                                    <input type="text" name="tracks[<?= $index + 1 ?>][duration]" 
                                                           value="<?= sanitizeOutput($track['duration']) ?>"
                                                           placeholder="mm:ss" pattern="[0-9]{1,2}:[0-9]{2}">
                                                </div>
                                                <div class="track-actions">
                                                    <button type="button" class="btn btn-danger btn-small remove-track" 
                                                            onclick="removeEditTrack(<?= $index + 1 ?>)">Usuń</button>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <div class="track-item" data-track="1">
                                        <div class="form-row">
                                            <div class="form-group track-number">
                                                <label>Nr</label>
                                                <input type="number" name="tracks[1][number]" value="1" readonly>
                                            </div>
                                            <div class="form-group track-title">
                                                <label>Tytuł utworu</label>
                                                <input type="text" name="tracks[1][title]" placeholder="Wprowadź tytuł utworu">
                                            </div>
                                            <div class="form-group track-duration">
                                                <label>Czas</label>
                                                <input type="text" name="tracks[1][duration]" 
                                                       placeholder="mm:ss" pattern="[0-9]{1,2}:[0-9]{2}">
                                            </div>
                                            <div class="track-actions">
                                                <button type="button" class="btn btn-danger btn-small remove-track" 
                                                        onclick="removeEditTrack(1)" style="display:none;">Usuń</button>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            
                            <div class="track-controls">
                                <button type="button" id="addEditTrack" class="btn btn-secondary btn-small">
                                    ➕ Dodaj utwór
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">💾 Zapisz zmiany</button>
                        <button type="button" class="btn btn-secondary" onclick="closeEditModal()">Anuluj</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2025 Biblioteczka Płyt Winylowych. Wszystkie prawa zastrzeżone.</p>
        </div>
    </footer>

    <script src="js/script.js"></script>
    <script>
        function openEditModal(recordId) {
            document.getElementById('editModal').style.display = 'block';
            initializeEditTrackManagement();
        }
        
        function closeEditModal() {
            document.getElementById('editModal').style.display = 'none';
        }
        
        function deleteRecord(recordId) {
            if (confirm('Czy na pewno chcesz usunąć tę płytę? Ta operacja jest nieodwracalna.')) {
                const formData = new FormData();
                formData.append('record_id', recordId);
                formData.append('csrf_token', '<?= generateCSRFToken() ?>');
                
                fetch('ajax/delete_record_ajax.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        window.location.href = 'browse_records.php';
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    alert('Wystąpił błąd podczas usuwania płyty');
                });
            }
        }
        
        // Obsługa edycji utworów w modalu
        function initializeEditTrackManagement() {
            let editTrackCount = document.querySelectorAll('#edit-tracks-container .track-item').length;
            const maxTracks = 20;
            
            document.getElementById('addEditTrack').onclick = function() {
                if (editTrackCount >= maxTracks) {
                    alert('Maksymalna liczba utworów to ' + maxTracks);
                    return;
                }
                
                editTrackCount++;
                addEditTrackField(editTrackCount);
                updateEditRemoveButtons();
            };
            
            updateEditRemoveButtons();
        }
        
        function addEditTrackField(trackNumber) {
            const container = document.getElementById('edit-tracks-container');
            const trackDiv = document.createElement('div');
            trackDiv.className = 'track-item';
            trackDiv.setAttribute('data-track', trackNumber);
            
            trackDiv.innerHTML = `
                <div class="form-row">
                    <div class="form-group track-number">
                        <label>Nr</label>
                        <input type="number" name="tracks[${trackNumber}][number]" value="${trackNumber}" readonly>
                    </div>
                    <div class="form-group track-title">
                        <label>Tytuł utworu</label>
                        <input type="text" name="tracks[${trackNumber}][title]" placeholder="Wprowadź tytuł utworu">
                    </div>
                    <div class="form-group track-duration">
                        <label>Czas</label>
                        <input type="text" name="tracks[${trackNumber}][duration]" 
                               placeholder="mm:ss" pattern="[0-9]{1,2}:[0-9]{2}">
                    </div>
                    <div class="track-actions">
                        <button type="button" class="btn btn-danger btn-small remove-track" 
                                onclick="removeEditTrack(${trackNumber})">Usuń</button>
                    </div>
                </div>
            `;
            
            container.appendChild(trackDiv);
        }
        
        function removeEditTrack(trackNumber) {
            const trackElement = document.querySelector(`#edit-tracks-container [data-track="${trackNumber}"]`);
            if (trackElement) {
                trackElement.remove();
                renumberEditTracks();
                updateEditRemoveButtons();
            }
        }
        
        function renumberEditTracks() {
            const tracks = document.querySelectorAll('#edit-tracks-container .track-item');
            tracks.forEach((track, index) => {
                const newNumber = index + 1;
                track.setAttribute('data-track', newNumber);
                
                const inputs = track.querySelectorAll('input');
                inputs[0].value = newNumber;
                inputs[0].name = `tracks[${newNumber}][number]`;
                inputs[1].name = `tracks[${newNumber}][title]`;
                inputs[2].name = `tracks[${newNumber}][duration]`;
                
                const removeButton = track.querySelector('.remove-track');
                if (removeButton) {
                    removeButton.setAttribute('onclick', `removeEditTrack(${newNumber})`);
                }
            });
        }
        
        function updateEditRemoveButtons() {
            const tracks = document.querySelectorAll('#edit-tracks-container .track-item');
            tracks.forEach(track => {
                const removeButton = track.querySelector('.remove-track');
                removeButton.style.display = tracks.length > 1 ? 'inline-block' : 'none';
            });
        }
        
        // Obsługa formularza edycji
        document.getElementById('editRecordForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            
            fetch('ajax/edit_record_ajax.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    location.reload();
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                alert('Wystąpił błąd podczas zapisywania zmian');
            });
        });
        
        // Zamknięcie modala po kliknięciu poza nim
        window.onclick = function(event) {
            const modal = document.getElementById('editModal');
            if (event.target == modal) {
                closeEditModal();
            }
        }
    </script>
</body>
</html>