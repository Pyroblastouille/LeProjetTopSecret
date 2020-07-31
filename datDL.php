<?php
require_once('./_func/func.inc.php');
$purity = filter_input(INPUT_GET,'purity');
$tag = filter_input(INPUT_GET,'tag');
$randoms = getSomeRandomTagged($purity,$tag);
?>



<body onclick="interval()" style="cursor:grab;background-color: black;  background-position-x: center; background-repeat: no-repeat; background-size: contain; background-image:url('<?=$randoms[0]->path?>'), url('<?=$randoms[0]->thumbs->original?>');">


<script>
    var codes = [<?php
    $str = "";
    foreach ($randoms as $value) {
        $str .= "['".$value->path."','".$value->thumbs->original."'],";
    }
    echo rtrim($str,',');
    ?>]

fetch("./_func/dl.php", {
        method: "POST",
        body: JSON.stringify(codes)
      }).then(resp => resp.text()).then(function(res){
          console.log("Resultat : "+res);
          canReload = true;
      });

      var interv = setTimeout(interval,4000);
    var i = 0;
    var reload=false;
    var canReload = false;
    function interval(){
        clearTimeout(interv);
        if(reload & canReload){
            window.location=window.location;
        }
        document.body.style.backgroundImage = "url("+codes[i][0]+"),url("+codes[i][1]+")";
        i++;
        if (i >= codes.length){
            i = 0;
            reload = true;
        }
        interv = setTimeout(interval,4000);
    }
</script>

</body>
