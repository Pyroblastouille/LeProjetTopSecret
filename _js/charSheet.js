$('.stat').bind('input', changeBonuses)
$('.profCheck').bind('change', changeBonuses);
$('.nomPerso').bind('input', function () {
    $('.nomPerso').val($(this).val());
})

var total = 0;
//Event when add a level in class
$("[name='classlevel']").bind('input', changeBonuses);


const WEIGHT_PER_FORCE = 5;

let jsonFiles = "";

function parseNewInt(val) {
    let ret = parseInt(val);
    if (isNaN(ret)) {
        return 0;
    }
    return ret;
}

function parseNewFloat(val) {
    let ret = parseFloat(val);
    if (isNaN(ret)) {
        return 0.0;
    }
    return ret;
}

function changeBonuses() {
    changeMastery();
    let arrayMod = ['Forcescore', 'Dextéritéscore', 'Constitutionscore', 'Intelligencescore', 'Sagessescore', 'Charismescore'];

    arrayMod.forEach(inputName => {
        let carac = $('[name=' + inputName + ']');
        if (carac.val() != "") {

            //Get normal bonus
            let modNum = parseInt(carac.val()) - 10
            if (modNum % 2 == 0)
                modNum = modNum / 2
            else
                modNum = (modNum - 1) / 2
            modTag = modNum
            if (isNaN(modNum))
                modTag = ""
            else if (modNum >= 0)
                modTag = "+" + modNum

            if (inputName == "Sagessescore") {
                $(".sagPass").val(10 + modNum);
            }
            //Get proficiency bonus
            let prof = $("[name=proficiencybonus]").val();
            if (prof[0] == "+") {
                prof = prof.slice(1);
            }
            prof = parseInt(prof);
            let profNum = prof + modNum;
            let profMod = profNum;
            if (isNaN(profNum))
                profMod = ""
            else if (profMod >= 0)
                profMod = "+" + profNum

            //Extract the name of carac
            let scoreName = inputName.slice(0, inputName.indexOf("score"))

            //show the standard modificator
            let modName = scoreName + "mod"
            $("[name=" + modName + "]").val(modTag);

            //change for the saving throws
            let savingThrowName = scoreName + "-save"
            let isProficientSavingThrow = $('[name=' + scoreName + '-save-prof]')[0].checked;
            let savingThrow = $("[name=" + savingThrowName + "]").val(isProficientSavingThrow ? profMod : modTag);

            //Make change for the skills
            let childs = $('.' + savingThrow[0].className.split(' ')[0]);
            for (let i = 0; i < childs.length; i++) {
                const ch = childs[i];
                let isProficientChild = $('[name=' + ch.name + '-prof]');
                if (isProficientChild.is(':checked')) {
                    if (ch.name == "Perception") {
                        console.log("non");
                        $(".sagPass").val(10 + profNum);
                    }
                    ch.value = profMod;
                } else {
                    ch.value = modTag;
                }
            }

            $(".initiative").val($(".DEX").val());
        }
    });
}

