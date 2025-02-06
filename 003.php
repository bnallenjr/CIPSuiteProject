<!DOCTYPE html>
<html lang="en">
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

  <div class="container mt-4">
    <h2>Security Management Policy</h2>

    <div class="row">
      <!-- Left Section -->
      <div class="col-sm-6">
        <div class="card bg-secondary text-white mb-3">
          <div class="card-body text-center">
            <a href="#tbldocs" data-toggle="modal" class="text-white">
              <h5>CIP Documentation (Policies, Plans, Processes, Procedures, etc.)</h5>
            </a>
          </div>
        </div>

        <div class="card bg-secondary text-white mb-3">
          <div class="card-body text-center">
            <a href="#cipSenAssign" data-toggle="modal" class="text-white">
              <h5>CIP Senior Manager (Assignment & Delegation)</h5>
            </a>
          </div>
        </div>

        <div class="card bg-secondary text-white">
          <div class="card-body text-center">
            <h5>Low Impact CIP Program</h5>
          </div>
        </div>
      </div>

      <!-- Right Section -->
      <div class="col-sm-6">
        <?php include 'uptasks.php'; ?>
      </div>
    </div>

    <!-- Footer Section -->
    <footer class="mt-4">
      <p>&copy; <?php
        $copyYear = 2018; // Set your website start date
        $curYear = date('Y');
        echo $copyYear . (($copyYear != $curYear) ? '-' . $curYear : '');
      ?> Copyright. Allen Solutions Group LLC. All Rights Reserved.</p>
    </footer>
  </div>

  <!-- CIP Senior Manager Assignment Modal -->
  <div id="cipSenAssign" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="cipSenAssignLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h3 id="cipSenAssignLabel">CIP Senior Manager Assignment</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <?php include 'cipsnrassign.php'; ?>
        </div>
      </div>
    </div>
  </div>

  <!-- CIP Documentation Program Modal -->
  <div id="tbldocs" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="tbldocsLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h3 id="tbldocsLabel">CIP Documentation Program</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <?php include 'tblDocs.php'; ?>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
