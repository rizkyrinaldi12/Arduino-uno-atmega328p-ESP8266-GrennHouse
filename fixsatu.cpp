#include "DHT.h"
#include <SoftwareSerial.h>

#define DHTPIN 8
#define DHTTYPE DHT11
const int sensorPin = A2;

DHT dht(DHTPIN, DHTTYPE);
float humidity, temperature, nilai;

SoftwareSerial ss(2,3); 

void setup() {
  Serial.begin(9600);
  ss.begin(115200);
  dht.begin(); 
}

void loop() {
  humidity = dht.readHumidity();
  temperature = dht.readTemperature();
  nilai = analogRead(sensorPin);
  
  // Print log messages
  Serial.print("Kelembapan: ");
  Serial.print(humidity);
  Serial.print(" %\t");
  Serial.print("Suhu: ");
  Serial.print(temperature);
  Serial.print(" °C\t");
  Serial.print("Kelembapan tanah: ");
  Serial.println(nilai);

  //kirim data ke ESP melalui komunikasi serial 
  String sendToESP = "";
  sendToESP += humidity;
  sendToESP += ";";
  sendToESP += temperature;
  sendToESP += ";";
  sendToESP += nilai;
  ss.println(sendToESP);
  delay(10000);
}