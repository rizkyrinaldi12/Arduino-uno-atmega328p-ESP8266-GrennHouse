<?php
 include("Koneksi.php");
 if(!empty($_POST)){
 $humidity = $_POST["humidity"];
 $temperature = $_POST["temperature"];
 $nilai = $_POST["nilai"];
 $query = "INSERT INTO SensorData (humidity, temperature, nilai)
 VALUES ('".$humidity."', '".$temperature."', '".$nilai."')";
 if ($conn->query($query) === TRUE) {
 echo "Berhasil menyimpan data ke tabel<br>";
 echo "Kelembapan: " . $humidity . ", Suhu: " . $temperature . ", Kelembapan tanah: " . $nilai;
 } else {
 echo "Error: " . $sql . "<br>" . $conn->error;
 }
 }
?>