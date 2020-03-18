const HEIGHT_DB = 864;
const HEIGHT_LB = 432;
console.log("layout.js loaded");

function createLayout() {
    numerOfAreas = getNumberOfAreas(rollDice(20));

    areas = new Array(numerOfAreas);
    for (let i = 0; i < numerOfAreas; i++) {
        areaSize = getAreaSize(rollDice(12));
        areas[i] = new Array(areaSize);
        for (let x = 0; x < areaSize; x++) {
            let book = getPageTileTable(rollDice(10));
            switch (book) {
                case "DB1":
                    areas[i][x] = getPageVol1(rollDice(100));
                    break;
                case "DB2":
                    areas[i][x] = getPageVol2(rollDice(100));
                    break;
                case "LBD":
                    areas[i][x] = getLittleBook(rollDice(100));
                    break;
                default:
                    areas[i][x] = book
                    break;
            }
            areas[i][x]= areas[i][x].split(',');
        }
    }
    return areas;
}

function getNumberOfAreas(d20) {
    ret = 0;
    switch (true) {
        case (d20 <= 3):
            ret = 1;
            break;
        case (d20 <= 8):
            ret = 2;
            break;
        case (d20 <= 12):
            ret = 3;
            break;
        case (d20 <= 14):
            ret = 4;
            break;
        case (d20 == 15):
            ret = 5;
            break;
        case (d20 == 16):
            ret = 6;
            break;
        case (d20 == 17):
            ret = 7;
            break;
        case (d20 == 18):
            ret = 8;
            break;
        case (d20 == 19):
            ret = 9;
            break;
        case (d20 == 20):
            ret = 10;
            break;
    }
    return ret;
}

/**
 * D4 - Dungeon Books Set
 * D6 - Dungeon Books Set and a Little Book
 * D8 - 2 Dungeon Books Sets
 * D10 - 2 Dungeon Books Sets and a Little Book
 * D12 - Using the Digital VTT Tiles
 * @param {int} d12 
 */
function getAreaSize(d12) {
    ret = 0;
    switch (true) {
        case (d12 <= 2):
            ret = 1;
            break;
        case (d12 <= 4):
            ret = 2;
            break;
        case (d12 <= 6):
            ret = 3;
            break;
        case (d12 <= 8):
            ret = 4;
            break;
        case (d12 <= 10):
            ret = 5;
            break;
        case (d12 == 11):
            ret = 6;
            break;
        case (d12 == 12):
            ret = 7;
            break;
    }
    return ret;
}

/**
 * D8 - Dungeon Books Set
 * D10 - Dungeon Books Sets and a Little Book
 * D10 - Using the Digital VTT Tiles
 * @param {*} d10 
 */
function getPageTileTable(d10) {
    ret = "";
    switch (true) {
        case (d10 <= 4):
            ret = "DB1";
            break;
        case (d10 <= 8):
            ret = "DB2";
            break;
        case (d10 <= 10):
            ret = "LBD";
            break;
    }
    return ret;
}

