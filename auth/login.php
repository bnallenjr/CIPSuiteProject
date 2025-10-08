<?php
require_once __DIR__ . '/csrf.php';
require_once __DIR__ . '/Auth.php';
$err = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_validate();
    $username = trim($_POST['username'] ?? '');
    $password = (string)($_POST['password'] ?? '');
    list($ok, $msg) = Auth::login($username, $password);
    if ($ok) {
        $dest = $_GET['redirect'] ?? '/';
        header('Location: ' . $dest);
        exit;
    } else { $err = $msg; }
}
?><!doctype html><html><head>
   <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"><meta charset="utf-8"><title>Login</title></head>
<body>
<h1>Login</h1>
<?php if ($err): ?><div style="color:red"><?php echo htmlspecialchars($err, ENT_QUOTES, 'UTF-8'); ?></div><?php endif; ?>
<form method="post">
  <?php csrf_input(); ?>
  <label>Username <input name="username" required></label><br>
  <label>Password <input name="password" type="password" required></label><br>
  <button type="submit">Sign in</button>
</form>
</body></html>
