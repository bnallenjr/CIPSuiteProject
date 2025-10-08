<?php
// login.php (modernized, mobile-friendly)
declare(strict_types=1);
session_start();

error_reporting(E_ALL);
ini_set('display_errors', '1');

// Load your Auth class (this file is in /auth)
require_once __DIR__ . '/Auth.php';

// --- CSRF token ---
if (empty($_SESSION['csrf_token'])) {
  $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrfToken = $_SESSION['csrf_token'];

// --- Helpers ---
function isSafeRedirect(string $url): bool {
  // Allow only same-site relative paths (no scheme/host)
  if ($url === '' || $url[0] !== '/') return false;          // must start with /
  if (str_starts_with($url, '//')) return false;             // protocol-relative -> no
  if (preg_match('/[\r\n]/', $url)) return false;            // header injection guard
  return true;
}

// Default redirect after login (dashboard is at site root)
$defaultRedirect = '../dashboard.php';
$redirect = $defaultRedirect;
if (isset($_GET['redirect']) && isSafeRedirect($_GET['redirect'])) {
  $redirect = $_GET['redirect'];
}

// Feedback vars
$error = '';
$usernamePrefill = '';

// Try to log in
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // CSRF check
  if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], (string)$_POST['csrf_token'])) {
    $error = 'Your session expired. Please try again.';
  } else {
    $username = trim((string)($_POST['username'] ?? ''));
    $password = (string)($_POST['password'] ?? '');
    $remember = !empty($_POST['remember']);

    $usernamePrefill = htmlspecialchars($username, ENT_QUOTES, 'UTF-8');

    if ($username === '' || $password === '') {
      $error = 'Please enter both your username and password.';
    } else {
      // Call your Auth class in a flexible way (supports different method names/styles)
      $ok = null;

      if (is_callable(['Auth', 'login'])) {
        // Static login
        $ok = Auth::login($username, $password, $remember);
      } elseif (is_callable(['Auth', 'attempt'])) {
        $ok = Auth::attempt($username, $password, $remember);
      } else {
        // Try instance methods if the class prefers that
        $authInstance = class_exists('Auth') ? new Auth() : null;
        if ($authInstance && is_callable([$authInstance, 'login'])) {
          $ok = $authInstance->login($username, $password, $remember);
        } elseif ($authInstance && is_callable([$authInstance, 'attempt'])) {
          $ok = $authInstance->attempt($username, $password, $remember);
        } else {
          $error = 'Authentication system is not available.';
        }
      }

      if ($ok) {
        // Regenerate CSRF for next request
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

        // Redirect safely
        header('Location: ' . $redirect);
        exit;
      } else if ($error === '') {
        $error = 'Invalid username or password.';
      }
    }
  }
}