function getPageVol1(d100) {
    ret = "";
    switch (true) {
        case (d100 <= 1):
            ret = "DB1-P3-L";
            break;
        case (d100 <= 2):
            ret = "DB1-P4-R";
            break;
        case (d100 <= 4):
            ret = "DB1-P3-L,DB1-P4-R";
            break;
        case (d100 <= 5):
            ret = "DB1-P5-L";
            break;
        case (d100 <= 6):
            ret = "DB1-P6-R";
            break;
        case (d100 <= 9):
            ret = "DB1-P5-L,DB1-P6-R";
            break;
        case (d100 <= 10):
            ret = "DB1-P7-L";
            break;
        case (d100 <= 11):
            ret = "DB1-P8-R";
            break;
        case (d100 <= 14):
            ret = "DB1-P7-L,DB1-P8-R";
            break;
        case (d100 <= 15):
            ret = "DB1-P9-L";
            break;
        case (d100 <= 16):
            ret = "DB1-P10-R";
            break;
        case (d100 <= 19):
            ret = "DB1-P9-L,DB1-P10-R";
            break;
        case (d100 <= 20):
            ret = "DB1-P11-L";
            break;
        case (d100 <= 21):
            ret = "DB1-P12-R";
            break;
        case (d100 <= 24):
            ret = "DB1-P11-L,DB1-P12-R";
            break;
        case (d100 <= 25):
            ret = "DB1-P13-L";
            break;
        case (d100 <= 26):
            ret = "DB1-P14-R";
            break;
        case (d100 <= 30):
            ret = "DB1-P13-L,DB1-P14-R";
            break;
        case (d100 <= 31):
            ret = "DB1-P15-L";
            break;
        case (d100 <= 32):
            ret = "DB1-P16-R";
            break;
        case (d100 <= 36):
            ret = "DB1-P15-L,DB1-P16-R";
            break;
        case (d100 <= 37):
            ret = "DB1-P17-L";
            break;
        case (d100 <= 38):
            ret = "DB1-P18-R";
            break;
        case (d100 <= 42):
            ret = "DB1-P17-L,DB1-P18-R";
            break;
        case (d100 <= 43):
            ret = "DB1-P19-L";
            break;
        case (d100 <= 44):
            ret = "DB1-P20-R";
            break;
        case (d100 <= 48):
            ret = "DB1-P19-L,DB1-P20-R";
            break;
        case (d100 <= 49):
            ret = "DB1-P21-L";
            break;
        case (d100 <= 50):
            ret = "DB1-P22-R";
            break;
        case (d100 <= 54):
            ret = "DB1-P21-L,DB1-P22-R";
            break;
        case (d100 <= 55):
            ret = "DB1-P23-L";
            break;
        case (d100 <= 56):
            ret = "DB1-P24-R";
            break;
        case (d100 <= 60):
            ret = "DB1-P23-L,DB1-P24-R";
            break;
        case (d100 <= 61):
            ret = "DB1-P25-L";
            break;
        case (d100 <= 62):
            ret = "DB1-P26-R";
            break;
        case (d100 <= 66):
            ret = "DB1-P25-L,DB1-P26-R";
            break;
        case (d100 <= 67):
            ret = "DB1-P27-L";
            break;
        case (d100 <= 68):
            ret = "DB1-P28-R";
            break;
        case (d100 <= 71):
            ret = "DB1-P27-L,DB1-P28-R";
            break;
        case (d100 <= 72):
            ret = "DB1-P29-L";
            break;
        case (d100 <= 73):
            ret = "DB1-P30-R";
            break;
        case (d100 <= 76):
            ret = "DB1-P29-L,DB1-P30-R";
            break;
        case (d100 <= 77):
            ret = "DB1-P31-L";
            break;
        case (d100 <= 78):
            ret = "DB1-P32-R";
            break;
        case (d100 <= 81):
            ret = "DB1-P31-L,DB1-P32-R";
            break;
        case (d100 <= 82):
            ret = "DB1-P33-L";
            break;
        case (d100 <= 83):
            ret = "DB1-P34-R";
            break;
        case (d100 <= 86):
            ret = "DB1-P33-L,DB1-P34-R";
            break;
        case (d100 <= 87):
            ret = "DB1-P35-L";
            break;
        case (d100 <= 88):
            ret = "DB1-P36-R";
            break;
        case (d100 <= 91):
            ret = "DB1-P35-L,DB1-P36-R";
            break;
        case (d100 <= 92):
            ret = "DB1-P37-L";
            break;
        case (d100 <= 93):
            ret = "DB1-P38-R";
            break;
        case (d100 <= 96):
            ret = "DB1-P37-L,DB1-P38-R";
            break;
        case (d100 <= 97):
            ret = "DB1-P39-L";
            break;
        case (d100 <= 98):
            ret = "DB1-P40-R";
            break;
        case (d100 <= 100):
            ret = "DB1-P39-L,DB1-P40-R";
            break;
    }
    return ret;
}

