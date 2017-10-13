
void loop() {

  //For pH module
  static unsigned long samplingTime = millis();
  static unsigned long printTime = millis();
  static float pHValue,pHvoltage;
  if(millis()-samplingTime > samplingInterval)
  {
      pHArray[pHArrayIndex++]=analogRead(SensorPin);
      if(pHArrayIndex==ArrayLenth)pHArrayIndex=0;
      pHvoltage = avergearray(pHArray, ArrayLenth)*5.0/1024;
      pHValue = 3.5*pHvoltage+Offset;
      samplingTime=millis();
  }
  if(millis() - printTime > printInterval)   //Every 800 milliseconds, print a numerical, convert the state of the LED indicator
  {
    Serial.println("\n ************** ************** pH Sensor: ************** **************");
  Serial.print("pHvoltage: ");
        Serial.print(pHvoltage,2);
        Serial.print("    pH value: ");
  Serial.println(pHValue,2);
        digitalWrite(LED,digitalRead(LED)^1);
        printTime=millis();
  }

  //For EC module

  /*
   Every once in a while,sample the analog value and calculate the average.
  */
  if(millis()-AnalogSampleTime>=AnalogSampleInterval)  
  {
    AnalogSampleTime=millis();
     // subtract the last reading:
    AnalogValueTotal = AnalogValueTotal - readings[index];
    // read from the sensor:
    readings[index] = analogRead(ECsensorPin);
    // add the reading to the total:
    AnalogValueTotal = AnalogValueTotal + readings[index];
    // advance to the next position in the array:
    index = index + 1;
    // if we're at the end of the array...
    if (index >= numReadings)
    // ...wrap around to the beginning:
    index = 0;
    // calculate the average:
    AnalogAverage = AnalogValueTotal / numReadings;
  }
  /*
   Every once in a while,MCU read the temperature from the DS18B20 and then let the DS18B20 start the convert.
   Attention:The interval between start the convert and read the temperature should be greater than 750 millisecond,or the temperature is not accurate!
  */
   if(millis()-tempSampleTime>=tempSampleInterval) 
  {
    tempSampleTime=millis();
    temperature = TempProcess(ReadTemperature);  // read the current temperature from the  DS18B20
    TempProcess(StartConvert);                   //after the reading,start the convert for next reading
  }
   /*
   Every once in a while,print the information on the serial monitor.
  */
  if(millis()-printTime>=printIntervalEC)
  {
    printTime=millis();
    averageVoltage=AnalogAverage*(float)5000/1024;
    Serial.println("\n ************** ************** Electronic Conductivity: ************** **************");
    Serial.print("\nAnalog value:");
    Serial.print(AnalogAverage);   //analog average,from 0 to 1023
    Serial.print("    Voltage:");
    Serial.print(averageVoltage);  //millivolt average,from 0mv to 4995mV
    Serial.print("mV    ");
    Serial.print("temp:");
    Serial.print(temperature);    //current temperature
    Serial.print("^C     EC:");
    
    float TempCoefficient=1.0+0.0185*(temperature-25.0);    //temperature compensation formula: fFinalResult(25^C) = fFinalResult(current)/(1.0+0.0185*(fTP-25.0));
    float CoefficientVolatge=(float)averageVoltage/TempCoefficient;   
    if(CoefficientVolatge<150)Serial.println("No solution!");   //25^C 1413us/cm<-->about 216mv  if the voltage(compensate)<150,that is <1ms/cm,out of the range
    else if(CoefficientVolatge>3300)Serial.println("Out of the range!");  //>20ms/cm,out of the range
    else
    { 
      if(CoefficientVolatge<=448)ECcurrent=6.84*CoefficientVolatge-64.32;   //1ms/cm<EC<=3ms/cm
      else if(CoefficientVolatge<=1457)ECcurrent=6.98*CoefficientVolatge-127;  //3ms/cm<EC<=10ms/cm
      else ECcurrent=5.3*CoefficientVolatge+2278;                           //10ms/cm<EC<20ms/cm
      ECcurrent/=1000;    //convert us/cm to ms/cm
      Serial.print(ECcurrent,2);  //two decimal
      Serial.println("ms/cm");
      ECvalue=ECcurrent;
    }
  }

// for Turbidity Module

 Serial.println("\n ************** ************** Turbidity Sensor: ************** **************");
  int sensorValue = analogRead(A2);// read the input on analog pin 2:
  float Turbvoltage = sensorValue * (5.0 / 1024.0); // Convert the analog reading (which goes from 0 - 1023) to a voltage (0 - 5V):
  Serial.println("Turbvoltage: ");
  Serial.println(Turbvoltage); // print out the value you read:
  float Turbidity = -1120.4*Turbvoltage*Turbvoltage + 5742.3*Turbvoltage +4352.9; // Convert the voltage (0 - 5V) to NTU:
   Serial.println("Turbidity: "); 
   Serial.println(Turbidity); // print out the turbidity value:
   TurbidityValue = Turbidity;
  delay(500);

// ChlorinationMechanism

if(timerWorking) {
timerhour = ShowHours();
if(timerhour =0) {
timeUp =true;
}
}

if(pHValue<6.5){
  Serial.println("\n ************** ************** ATTENTION! ************** **************");
    Serial.println("pH value is below 6.5!\n");
    Serial.println("\n ************** ************** ATTENTION! ************** **************");
     if(timeUp) {
      runChlorination(1);
     }
}

if(pHValue>9.5){
  Serial.println("\n ************** ************** ATTENTION! ************** **************");
    Serial.println("pH value is over 9.5!\n");
    Serial.println("\n ************** ************** ATTENTION! ************** **************");
         if(timeUp) {
      runChlorination(2);
     }
}

if(ECvalue>2500){
  Serial.println("\n ************** ************** ATTENTION! ************** **************");
    Serial.println("EC value is over 2500 us/cm!\n");
    Serial.println("\n ************** ************** ATTENTION! ************** **************");
         if(timeUp) {
      runChlorination(1);
     }
}

if(TurbidityValue>9.5){
  Serial.println("\n ************** ************** ATTENTION! ************** **************");
    Serial.println("Turbidity value is over 5 NTU!\n");
    Serial.println("\n ************** ************** ATTENTION! ************** **************");
         if(timeUp) {
      runChlorination(2);
     }
}

//LCD printing

 // int pHtext =(int)pHValue;
/*  
  lcd.clear();
  lcd.setCursor(0,0); 
  lcd.print("pH :");
  lcd.setCursor(4,0); 
  lcd.print(pHValue);
  lcd.setCursor(9,0); 
  lcd.print("EC:");
  lcd.setCursor(12,0); 
  lcd.print(ECvalue);
  
  lcd.setCursor(0,1); 
  lcd.print("Trb:");
  lcd.setCursor(4,1); 
  lcd.print(TurbidityValue);
  lcd.setCursor(9,1); 
  lcd.print("T:");
  lcd.setCursor(12,1); 
  lcd.print(temperature);
  */
  lcd.clear();
  lcd.setCursor(0,0);
  lcd.print(timerhour);
  
// LoRa communication

  
}