function exportObj() {
    let soonJSON = {
        "nomPerso": $(".nomPerso").val(),
        "nomJoueur": $(".nomJoueur").val(),

        "FORscore": $(".FORscore").val(),
        "DEXscore": $(".DEXscore").val(),
        "CONscore": $(".CONscore").val(),
        "INTscore": $(".INTscore").val(),
        "SAGscore": $(".SAGscore").val(),
        "CHAscore": $(".CHAscore").val(),

        "classeEtNiveau": $(".classeEtNiveau").val(),
        "deDeVie": $(".deDeVie").val(),
        "race": $(".race").val(),

        "historique": $(".historique").val(),
        "TraitPersonalite": $(".TraitPersonalite").val(),
        "Ideaux": $(".Ideaux").val(),
        "Liens": $(".Liens").val(),
        "defauts": $(".defauts").val(),

        "alignement": $(".alignement").val(),

        "ac": $(".ac").val(),
        "speed": $("[name=speed]").val(),
        "pvMax": $(".pvMax").val(),
        "inspiration": $(".inspiration").val(),
        "traits": $(".traits").val(),

        "arme1": {
            "nom": $(".arme1Nom").val(),
            "atk": $(".arme1Atk").val(),
            "deg": $(".arme1Deg").val()
        },
        "arme2": {
            "nom": $(".arme2Nom").val(),
            "atk": $(".arme2Atk").val(),
            "deg": $(".arme2Deg").val()
        },
        "arme3": {
            "nom": $(".arme3Nom").val(),
            "atk": $(".arme3Atk").val(),
            "deg": $(".arme3Deg").val()
        },
        "weaponTextArea": $(".weaponTextArea").val(),

        "proficiencies": $("[name=proficiencies]").val(),

        "skillsProf": [],
        "saveProf": [],

        "equipmentTextArea": $(".equipmentTextArea").val(),
        "pc": $(".pc").val(),
        "pa": $(".pa").val(),
        "pe": $(".pe").val(),
        "po": $(".po").val(),
        "pp": $(".pp").val(),
        "xp": $(".xp").val(),

        "apparence": $("[name=apparence]").val(),
        "histoire": $("[name=histoire]").val(),
        "allies": $("[name=allies]").val(),
        "traitsSup": $("[name=traitsSup]").val(),
        "tresor": $("[name=tresor]").val(),

        "age": $("[name=age]").val(),
        "yeux": $("[name=yeux]").val(),
        "taille": $("[name=taille]").val(),
        "poids": $("[name=poids]").val(),
        "cheveux": $("[name=cheveux]").val(),
        "peau": $("[name=peau]").val(),
        "caracIncantation": $("[name=caracIncantation]").val(),
        "ddSauvegardeSort": $("[name=ddSauvegardeSort]").val(),
        "bonusAttaqueSort": $("[name=bonusAttaqueSort]").val(),
        "sorts": {
            "lvl0": $("[name=sort-0]").val(),
            "lvl1": $("[name=sort-1]").val(),
            "lvl2": $("[name=sort-2]").val(),
            "lvl3": $("[name=sort-3]").val(),
            "lvl4": $("[name=sort-4]").val(),
            "lvl5": $("[name=sort-5]").val(),
            "lvl6": $("[name=sort-6]").val(),
            "lvl7": $("[name=sort-7]").val(),
            "lvl8": $("[name=sort-8]").val(),
            "lvl9": $("[name=sort-9]").val()
        }
    };
    let arrayScoreMod = ['Force', 'Dextérité', 'Constitution', 'Intelligence', 'Sagesse', 'Charisme'];
    arrayScoreMod.forEach(el => {
        let isProficientSavingThrow = $('[name=' + el + '-save-prof]').is(':checked');
        if (isProficientSavingThrow) {
            soonJSON.saveProf.push(el);
        }
    });
    let arraySkills = ["Acrobaties", "Arcanes", "Athlétisme", "Discrétion", "Dressage", "Escamotage", "Histoire", "Intimidation", "Investigation", "Médecine", "Nature", "Perception", "Perspicacité", "Persuasion", "Religion", "Représentation", "Survie", "Supercherie"]
    arraySkills.forEach(el => {

        let isProficientSavingThrow = $('.' + el + "-prof").is(':checked');
        if (isProficientSavingThrow) {
            soonJSON.skillsProf.push(el);
        }
    })
    return soonJSON;
}