function getPageVol2(d100) {
    ret = "";
    switch (true) {
        case (d100 <= 1):
            ret = "DB2-P3-L";
            break;
        case (d100 <= 2):
            ret = "DB2-P4-R";
            break;
        case (d100 <= 4):
            ret = "DB2-P3-L,DB2-P4-R";
            break;
        case (d100 <= 5):
            ret = "DB2-P5-L";
            break;
        case (d100 <= 6):
            ret = "DB2-P6-R";
            break;
        case (d100 <= 9):
            ret = "DB2-P5-L,DB2-P6-R";
            break;
        case (d100 <= 10):
            ret = "DB2-P7-L";
            break;
        case (d100 <= 11):
            ret = "DB2-P8-R";
            break;
        case (d100 <= 14):
            ret = "DB2-P7-L,DB2-P8-R";
            break;
        case (d100 <= 15):
            ret = "DB2-P9-L";
            break;
        case (d100 <= 16):
            ret = "DB2-P10-R";
            break;
        case (d100 <= 19):
            ret = "DB2-P9-L,DB2-P10-R";
            break;
        case (d100 <= 20):
            ret = "DB2-P11-L";
            break;
        case (d100 <= 21):
            ret = "DB2-P12-R";
            break;
        case (d100 <= 24):
            ret = "DB2-P11-L,DB2-P12-R";
            break;
        case (d100 <= 25):
            ret = "DB2-P13-L";
            break;
        case (d100 <= 26):
            ret = "DB2-P14-R";
            break;
        case (d100 <= 30):
            ret = "DB2-P13-L,DB2-P14-R";
            break;
        case (d100 <= 31):
            ret = "DB2-P15-L";
            break;
        case (d100 <= 32):
            ret = "DB2-P16-R";
            break;
        case (d100 <= 36):
            ret = "DB2-P15-L,DB2-P16-R";
            break;
        case (d100 <= 37):
            ret = "DB2-P17-L";
            break;
        case (d100 <= 38):
            ret = "DB2-P18-R";
            break;
        case (d100 <= 42):
            ret = "DB2-P17-L,DB2-P18-R";
            break;
        case (d100 <= 43):
            ret = "DB2-P19-L";
            break;
        case (d100 <= 44):
            ret = "DB2-P20-R";
            break;
        case (d100 <= 48):
            ret = "DB2-P19-L,DB2-P20-R";
            break;
        case (d100 <= 49):
            ret = "DB2-P21-L";
            break;
        case (d100 <= 50):
            ret = "DB2-P22-R";
            break;
        case (d100 <= 54):
            ret = "DB2-P21-L,DB2-P22-R";
            break;
        case (d100 <= 55):
            ret = "DB2-P23-L";
            break;
        case (d100 <= 56):
            ret = "DB2-P24-R";
            break;
        case (d100 <= 60):
            ret = "DB2-P23-L,DB2-P24-R";
            break;
        case (d100 <= 61):
            ret = "DB2-P25-L";
            break;
        case (d100 <= 62):
            ret = "DB2-P26-R";
            break;
        case (d100 <= 66):
            ret = "DB2-P25-L,DB2-P26-R";
            break;
        case (d100 <= 67):
            ret = "DB2-P27-L";
            break;
        case (d100 <= 68):
            ret = "DB2-P28-R";
            break;
        case (d100 <= 71):
            ret = "DB2-P27-L,DB2-P28-R";
            break;
        case (d100 <= 72):
            ret = "DB2-P29-L";
            break;
        case (d100 <= 73):
            ret = "DB2-P30-R";
            break;
        case (d100 <= 76):
            ret = "DB2-P29-L,DB2-P30-R";
            break;
        case (d100 <= 77):
            ret = "DB2-P31-L";
            break;
        case (d100 <= 78):
            ret = "DB2-P32-R";
            break;
        case (d100 <= 81):
            ret = "DB2-P31-L,DB2-P32-R";
            break;
        case (d100 <= 82):
            ret = "DB2-P33-L";
            break;
        case (d100 <= 83):
            ret = "DB2-P34-R";
            break;
        case (d100 <= 86):
            ret = "DB2-P33-L,DB2-P34-R";
            break;
        case (d100 <= 87):
            ret = "DB2-P35-L";
            break;
        case (d100 <= 88):
            ret = "DB2-P36-R";
            break;
        case (d100 <= 91):
            ret = "DB2-P35-L,DB2-P36-R";
            break;
        case (d100 <= 92):
            ret = "DB2-P37-L";
            break;
        case (d100 <= 93):
            ret = "DB2-P38-R";
            break;
        case (d100 <= 96):
            ret = "DB2-P37-L,DB2-P38-R";
            break;
        case (d100 <= 97):
            ret = "DB2-P39-L";
            break;
        case (d100 <= 98):
            ret = "DB2-P40-R";
            break;
        case (d100 <= 100):
            ret = "DB2-P39-L,DB2-P40-R";
            break;
    }
    return ret;
}

