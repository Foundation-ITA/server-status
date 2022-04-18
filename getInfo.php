<?php
$count = 0;
$time = array('00:00', '00:30', '1:00', '1:30', '2:00', '2:30', '3:00', '3:30', '4:00', '4:30', '5:00', '5:30', '6:00', '6:30', '7:00', '7:30', '8:00', '8:30', '9:00', '9:30', '10:00', '10:30', '11:00', '11:30', '12:00', '12:30', '13:00', '13:30', '14:00', '14:30', '15:00', '15:30', '16:00', '16:30', '17:00', '17:30', '18:00', '18:30', '19:00', '19:30', '20:00', '20:30', '21:00', '21:30', '22:00', '22:30', '23:00', '23:30');
while (empty($no)) {
  echo "INIZIATO IL PROCESSO ALLE " . date("d/m/Y - H:i:s");
  $d = date("d");
  $m = date("m");
  $dev = json_decode(file_get_contents('https://api.fcosma.it/scpsl/status/rp.json'));
  $rp = $dev->Servers[0];
  $online = explode('/', $rp->Players)[0];
  // Controllo che ci sia una cartella con il mese e con il giorno
  if (!is_dir('data/' . $m . '/')) {
    mkdir('data/' . $m, 0777);
  }
  if (!is_dir('data/' . $m . '/' . $d)) {
    mkdir('data/' . $m . '/' . $d, 0777);
  }
  file_put_contents('data/' . $m . '/' . $d . '/' . $time[$count], $online);
  // Verifico che il picco di player giornalieri non sia stato superato
  if (file_get_contents('max') < $online) {
    file_put_contents('max', $online);
  }

  // Ok, ora verifico che non siano passate 24 ore
  if ($count == 47) {
    $count = 0;
    for ($a = 0; $a < 48; $a++) {
      unlink($time[$a]);
    }
  } else {
    $count++;
  }
  sleep(1800);
}
