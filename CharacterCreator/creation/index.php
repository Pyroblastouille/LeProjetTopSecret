<?php
require_once('../../_func/func.inc.php');
$races = json_decode(file_get_contents("races.json"));
$classes = json_decode(file_get_contents("classes.json"));


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Création d'un personnage</title>
    <meta name="generator" content="hosting-page-builder">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="og:locale" content="fr">
    <meta name="og:type" content="website">
    <link rel="stylesheet" href="https://assets.storage.infomaniak.com/fonts/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open Sans">
    <link rel="stylesheet" type="text/css" href="../../_css/main.css" />
    <style>
        .page {
            background-position-x: center;
            background-repeat: no-repeat;
            background-size: contain;
        }

        form {
            margin: auto;
        }

        table {
            margin: auto;
        }
    </style>
</head>

<body>
    <div id="page" class="page  overlay-dark bg-position-middle">
        <div class="container">
            <div id="content">
                <form action="addChar.php" method="POST">
                    <div id="step1">
                        <h1>Classe et Race</h1>
                        <div>
                            <input type="text" id="charName" placeholder="Nom du personnage">
                            <select name="classe" id="classe"></select>
                            <select name="race" id="race"></select>
                        </div>
                        <div>
                            <input type="button" value="Valider" onclick="switchToStep2();" />
                        </div>
                    </div>
                    <div id="step2" hidden>
                        <h1>Caractéristiques</h1>
                        <div>
                            <table>
                                <tr>
                                    <th>Carac.</th>
                                    <th>Val.</th>
                                    <th>Race</th>
                                    <th>Tot</th>
                                </tr>
                                <tr>
                                    <th>Force</th>
                                    <td><input type="number" min="8" max="15" value="8" oninput="updatePoints(this)" name="FOR" id="InputFOR" /></td>
                                    <td id="bonusFOR"></td>
                                    <td id="totFOR"></td>
                                </tr>
                                <tr>
                                    <th>Dextérité</th>
                                    <td><input type="number" min="8" max="15" value="8" oninput="updatePoints(this)" name="DEX" id="InputDEX" /></td>
                                    <td id="bonusDEX"></td>
                                    <td id="totDEX"></td>
                                </tr>
                                <tr>
                                    <th>Constitution</th>
                                    <td><input type="number" min="8" max="15" value="8" oninput="updatePoints(this)" name="CON" id="InputCON" /></td>
                                    <td id="bonusCON"></td>
                                    <td id="totCON"></td>
                                </tr>
                                <tr>
                                    <th>Intelligence</th>
                                    <td><input type="number" min="8" max="15" value="8" oninput="updatePoints(this)" name="INT" id="InputINT" /></td>
                                    <td id="bonusINT"></td>
                                    <td id="totINT"></td>
                                </tr>
                                <tr>
                                    <th>Sagesse</th>
                                    <td><input type="number" min="8" max="15" value="8" oninput="updatePoints(this)" name="SAG" id="InputSAG" /></td>
                                    <td id="bonusSAG"></td>
                                    <td id="totSAG"></td>
                                </tr>
                                <tr>
                                    <th>Charisme</th>
                                    <td><input type="number" min="8" max="15" value="8" oninput="updatePoints(this)" name="CHA" id="InputCHA" /></td>
                                    <td id="bonusCHA"></td>
                                    <td id="totCHA"></td>
                                </tr>
                                <tr>
                                    <td colspan="4">points restants : <span id="remaining">27</span></td>
                                </tr>
                            </table>
                        </div>
                        <div>
                            <input type="button" value="Valider" onclick="switchToStep3();" />
                        </div>
                    </div>

                    <div id="step3" hidden>
                        <h1>Historique</h1>
                        <div>
                            <select name="historique" id="historique"></select>
                        </div>
                        <div>
                            <input type="button" value="Valider" onclick="switchToStep4();" />
                        </div>
                    </div>
                    <div id="step4" hidden>
                        <h1>Choix</h1>
                        <div id="choices">
                        </div>
                        <div>
                            <input type="button" value="Valider" onclick="switchToStep5();" />
                        </div>
                    </div>
                </form>
            </div>
            <div class="social-links">
            </div>
            <div class="hosting-info">
                <p>
                    <?php if (isset($_SESSION['logged'])) : ?>
                        <a href="../../_func/logout.php">Logout</a>
                    <?php else : ?>
                        <a href="../../_func/login.php">Login</a>
                    <?php endif; ?>
                    -
                    <a href="#" onclick="toggleUI()">Cacher/Montrer l'UI</a>
                    -
                    <a href="#" onclick="mute()">Mute/Unmute</a>
                    -
                    <a href="../../">Retour à la page d'accueil</a>
                </p>
            </div>
            <video <?= (isset($_SESSION['mute']) && $_SESSION['mute'] ? "muted" : "") ?> class="son" hidden autoplay loop>
                <source src="../../_sounds/cringe_sound.mp3" type="audio/mpeg" />
            </video>
        </div>
        <script>
            var races;
            var classes;
            var historiques;
            var thisRace;
            var myClass;
            var myHistorique;
            fetch('races.json').then(resp => resp.json()).then(function(resp) {
                races = resp;
                Object.keys(races).forEach(r => {
                    if (races[r].variantes != undefined) {
                        Object.keys(races[r].variantes).forEach(v => {
                            race.innerHTML += "<option value=\"" + r + "." + v + "\">" + v + "</option>";
                        });
                    } else {
                        race.innerHTML += "<option value=\"" + r + "\">" + r + "</option>";
                    }
                });
            });

            fetch('classes.json').then(resp => resp.json()).then(function(resp) {
                classes = resp;
                Object.keys(classes).forEach(c => {
                    classe.innerHTML += "<option value=\"" + c + "\">" + c + "</option>";
                });
            });
            fetch('historiques.json').then(resp => resp.json()).then(function(resp) {
                historiques = resp;
                Object.keys(historiques).forEach(c => {
                    historique.innerHTML += "<option value=\"" + c + "\">" + c + "</option>";
                });
            });

            function updateTot() {
                totFOR.innerText = parseInt(InputFOR.value) + parseInt(bonusFOR.innerText);
                totINT.innerText = parseInt(InputINT.value) + parseInt(bonusINT.innerText);
                totDEX.innerText = parseInt(InputDEX.value) + parseInt(bonusDEX.innerText);
                totSAG.innerText = parseInt(InputSAG.value) + parseInt(bonusSAG.innerText);
                totCHA.innerText = parseInt(InputCHA.value) + parseInt(bonusCHA.innerText);
                totCON.innerText = parseInt(InputCON.value) + parseInt(bonusCON.innerText);
            }

            //Passage à l'étape 2 qui est celle des stats
            function switchToStep2() {
                step1.hidden = true;
                step2.removeAttribute('hidden');
                myClass = classes[classe.value];
                let splitName = race.value.split(".");
                let isSubrace = splitName.length > 1;
                let OrRace = races[splitName[0]];
                let subRace = undefined;
                thisRace = {
                    name: splitName[isSubrace ? 1 : 0],
                    bonus: races[splitName[0]].bonus,
                    choix: races[splitName[0]].choix,
                    traits: races[splitName[0]].traits,
                    maitrises: races[splitName[0]].maitrises,
                    vitesse: races[splitName[0]].vitesse,
                    langues: races[splitName[0]].langues
                };
                if (isSubrace) {
                    subRace = OrRace.variantes[splitName[1]];

                    if (thisRace.bonus == undefined) {
                        if (subRace.bonus != undefined)
                            thisRace.bonus = subRace.bonus;
                    } else {
                        if (subRace.bonus != undefined)
                            thisRace.bonus = Object.assign(thisRace.bonus, subRace.bonus);
                    }

                    if (thisRace.choix == undefined) {
                        if (subRace.choix != undefined)
                            thisRace.choix = subRace.choix;
                    } else {
                        if (subRace.choix != undefined)
                            thisRace.choix = Object.assign(thisRace.choix, subRace.choix);
                    }

                    if (thisRace.traits == undefined) {
                        if (subRace.traits != undefined)
                            thisRace.traits = subRace.traits;
                    } else {
                        if (subRace.traits != undefined)
                            thisRace.traits = Object.assign(thisRace.traits, subRace.traits);
                    }

                    if (thisRace.maitrises == undefined) {
                        if (subRace.maitrises != undefined)
                            thisRace.maitrises = subRace.maitrises;
                    } else {
                        if (subRace.maitrises != undefined)
                            thisRace.maitrises = Object.assign(thisRace.maitrises, subRace.maitrises);
                    }

                    if (thisRace.vitesse == undefined) {
                        if (subRace.vitesse != undefined)
                            thisRace.vitesse = subRace.vitesse;
                    } else {
                        if (subRace.vitesse != undefined)
                            thisRace.vitesse = Object.assign(thisRace.vitesse, subRace.vitesse);
                    }

                    if (thisRace.langues == undefined) {
                        if (subRace.langues != undefined)
                            thisRace.langues = subRace.langues;
                    } else {
                        if (subRace.langues != undefined)
                            thisRace.langues = Object.assign(thisRace.langues, subRace.langues);
                    }
                }

                if (thisRace.bonus.FOR != undefined) {
                    bonusFOR.innerText = thisRace.bonus.FOR;
                } else {
                    bonusFOR.innerText = "0";
                }
                if (thisRace.bonus.DEX != undefined) {
                    bonusDEX.innerText = thisRace.bonus.DEX;
                } else {
                    bonusDEX.innerText = "0";
                }
                if (thisRace.bonus.INT != undefined) {
                    bonusINT.innerText = thisRace.bonus.INT;
                } else {
                    bonusINT.innerText = "0";
                }
                if (thisRace.bonus.SAG != undefined) {
                    bonusSAG.innerText = thisRace.bonus.SAG;
                } else {
                    bonusSAG.innerText = "0";
                }
                if (thisRace.bonus.CON != undefined) {
                    bonusCON.innerText = thisRace.bonus.CON;
                } else {
                    bonusCON.innerText = "0";
                }
                if (thisRace.bonus.CHA != undefined) {
                    bonusCHA.innerText = thisRace.bonus.CHA;
                } else {
                    bonusCHA.innerText = "0";
                }
                updateTot();
            }


            //Passage à l'étape 3 qui est celle historiques
            function switchToStep3() {
                if (parseInt(remaining.innerText) == 0) {
                    step2.hidden = true;
                    step3.removeAttribute('hidden');
                } else {
                    alert("Vous devez avoir un nombre de points égal à 0");
                }
            }

            //Passage à l'étape 4 qui est celle des choix
            function switchToStep4() {
                step3.hidden = true;
                step4.removeAttribute('hidden');
                myHistorique = historiques[historique.value];
                let choix = [];
                let nbChoix = 0;
                let str = "";
                if (thisRace.choix != undefined) {

                    str += "<h2>Choix de race</h2>";
                    thisRace.choix.forEach(ch => {
                        let nb = ch.nombre;
                        let name = Object.keys(ch)[0];
                        if (!allChoix.includes(name)) {
                            allChoix.push(name);
                        }
                        for (let i = 0; i < nb; i++) {
                            let opt = "";
                            console.log(name);
                            if (name == "bonus") {
                                ch[name].forEach(el => {
                                    if (!((myClass[name] != undefined && myClass[name][el] != undefined) ||
                                            (myHistorique[name] != undefined && myHistorique[name][el] != undefined) ||
                                            (thisRace[name] != undefined && thisRace[name][el] != undefined))) {
                                        opt += "<option value=\"" + el + "\">" + el + "</option>";
                                    }

                                });
                            } else {
                                ch[name].forEach(el => {
                                    if (!((myClass[name] != undefined && myClass[name].includes(el)) ||
                                            (myHistorique[name] != undefined && myHistorique[name].includes(el)) ||
                                            (thisRace[name] != undefined && thisRace[name].includes(el)))) {
                                        opt += "<option value=\"" + el + "\">" + el + "</option>";
                                    }

                                });
                            }
                            if (opt.length != 0) {
                                str += "<div>" + name;
                                str += " :  <select name=\"" + name + "\" ";
                                if (ch.taux != undefined) {
                                    str += "taux=\"" + ch.taux + "\"";
                                }
                                str += " >";
                                str += opt;
                                str += "</select></div>";
                            }
                        }
                    });
                    nbChoix += thisRace.choix.length;
                }
                if (myClass.choix != undefined) {

                    str += "<h2>Choix de classe</h2>";
                    myClass.choix.forEach(ch => {
                        let nb = ch.nombre;
                        let name = Object.keys(ch)[0];
                        if (!allChoix.includes(name)) {
                            allChoix.push(name);
                        }
                        for (let i = 0; i < nb; i++) {
                            let opt = "";
                            console.log(name);
                            if (name == "bonus") {
                                ch[name].forEach(el => {
                                    if (!((myClass[name] != undefined && myClass[name][el] != undefined) ||
                                            (myHistorique[name] != undefined && myHistorique[name][el] != undefined) ||
                                            (thisRace[name] != undefined && thisRace[name][el] != undefined))) {
                                        opt += "<option value=\"" + el + "\">" + el + "</option>";
                                    }

                                });
                            } else {
                                ch[name].forEach(el => {
                                    if (!((myClass[name] != undefined && myClass[name].includes(el)) ||
                                            (myHistorique[name] != undefined && myHistorique[name].includes(el)) ||
                                            (thisRace[name] != undefined && thisRace[name].includes(el)))) {
                                        opt += "<option value=\"" + el + "\">" + el + "</option>";
                                    }

                                });
                            }
                            if (opt.length != 0) {
                                str += "<div>" + name;
                                str += " :  <select name=\"" + name + "\" ";
                                if (ch.taux != undefined) {
                                    str += "taux=\"" + ch.taux + "\"";
                                }
                                str += " >";
                                str += opt;
                                str += "</select></div>";
                            }
                        }
                    });
                    nbChoix += myClass.choix.length;
                }
                if (myHistorique.choix != undefined) {

                    str += "<h2>Choix d'historique</h2>";
                    myHistorique.choix.forEach(ch => {
                        let nb = ch.nombre;
                        let name = Object.keys(ch)[0];
                        if (!allChoix.includes(name)) {
                            allChoix.push(name);
                        }
                        for (let i = 0; i < nb; i++) {
                            let opt = "";
                            console.log(name);
                            if (name == "bonus") {
                                ch[name].forEach(el => {
                                    if (!((myClass[name] != undefined && myClass[name][el] != undefined) ||
                                            (myHistorique[name] != undefined && myHistorique[name][el] != undefined) ||
                                            (thisRace[name] != undefined && thisRace[name][el] != undefined))) {
                                        opt += "<option value=\"" + el + "\">" + el + "</option>";
                                    }

                                });
                            } else {
                                ch[name].forEach(el => {
                                    if (!((myClass[name] != undefined && myClass[name].includes(el)) ||
                                            (myHistorique[name] != undefined && myHistorique[name].includes(el)) ||
                                            (thisRace[name] != undefined && thisRace[name].includes(el)))) {
                                        opt += "<option value=\"" + el + "\">" + el + "</option>";
                                    }

                                });
                            }
                            if (opt.length != 0) {
                                str += "<div>" + name;
                                str += " :  <select name=\"" + name + "\" ";
                                if (ch.taux != undefined) {
                                    str += "taux=\"" + ch.taux + "\"";
                                }
                                str += " >";
                                str += opt;
                                str += "</select></div>";
                            }
                        }
                    });
                    nbChoix += myHistorique.choix.length;
                }
                if (nbChoix == 0) {
                    switchToStep5();
                }

                choices.innerHTML = str;
            }
            let allChoix = [];

            function switchToStep5() {
                //verify values
                let good = true;
                let choix = {};
                allChoix.forEach(nm => {
                    if (good) {
                        let elements = document.getElementsByName(nm);
                        console.log(elements);
                        let values = [];
                        choix[nm] = [];
                        elements.forEach(el => {
                            if (values.includes(el.value)) {
                                good = false;
                                alert(nm + ' - La valeur "' + el.value + '" a été affectée 2 fois');
                            } else {
                                choix[nm].push(el.value);
                                values.push(el.value);
                            }
                        });
                    }
                });
                if (good) {
                    //Récupère la valeur de chaque truc
                    step4.hidden = true;
                    //récupère le json vide
                    fetch('../perso/_empty.json').then(resp => resp.json()).then(char => {
                        //set les choix de carac
                        document.getElementsByName('bonus').forEach(el => {
                            switch (el.value) {
                                case "SAG":
                                    totSAG.innerText = parseInt(totSAG.innerText) + parseInt(el.getAttribute('taux'));
                                    break;
                                case "INT":
                                    totINT.innerText = parseInt(totINT.innerText) + parseInt(el.getAttribute('taux'));
                                    break;
                                case "CHA":
                                    totCHA.innerText = parseInt(totCHA.innerText) + parseInt(el.getAttribute('taux'));
                                    break;
                                case "FOR":
                                    totFOR.innerText = parseInt(totFOR.innerText) + parseInt(el.getAttribute('taux'));
                                    break;
                                case "CON":
                                    totCON.innerText = parseInt(totCON.innerText) + parseInt(el.getAttribute('taux'));
                                    break;
                                case "DEX":
                                    totDEX.innerText = parseInt(totDEX.innerText) + parseInt(el.getAttribute('taux'));
                                    break;
                            }
                        });

                        //set le nom, niveau, caracs, et autres infos
                        char.nomPerso = charName.value;
                        char.nomJoueur = "<?= (isset($_GET['jsonFile']) ? $_GET['jsonFile'] : "unknown") ?>";
                        char.FORscore = totFOR.innerText;
                        char.DEXscore = totDEX.innerText;
                        char.CONscore = totCON.innerText;
                        char.SAGscore = totSAG.innerText;
                        char.CHAscore = totCHA.innerText;
                        char.INTscore = totINT.innerText;
                        char.classeEtNiveau = classe.value + " 1";
                        char.deDeVie = "1d" + myClass.deDeVie;
                        char.race = thisRace.name;
                        char.historique = historique.value;
                        char.speed = thisRace.vitesse + "m";
                        char.pvMax = (myClass.deDeVie + Math.floor((parseInt(totCON.innerText) - 10) / 2)).toString();
                        char.ac = "10";

                        //traits
                        if (thisRace.traits != null && thisRace.traits != undefined) {
                            Object.keys(thisRace.traits).forEach(el => {
                                char.traits += el + "." + thisRace.traits[el] + "\n\n";
                            });
                        }

                        char.proficiencies = "armes : ";
                        //armes,armures,outils,langues
                        if (thisRace.armes != undefined) {
                            char.proficiencies += thisRace.armes.toString()+", ";
                        }
                        if (myClass.armes != undefined) {
                            char.proficiencies += myClass.armes.toString()+", ";
                        }
                        char.proficiencies = char.proficiencies.substr(0,char.proficiencies.length - 2);
                        char.proficiencies += "\narmures : ";
                        if (thisRace.armures != undefined) {
                            char.proficiencies += thisRace.armures.toString()+", ";
                        }
                        if (myClass.armures != undefined) {
                            char.proficiencies += myClass.armures.toString()+", ";
                        }
                        char.proficiencies = char.proficiencies.substr(0,char.proficiencies.length - 2);
                        char.proficiencies += "\noutils : ";
                        if (thisRace.outils != undefined) {
                            char.proficiencies += thisRace.outils.toString()+", ";
                        }
                        if (myClass.outils != undefined) {
                            char.proficiencies += myClass.outils.toString()+", ";
                        } 
                        document.getElementsByName('outils').forEach(el => {
                            char.proficiencies += el.value+", ";
                        });
                        char.proficiencies = char.proficiencies.substr(0,char.proficiencies.length - 2);
                        char.proficiencies += "\nlangues : ";
                        if (thisRace.langues != undefined) {
                            char.proficiencies += thisRace.langues.toString()+", ";
                        }
                        if (myClass.langues != undefined) {
                            char.proficiencies += myClass.langues.toString()+", ";
                        }
                        if (myHistorique.langues != undefined) {
                            char.proficiencies += myHistorique.langues.toString()+", ";
                        } 
                        document.getElementsByName('langues').forEach(el => {
                            char.proficiencies += el.value+", ";
                        });
                        char.proficiencies = char.proficiencies.substr(0,char.proficiencies.length - 2);

                        //maitrises
                        document.getElementsByName('maitrises').forEach(el => {
                            char.skillsProf.push(el.value)+", ";
                        });
                        if (thisRace.maitrises != undefined)
                            char.skillsProf = char.skillsProf.concat(thisRace.maitrises);
                        if (myHistorique.maitrises != undefined)
                            char.skillsProf = char.skillsProf.concat(myHistorique.maitrises);
                        char.saveProf = myClass.sauvegarde;

                        //equipements
                        if (myClass.equipement != undefined)
                            char.equipmentTextArea = myClass.equipement;
                        document.getElementsByName('equipement').forEach(el => {
                            char.equipmentTextArea += ", " + el.value;
                        });
                        char.equipmentTextArea += "," + myHistorique.equipement;

                        char.po = myHistorique.po.toString();

                        switch (classe.value) {
                            case "Barbare":
                            case "Druide":
                                //2d4*10
                                char.po = (myHistorique.po + <?= random_int(2, 8) * 10 ?>).toString();
                                break;
                            case "Barde":
                            case "Clerc":
                            case "Guerrier":
                            case "Paladin":
                            case "Rôdeur":
                                //5d4*10
                                char.po = (myHistorique.po + <?= random_int(5, 20) * 10 ?>).toString();
                                break;

                            case "Ensorceleur":
                                //3d4*10
                                char.po = (myHistorique.po + <?= random_int(3, 12) * 10 ?>).toString();
                                break;
                            case "Magicien":
                            case "Roublard":
                            case "Sorcier":
                                //4d4*10
                                char.po = (myHistorique.po + <?= random_int(4, 16) * 10 ?>).toString();
                                break;
                            case "Moine":
                                //5d4
                                char.po = (myHistorique.po + <?= random_int(5, 20) ?>).toString();
                                break;
                        }

                        let fileName = char.nomJoueur;

                        var myInit = {
                            method: 'POST',
                            headers: new Headers(),
                            mode: 'cors',
                            cache: 'default',
                            body: JSON.stringify(char)
                        };

                        fetch("../../_func/saveJson.php", {
                            method: "POST",
                            body: JSON.stringify({
                                "file": '../CharacterCreator/perso/' + fileName + '.json',
                                "create": true,
                                "data": char
                            })
                        }).then(function(res) {
                            window.location = "../perso/?jsonFile=" + fileName + ".json";
                        });
                    });
                }
            }

            function updatePoints(current) {
                if (current.value > 15) {
                    current.value = 15;
                }
                if (current.value < 8) {
                    current.value = 8;
                }
                let tot = 0;
                let lst = [InputFOR, InputDEX, InputCHA, InputCON, InputSAG, InputINT];

                lst.forEach(el => {
                    let nb = 0;
                    nb = el.value - 8;
                    if (nb == 6) {
                        nb = 7;
                    } else if (nb == 7) {
                        nb = 9;
                    }
                    tot += nb;
                });
                let remainingPts = 27 - tot;
                remaining.innerText = remainingPts;
                updateTot();
            }
        </script>
        <script src="../../_js/script.js">
        </script>
        <script src="https://assets.storage.infomaniak.com/js/css_browser_selector.min.js"></script>
    </div>

</body>

</html>