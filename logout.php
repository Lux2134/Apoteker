<?php
// Start a session
session_start();

// Destroy all session data
session_destroy();

// Redirect to the login page
echo "<script> 
    alert('logout berhasil');
    window.location.href='login.php'
</script>";
exit;