?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Sign in | CIP Suite</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap 5 (standalone page; won’t affect app pages) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <style>
    :root {
      --brand: #0d6efd; /* Bootstrap primary */
      --bg-grad-1: #f8fafc;
      --bg-grad-2: #eef2f7;
    }
    html, body { height: 100%; }
    body {
      background: radial-gradient(1000px 600px at 10% 0%, var(--bg-grad-1), var(--bg-grad-2));
      display: flex; align-items: center; justify-content: center; padding: 24px;
      font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif;
    }
    .login-card {
      width: 100%;
      max-width: 420px;
      border: 1px solid rgba(0,0,0,.06);
      border-radius: 16px;
      box-shadow: 0 10px 30px rgba(0,0,0,.06);
      background: #fff;
      overflow: hidden;
    }
    .login-header {
      padding: 18px 20px;
      background: linear-gradient(180deg, #ffffff, #fafbff);
      border-bottom: 1px solid rgba(0,0,0,.06);
    }
    .login-header .title {
      display: flex; align-items: center; gap: .5rem;
      margin: 0; font-weight: 600;
    }
    .badge-pill {
      border-radius: 999px;
      padding: .35rem .6rem;
      font-size: .7rem; background: #e7f1ff; color: var(--brand); border: 1px solid #d7e9ff;
    }
    .login-body { padding: 20px; }
    .form-floating > label { color: #6c757d; }
    .input-group .form-control { padding-right: 3rem; }
    .toggle-pass {
      cursor: pointer; user-select: none;
      border: 1px solid #dee2e6; border-left: 0; background: #f8f9fa;
    }
    .footer {
      padding: 14px 20px; font-size: .9rem; color: #6c757d; border-top: 1px solid rgba(0,0,0,.06);
      display: flex; justify-content: space-between; align-items: center; gap: .5rem; flex-wrap: wrap;
    }
    .brand-mark {
      width: 36px; height: 36px; border-radius: 8px;
      display: inline-flex; align-items: center; justify-content: center;
      background: #e7f1ff; color: var(--brand); font-weight: 700;
    }
    @media (max-width: 420px) {
      .login-header, .login-body, .footer { padding-left: 16px; padding-right: 16px; }
    }
  </style>
</head>
<body>

  <main class="login-card" role="main" aria-label="Sign in">
    <div class="login-header">
      <h1 class="title h5 mb-0">
        <span class="brand-mark">C</span>
        <span>CIP Suite</span>
        <span class="badge-pill">sign in</span>
      </h1>
    </div>

    <div class="login-body">
      <?php if ($error): ?>
        <div class="alert alert-danger d-flex align-items-center" role="alert">
          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" class="me-2" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
            <path d="M11 7h2v6h-2V7zm0 8h2v2h-2v-2z"/><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10
            10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8
            8-8 8 3.59 8 8-3.59 8-8 8z"/>
          </svg>
          <div><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></div>
        </div>
      <?php endif; ?>

      <form method="post" action="" novalidate>
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrfToken, ENT_QUOTES, 'UTF-8') ?>">
        <?php if ($redirect !== $defaultRedirect): ?>
          <input type="hidden" name="redirect" value="<?= htmlspecialchars($redirect, ENT_QUOTES, 'UTF-8') ?>">
        <?php endif; ?>

        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="username" name="username" placeholder="Username"
                 value="<?= $usernamePrefill ?>" required autocomplete="username">
          <label for="username">Username</label>
        </div>

        <div class="mb-3">
          <div class="input-group">
            <div class="form-floating">
              <input type="password" class="form-control" id="password" name="password" placeholder="Password"
                     required autocomplete="current-password" style="border-top-right-radius:0;border-bottom-right-radius:0;">
              <label for="password">Password</label>
            </div>
            <button class="btn toggle-pass" type="button" id="togglePassword" aria-label="Show password">
              <span id="eye">👁️</span>
            </button>
          </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-3">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="1" id="remember" name="remember">
            <label class="form-check-label" for="remember">Remember me</label>
          </div>
          <!-- Optional: <a href="forgot.php" class="small">Forgot password?</a> -->
        </div>

        <button type="submit" name="submit" class="btn btn-primary w-100 py-2">
          Sign in
        </button>
      </form>
    </div>

    <div class="footer">
      <div class="small">© <?= date('Y') ?> CIP Suite</div>
      <div class="small text-muted">Secure portal access</div>
    </div>
  </main>

  <script>
    // Show/Hide password
    (function(){
      var btn = document.getElementById('togglePassword');
      var input = document.getElementById('password');
      var eye = document.getElementById('eye');
      if (btn && input) {
        btn.addEventListener('click', function(){
          if (input.type === 'password') {
            input.type = 'text';
            eye.textContent = '🙈';
            btn.setAttribute('aria-label', 'Hide password');
          } else {
            input.type = 'password';
            eye.textContent = '👁️';
            btn.setAttribute('aria-label', 'Show password');
          }
        });
      }
    })();
  </script>

  <!-- Bootstrap JS (optional for form styling; no jQuery needed) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
          integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
          crossorigin="anonymous"></script>
</body>
</html>
