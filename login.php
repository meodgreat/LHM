<?php
session_start();
require_once 'db.php';

if (isset($_SESSION['admin_logged'])) {
    header('Location: admin.php');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = $pdo->prepare('SELECT * FROM admins WHERE username = ?');
    $stmt->execute([$username]);
    $admin = $stmt->fetch();

    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['admin_logged'] = true;
        $_SESSION['admin_user'] = $admin['username'];
        header('Location: admin.php');
        exit;
    } else {
        $error = 'Invalid administrative identification credentials.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Secure Administrative Sign-In</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@400;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Comfortaa', cursive; }</style>
</head>
<body class="bg-[#083d47] min-h-screen flex items-center justify-center px-4">
    <div class="bg-white p-10 rounded-[2.5rem] w-full max-w-md shadow-2xl">
        <div class="text-center mb-8">
            <img src="lhm.png" alt="Logo" class="h-12 mx-auto mb-4 object-contain">
            <h2 class="text-xl font-bold text-[#083d47]">LHM Control Center</h2>
            <p class="text-gray-400 text-xs mt-1">Authorized access routing matrix</p>
        </div>

        <?php if($error): ?>
            <div class="bg-red-50 text-red-600 text-xs font-bold p-4 rounded-xl mb-6 text-center"><?php echo $error; ?></div>
        <?php endif; ?>

        <form action="login.php" method="POST" class="space-y-5">
            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Username</label>
                <input type="text" name="username" required class="w-full px-4 py-3.5 bg-gray-50 border border-gray-100 rounded-xl focus:outline-none focus:border-[#3a8fab] text-sm text-gray-700 font-bold">
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Password</label>
                <input type="password" name="password" required class="w-full px-4 py-3.5 bg-gray-50 border border-gray-100 rounded-xl focus:outline-none focus:border-[#3a8fab] text-sm text-gray-700">
            </div>
            <button type="submit" class="w-full bg-[#3a8fab] text-white py-4 rounded-xl font-bold hover:bg-[#083d47] transition shadow-lg tracking-wider text-xs uppercase">Authenticate</button>
        </form>
    </div>
</body>
</html>