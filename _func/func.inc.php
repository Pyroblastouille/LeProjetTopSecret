<?php
session_start();

function random_text($length)
{
    $rand = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, $length);
    return $rand;
}

function exists(string $file)
{
    $file_headers = @get_headers($file);
    return !(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found');
}

function dlImgs($urls)
{
    $fp = fopen('dt.txt', 'a+');
    $tot = count($urls);
    $cpt = 0;
    fwrite($fp, "download of $tot elements\r\n");
    foreach ($urls as $url) {
        $cpt++;
        $fileDest = './imgOk/' . end(explode('/', $url));
        $contents = file_get_contents($url);
        if (!exists($fileDest)  || filesize($fileDest) == 0) {
            file_put_contents($fileDest, $contents);
            fwrite($fp, "$cpt/$tot downloaded $url\r\n");
        } else {
            fwrite($fp, "$cpt/$tot skip download of $url\r\n");
        }
    }
    fclose($fp);
}

function dlPornGIF()
{
    $url = "http://porngif.top/";
    $source = file_get_contents($url);
    if (!$source) {
        throw new Exception("Error, url non atteignable \"$url\"", 1);
    }

    $sources = explode('class="hide big" src="', $source);
    for ($j = 1; $j < count($sources); $j++) {
        $source = $sources[$j];
        $i = 0;
        while (substr($source, $i, 1) != '"') {
            $i++;
            if ($i > 280) {
                break;
            }
        }
        $filePath = $url . substr($source, 0, $i);
        $filePath = str_replace(' ', '%20', $filePath);
        $simpleText = explode('/', $filePath);
        $simpleText = $simpleText[count($simpleText) - 1];
        $fileDest = '../_img/' . $simpleText;
        if (!exists($fileDest) || filesize($fileDest) == 0) {
            $fileContent =  file_get_contents($filePath);
            if ($fileContent != false) {
                file_put_contents($fileDest, $fileContent);
            }
        }
    }
}

function getRandomExistingImg()
{
    $files = glob('./imgOk/*.{jpg,png}', GLOB_BRACE);
    $ret = $files[rand(0, count($files) - 1)];
    return $ret;
}

/**
 * bill
 */
function getRandomGif()
{
    $url = "https://api.giphy.com/v1/gifs/random?api_key=4ZX1wXV0QB5LGOCHxcEa68f5TJb0zvvb&tag=&rating=G";
    $json = file_get_contents($url);
    $obj = json_decode($json);
    return $obj->data->images->original->url;
}

function getRandomPornGIF($local = false)
{
    if($local){
        $files = glob('../_img/*.gif');
        $ret = $files[rand(0, count($files) - 1)];
    }else{
        $fl = file_get_contents("https://gifmixxx.com/random");
        $part2 = explode('background-image: url(',$fl)[1];
        $ret = explode(')',$part2)[0];
    }
    
    return $ret;
}
/**
 * Wallhaven get images
 */

function getSomeRandom($purity = '111', $resolution = null)
{
    $url = "https://wallhaven.cc/api/v1/search?apikey=9rEpO1TbRmm4OAAvmyGZseOD4EZGjZEX&purity=$purity&sorting=random";
    if (!is_null($resolution)) {
        $url .= "&resolutions=$resolution";
    }
    $source = file_get_contents($url);
    if (!$source) {
        throw new Exception("Error, url non atteignable \"$url\"", 1);
    }
    $json = json_decode($source);
    return $json->data;
}
function getSomeRandomNSFW($resolution = null)
{
    return getSomeRandom('001', $resolution);
}
function getSomeRandomSketchy($resolution = null)
{
    return getSomeRandom('010', $resolution);
}
function getSomeRandomSFW($resolution = null)
{
    return getSomeRandom('100', $resolution);
}


function getSomeRandomTagged($purity = '111', $tag = null, $resolution = null)
{
    $url = "https://wallhaven.cc/api/v1/search?apikey=9rEpO1TbRmm4OAAvmyGZseOD4EZGjZEX&purity=$purity&sorting=random";
    if (!is_null($resolution)) {
        $url .= "&resolutions=$resolution";
    }
    if (!is_null($tag)) {
        $url .= "&q=$tag";
    }
    $source = file_get_contents($url);
    if (!$source) {
        throw new Exception("Error, url non atteignable \"$url\"", 1);
    }
    $json = json_decode($source);
    return $json->data;
}
function getRandomTrans()
{
    $url = "https://wallhaven.cc/api/v1/search?apikey=9rEpO1TbRmm4OAAvmyGZseOD4EZGjZEX&purity=011&page=1&sorting=random&q=id:18116";
    $source = file_get_contents($url);
    if (!$source) {
        throw new Exception("Error, url non atteignable \"$url\"", 1);
    }
    $json = json_decode($source);
    return $json->data[0];
}

function getRandom($purity = '111')
{
    $url = "https://wallhaven.cc/api/v1/search?apikey=9rEpO1TbRmm4OAAvmyGZseOD4EZGjZEX&purity=$purity&page=1&sorting=random";
    $source = file_get_contents($url);
    if (!$source) {
        throw new Exception("Error, url non atteignable \"$url\"", 1);
    }
    $json = json_decode($source);
    return $json->data[0];
}
function getRandomSFW()
{
    return getRandom('100');
}
function getRandomNSFW()
{
    return getRandom('001');
}
function getRandomSketchy()
{
    return getRandom('010');
}



function getLatest($purity = '111')
{
    $url = "https://wallhaven.cc/api/v1/search?apikey=9rEpO1TbRmm4OAAvmyGZseOD4EZGjZEX&purity=$purity&page=1";
    $source = file_get_contents($url);
    if (!$source) {
        throw new Exception("Error, url non atteignable \"$url\"", 1);
    }
    $json = json_decode($source);
    return $json->data[0];
}
function getLatestNSFW()
{
    return getLatest('001');
}
function getLatestSketchy()
{
    return getLatest('010');
}
function getLatestSFW()
{
    return getLatest('100');
}

function getRandomChubby()
{
    $url = "https://wallhaven.cc/api/v1/search?apikey=9rEpO1TbRmm4OAAvmyGZseOD4EZGjZEX&purity=011&page=1&sorting=random&q=id:5785";
    $source = file_get_contents($url);
    if (!$source) {
        throw new Exception("Error, url non atteignable \"$url\"", 1);
    }
    $json = json_decode($source);
    return $json->data[0];
}

function getRandomDnD()
{
    $url = "https://wallhaven.cc/api/v1/search?apikey=9rEpO1TbRmm4OAAvmyGZseOD4EZGjZEX&purity=111&page=1&sorting=random&q=id:34251";
    $source = file_get_contents($url);
    if (!$source) {
        throw new Exception("Error, url non atteignable \"$url\"", 1);
    }
    $json = json_decode($source);
    return $json->data[0];
}
function getRandomFantasyArtNSFW()
{
    $url = "https://wallhaven.cc/api/v1/search?apikey=9rEpO1TbRmm4OAAvmyGZseOD4EZGjZEX&purity=001&page=1&sorting=random&q=id:7820";
    $source = file_get_contents($url);
    if (!$source) {
        throw new Exception("Error, url non atteignable \"$url\"", 1);
    }
    $json = json_decode($source);
    return $json->data[0];
}

function getDndHandbookImage()
{
    $id = 'nzljro';

    $url = "https://wallhaven.cc/api/v1/w/$id?apikey=9rEpO1TbRmm4OAAvmyGZseOD4EZGjZEX";
    $source = file_get_contents($url);
    if (!$source) {
        throw new Exception("Error, url non atteignable \"$url\"", 1);
    }
    $json = json_decode($source);
    return $json->data;
}

function is_prof($element, $jsonArray)
{
    if (is_array($jsonArray) && in_array($element, $jsonArray)) {
        return "checked";
    } else {
        return "";
    }
}
