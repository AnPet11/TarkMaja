from datetime import datetime
import datetime
import csv
import datetime



def timeOfWeek():
  dayNr = datetime.datetime.today().weekday()
  if dayNr<5:
    return('Weekday')
  else:
    return('Weekend')

#timeOfWeek()
#funktsioon timeOfWeek t22tab



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

    print(expensiveTimes)
    print(cheapTimes)




splitPrices()