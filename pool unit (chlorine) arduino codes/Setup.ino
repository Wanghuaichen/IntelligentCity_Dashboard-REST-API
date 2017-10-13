void setup() {

  //LCD

  // initialize the LCD
 lcd.begin(16,2);   // initialize the lcd for 16 chars 2 lines, turn on backlight

// ------- Quick 3 blinks of backlight  -------------
  for(int i = 0; i< 3; i++)
  {
    lcd.backlight();
    delay(250);
    lcd.noBacklight();
    delay(250);
  }
  lcd.backlight(); // finish with backlight on  

//Start message
  lcd.setCursor(0,0); 
  lcd.print("IntelligentCity");
  lcd.setCursor(0,1); 
  lcd.print("Smart Water");
  delay(1000);

  //For pH module
  
  pinMode(LED,OUTPUT);  
  Serial.begin(115200);  
  Serial.println("Havuz Unitesi");    //Test the serial monitor

//For EC module
  // initialize all the readings to 0:
  for (byte thisReading = 0; thisReading < numReadings; thisReading++)
    readings[thisReading] = 0;
  TempProcess(StartConvert);   //let the DS18B20 start the convert
  AnalogSampleTime=millis();
  printTime=millis();
  tempSampleTime=millis();
  
// ChlorinationMechanism 


}