function importJSON(filename) {
    $.getJSON(filename, function (json) {
        let bonusSAGPASS = false;
        let SAGPassive = Math.floor((parseNewInt(json.SAGscore) - 10) / 2) + 10;


        $(".nomPerso").val(json.nomPerso);
        $(".nomJoueur").val(json.nomJoueur);

        $(".FORscore").val(json.FORscore);
        $(".DEXscore").val(json.DEXscore);
        $(".CONscore").val(json.CONscore);
        $(".INTscore").val(json.INTscore);
        $(".SAGscore").val(json.SAGscore);
        $(".CHAscore").val(json.CHAscore);

        $(".classeEtNiveau").val(json.classeEtNiveau);
        $(".deDeVie").val(json.deDeVie);
        $(".race").val(json.race);

        $(".historique").val(json.historique);
        $(".TraitPersonalite").val(json.TraitPersonalite);
        $(".Ideaux").val(json.Ideaux);
        $(".Liens").val(json.Liens);
        $(".defauts").val(json.defauts);

        $(".alignement").val(json.alignement);

        $(".ac").val(json.ac);
        $(".speed").val(json.speed);
        $(".pvMax").val(json.pvMax);
        $(".inspiration").val(json.inspiration);
        $(".traits").val(json.traits);
        $(".arme1Nom").val(json.arme1.nom);
        $(".arme1Atk").val(json.arme1.atk);
        $(".arme1Deg").val(json.arme1.deg);
        $(".arme2Nom").val(json.arme2.nom);
        $(".arme2Atk").val(json.arme2.atk);
        $(".arme2Deg").val(json.arme2.deg);
        $(".arme3Nom").val(json.arme3.nom);
        $(".arme3Atk").val(json.arme3.atk);
        $(".arme3Deg").val(json.arme3.deg);
        $(".weaponTextArea").val(json.weaponTextArea);

        $(".proficiencies").val(json.proficiencies);

        json.skillsProf.forEach(el => {
            if (el == "Perception") { bonusSAGPASS = true; }

            $('.' + el + '-prof').prop("checked", true);
        });
        json.saveProf.forEach(el => {
            $('[name=' + el + '-save-prof]').prop("checked", true);
        });

        $(".equipmentTextArea").val(json.equipmentTextArea);
        $(".pc").val(json.pc);
        $(".pa").val(json.pa);
        $(".pe").val(json.pe);
        $(".po").val(json.po);
        $(".pp").val(json.pp);
        $(".xp").val(json.xp);

        changeMastery();

        if (bonusSAGPASS) {
            let bonusMait = $('.bonusMaitrise').val();
            if (bonusMait[0] == "+") {
                bonusMait = bonusMait.slice(1);
            }
            bonusMait = parseNewInt(bonusMait);
            SAGPassive += bonusMait;
        }
        $(".sagPass").val(SAGPassive);


        $("[name=apparence]").val(json.apparence);
        $("[name=histoire]").val(json.histoire);
        $("[name=allies]").val(json.allies);
        $("[name=traitsSup]").val(json.traitsSup);
        $("[name=tresor]").val(json.tresor);
        $("[name=age]").val(json.age);
        $("[name=yeux]").val(json.yeux);
        $("[name=taille]").val(json.taille);
        $("[name=poids]").val(json.poids);
        $("[name=cheveux]").val(json.cheveux);
        $("[name=peau]").val(json.peau);
        $("[name=caracIncantation]").val(json.caracIncantation);

        $(".caracIncantation").val(json.caracIncantation);
        $(".bonusAttaqueSort").val(json.bonusAttaqueSort);
        $(".ddSauvegardeSort").val(json.ddSauvegardeSort);
        if (json.sorts != undefined) {
            $(".sort-0").val(json.sorts.lvl0);
            $(".sort-1").val(json.sorts.lvl1);
            $(".sort-2").val(json.sorts.lvl2);
            $(".sort-3").val(json.sorts.lvl3);
            $(".sort-4").val(json.sorts.lvl4);
            $(".sort-5").val(json.sorts.lvl5);
            $(".sort-6").val(json.sorts.lvl6);
            $(".sort-7").val(json.sorts.lvl7);
            $(".sort-8").val(json.sorts.lvl8);
            $(".sort-9").val(json.sorts.lvl9);
        }
    });
}


function changeMastery() {
    let classes = $(".classeEtNiveau").val()
    let r = new RegExp(/\d+/g)
    total = 0
    let result
    while ((result = r.exec(classes)) != null) {
        let lvl = parseInt(result)
        if (!isNaN(lvl))
            total += lvl
    }
    $(".totalDe").val(total);
    let prof = 2
    if (total > 0) {
        total -= 1
        prof += Math.trunc(total / 4)
        prof = "+" + prof
    } else {
        prof = ""
    }
    $("[name='proficiencybonus']").val(prof)
}