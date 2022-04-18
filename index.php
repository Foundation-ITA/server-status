<?php
$d = date("d");
$m = date("m");
?>
<!DOCTYPE html>
<html>
 <head>
  <title>Server Status - SCP:SL - RP | Foundation</title>
  <script src='https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js'></script>
 </head>
 <body>
<canvas id="myChart"></canvas>
<script>
<?php
$time = array('00:00', '00:30', '1:00', '1:30', '2:00', '2:30', '3:00', '3:30', '4:00', '4:30', '5:00', '5:30', '6:00', '6:30', '7:00', '7:30', '8:00', '8:30', '9:00', '9:30', '10:00', '10:30', '11:00', '11:30', '12:00', '12:30', '13:00', '13:30', '14:00', '14:30', '15:00', '15:30', '16:00', '16:30', '17:00', '17:30', '18:00', '18:30', '19:00', '19:30', '20:00', '20:30', '21:00', '21:30', '22:00', '22:30', '23:00', '23:30'); 
for ($a = 0; $a < 48; $a++) {
  if (file_exists('data/' . $m . '/' . $d . '/' . $time[$a])) {
    $label = $label . "'" . $time[$a] . "', ";
    $data = $data . "'" . file_get_contents('data/' . $m . '/' . $d . '/' . $time[$a]). "', ";
  } else {
    $label = $label . "'(" . $time[$a] . ")', ";
    $data = $data . "'0', ";
  }
}
?>
const ctx = document.getElementById('myChart').getContext('2d');
const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [<?= $label; ?>],
        datasets: [{
            label: ' Player nel server RP',
            data: [<?= $data; ?>],
            backgroundColor: [
<?php
for ($a = 0; $a < 47; $a++) {
?>
                'rgba(54, 162, 235, 0.2)',
<?php
}
?>
                'rgba(54, 162, 235, 0.2)'
            ],
            borderColor: [
<?php
for ($a = 0; $a < 47; $a++) {
?>
                'rgba(54, 162, 235, 0.2)',
<?php
}
?>
                'rgba(54, 162, 235, 0.2)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>
