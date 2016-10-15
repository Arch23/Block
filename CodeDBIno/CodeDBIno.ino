//ARDUINO 1.0+ ONLY
//ARDUINO 1.0+ ONLY
#include <Ethernet.h>
#include <SPI.h>

////////////////////////////////////////////////////////////////////////
//CONFIGURE
////////////////////////////////////////////////////////////////////////
byte server[] = {192,168,1,100 }; //ip Address of the server you will connect to

//The location to go to on the server
//make sure to keep HTTP/1.0 at the end, this is telling it what type of file it is
String location = " /block/web/model/ArduinoDAO.php?";


// if need to change the MAC address (Very Rare)
byte mac[] = { 0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED };
////////////////////////////////////////////////////////////////////////

EthernetClient client;

char inString[32]; // string for incoming serial data
int stringPos = 0; // string index counter
boolean startRead = false; // is reading?
String aux;
void setup(){
  Ethernet.begin(mac);
  Serial.begin(9600);
}

void loop(){
  String pageValue = connectAndRead(); //connect to the server and read the output

  Serial.println(pageValue); //print out the findings.

  delay(5000); //wait 5 seconds before connecting again
}

String connectAndRead(){
  //connect to the server

  Serial.println("connecting...");

  //port 80 is typical of a www page
  if (client.connect(server, 80)) {
    Serial.println("connected");
    client.print("GET ");
    client.print(location);
    client.print("key=5&bloco=1&andar=1&sala=1");
    client.println(" HTTP/1.0");
    client.println();
    aux=readPage();
    if(aux.equals("Pode entrar")){
      Serial.println("Seja bem vindo!");
    }
    else if(aux.equals("Sala utilizada!")){
      Serial.println("Sala em uso!");
    }
    else if(aux.equals("Reserva liberada!")){
      Serial.println("Reserva Registrada,Pode entrar");
    }
    else if(aux.equals("Voce nao pode usar esta sala!")){
      Serial.println("Voce nao pode usar esta sala, contate o departamento resposavel!");
    }
    else if(aux.equals("Voce nao pode reservar salas")){
      Serial.println("Voce nao tem permissao de reservar salas!");
    }
    else if(aux.equals("Usuario nao encontrado!")){
       Serial.println("Usuario nao encontrado verifique sua tag!");
    }
    else{
      return readPage();
    }
  
  }else{
    return "connection failed";
  }

}

String readPage(){
  //read the page, and capture & return everything between '<' and '>'

  stringPos = 0;
  memset( &inString, 0, 32 ); //clear inString memory

  while(true){

    if (client.available()) {
      char c = client.read();

      if (c == '<' ) { //'<' is our begining character
        startRead = true; //Ready to start reading the part 
      }else if(startRead){

        if(c != '>'){ //'>' is our ending character
          inString[stringPos] = c;
          stringPos ++;
        }else{
          //got what we need here! We can disconnect now
          startRead = false;
          client.stop();
          client.flush();
          Serial.println("disconnecting.");
          return inString;

        }

      }
    }

  }

}
