<?php
require_once('../../_func/func.inc.php');
$json = filter_input(INPUT_GET, "jsonFile");
if ($json == false || is_null($json)) {
  if (isset($_SESSION['jsonFile'])) {
    $json == $_SESSION['jsonFile'];
  } else {
    header("Location: index.php");
  }
} else {
  $_SESSION['jsonFile'] = $json;
}
$imgUrl = getDndHandbookImage();
if (file_exists($json)) {
  $char = json_decode(file_get_contents($json));
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Fiche de perso - <?= explode('.', $json)[0] ?></title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" href="../../_css/charSheet.css">
  <style>
  </style>
</head>

<body>
  <nav id="ui">
    <input type="button" class="btnUI" onclick="Print()" value="Imprimer">
    <input type="button" class="btnUI" onclick="Save()" value="Enregistrer">
    <input type="button" class="btnUI" onclick="Delete()" value="Supprimer">
    <input type="button" class="btnUI" onclick="window.location = 'http:\/\/pyroblastouille.site/LeProjetTopSecret/?page=deuneudeu'; " value="Retour">
  </nav>
  <!-- partial:index.partial.html -->
  <form class="charsheet sheetForm breakPage">
    <header>
      <section class="charname">
        <label for="charname">Nom du personnage</label><input value="<?= $char->nomPerso ?>" class="nomPerso" name="charname" placeholder="Thoradin Forgefeu" />
      </section>
      <section class="misc">
        <ul>
          <li>
            <label for="classlevel">Classe & niveau</label><input value="<?= $char->classeEtNiveau ?>" class="classeEtNiveau" name="classlevel" placeholder="Paladin 2" />
          </li>
          <li>
            <label for="background">Historique</label><input value="<?= $char->historique ?>" name="background" class="historique" placeholder="Acolyte" />
          </li>
          <li>
            <label for="playername">Nom du joueur</label><input value="<?= $char->nomJoueur ?>" name="playername" class="nomJoueur" placeholder="Player McPlayerface">
          </li>
          <li>
            <label for="race">Race</label><input value="<?= $char->race ?>" name="race" placeholder="Demi-elfe" class="race" />
          </li>
          <li>
            <label for="alignment">Alignement</label><input value="<?= $char->alignement ?>" name="alignment" class="alignement" placeholder="Loyal Bon" />
          </li>
          <li>
            <label for="experiencepoints">Points d'expérience</label><input value="<?= $char->xp ?>" class="xp" name="experiencepoints" placeholder="3240" />
          </li>
        </ul>
      </section>
    </header>
    <main>
      <section>
        <section class="attributes">
          <div class="scores">
            <ul>
              <li>
                <div class="score">
                  <label for="Forcescore">Force</label><input value="<?= $char->FORscore ?>" class="stat FORscore" name="Forcescore" placeholder="10" />
                </div>
                <div class="modifier">
                  <input class="statmod unselectable FOR" name="Forcemod" placeholder="+0" />
                </div>
              </li>
              <li>
                <div class="score">
                  <label for="Dextéritéscore">Dextérité</label><input value="<?= $char->DEXscore ?>" class="stat DEXscore" name="Dextéritéscore" placeholder="10" />
                </div>
                <div class="modifier">
                  <input class="statmod unselectable DEX" name="Dextéritémod" placeholder="+0" />
                </div>
              </li>
              <li>
                <div class="score">
                  <label for="Constitutionscore">Constitution</label><input value="<?= $char->CONscore ?>" class="stat CONscore" name="Constitutionscore" placeholder="10" />
                </div>
                <div class="modifier">
                  <input class="statmod unselectable CON" name="Constitutionmod" placeholder="+0" />
                </div>
              </li>
              <li>
                <div class="score">
                  <label for="Intelligencescore">Intelligence</label><input value="<?= $char->INTscore ?>" class="stat INTscore" name="Intelligencescore" placeholder="10" />
                </div>
                <div class="modifier">
                  <input class="statmod unselectable INT" name="Intelligencemod" placeholder="+0" />
                </div>
              </li>
              <li>
                <div class="score">
                  <label for="Sagessescore">Sagesse</label><input value="<?= $char->SAGscore ?>" class="stat SAGscore" name="Sagessescore" placeholder="10" />
                </div>
                <div class="modifier">
                  <input class="statmod unselectable SAG" name="Sagessemod" placeholder="+0" />
                </div>
              </li>
              <li>
                <div class="score">
                  <label for="Charismescore">Charisme</label><input value="<?= $char->CHAscore ?>" class="stat CHAscore" name="Charismescore" placeholder="10" />
                </div>
                <div class="modifier">
                  <input class="statmod unselectable CHA" name="Charismemod" placeholder="+0" />
                </div>
              </li>
            </ul>
          </div>
          <div class="attr-applications">
            <div class="inspiration box">
              <div class="label-container">
                <label for="inspiration">Inspiration</label>
              </div>
              <input <?= ($char->inspiration != "" ? "checked" : "") ?> name="inspiration" class="inspiration" type="checkbox" />
            </div>
            <div class="proficiencybonus box">
              <div class="label-container">
                <label for="proficiencybonus">Bonus de maitrise</label>
              </div>
              <input name="proficiencybonus" class="unselectable bonusMaitrise" placeholder="+2" />
            </div>
            <div class="saves list-section box">
              <ul>
                <li>
                  <label for="Force-save">Force</label><input name="Force-save" placeholder="+0" class="FORMod unselectable" type="text" /><input <?= is_prof('Force', $char->saveProf) ?> name="Force-save-prof" class="profCheck FORModCheck" type="checkbox" />
                </li>
                <li>
                  <label for="Dextérité-save">Dextérité</label><input name="Dextérité-save" class="DEXMod unselectable" placeholder="+0" type="text" /><input <?= is_prof('Dextérité', $char->saveProf) ?> name="Dextérité-save-prof" class="profCheck DEXModCheck" type="checkbox" />
                </li>
                <li>
                  <label for="Constitution-save">Constitution</label><input name="Constitution-save" class="CONMod unselectable" placeholder="+0" type="text" /><input <?= is_prof('Constitution', $char->saveProf) ?> name="Constitution-save-prof" class="profCheck CONModCheck" type="checkbox" />
                </li>
                <li>
                  <label for="Intelligence-save">Intelligence</label><input name="Intelligence-save" class="INTMod unselectable" placeholder="+0" type="text" /><input <?= is_prof('Intelligence', $char->saveProf) ?> name="Intelligence-save-prof" class="profCheck INTModCheck" type="checkbox" />
                </li>
                <li>
                  <label for="Sagesse-save">Sagesse</label><input name="Sagesse-save" class="SAGMod unselectable" placeholder="+0" type="text" /><input <?= is_prof('Sagesse', $char->saveProf) ?> name="Sagesse-save-prof" class="profCheck SAGModCheck" type="checkbox" />
                </li>
                <li>
                  <label for="Charisme-save">Charisme</label><input name="Charisme-save" class="CHAMod unselectable" placeholder="+0" type="text" /><input <?= is_prof('Charisme', $char->saveProf) ?> name="Charisme-save-prof" class="profCheck CHAModCheck" type="checkbox" />
                </li>
              </ul>
              <div class="label">
                Jets de sauvegarde
              </div>
            </div>
            <div class="skills list-section box">
              <ul>
                <li>
                  <label for="Acrobaties">Acrobaties <span class="skill unselectable">(DEX)</span></label><input class="DEXMod" name="Acrobaties" placeholder="+0" type="text" /><input <?= is_prof('Acrobaties', $char->skillsProf) ?> name="Acrobaties-prof" class="profCheck Acrobaties-prof" type="checkbox" />
                </li>
                <li>
                  <label for="Arcanes">Arcanes <span class="skill unselectable">(INT)</span></label><input class="INTMod" name="Arcanes" placeholder="+0" type="text" /><input <?= is_prof('Arcanes', $char->skillsProf) ?> name="Arcanes-prof" class="profCheck Arcanes-prof" type="checkbox" />
                </li>
                <li>
                  <label for="Athlétisme">Athlétisme <span class="skill unselectable">(FOR)</span></label><input class="FORMod" name="Athlétisme" placeholder="+0" type="text" /><input <?= is_prof('Athlétisme', $char->skillsProf) ?> name="Athlétisme-prof" class="profCheck Athlétisme-prof" type="checkbox" />
                </li>
                <li>
                  <label for="Discrétion">Discrétion <span class="skill unselectable">(DEX)</span></label><input class="DEXMod" name="Discrétion" placeholder="+0" type="text" /><input <?= is_prof('Discrétion', $char->skillsProf) ?> name="Discrétion-prof" class="profCheck Discrétion-prof" type="checkbox" />
                </li>
                <li>
                  <label for="Dressage">Dressage <span class="skill unselectable">(SAG)</span></label><input class="SAGMod" name="Dressage" placeholder="+0" type="text" /><input <?= is_prof('Dressage', $char->skillsProf) ?> name="Dressage-prof" class="profCheck Dressage-prof" type="checkbox" />
                </li>
                <li>
                  <label for="Escamotage">Escamotage <span class="skill unselectable">(DEX)</span></label><input class="DEXMod" name="Escamotage" placeholder="+0" type="text" /><input <?= is_prof('Escamotage', $char->skillsProf) ?> name="Escamotage-prof" class="profCheck Escamotage-prof" type="checkbox" />
                </li>
                <li>
                  <label for="Histoire">Histoire <span class="skill unselectable">(INT)</span></label><input class="INTMod" name="Histoire" placeholder="+0" type="text" /><input <?= is_prof('Histoire', $char->skillsProf) ?> name="Histoire-prof" class="profCheck Histoire-prof" type="checkbox" />
                </li>
                <li>
                  <label for="Intimidation">Intimidation <span class="skill unselectable">(FOR)</span></label><input class="FORMod" name="Intimidation" placeholder="+0" type="text" /><input <?= is_prof('Intimidation', $char->skillsProf) ?> name="Intimidation-prof" class="profCheck Intimidation-prof" type="checkbox" />
                </li>
                <li>
                  <label for="Investigation">Investigation <span class="skill unselectable">(INT)</span></label><input class="INTMod" name="Investigation" placeholder="+0" type="text" /><input <?= is_prof('Investigation', $char->skillsProf) ?> name="Investigation-prof" class="profCheck Investigation-prof" type="checkbox" />
                </li>
                <li>
                  <label for="Médecine">Médecine <span class="skill unselectable">(SAG)</span></label><input class="SAGMod" name="Médecine" placeholder="+0" type="text" /><input <?= is_prof('Médecine', $char->skillsProf) ?> name="Médecine-prof" class="profCheck Médecine-prof" type="checkbox" />
                </li>
                <li>
                  <label for="Nature">Nature <span class="skill unselectable">(INT)</span></label><input class="INTMod" name="Nature" placeholder="+0" type="text" /><input <?= is_prof('Nature', $char->skillsProf) ?> name="Nature-prof" class="profCheck Nature-prof" type="checkbox" />
                </li>
                <li>
                  <label for="Perception">Perception <span class="skill unselectable">(SAG)</span></label><input class="SAGMod" name="Perception" placeholder="+0" type="text" /><input <?= is_prof('Perception', $char->skillsProf) ?> name="Perception-prof" class="profCheck Perception-prof" type="checkbox" />
                </li>
                <li>
                  <label for="Perspicacité">Perspicacité <span class="skill unselectable">(SAG)</span></label><input class="SAGMod" name="Perspicacité" placeholder="+0" type="text" /><input <?= is_prof('Perspicacité', $char->skillsProf) ?> name="Perspicacité-prof" class="profCheck Perspicacité-prof" type="checkbox" />
                </li>
                <li>
                  <label for="Persuasion">Persuasion <span class="skill unselectable">(CHA)</span></label><input class="CHAMod" name="Persuasion" placeholder="+0" type="text" /><input <?= is_prof('Persuasion', $char->skillsProf) ?> name="Persuasion-prof" class="profCheck Persuasion-prof" type="checkbox" />
                </li>
                <li>
                  <label for="Religion">Religion <span class="skill unselectable">(INT)</span></label><input class="INTMod" name="Religion" placeholder="+0" type="text" /><input <?= is_prof('Religion', $char->skillsProf) ?> name="Religion-prof" class="profCheck Religion-prof" type="checkbox" />
                </li>
                <li>
                  <label for="Représentation">Représentation <span class="skill unselectable">(CHA)</span></label><input class="CHAMod" name="Représentation" placeholder="+0" type="text" /><input <?= is_prof('Représentation', $char->skillsProf) ?> name="Représentation-prof" class="profCheck Représentation-prof" type="checkbox" />
                </li>
                <li>
                  <label for="Survie">Survie <span class="skill unselectable">(SAG)</span></label><input class="SAGMod" name="Survie" placeholder="+0" type="text" /><input <?= is_prof('Survie', $char->skillsProf) ?> name="Survie-prof" class="profCheck Survie-prof" type="checkbox" />
                </li>
                <li>
                  <label for="Tromperie">Tromperie <span class="skill unselectable">(CHA)</span></label><input class="CHAMod" name="Tromperie" placeholder="+0" type="text" /><input <?= is_prof('Tromperie', $char->skillsProf) ?> name="Tromperie-prof" class="profCheck Tromperie-prof" type="checkbox" />
                </li>
              </ul>
              <div class="label">
                Compétences
              </div>
            </div>
          </div>
        </section>
        <div class="passive-perception box">
          <div class="label-container">
            <label for="passiveperception">Sagesse Passive (Perception)</label>
          </div>
          <input name="passiveperception" class="unselectable sagPass" placeholder="10" />
        </div>
        <div class="otherprofs box textblock">
          <label for="otherprofs">Autres maitrises et langues</label><textarea name="proficiencies" class="proficiencies"><?= $char->proficiencies ?></textarea>
        </div>
      </section>
      <section>
        <section class="combat">
          <div class="armorclass">
            <div>
              <label for="ac">Classe d'armure</label><input value="<?= $char->ac ?>" class="ac" name="ac" placeholder="10" type="text" />
            </div>
          </div>
          <div class="initiative">
            <div>
              <label for="initiative">Initiative</label><input name="initiative" class="unselectable initiative" placeholder="+0" type="text" />
            </div>
          </div>
          <div class="speed">
            <div>
              <label for="speed">Vitesse</label><input value="<?= $char->speed ?>" name="speed" placeholder="9m" class="speed" type="text" />
            </div>
          </div>
          <div class="hp">
            <div class="regular">
              <div class="max">
                <label for="maxhp">Points de Vie Maximum</label><input value="<?= $char->pvMax ?>" name="maxhp" placeholder="10" class="pvMax" type="text" />
              </div>
              <div class="current">
                <label for="currenthp">Points de Vie actuels</label><input name="currenthp" type="text" />
              </div>
            </div>
            <div class="temporary">
              <label for="temphp">Points de vie temporaires</label><input name="temphp" type="text" />
            </div>
          </div>
          <div class="hitdice">
            <div>
              <div class="total">
                <label for="totalhd">Total</label><input name="totalhd" placeholder="2" class="totalDe" type="text" />
              </div>
              <div class="remaining">
                <label for="remaininghd">Dé de vie</label><input name="Constitutionmod" class="unselectable" type="text" placeholder="+0" /><input value="<?= $char->deDeVie ?>" name="remaininghd" type="text" class="deDeVie" placeholder="1d10" />
              </div>
            </div>
          </div>
          <div class="deathsaves">
            <div>
              <div class="label">
                <label>Jets Contre mort</label>
              </div>
              <div class="marks">
                <div class="deathsuccesses">
                  <label>Succès</label>
                  <div class="bubbles">
                    <input name="deathsuccess1" type="checkbox" />
                    <input name="deathsuccess2" type="checkbox" />
                    <input name="deathsuccess3" type="checkbox" />
                  </div>
                </div>
                <div class="deathfails">
                  <label>échecs</label>
                  <div class="bubbles">
                    <input name="deathfail1" type="checkbox" />
                    <input name="deathfail2" type="checkbox" />
                    <input name="deathfail3" type="checkbox" />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <section class="attacksandspellcasting">
          <div>
            <label>Attaques et sorts</label>
            <table>
              <thead>
                <tr>
                  <th>
                    Nom
                  </th>
                  <th>
                    Bonus ATT
                  </th>
                  <th>
                    dégâts/Type
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <input value="<?= $char->arme1->nom ?>" name="atkname1" class="arme1Nom" type="text" />
                  </td>
                  <td>
                    <input value="<?= $char->arme2->atk ?>" name="atkbonus1" class="arme1Atk" type="text" />
                  </td>
                  <td>
                    <input value="<?= $char->arme1->deg ?>" name="atkdamage1" class="arme1Deg" type="text" />
                  </td>
                </tr>

                <tr>
                  <td>
                    <input value="<?= $char->arme2->nom ?>" name="atkname2" class="arme2Nom" type="text" />
                  </td>
                  <td>
                    <input value="<?= $char->arme2->atk ?>" name="atkbonus2" class="arme2Atk" type="text" />
                  </td>
                  <td>
                    <input value="<?= $char->arme2->deg ?>" name="atkdamage2" class="arme2Deg" type="text" />
                  </td>
                </tr>

                <tr>
                  <td>
                    <input value="<?= $char->arme3->nom ?>" name="atkname3" class="arme3Nom" type="text" />
                  </td>
                  <td>
                    <input value="<?= $char->arme3->atk ?>" name="atkbonus3" class="arme3Atk" type="text" />
                  </td>
                  <td>
                    <input value="<?= $char->arme3->deg ?>" name="atkdamage3" class="arme3Deg" type="text" />
                  </td>
                </tr>
              </tbody>
            </table>
            <textarea class="weightChange weaponTextArea"><?= $char->weaponTextArea ?></textarea>
          </div>
        </section>
        <section class="equipment">
          <div>
            <label>équipement - <span><span class="weightModif actualWeight"></span>/<span class="maxWeight"></span>kg</span></label>
            <div class="money">
              <ul>
                <li>
                  <label for="pc">pc</label><input value="<?= $char->pc ?>" class="weightChange" name="pc" class="pc" />
                </li>
                <li>
                  <label for="pa">pa</label><input value="<?= $char->pa ?>" class="weightChange pa" name="pa" />
                </li>
                <li>
                  <label for="pe">pe</label><input value="<?= $char->pe ?>" class="weightChange pe" name="pe" />
                </li>
                <li>
                  <label for="po">po</label><input value="<?= $char->po ?>" class="weightChange po" name="po" />
                </li>
                <li>
                  <label for="pp">pp</label><input value="<?= $char->pp ?>" class="weightChange pp" name="pp" />
                </li>
              </ul>
            </div>
            <textarea class="weightChange equipmentTextArea" placeholder="Liste d&#39;équipement ici"><?= $char->equipmentTextArea ?></textarea>
          </div>
        </section>
      </section>
      <section>
        <section class="flavor">
          <div class="personality">
            <label for="personality">Traits de personnalité</label><textarea name="personality" class="TraitPersonalite"><?= $char->TraitPersonalite ?></textarea>
          </div>
          <div class="ideals">
            <label for="ideals">idéaux</label><textarea name="ideals" class="Ideaux"><?= $char->Ideaux ?></textarea>
          </div>
          <div class="bonds">
            <label for="bonds">liens</label><textarea name="bonds" class="Liens"><?= $char->Liens ?></textarea>
          </div>
          <div class="flaws">
            <label for="flaws">défauts</label><textarea name="flaws" class="defauts"><?= $char->defauts ?></textarea>
          </div>
        </section>
        <section class="features">
          <div>
            <label for="features">capacités et traits</label><textarea name="features" class="traits"><?= $char->traits ?></textarea>
          </div>
        </section>
      </section>
    </main>
  </form>


  <form class="charsheet sheetForm breakPage">
    <header>
      <section class="charname">
        <label for="charname">Nom du personnage</label><input value="<?= $char->nomPerso ?>" class="nomPerso" name="charname" placeholder="Thoradin Forgefeu" />
      </section>
      <section class="misc">
        <ul>
          <li>
            <label for="age">âge</label><input value="<?= $char->age ?>" class="age" name="age" placeholder="138 ans" />
          </li>
          <li>
            <label for="taille">taille</label><input value="<?= $char->taille ?>" name="taille" class="taille" placeholder="1m68" />
          </li>
          <li>
            <label for="poids">poids</label><input value="<?= $char->poids ?>" name="poids" class="poids" placeholder="76kg">
          </li>
          <li>
            <label for="yeux">yeux</label><input value="<?= $char->yeux ?>" name="yeux" class="yeux" placeholder="Bleu" />
          </li>
          <li>
            <label for="peau">peau</label><input value="<?= $char->peau ?>" name="peau" class="peau" placeholder="Blanc mat" />
          </li>
          <li>
            <label for="cheveux">cheveux</label><input value="<?= $char->cheveux ?>" name="cheveux" class="cheveux" placeholder="Bruns" />
          </li>
        </ul>
      </section>
    </header>

    <main>

      <section>
        <section class="background">
          <section class="apparence">
            <div>
              <label for="apparence">Apparence du personnage</label><textarea name="apparence" class="apparence"><?= $char->apparence ?></textarea>
            </div>
          </section>
          <section class="histoire">
            <div>
              <label for="histoire">histoire du personnage</label><textarea name="histoire" class="histoire"><?= $char->histoire ?></textarea>
            </div>
          </section>
        </section>

      </section>
      <article>
        <section class="allies">
          <div>
            <label for="allies">alliés et organisations</label><textarea name="allies" class="allies"><?= $char->allies ?></textarea>
          </div>
        </section>
        <section class="traitsSup">
          <div>
            <label for="traitsSup">traits et aptitudes supplémentaires</label><textarea name="traitsSup" class="traitsSup"><?= $char->traitsSup ?></textarea>
          </div>
        </section>
        <section class="tresor">
          <div>
            <label for="tresor">trésor</label><textarea name="tresor" class="tresor"><?= $char->tresor ?></textarea>
          </div>
        </section>
      </article>
    </main>
  </form>

  <form class="charsheet sheetForm">
    <header>
      <section class="charname">
        <label for="charname">Nom du personnage</label><input value="<?= $char->nomPerso ?>" class="nomPerso" name="charname" placeholder="Thoradin Forgefeu" />
      </section>
      <section class="misc">
        <ul>
          <li>
            <label for="caracIncantation">Caractéristique d'incantation</label><input value="<?= $char->caracIncantation ?>" class="caracIncantation" name="caracIncantation" placeholder="SAG" />
          </li>
          <li>
            <label for="ddSauvegardeSort">DD des JdS contre les sorts</label><input value="<?= $char->ddSauvegardeSort ?>" name="ddSauvegardeSort" class="ddSauvegardeSort" placeholder="14" />
          </li>
          <li>
            <label for="bonusAttaqueSort">Bonus d'attaque des sorts</label><input value="<?= $char->bonusAttaqueSort ?>" name="bonusAttaqueSort" class="bonusAttaqueSort" placeholder="+5" />
          </li>
        </ul>
      </section>
    </header>
    <main>
      <section>
        <section class="sort sort-0">
          <div>
            <label for="sort-0">Tours de magie</label><textarea name="sort-0" class="sort-0"><?= $char->sorts->lvl0 ?></textarea>
          </div>
        </section>
        <section class="sort sort-1">
          <div>
            <label for="sort-1">Niveau 1</label><textarea name="sort-1" class="sort-1" placeholder="Nom du sort"><?= $char->sorts->lvl1 ?></textarea>
          </div>
        </section>
        <section class="sort sort-2">
          <div>
            <label for="sort-2">Niveau 2</label><textarea name="sort-2" class="sort-2"><?= $char->sorts->lvl2 ?></textarea>
          </div>
        </section>
      </section>
      <section>
        <section class="sort sort-3">
          <div>
            <label for="sort-3">Niveau 3</label><textarea name="sort-3" class="sort-3"><?= $char->sorts->lvl3 ?></textarea>
          </div>
        </section>
        <section class="sort sort-4">
          <div>
            <label for="sort-4">Niveau 4</label><textarea name="sort-4" class="sort-4"><?= $char->sorts->lvl4 ?></textarea>
          </div>
        </section>
        <section class="sort sort-5">
          <div>
            <label for="sort-5">Niveau 5</label><textarea name="sort-5" class="sort-5"><?= $char->sorts->lvl5 ?></textarea>
          </div>
        </section>
      </section>
      <section>
        <section class="sort sort-6">
          <div>
            <label for="sort-6">Niveau 6</label><textarea name="sort-6" class="sort-6"><?= $char->sorts->lvl6 ?></textarea>
          </div>
        </section>
        <section class="sort sort-7">
          <div>
            <label for="sort-7">Niveau 7</label><textarea name="sort-7" class="sort-7"><?= $char->sorts->lvl7 ?></textarea>
          </div>
        </section>
        <section class="sort sort-8">
          <div>
            <label for="sort-8">Niveau 8</label><textarea name="sort-8" class="sort-8"><?= $char->sorts->lvl8 ?></textarea>
          </div>
        </section>
        <section class="sort sort-9">
          <div>
            <label for="sort-9">Niveau 9</label><textarea name="sort-9" class="sort-9"><?= $char->sorts->lvl9 ?></textarea>
          </div>
        </section>
      </section>
    </main>
  </form>
  <video <?= (isset($_SESSION['mute']) && $_SESSION['mute'] ? "muted" : "") ?> class="son" hidden autoplay>
    <source src="../_sounds/lol.mp3" type="audio/mpeg" />
  </video>
  <!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
  <script src="../../_js/charSheet.js"></script>
  <script>
    changeBonuses();

    function Save() {
      let objCurrent = exportObj();
      fetch("../../_func/saveJson.php", {
        method: "POST",
        body: JSON.stringify({
          "file": '../deuneudeu/perso/<?= $json ?>',
          'data': objCurrent
        })
      }).then(function(res) {
        alert('Sauvegarde effectuée');
      });
    }

    function Delete() {
      if (window.confirm("Veux-tu vraiment supprimer ?\nLe fichier sera perdu définitivement.")) {
        fetch("../../_func/deleteJson.php", {
          method: "POST",
          body: JSON.stringify({
            "file": '../deuneudeu/perso/<?= $json ?>'
          })
        }).then(function(res) {
          window.location = "../index.php";
        });
      }
    }

    function Print() {
      ui.hidden = true;
      window.print();
      ui.removeAttribute("hidden");
    }
  </script>

</body>

</html>