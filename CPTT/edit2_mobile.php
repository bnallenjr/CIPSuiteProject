<?php
/**
 * edit2_bootstrap.php
 *
 * Purpose: Wrap the existing edit2.php form/page with Bootstrap 5 and mobile-first UX
 * without changing any PHP logic or field names that power the "make and save edits" functionality.
 */

// Capture the output of the existing page.
ob_start();
require __DIR__ . '/edit2.php';
$pageContent = ob_get_clean();

$hasHtmlTag = stripos($pageContent, '<html') !== false;
$hasHeadTag = stripos($pageContent, '</head>') !== false;

$bootstrapHead = <<<HTML
  <!-- Bootstrap 5 -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .responsive-form table,
    .responsive-table { width: 100%; }
    @media (max-width: 767.98px) {
      .responsive-form table, .responsive-table { display: block; border: 0 !important; }
      .responsive-form tr, .responsive-table tr { display: block; margin-bottom: 1rem; }
      .responsive-form td, .responsive-form th,
      .responsive-table td, .responsive-table th {
        display: block; width: 100% !important; border: 0 !important;
        padding-left: 0 !important; padding-right: 0 !important;
      }
      .responsive-form td > *, .responsive-table td > * { width: 100%; }
    }
    body { background-color: #f8f9fa; }
    .page-wrap { padding-top: 1rem; padding-bottom: 2rem; }
    .form-section {
      background: #fff; border-radius: .75rem;
      box-shadow: 0 2px 12px rgba(0,0,0,.06);
      padding: 1rem; margin-bottom: 1rem;
    }
    input[type="text"], input[type="number"], input[type="email"],
    input[type="tel"], input[type="url"], input[type="password"],
    textarea, select { max-width: 100%; }
    .btn-wide-sm { width: 100%; }
    @media (min-width: 768px) { .btn-wide-sm { width: auto; } }
    .responsive-form table td label { margin-bottom: .25rem; font-weight: 600; }
  </style>
HTML;

$bootstrapFoot = <<<HTML
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    (function() {
      try {
        document.querySelectorAll('form').forEach(function(form) {
          form.classList.add('responsive-form');
          var parent = form.parentElement;
          var needsWrap = !parent || !parent.classList || !parent.classList.contains('form-section');
          if (needsWrap) {
            var wrapper = document.createElement('div');
            wrapper.className = 'form-section';
            parent ? parent.insertBefore(wrapper, form) : document.body.appendChild(wrapper);
            wrapper.appendChild(form);
          }
        });

        var selector = 'input:not([type=checkbox]):not([type=radio]):not([type=file]):not([type=hidden]), select, textarea';
        document.querySelectorAll(selector).forEach(function(el) {
          if (!el.classList.contains('form-control')) el.classList.add('form-control');
        });

        document.querySelectorAll('input[type=checkbox], input[type=radio]').forEach(function(el) {
          var parent = el.closest('.form-check');
          if (!parent) {
            var wrap = document.createElement('div');
            wrap.className = 'form-check';
            el.parentNode.insertBefore(wrap, el);
            wrap.appendChild(el);
            var label = el.nextElementSibling;
            if (label && label.tagName === 'LABEL') {
              label.classList.add('form-check-label');
              wrap.appendChild(label);
            }
            el.classList.add('form-check-input');
          } else {
            el.classList.add('form-check-input');
          }
        });

        document.querySelectorAll('button, input[type=submit], input[type=button]').forEach(function(btn) {
          var isLinkish = btn.tagName.toLowerCase() === 'a';
          if (!isLinkish) {
            var hasBs = /(btn-)/.test(btn.className);
            if (!hasBs) btn.classList.add('btn','btn-primary','btn-wide-sm');
            else if (!btn.classList.contains('btn')) btn.classList.add('btn','btn-wide-sm');
          }
        });

        document.querySelectorAll('table').forEach(function(t) {
          if (!t.classList.contains('table')) {
            t.classList.add('table','table-striped','responsive-table');
          } else {
            t.classList.add('responsive-table');
          }
        });

        var top = document.createElement('div');
        top.className = 'container-lg page-wrap';
        while (document.body.firstChild) {
          var node = document.body.firstChild;
          if (node === top) break;
          top.appendChild(node);
        }
        document.body.appendChild(top);
      } catch (e) { console.error('Bootstrap enhancement error:', e); }
    })();
  </script>
HTML;

if ($hasHeadTag) {
  $pageContent = preg_replace('~</head>~i', $bootstrapHead . "\n</head>", $pageContent, 1);
} elseif ($hasHtmlTag) {
  $pageContent = preg_replace('~<html[^>]*>~i', '$0' . "\n<head>\n" . $bootstrapHead . "\n</head>\n", $pageContent, 1);
} else {
  $pageContent = '<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
' . $bootstrapHead . '
<title>Edit Form</title>
</head>
<body>
' . $pageContent . '
' . $bootstrapFoot . '
</body>
</html>';
}

if (stripos($pageContent, $bootstrapFoot) === false) {
  if (stripos($pageContent, '</body>') !== false) {
    $pageContent = preg_replace('~</body>~i', $bootstrapFoot . "\n</body>", $pageContent, 1);
  } else {
    $pageContent .= $bootstrapFoot;
  }
}

echo $pageContent;
