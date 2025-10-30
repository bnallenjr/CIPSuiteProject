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
   <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script><title>Login</title></head>
<body>
  <div class="container" >
<h1>Login</h1>
<?php if ($err): ?><div style="color:red"><?php echo htmlspecialchars($err, ENT_QUOTES, 'UTF-8'); ?></div><?php endif; ?>
<form method="post">
  <?php csrf_input(); ?>
  <div class ="form-group">
  <label>Username <input name="username" required></label><br></div>
  <div class ="form-group">
  <label>Password <input name="password" type="password" required></label><br></div>
  <button type="submit">Sign in</button>
</form></div>
</body></html>