function getLittleBook(d100) {
    ret = "";
    switch (true) {
        case (d100 <= 1):
            ret = "LBD-P3-L";
            break;
        case (d100 <= 2):
            ret = "LBD-P4-R";
            break;
        case (d100 <= 4):
            ret = "LBD-P3-L,LBD-P4-R";
            break;
        case (d100 <= 5):
            ret = "LBD-P5-L";
            break;
        case (d100 <= 6):
            ret = "LBD-P6-R";
            break;
        case (d100 <= 9):
            ret = "LBD-P5-L,LBD-P6-R";
            break;
        case (d100 <= 10):
            ret = "LBD-P7-L";
            break;
        case (d100 <= 11):
            ret = "LBD-P8-R";
            break;
        case (d100 <= 14):
            ret = "LBD-P7-L,LBD-P8-R";
            break;
        case (d100 <= 15):
            ret = "LBD-P9-L";
            break;
        case (d100 <= 16):
            ret = "LBD-P10-R";
            break;
        case (d100 <= 19):
            ret = "LBD-P9-L,LBD-P10-R";
            break;
        case (d100 <= 20):
            ret = "LBD-P11-L";
            break;
        case (d100 <= 21):
            ret = "LBD-P12-R";
            break;
        case (d100 <= 24):
            ret = "LBD-P11-L,LBD-P12-R";
            break;
        case (d100 <= 25):
            ret = "LBD-P13-L";
            break;
        case (d100 <= 26):
            ret = "LBD-P14-R";
            break;
        case (d100 <= 30):
            ret = "LBD-P13-L,LBD-P14-R";
            break;
        case (d100 <= 31):
            ret = "LBD-P15-L";
            break;
        case (d100 <= 32):
            ret = "LBD-P16-R";
            break;
        case (d100 <= 36):
            ret = "LBD-P15-L,LBD-P16-R";
            break;
        case (d100 <= 37):
            ret = "LBD-P17-L";
            break;
        case (d100 <= 38):
            ret = "LBD-P18-R";
            break;
        case (d100 <= 42):
            ret = "LBD-P17-L,LBD-P18-R";
            break;
        case (d100 <= 43):
            ret = "LBD-P19-L";
            break;
        case (d100 <= 44):
            ret = "LBD-P20-R";
            break;
        case (d100 <= 48):
            ret = "LBD-P19-L,LBD-P20-R";
            break;
        case (d100 <= 49):
            ret = "LBD-P21-L";
            break;
        case (d100 <= 50):
            ret = "LBD-P22-R";
            break;
        case (d100 <= 54):
            ret = "LBD-P21-L,LBD-P22-R";
            break;
        case (d100 <= 55):
            ret = "LBD-P23-L";
            break;
        case (d100 <= 56):
            ret = "LBD-P24-R";
            break;
        case (d100 <= 60):
            ret = "LBD-P23-L,LBD-P24-R";
            break;
        case (d100 <= 61):
            ret = "LBD-P25-L";
            break;
        case (d100 <= 62):
            ret = "LBD-P26-R";
            break;
        case (d100 <= 66):
            ret = "LBD-P25-L,LBD-P26-R";
            break;
        case (d100 <= 67):
            ret = "LBD-P27-L";
            break;
        case (d100 <= 68):
            ret = "LBD-P28-R";
            break;
        case (d100 <= 71):
            ret = "LBD-P27-L,LBD-P28-R";
            break;
        case (d100 <= 72):
            ret = "LBD-P29-L";
            break;
        case (d100 <= 73):
            ret = "LBD-P30-R";
            break;
        case (d100 <= 76):
            ret = "LBD-P29-L,LBD-P30-R";
            break;
        case (d100 <= 77):
            ret = "LBD-P31-L";
            break;
        case (d100 <= 78):
            ret = "LBD-P32-R";
            break;
        case (d100 <= 81):
            ret = "LBD-P31-L,LBD-P32-R";
            break;
        case (d100 <= 82):
            ret = "LBD-P33-L";
            break;
        case (d100 <= 83):
            ret = "LBD-P34-R";
            break;
        case (d100 <= 86):
            ret = "LBD-P33-L,LBD-P34-R";
            break;
        case (d100 <= 87):
            ret = "LBD-P35-L";
            break;
        case (d100 <= 88):
            ret = "LBD-P36-R";
            break;
        case (d100 <= 91):
            ret = "LBD-P35-L,LBD-P36-R";
            break;
        case (d100 <= 92):
            ret = "LBD-P37-L";
            break;
        case (d100 <= 93):
            ret = "LBD-P38-R";
            break;
        case (d100 <= 96):
            ret = "LBD-P37-L,LBD-P38-R";
            break;
        case (d100 <= 97):
            ret = "LBD-P39-L";
            break;
        case (d100 <= 98):
            ret = "LBD-P40-R";
            break;
        case (d100 <= 100):
            ret = "LBD-P39-L,LBD-P40-R";
            break;

    }
    return ret;

}
