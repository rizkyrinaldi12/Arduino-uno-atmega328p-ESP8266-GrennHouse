<!DOCTYPE html>
<html>
<head>
  <title>Menampilkan Data</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <!-- Tambahkan library Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<div class="w3-container">
 <h1> <center>Data Hasil Sensor</h1>
</div>
<!-- Canvas untuk line chart Suhu -->
<div style="width: 100%; margin: auto;">
  <canvas id="lineChartSuhu"></canvas>
</div>

<!-- Canvas untuk line chart Kelembaban -->
<div style="width: 100%; height: 80%; margin: auto;">
  <canvas id="lineChartKelembaban"></canvas>
</div>

<!-- Canvas untuk line chart Kelembapan Tanah -->
<div style="width: 100%; margin: auto;">
  <canvas id="lineChartKelembapanTanah"></canvas>
</div>

<?php
require ("Koneksi.php");
$sql = "SELECT * FROM SensorData ORDER BY waktu DESC LIMIT 15"; // Ambil hanya 15 data terbaru
$hasil = mysqli_query($conn, $sql);

$labels = [];
$suhuData = [];
$kelembabanData = [];
$nilaiData = [];

while ($row = mysqli_fetch_assoc($hasil)) {
    $labels[] = $row['waktu'];
    $suhuData[] = $row['temperature'];
    $kelembabanData[] = $row['humidity'];
    $nilaiData[] = $row['nilai'];
}
?>

<script>
  var labels = <?php echo json_encode($labels); ?>;
  var suhuData = <?php echo json_encode($suhuData); ?>;
  var kelembabanData = <?php echo json_encode($kelembabanData); ?>;
  var nilaiData = <?php echo json_encode($nilaiData); ?>;

  // Membuat line chart untuk Suhu
  var ctxSuhu = document.getElementById('lineChartSuhu').getContext('2d');
  var lineChartSuhu = new Chart(ctxSuhu, {
    type: 'line',
    data: {
      labels: labels,
      datasets: [{
        label: 'Suhu',
        data: suhuData,
        borderColor: 'red',
        fill: false,
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      scales: {
        x: {
          display: true,
          title: {
            display: true,
            text: 'Waktu'
          }
        },
        y: {
          display: true,
          title: {
            display: true,
            text: 'Suhu'
          }
        }
      }
    }
  });

  // Membuat line chart untuk Kelembaban
  var ctxKelembaban = document.getElementById('lineChartKelembaban').getContext('2d');
  var lineChartKelembaban = new Chart(ctxKelembaban, {
    type: 'line',
    data: {
      labels: labels,
      datasets: [{
        label: 'Kelembaban',
        data: kelembabanData,
        borderColor: 'blue',
        fill: false,
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      scales: {
        x: {
          display: true,
          title: {
            display: true,
            text: 'Waktu'
          }
        },
        y: {
          display: true,
          title: {
            display: true,
            text: 'Kelembaban'
          }
        }
      }
    }
  });

  // Membuat line chart untuk Kelembapan Tanah
  var ctxKelembapanTanah = document.getElementById('lineChartKelembapanTanah').getContext('2d');
  var lineChartKelembapanTanah = new Chart(ctxKelembapanTanah, {
    type: 'line',
    data: {
      labels: labels,
      datasets: [{
        label: 'Kelembapan Tanah',
        data: nilaiData,
        borderColor: 'green',
        fill: false,
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      scales: {
        x: {
          display: true,
          title: {
            display: true,
            text: 'Waktu'
          }
        },
        y: {
          display: true,
          title: {
            display: true,
            text: 'Kelembapan Tanah'
          }
        }
      }
    }
  });
  function refreshPage() {
    location.reload(); // Memuat ulang halaman
  }

  // Panggil fungsi refreshPage setiap 2 detik
  setInterval(refreshPage, 5000);
</script>
</body>
</html>
