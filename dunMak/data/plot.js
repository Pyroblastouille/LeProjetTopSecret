console.log("plot.js loaded");

function getPlotHook(d20) {
    let ret = "";
    switch (true) {
        case (d20 <= 6):
            ret = "GOLD AND GLORY - The Dungeon is rumoured to be full of both treasure to loot and enemies to defeat.";
            break;
        case (d20 <= 10):
            ret = "PROTECT CIVILISATION - The local population centre is threatened by the presence of the Dungeon, the common folk seek the Characters aid.";
            break;
        case (d20 <= 12):
            ret = "REWARD - An authority want the Dungeon dealt with in some manner and are willing to pay.";
            break;
        case (d20 == 13):
            ret = "ITEM(S) - There is an item or item(s) in the Dungeon that are desirable. This could be anything from legendary artifacts, ancient tomes or even rare mushrooms required for a plague cure.";
            break;
        case (d20 == 14):
            ret = "RESCUE - Someone or multiple people are held prisoner within the Dungeon and the Characters have reason to try and rescue them.";
            break;
        case (d20 == 15):
            ret = "RECOVERY - Item(s) have been stolen and carried in to the Dungeon. Either they are important to the Characters or a reward is being offered for the safe return of the item(s).";
            break;
        case (d20 == 16):
            ret = "INVESTIGATION - A mystery needs solving and the answer looks to be found in the Dungeon. This could be anything from a murder, evidence required for a truce or even seeking the knowledge required for a magical ritual.";
            break;
        case (d20 == 17):
            ret = "COMPETITION - There is a competition to see who can conquer the Dungeon first and fastest.";
            break;
        case (d20 == 18):
            ret = "SLAYERS - A monster that terrorizes the land must be slain.";
            break;
        case (d20 == 19):
            ret = "PRISON BREAK - The Characters have been captured somehow and start in the depths of the Dungeon.";
            break;
        case (d20 == 20):
            ret = "QUEST - An item must be taken to the very heart of the Dungeon to complete a ritual or prophecy.";
            break;
    }
    return ret;
} function getLocation(d20) {
    ret = "";
    switch (true) {
        case (d20 <= 5):
            ret = "WILDERNESS RUINS - The Dungeon is a few days travel from civilized lands in temperate but remote wilderness."; break;
        case (d20 <= 8):
            ret = "CLOSE TO TOWN - The Dungeon is a short travel distance from a settled community."; break;
        case (d20 <= 10):
            ret = "DEEP UNDERGROUND - The Dungeon is part of a larger underground landscape."; break;
        case (d20 <= 12):
            ret = "URBAN - The Dungeon is accessed directly from within an urban environment."; break;
        case (d20 == 13):
            ret = "FREEZING WASTES - The Dungeon is found in an extreme cold climate."; break;
        case (d20 == 14):
            ret = "BURNING SANDS - The Dungeon is found in an extreme hot climate."; break;
        case (d20 == 15):
            ret = "JUNGLE DEPTHS - The Dungeon is found deep within a lush jungle."; break;
        case (d20 == 16):
            ret = "MOVING CITY - The Dungeon is part of a moving environment, such as on the back of a vast creature or via huge wheeled tracks."; break;
        case (d20 == 17):
            ret = "FLYING - The Dungeon is part of a floating landmass and is very high up in the air."; break;
        case (d20 == 18):
            ret = "SINKING - The Dungeon is slowly sinking, either in to a swamp, the ocean or even a sea of sand or lava."; break;
        case (d20 == 19):
            ret = "DREAM WORLD - The Dungeon can only be accessed via sleep rituals and it’s not clear if whatever happens inside is real."; break;
        case (d20 == 20):
            ret = "POCKET REALITY - The Dungeon exists inside it’s own magic realm, such as the inside of a crystal ball."; break;
    }
    return ret;
} 

function getVariation(d20) {

    ret = "";
    switch (true) {
        case (d20 <= 10):
            ret = "STANDARD DUNGEON - No variation.";
            break;
        case (d20 == 11):
            ret = "WAR CAMP - Dungeon has organised enemies encamped within – Wandering patrols, alarms, reinforcements, Denizens are friendly with most Beasts and Monsters";
            break;
        case (d20 == 12):
            ret = "DEATHTRAP - Dungeon is full of traps - Replace any Interaction encounters with Trap encounters and add a Trap Encounter to all Intrigue and Boon encounters.";
            break;
        case (d20 == 13):
            ret = "OPEN AIR RUINS - Dungeon has no roof; walls can be climbed and weather may be a factor.";
            break;
        case (d20 == 14):
            ret = "GAUNTLET ARENA - Dungeon is actually a contest area, replace any Intrigue encoun ters with a Trap and replace any Interaction encounters with an Enemy encounter.";
            break;
        case (d20 == 15):
            ret = "SHIFTING LAYOUT - Dungeon changes lay out at regular intervals, rearrange the books/ VTT-tiles after every two or four encounters.";
            break;
        case (d20 == 16):
            ret = "SUMMONERS PLAYGROUND - Dungeon is controlled by a powerful being for their own entertainment, replace Denizen keyword with Monster keyword. Monster and beasts are friendly with each other.";
            break;
        case (d20 == 17):
            ret = "UNSTABLE ENVIRONMENT - Dungeon is prone to Environmental effects, roll an Envi ronmental encounter for each Dungeon Tile.";
            break;
        case (d20 == 18):
            ret = "MENAGERIE - Dungeon has no Denizens, but more Beasts. Replace Denizen keyword with Beast keyword in encounters.";
            break;
        case (d20 == 19):
            ret = "NEVER ENDING - Dungeon continues with out end - Don’t determine Dungeon Size, just create a new area each time an area is exited.";
            break;
        case (d20 == 20):
            ret = "FUN-HOUSE - A very active dungeon - roll twice for each encounter and combine the results!";
            break;
    }
    return ret;
}
function getVariation(d20) {

    ret = "";
    switch (true) {
        case (d20 <= 5):
            ret = "ANCIENT RUINS - This place has fallen in to ruin since the collapse of an ancient civilisation.";
            break;
        case (d20 <= 7):
            ret = "RECENT RUINS - This used to be a thriving settlement until plague or natural disaster left it deserted.";
            break;
        case (d20 <= 9):
            ret = "HIDEOUT - The Dungeon was build by a secret or criminal organisation.";
            break;
        case (d20 <= 11):
            ret = "OCCUPIED FORTRESS - This one time bastion defending civilised lands has fallen to Denizen or Monstrous forces.";
            break;
        case (d20 <= 13):
            ret = "DENIZEN SETTLEMENT - This Dungeon is home to a full settlement of Denizens";
            break;
        case (d20 <= 15):
            ret = "CATACOMBS - A purpose build tomb and temple complex.";
            break;
        case (d20 == 16):
            ret = "GATEWAY - The Dungeon is a known place of magical power with a gateway to beyond rumoured to be at it’s heart.";
            break;
        case (d20 == 17):
            ret = "REVEALED SECRET - This dungeon was unknown until recent activity uncovered it, maybe a branch of a mine or a sewer expansion revealed it’s chambers.";
            break;
        case (d20 == 18):
            ret = "CURSED - An old curse led to this place becoming abandoned.";
            break;
        case (d20 == 19):
            ret = "FOLLY - The Dungeon is the construct of noble, magic user or other group.";
            break;
        case (d20 == 20):
            ret = "RITUAL CONSTRUCT - The Dungeons very layout is all part of some great ritual.";
            break;
    }
    return ret;
}