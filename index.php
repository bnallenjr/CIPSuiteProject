<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <title>CIP SUITE</title>
</head>
<body>
  <?php include 'nav.html'; ?>
  <div id="accordion">
    <?php
      $cipSections = [
        ['title' => 'Asset Management', 'id' => 'CIP-002'],
        ['title' => 'Cyber Security Program', 'id' => 'CIP-003'],
        ['title' => 'Personnel Management', 'id' => 'CIP-004'],
        ['title' => 'Networks and ESPs', 'id' => 'CIP-005'],
        ['title' => 'Physical Security of BES Cyber Systems', 'id' => 'CIP-006'],
        ['title' => 'System Security Management', 'id' => 'CIP-007'],
        ['title' => 'Incident Response', 'id' => 'CIP-008'],
        ['title' => 'System Recovery', 'id' => 'CIP-009'],
        ['title' => 'Baselining, Change Management, Vulnerability Management', 'id' => 'CIP-010'],
        ['title' => 'Information Protection', 'id' => 'CIP-011'],
        ['title' => 'Control Center Communications', 'id' => 'CIP-012'],
        ['title' => 'Supply Chain Mitigation Management', 'id' => 'CIP-013'],
        ['title' => 'Physical Security', 'id' => 'CIP-014']
      ];

      foreach ($cipSections as $index => $section) {
        echo "<div class='card'>
                <div class='card-header'>
                  <h4 class='panel-title'>
                    <a data-toggle='collapse' href='#collapse{$index}' data-parent='#accordion'>
                      {$section['title']} - ({$section['id']})
                    </a>
                  </h4>
                </div>
                <div id='collapse{$index}' class='collapse' data-parent='#accordion'>
                  <div class='card-body'>
                    <ul class='list-group'>
                      <button type='button' class='list-group-item list-group-item-action'>Documentation</button>
                      <button type='button' class='list-group-item list-group-item-action'>Evidence</button>
                      <button type='button' class='list-group-item list-group-item-action'>Standard Owner</button>
                    </ul>
                  </div>
                </div>
              </div>";
      }
    ?>
  </div>

  <div>
    &copy; <?php
      $copyYear = 2018; // Set your website start date
      $curYear = date('Y'); // Keeps the second year updated
      echo $copyYear . (($copyYear != $curYear) ? '-' . $curYear : '');
    ?> Copyright. Allen Solutions Group Inc. All Rights Reserved.
  </div>
</body>
</html>