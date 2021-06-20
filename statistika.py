from os import stat
import datetime
from Kirje import Kirje


def Data():
    list = []
    fm = open("stat.txt", "r")
    statistika = fm.readlines()
    date = datetime.date.today()
    for rida in statistika:
        andmed = rida.split(",")
        if datetime.date(int(andmed[3][6:10]),int(andmed[3][3:5]),int(andmed[3][0:2]))>date-datetime.timedelta(30,0,0,0,0,0,0):
            list.append(Kirje(andmed[0],andmed[1],andmed[2],andmed[3],andmed[4],andmed[5]))
    

    result = ToOneDate(list, date)
    print(result)
    f = open("sorted.csv", 'w')
    for i in result:
        f.write(i)
        for j in result[i]:
            f.write(","+j.strftime('%Y-%m-%d')+','+str(result[i][j]))
        f.write("\n")
    f.close()

def ToOneDate(list, date):
    list2 = list[:]
    for k in range(len(list)):
        list2[k] = list[k].device_id
    dictl={}
    for j in list2:
        dictl[j] = {}
        for i in range(30):
            dictl[j][date-datetime.timedelta(i+1,0,0,0,0,0,0)] = 0
        for k in range(29):
            for l in list:
                if date-datetime.date(int(l.aeg_lopp[6:10]),int(l.aeg_lopp[3:5]),int(l.aeg_lopp[0:2])) == datetime.timedelta(k,0,0,0,0,0,0) and l.device_id==j:
                    dictl[j][date-datetime.timedelta(k,0,0,0,0,0,0)] += int(l.kulu)
    return dictl

if __name__ == '__main__':

   Data()
   