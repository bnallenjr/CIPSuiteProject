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

  <h2>Asset Management</h2>

  <div class="row">
    <div class="col-sm-6">
      <?php
      $cards = [
        ["New BES Asset (Facilities)", "#newAsset"],
        ["BES Asset (Facilities)", "#tblAsset"],
        ["New BES Cyber Systems", "#newSystem"],
        ["BES Cyber Systems", "#tblSystem"],
        ["New BES Cyber Assets, PCAs, EACMS, PACS", "#newCyberAsset"],
        ["BES Cyber Assets, PCAs, EACMS, PACS", "#tblCyberAsset"]
      ];
      foreach (array_chunk($cards, 2) as $row) {
        echo '<div class="row mb-2">';
        foreach ($row as $card) {
          list($title, $link) = $card;
          echo "<div class='col-sm-6'>
                  <div class='card bg-secondary text-white'>
                    <a href='$link' data-toggle='modal'>
                      <div class='card-body'>
                        <h5 align='center' class='text-white'>$title</h5>
                      </div>
                    </a>
                  </div>
                </div>";
        }
        echo '</div>';
      }
      ?>
    </div>

    <div class="col-sm-6">
      <?php include "uptasks.php"; ?>
    </div>
  </div>

  <footer class="text-center mt-4">
    &copy; <?php
    $copyYear = 2018;
    $curYear = date('Y');
    echo $copyYear . (($copyYear != $curYear) ? '-' . $curYear : '');
    ?> Copyright. Allen Solutions Group LLC. All Rights Reserved.
  </footer>

  <?php
  $modals = [
    ["tblAsset", "Asset List", "tblAsset.php"],
    ["tblSystem", "System List", "tblSystem.php"],
    ["tblCyberAsset", "Cyber Asset List", "tblCybAsset.php"],
    ["newAsset", "New Asset Form", "NewAsset.php"],
    ["newSystem", "New System Form", "NewSystem.php"],
    ["newCyberAsset", "New Cyber Asset Form", 'NewCyberAsset.php']
  ];
  foreach ($modals as $modal) {
    list($id, $title, $file) = $modal;
    echo "<div id='$id' class='modal fade'>
            <div class='modal-dialog modal-lg'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h3>$title</h3>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                </div>
                <div class='modal-body'>
                  <?php include '$file'; ?>
                </div>
              </div>
            </div>
          </div>";
  }
  ?>

</body>
</html>
