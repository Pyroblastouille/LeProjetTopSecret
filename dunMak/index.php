<?php
require_once('../_func/func.inc.php');
require_once('dndLayout.func.php');


if (!isset($_SESSION['logged'])) {
    $imgUrl = "";
} else {
    $imgUrl = getRandomTrans();
}
$damage = filter_input(INPUT_GET, 'damage');
$difficulty = filter_input(INPUT_GET, 'difficulty');
$enemyType = filter_input(INPUT_GET, 'enemyType');
$groupSize = filter_input(INPUT_GET, 'groupSize');
$NPCType = filter_input(INPUT_GET, 'NPCType');

$layout = createLayout();
$layoutJson = json_encode($layout);

?>

<style href="http://pyroblastouille.site/LeProjetTopSecret/_css/dungeonMaker.css" ></style>
<style>
    img {
        position: absolute;
        width: 128px;
        height: 128px;
    }

    img.small {
        width: 64px;
        height: 64px;
    }
</style>
<table>
    <tr>
        <th>Map</th>
        <td>Area <input oninput="changeMap()" type="number" min="1" max="1" id="actualArea" value="1">/<span id="total">0</span></td>
    </tr>
    <tr>
        <td colspan="2" id="map"></td>
    </tr>
</table>


<script src="data/func.js"></script>
<script src="data/layout.js"></script>
<script src="data/plot.js"></script>
<script src="data/whoHere.js"></script>
<script>
    //What's the plot
    var plotHook, location, variation, backstory;

    //Who lives here
    var boss, lair;
    var areaId = 0;

    //layout
    var layout;
    validateChoice();

    function validateChoice() {
        layout = JSON.parse('<?= $layoutJson ?>');
        total.innerHTML = layout.length;
        actualArea.max = layout.length;
        console.log(layout);
        changeMap();
    }

    function changeMap() {
        let val = actualArea.value

        var drawedMap = "";
        let posXMin = 0,
            posYMin = 0;
        layout[actualArea.value - 1].forEach(element => {
            if (element.position[0] < posXMin) {
                posXMin = element.position[0];
            }
            if (element.position[1] < posYMin) {
                posYMin = element.position[1];
            }
        });

        layout[actualArea.value - 1].forEach(arrayArea => {
            let left = (posXMin + arrayArea.position[0]) * 128 / 12;
            let top = (posYMin + arrayArea.position[1]) * 128 / 12;
            arrayArea.pages.forEach(el => {
                if (el.includes("LBD")) {
                    drawedMap += '<img style="transform:translate(' + left + 'px,' + top + 'px);" class="small" src="tiles/' + el + '.jpg" alt="' + el + '"/>';
                    left += 64;
                } else {
                    drawedMap += '<img style="transform:translate(' + left + 'px,' + top + 'px);" src="tiles/' + el + '.jpg" alt="' + el + '"/>';
                    left += 128;
                }
            });
        });

        map.innerHTML = drawedMap;
    }
</script>