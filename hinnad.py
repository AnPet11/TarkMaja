import datetime
import pytz
import urllib
import urllib.request
import urllib.error

def GetPrices():

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

if __name__=="__main__":
    GetPrices()