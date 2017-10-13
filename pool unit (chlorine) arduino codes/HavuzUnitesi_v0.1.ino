#include <LiquidCrystal_I2C.h>

#include <Wire.h> 

LiquidCrystal_I2C lcd(0x27, 2, 1, 0, 4, 5, 6, 7, 3, POSITIVE);  // Set the LCD I2C address



//For pH module

#define SensorPin A1            //pH meter Analog output to Arduino Analog Input 1
#define Offset 0.00            //deviation compensate
#define LED 13
#define samplingInterval 20
#define printInterval 800
#define ArrayLenth  40    //times of collection
int pHArray[ArrayLenth];   //Store the average value of the sensor feedback
int pHArrayIndex=0;    

//For EC module

#include <OneWire.h>

#define StartConvert 0
#define ReadTemperature 1

const byte numReadings = 20;     //the number of sample times
byte ECsensorPin = A3;  //EC Meter analog output,pin on analog 3
byte DS18B20_Pin = 2; //DS18B20 signal, pin on digital 2
unsigned int AnalogSampleInterval=25,printIntervalEC=700,tempSampleInterval=850;  //analog sample interval;serial print interval;temperature sample interval
unsigned int readings[numReadings];      // the readings from the analog input
byte index = 0;                  // the index of the current reading
unsigned long AnalogValueTotal = 0;                  // the running total
unsigned int AnalogAverage = 0,averageVoltage=0;                // the average
unsigned long AnalogSampleTime,printTime,tempSampleTime;
float temperature,ECcurrent,ECvalue; 
 
//Temperature chip i/o
OneWire ds(DS18B20_Pin);  // on digital pin 2

// for Turbidity Module

float TurbidityValue;

// ChlorinationMechanism 
bool timeUp=true,timerWorking=false;


// for Chlorination mechanism

unsigned long timerhour;
