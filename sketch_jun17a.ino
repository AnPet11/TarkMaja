/**
   BasicHTTPClient.ino

    Created on: 24.05.2015

*/

#include <Arduino.h>

#include <ESP8266WiFi.h>
#include <ESP8266WiFiMulti.h>

#include <ESP8266HTTPClient.h>

#include <WiFiClient.h>

ESP8266WiFiMulti WiFiMulti;

void setup() {
  pinMode(D5, OUTPUT);
  pinMode(D6, OUTPUT);
  pinMode(D7, OUTPUT);
  pinMode(D8, OUTPUT);
  Serial.begin(115200);
  // Serial.setDebugOutput(true);

  Serial.println();
  Serial.println();
  Serial.println();

  for (uint8_t t = 4; t > 0; t--) {
    Serial.printf("[SETUP] WAIT %d...\n", t);
    Serial.flush();
    delay(1000);
  }

  WiFi.mode(WIFI_STA);
  WiFiMulti.addAP("TLU", "");

}

void loop() {
  // wait for WiFi connection
  if ((WiFiMulti.run() == WL_CONNECTED)) {

    WiFiClient client;

    HTTPClient http;

    Serial.print("[HTTP] begin...\n");
    if (http.begin(client, "http://www.tlu.ee/~har0216/Tarkmaja/status.txt")) {  // HTTP

  //Tehke oma vأ¤ikese tekstiga veebileht
  //Veenduge, et kui seal teksti muudate, siis loeb ka NodeMCU selle muudetud teksti
  
      Serial.print("[HTTP] GET...\n");
      // start connection and send HTTP header
      int httpCode = http.GET();

      // httpCode will be negative on error
      if (httpCode > 0) {
        // HTTP header has been send and Server response header has been handled
        Serial.printf("[HTTP] GET... code: %d\n", httpCode);

        // file found at server
        if (httpCode == HTTP_CODE_OK || httpCode == HTTP_CODE_MOVED_PERMANENTLY) {
          String sisend = http.getString();
          Serial.println(sisend);
          char buf[20];
          sisend.toCharArray(buf, 20);
          char *p=buf;
          char *esimene=strtok_r(p, "\n", &p);
          char *teine=strtok_r(p, "\n", &p);
          char *kolmas=strtok_r(p, "\n", &p);
          char *neljas=strtok_r(p, "\n", &p);
          Serial.println(esimene);
          Serial.println(String(esimene).toInt());
          Serial.println(teine);
          int aeg1=String(esimene).toInt();
          int aeg2=String(teine).toInt();
          int aeg3=String(kolmas).toInt();
          int aeg4=String(neljas).toInt();
          Serial.println("viies");
          Serial.println(viies);
          if(aeg1==1){
             Serial.println("sees");
             digitalWrite(D5, HIGH);
           } else  {
             Serial.println("valjas");
             digitalWrite(D5, LOW);   
           }
           if(aeg2==1){
             Serial.println("sees");
             digitalWrite(D6, HIGH);
           } else  {
             Serial.println("valjas");
             digitalWrite(D6, LOW);   
           }
           if(aeg3==1){
             Serial.println("sees");
             digitalWrite(D7, HIGH);
           } else  {
             Serial.println("valjas");
             digitalWrite(D7, LOW);   
           }
           if(aeg4==1){
             Serial.println("sees");
             digitalWrite(D8, HIGH);
           } else  {
             Serial.println("valjas");
             digitalWrite(D8, LOW);   
           }
          delay(3600000);

         
        }
      } else {
        Serial.printf("[HTTP] GET... failed, error: %s\n", http.errorToString(httpCode).c_str());
      }

      http.end();
    } else {
      Serial.printf("[HTTP} Unable to connect\n");
    }
    delay(1000);
  }


}
