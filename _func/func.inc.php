<?php
session_start();


function exists(string $file)
{
    $file_headers = @get_headers($file);
    return !(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found');
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
function getRandomGif(){
    $url = "https://api.giphy.com/v1/gifs/random?api_key=4ZX1wXV0QB5LGOCHxcEa68f5TJb0zvvb&tag=&rating=G";
    $json = file_get_contents($url);
    $obj = json_decode($json);
    return $obj->data->images->original->url;
}

function getRandomPornGIF()
{
    $files = glob('../_img/*.gif');
    $ret = $files[rand(0, count($files) - 1)];
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
