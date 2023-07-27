import mysql.connector
import bs4
import urllib.request
import re
import time
import datetime
import config

mydb = mysql.connector.connect(
  host=config.DB_HOST,
  user=config.DB_USER,
  password=config.DB_PASS,
  database="plants"
)


mycursor = mydb.cursor()

#mycursor.execute("CREATE DATABASE temps")

#mycursor.execute("DROP TABLE IF EXISTS temps")

#mycursor.execute("CREATE TABLE temps (timestamp DATETIME, temp1 INTEGER, temp2 INTEGER)")

link="http://192.168.1.204/status"



i=0

while i<10:
  
  try:

    webpage=str(urllib.request.urlopen(link).read())
    soup = bs4.BeautifulSoup(webpage, "html.parser")


    result = re.sub('[^0-9.]','', soup.get_text())
    s1 = result[:3]
    s2 = result[3:6]
    s3 = result[6:9]
    s4 = result[9:12]
    voltage = result[12:]

    ts = time.time()
    timestamp = datetime.datetime.fromtimestamp(ts).strftime('%Y-%m-%d %H:%M:%S')

    #print(timestamp, temp1, temp2, current)
    print(result)
    sql="insert into plants (s1, s2, s3, s4, voltage) values (%s, %s, %s, %s, %s)"
    mycursor.execute(sql, (s1, s2, s3, s4, voltage))
    mydb.commit()


    time.sleep(60)
  except KeyboardInterrupt:
    # quit
    sys.exit()
  except mysql.connector.Error as error:
    print("Error connecting to MySQL database: ", error)
    time.sleep(60)
  except Exception as error:
    print("An error occurred:", error)
    time.sleep(60)


