<?php
// login.php
// Strona logowania użytkownika
require_once __DIR__ . '/init.php';

// Przekierowanie jeśli już zalogowany
if (isLoggedIn()) {
    header('Location: dashboard.php');
    exit;
}

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Weryfikacja tokenu CSRF
    if (!isset($_POST['csrf_token']) || !verifyCSRFToken($_POST['csrf_token'])) {
        $error_message = 'Błąd zabezpieczeń. Odśwież stronę i spróbuj ponownie.';
    } else {
        $username = sanitizeInput($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';
        
        if (empty($username) || empty($password)) {
            $error_message = 'Proszę wypełnić wszystkie pola';
        } else {
            if (loginUser($username, $password)) {
                header('Location: dashboard.php');
                exit;
            } else {
                $error_message = 'Nieprawidłowy login lub hasło';
            }
        }
    }
}

$csrf_token = generateCSRFToken();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie - Biblioteczka Płyt Winylowych</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="login-page">
    <div class="login-container">
        <div class="login-form">
            <div class="logo">
                <h1>🎵 Biblioteczka Płyt</h1>
                <p>System zarządzania kolekcją winyli</p>
            </div>
            
            <?php if ($error_message): ?>
                <div class="message message-error">
                    <?= sanitizeOutput($error_message) ?>
                </div>
            <?php endif; ?>
            
            <form method="POST" action="login.php" autocomplete="off">
                <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                
                <div class="form-group">
                    <label for="username">Nazwa użytkownika:</label>
                    <input 
                        type="text" 
                        id="username" 
                        name="username" 
                        required 
                        autocomplete="username"
                        value="<?= isset($username) ? sanitizeOutput($username) : '' ?>"
                    >
                </div>
                
                <div class="form-group">
                    <label for="password">Hasło:</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        required 
                        autocomplete="current-password"
                    >
                </div>
                
                <button type="submit" class="btn btn-primary btn-large">
                    Zaloguj się
                </button>
            </form>
            
        </div>
    </div>

    <script>
        // Fokus na pierwszym polu
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('username').focus();
        });
        
        // Walidacja po stronie klienta
        document.querySelector('form').addEventListener('submit', function(e) {
            const username = document.getElementById('username').value.trim();
            const password = document.getElementById('password').value;
            
            if (!username || !password) {
                e.preventDefault();
                alert('Proszę wypełnić wszystkie pola');
                return false;
            }
            
            if (username.length < 3) {
                e.preventDefault();
                alert('Nazwa użytkownika musi mieć co najmniej 3 znaki');
                return false;
            }
        });
    </script>
</body>
</html>