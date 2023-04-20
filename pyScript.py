import serial
import requests
import time

# Initilize the serial communication
ser = serial.Serial('COM5', 115200, timeout=1.0)

# Waiting for serial comm. to be established
time.sleep(2)
ser.reset_input_buffer()

# Apache server listening on raspberry parameters
server = '192.168.137.165'
port = 80

# Read RFID tag code from serial port
try:
    while True :
        time.sleep(0.01)
        if ser.in_waiting > 0 :
            cardId = ser.readline().decode('utf-8').rstrip()
            if cardId :
                print('RFID tag code:', cardId)

                url = f'http://${server}:${port}/se_app-main/pointage.php?card_id={cardId}'
                
                resp = requests.get(url)
                
                response = resp.text + '\n'

                print(response)
            
                ser.write(response.encode())
                
                time.sleep(0.1)

except KeyboardInterrupt:
    ser.close()