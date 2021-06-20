import time
from datetime import datetime
import datetime
import csv
import pytz
import urllib
import urllib.request
import urllib.error

def getPrices():

    url = 'https://dashboard.elering.ee/api/nps/price/csv'
    
    today = datetime.datetime.today()-datetime.timedelta(1,0,0,0,0,0,0)
    
    starttime = datetime.datetime(int(today.strftime('%Y')),int(today.strftime('%m')),int(today.strftime('%d')),0,0,0)
    tomorrow = starttime + datetime.timedelta(2,0,0,0,0,0,0)


    todaystr = today.strftime('20%y-%m-%dT21:00:00.999Z')
    tomorrowstr = tomorrow.strftime('20%y-%m-%dT21:00:00.999Z')
    todaystr = todaystr.replace(':', '%3A')
    tomorrowstr = tomorrowstr.replace(':', '%3A')

    file = url+'?start='+todaystr+'&end='+tomorrowstr+'&fields=ee'
    path = 'hinnad.csv'
    
    try:
        urllib.request.urlretrieve(file, path)
    except urllib.error.HTTPError as ex:
        print('Problem:', ex)



def uuenda():
    listoflist= []
    fm = open("tingimused.txt", "r")
    tingimused = fm.readlines()
    for rida in tingimused:
        list = []
        andmed = rida.split(",")
        list.append(andmed[0])
        list.append(andmed[1])
        list.append(andmed[2])
        list.append(andmed[3])
        listoflist.append(list)

    status(listoflist)
    
def status(list):
    countlist = [len(list)]
    f = open("status.csv", 'w')
    times = splitPrices()[0]
    for n in range(len(list)):
      countlist[n]=0
    price=splitPrices()[1]
    for elem in range(len(list)):
      counter=countlist[elem]
      for i in times:
        if(counter<int(list[elem][1]) and int(list[elem][2].split('-')[0])<=int(i.split(':')[0])<int(list[elem][2].split('-')[1]) and price[elem]<=int(list[elem][3])):
          if (int(list[elem][2].split('-')[0])>=int(time.strftime('%H'))):
              f.write('1')
              counter[elem]+=1
          if (int(list[elem][2].split('-')[1])>=int(time.strftime('%H'))):
              f.write('0')
          countlist[elem]=counter
    f.close()

def is_dst ():
  doy = datetime.datetime.now().timetuple().tm_yday

  dst1 = range(0, 73)
  dst2 = range(74, 264)
  dst3 = range(311, 365)
  if doy in dst1:
      return True
  if doy in dst2:
      return False
  if doy in dst3:
      return True


def splitPrices():
  cheapTimes=[]
  expensiveTimes=[]
  total=0
  halfOfTotal=0
  times=[]
  prices=[]
  with open ('hinnad.csv', 'rt') as todaysPrices:
    hinnad= csv.reader(todaysPrices)
    next(hinnad)
    for line in hinnad:
      hinnad=("\t".join(line))
      hinnad=hinnad.replace('"', "")
      hinnad=hinnad.replace(";",",")
      hinnad=hinnad.replace('\t', '.')
      times.append(hinnad[22:27])
      prices.append(float(hinnad[28:34]))

    for hind in prices:
      total+=hind

    pakett = []
    f = open("pakett.txt", 'r')
        
    pakett = f.readline().split(',')
    
    paevvork=pakett[1]+pakett[3]+pakett[4]+pakett[5]+pakett[6]
    oovork=pakett[2]+pakett[3]+pakett[4]+pakett[5]+pakett[7]
    
    if (is_dst()==True): 
        for elm in prices:
            if((int(time.strftime('%H'))>=0 and int(time.strftime('%H'))<7) or (int(time.strftime('%H'))==23)):     
                elm+=oovork
            else:
                elm+=paevvork        
        
    else:

        for elm in prices:
            if(int(time.strftime('%H'))>=0 and int(time.strftime('%H'))<8):     
                elm+=float(oovork)
            else:
                elm+=float(paevvork)  


    halfOfTotal=total/23

    print(times)
    print(prices)
    print(total)
    print(halfOfTotal)

    i=0
    while i < 23:
      if prices[i] > halfOfTotal:
        expensiveTimes.append(prices[i])
        i+=1
      elif prices[i] <= halfOfTotal:
        cheapTimes.append(prices[i])
        i+=1
    prices, times = zip(*sorted(zip(prices, times)))
    print(times)

    print(expensiveTimes)
    print(cheapTimes)
    for t in times:
        t = t.split(":")[0]

    return times, prices
    
eof=False
while(eof==False):
    uuenda()
    if(int(time.strftime('%H'))==14):
        getPrices()
    time.sleep(3600)
