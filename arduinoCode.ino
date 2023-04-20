#include <Wire.h>
#include <LiquidCrystal_I2C.h>
#include <MFRC522.h>
#include <SPI.h>

#define RST_PIN         9
#define SS_PIN          10

MFRC522 mfrc522(SS_PIN, RST_PIN);  // Create MFRC522 instance
LiquidCrystal_I2C lcd(0x27, 16, 2); // Create LCD instance

void setup() {
  Serial.begin(115200);  // Initialize serial communication
  SPI.begin();         // Initialize SPI communication
  mfrc522.PCD_Init();   // Initialize MFRC522
  lcd.init();          // Initialize LCD
  lcd.backlight();     // Turn on LCD backlight
}

void loop() {
  lcd.clear();
  lcd.setCursor(0, 0); // Set cursor to top-left corner
  lcd.print("Place your card.");//Print message

  // Check for new card
  if ( ! mfrc522.PICC_IsNewCardPresent()) {
    return;
  }
  // Read card ID
  if ( ! mfrc522.PICC_ReadCardSerial()) {
    return;
  }

  String cardId = "";
  String response = "";

  for (byte i = 0; i < mfrc522.uid.size; i++) {
    cardId += String(mfrc522.uid.uidByte[i], HEX);
  }

  // Print the cardId to the serial for the python script to grasp it 
  Serial.println(cardId);

  // Wait until receive the response
  bool stop = false;
  while(!stop){
  if(Serial.available() > 0){
      response = Serial.readStringUntil('\n');
      response.trim();
      stop = ( response.equals("0") || response.equals("1") || response.equals("2") );
    }
  }

  String output = (response.equals("0")) ? "Thank You." : (response.equals("1")) ? "No Lecture." : "Card Not Valid.";
  
  scanning();

  lcd.clear();
  lcd.setCursor(0, 0);
  lcd.print(output);
  delay(2500);
}


void scanning(){
  lcd.clear();
  lcd.setCursor(0, 0);
  char myString[] = "Scanning";
  int length = strlen(myString);
  lcd.print(myString);
  for (int i = 0; i < 2; i++){
    lcd.setCursor(length + 1, 0);
    lcd.print(".");
    delay(500);
    lcd.setCursor(length + 2, 0);
    lcd.print(".");
    delay(500);
    lcd.setCursor(length + 3, 0);
    lcd.print(".");
    delay(500);
    lcd.clear();
    lcd.print(myString);//Print message
  }
}


