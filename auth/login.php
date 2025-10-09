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
?>
<!doctype html><html><head>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script><meta charset="utf-8"><title>Login</title></head>
<body>
  <div class="section-card" >
<h1>Login</h1>
<?php if ($err): ?><div style="color:red"><?php echo htmlspecialchars($err, ENT_QUOTES, 'UTF-8'); ?></div><?php endif; ?>
<form method="post">
  <?php csrf_input(); ?>
  <label>Username <input name="username" required></label><br>
  <label>Password <input name="password" type="password" required></label><br>
  <button type="submit">Sign in</button>
</form></div>
</body></html>
