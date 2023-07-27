import mysql.connector
import bs4
import urllib.request
import re
import time
import datetime

mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  password="Casino.69",
  database="temps"
)


mycursor = mydb.cursor()

#mycursor.execute("CREATE DATABASE temps")

#mycursor.execute("DROP TABLE IF EXISTS temps")

#mycursor.execute("CREATE TABLE temps (timestamp DATETIME, temp1 INTEGER, temp2 INTEGER)")

link="http://192.168.1.204/temp"



i=0

while i<10:
  
  try:

    webpage=str(urllib.request.urlopen(link).read())
    soup = bs4.BeautifulSoup(webpage, "html.parser")


    result = re.sub('[^0-9]','', soup.get_text())
    temp1 = result[:3]
    temp2 = result[3:6]
    current = result[-3:]

    ts = time.time()
    timestamp = datetime.datetime.fromtimestamp(ts).strftime('%Y-%m-%d %H:%M:%S')

    #print(timestamp, temp1, temp2, current)
    print(result)
    sql="insert into temps (timestamp, temp1, temp2, current) values (%s, %s, %s, %s)"
    mycursor.execute(sql, (timestamp, temp1, temp2, current))
    mydb.commit()


    time.sleep(60)
  except KeyboardInterrupt:
    # quit
    sys.exit()
  except:
    print("Error connecting")
    time.sleep(60)


