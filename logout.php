<?php
// logout.php
// Wylogowanie użytkownika

require_once __DIR__ . '/init.php';

// Wylogowanie użytkownika
logoutUser();

// Przekierowanie na stronę logowania
header('Location: login.php');
exit;
?>