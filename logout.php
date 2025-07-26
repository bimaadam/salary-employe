<?php
// memulai session
session_start();

// menghancurkan semua data session
$_SESSION = array();

// menghapus session cookie jika ada
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// menghancurkan session
session_destroy();

// mengarahkan ke halaman login.php dengan pesan logout berhasil
header("location: login.php?login=out");
exit();
?>