
//Programa : RFID - Controle de Acesso leitor RFID
 
#include <SPI.h>
#include <MFRC522.h>
#include <LiquidCrystal.h>
#include <Ethernet.h>


byte server[] = {192,168,1,100}; 
String location = " /block/web/model/ArduinoDAO.php?";


byte mac[] = { 0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED };
EthernetClient client;

char inString[32]; // string for incoming serial data
int stringPos = 0; // string index counter
boolean startRead = false; // is reading?
String aux;
#define SS_PIN 8
#define RST_PIN 9
MFRC522 mfrc522(SS_PIN, RST_PIN); 
LiquidCrystal lcd(6, 7, 5, 4, 3, 2); 
char st[20];
String conteudo= "";
void setup() 
{
  Serial.begin(9600);   
  SPI.begin();     
  mfrc522.PCD_Init();   
  lcd.begin(16, 2); 
  Ethernet.begin(mac);
  Serial.begin(9600);
  lcd.clear();
  lcd.setCursor(0,0);
  lcd.print("Conectando...");
   while(!client.connect(server,80)){
     delay(4000);  
  }
   mensageminicial();
}
 
void loop() 
{  
  if ( ! mfrc522.PICC_IsNewCardPresent()) 
  {
    return;
  }
  if ( ! mfrc522.PICC_ReadCardSerial()) 
  {
    return;
  }
  lcd.clear();
  lcd.setCursor(0,0);
  lcd.print("Leitura Efetuada");
  lcd.setCursor(0,1);
  lcd.print("Processando...");
  
  byte letra;
  for (byte i = 0; i < mfrc522.uid.size; i++) 
  {   
     conteudo.concat(String(mfrc522.uid.uidByte[i], HEX));
  }
  Serial.println();
  Serial.print(conteudo);
  delay(2000);
  String pageValue = connectAndRead();
 
}
String connectAndRead(){
  //connect to the server
    client.print("GET ");
    client.print(location);
    client.print("key=");
    client.print(conteudo);
    client.print("&bloco=1&andar=1&sala=1");
    client.println(" HTTP/1.0");
    client.println();
    aux=readPage();
    
    if(aux.substring(0,11).equals("Pode entrar")){
      lcd.clear();
      lcd.setCursor(0,0); 
      lcd.print("Seja Bem Vindo!");
      lcd.setCursor(0,1);
      lcd.print("Limite:");
      lcd.print(aux.substring(11));
    }
    else if(aux.substring(0,15).equals("Sala utilizada!")){
      lcd.clear();
      lcd.setCursor(0,0); 
      lcd.print("Sala em uso!");
    }
    else if(aux.substring(0,17).equals("Reserva liberada!")){
      for(int i=0;i<3;i++){
      lcd.clear();
      lcd.setCursor(0,0);
      lcd.print("Reserva Registra");
      lcd.setCursor(0,1);
      lcd.print("Limite:");
      lcd.print(aux.substring(17));
      delay(1000);
      
      lcd.clear();
      lcd.setCursor(0,0);
      lcd.print("serva Registrada");
      lcd.setCursor(0,1);
      lcd.print("Limite:");
      lcd.print(aux.substring(17));
      delay(1000);
      }
    }
    else if(aux.equals("Voce nao pode usar esta sala!")){
      for(int i=0;i<3;i++){
      lcd.clear();  
      lcd.setCursor(0,0); 
      lcd.print("Voce nao pode us");
      lcd.setCursor(0,1);
      lcd.print("Contate o depart");
      delay(1000);
      lcd.clear();
      lcd.setCursor(0,0);
      lcd.print("usar esta sala!");
      lcd.setCursor(0,1);
      lcd.print("amento responsa");
      delay(1000);
      lcd.setCursor(0,1);
      lcd.print("                     ");
      lcd.setCursor(0,1);
      lcd.print("reponsavel!");
      delay(1000);
      }
    }
    else if(aux.equals("Voce nao pode reservar salas")){
     for(int i=0;i<3;i++){ 
      lcd.clear();
      lcd.setCursor(0,0); 
      lcd.print("Voce nao tem per");
      lcd.setCursor(0,1);
      lcd.print("Para reservar sa");
      delay(1000);
      lcd.clear();
      lcd.setCursor(0,0);
      lcd.print("tem permissao!");
      lcd.setCursor(0,1);
      lcd.print("reservar salas!");
      delay(1000);
     }
    }
    else if(aux.equals("Usuario nao encontrado!")){
        for(int i=0;i<3;i++){
        lcd.clear();
        lcd.setCursor(0,0); 
        lcd.print("User nao encontr");
        lcd.setCursor(0,1); 
        lcd.print("Verifique sua ta!");
        delay(1000);
        lcd.clear();
        lcd.setCursor(0,0);
        lcd.print("nao encontrado!");
        lcd.setCursor(0,1); 
        lcd.print("sua tag!");
        delay(1000);
        }
    }
    else{
        lcd.clear();
        lcd.setCursor(0,0);
        lcd.print("Tente novamente");
        delay(3000);
        soft_reset();
        mensageminicial();
        conteudo="";
    }
  delay(3000);
  soft_reset();
  mensageminicial();
  conteudo="";
} 

 String readPage(){

  stringPos = 0;
  memset( &inString, 0, 32 );

  while(true){

    if (client.available()) {
      char c = client.read();

      if (c == '<' ) { 
        startRead = true; 
      }else if(startRead){

        if(c != '>'){
          inString[stringPos] = c;
          stringPos ++;
        }else{
          startRead = false;        
          return inString;

        }

      }
    }

  }

}
void mensageminicial()
{
  lcd.clear();
  lcd.print(" Aproxime o seu");  
  lcd.setCursor(0,1);
  lcd.print("cartao do leitor");  
}
void soft_reset() {
  asm volatile("jmp 0");
}
