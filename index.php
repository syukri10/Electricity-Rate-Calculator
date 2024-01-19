<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>

  <?php
  $voltage = 0;
  $current = 0;
  $currentRate = 0;
  ?>

  <div class="container"> 
    <div class="text-left">
      <h1>Electricity Rate Calculator</h1>
  
        <form action="index.php" method="post">
          <div class="form-group">
            <label for="voltageInput">Voltage</label>
              <input type="number" class="form-control" id="voltage" name="voltage" step="0.01" required>
            <label>Voltage (V)</label>
          </div>

          <div class="form-group">
            <label for="ampereInput">Current</label>
              <input type="number" class="form-control" id="current" name="current" step="0.01" required>
            <label>Ampere (A)</label>
          </div>

        <div class="form-group">
            <label for="currentRate">CURRENT RATE</label>
            <input type="number" class="form-control" id="currentRate" name="currentRate" step="0.01" required>
            <label>sen/kWh</label>
        </div>
         

          <div class="text-center">
            <button type="submit" class="btn btn-light">calculate</button>
          </div>

        </form>
        <br>

  <?php
  $voltage = 0;
  $current = 0;
  $currentRate = 0;

   if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once 'function.php';
    // Retrieve values from the form
    $voltage = isset($_POST["voltage"]) ? floatval($_POST["voltage"]) : null;
    $current = isset($_POST["current"]) ? floatval($_POST["current"]) : null;
    $currentRate = isset($_POST["currentRate"]) ? floatval($_POST["currentRate"]) : null;
   
       
          echo '<style>
          #powerTable {
              width: 100%;
              border-collapse: collapse;
              margin-top: 20px; /* Adjust the top margin as needed */
          }
  
          th, td {
              padding: 10px;
              text-align: left;
              border: 1px solid #ddd; /* Border color */
          }
  
          th {
              background-color: #f2f2f2; /* Header background color */
          }
          </style>';
  
          echo '<br>';
          echo '<table id="powerTable" class="table table-bordered">';
          echo '<thead>';
          echo '<tr>';
          echo '<th scope="col">Metric</th>';
          echo '<th scope="col">Value</th>';
          echo '</tr>';
          echo '</thead>';
          echo '<tbody>';
  
          if ($voltage !== null && $current !== null) {
              $power = calculatePower($voltage, $current);
              echo "<tr><td>Power</td><td>$power kW</td></tr>";
          }
          
          if ($currentRate !== null) {
              $rate = calRate($currentRate);
              echo "<tr><td>Rate</td><td>MYR $rate</td></tr>";
          }
          
          echo '</tbody>';
          echo '</table>';
        
        echo '<style>
        #hourlyReference {
            margin-top: 20px; /* Adjust the top margin as needed */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px; /* Adjust the bottom margin as needed */
        }

        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd; /* Border color */
        }

        th {
            background-color: #f2f2f2; /* Header background color */
        }

        tbody tr:hover {
            background-color: #f5f5f5; /* Hover color for table rows */
        }
        </style>';
        echo '<br>';
        echo '<div id="hourlyReference">';
        echo '<table class="table table-bordered table-hover">';
        echo '<thead class="thead-light">';
        echo '<tr>';
        echo '<th scope="col">Hour</th>';
        echo '<th scope="col">Energy (kWh)</th>';
        echo '<th scope="col">Total (RM)</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        // Display hourly data 
        for ($hour = 1; $hour <= 24; $hour++) {
            $hourlyEnergy = $power * $hour;
            $hourlyTotalCharge = ($hourlyEnergy* $rate );

            echo '<tr>';
            echo '<td>' . $hour . '</td>';
            echo '<td>' . number_format($hourlyEnergy, 5) . '</td>';
            echo '<td>' . number_format($hourlyTotalCharge, 2) . '</td>';
            echo '</tr>';
        }
        
        echo '</tbody>';
        echo '</table>';
        echo '</div>';
    }
    ?>
  
  </div>
</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    
  </body>
</html>