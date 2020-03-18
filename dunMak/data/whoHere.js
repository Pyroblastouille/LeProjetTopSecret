console.log("whoHere.js loaded");

function getBoss(d20) {

    ret = "";
    switch (true) {
        case (d20 <= 2):
            ret = "WARRIOR LORD - The Dungeon Boss is a mighty warrior Denizen.";
            break;
        case (d20 <= 4):
            ret = "MAGE LORD - The Dungeon Boss is a powerful spell casting Denizen.";
            break;
        case (d20 <= 6):
            ret = "PRIEST LORD - The Dungeon Boss is a chosen of the Denizen god(s).";
            break;
        case (d20 <= 8):
            ret = "MONSTROUS OVERLORD - The Dungeon Boss is a potent monster.";
            break;
        case (d20 <= 10):
            ret = "MASTERMIND - The Dungeon Boss is a bril liant non-denizen humanoid that has managed to take over this Dungeon.";
            break;
        case (d20 <= 12):
            ret = "RELUCTANT TYRANT - This Dungeon Boss would be an important friendly NPC acting under evil influences, either magical or mundane.";
            break;
        case (d20 <= 14):
            ret = "THE COUNCIL - The Dungeon Boss is actually a group of Denizens.";
            break;
        case (d20 <= 16):
            ret = "OUTSIDER - The Dungeon Boss is a Demon, Devil or similar.";
            break;
        case (d20 <= 18):
            ret = "PUPPETMASTER - This Dungeon Boss is incorporeal and possesses hosts.";
            break;
        case (d20 == 19):
            ret = "THE TWINS - The Dungeon Boss is actual a pair of overpowering Denizens, one a Warrior Lord and the other a Mage Lord.";
            break;
        case (d20 == 20):
            ret = "POWER BEHIND THE THRONE - This Dungeon Boss is just the public face for the real Dungeon Boss; roll again for both the public boss and the real boss who’ll reveal themselves if the situation calls for it.";
            break;
    }
    return ret;
}

function getLair(d20) {

    ret = "";
    switch (true) {
        case (d20 <= 2):
            ret = "KENNEL MASTER - The Dungeon Boss- es lair has access to [Easy] beasts that are [Beyond Count].";
            break;
        case (d20 <= 4):
            ret = "TRAP MASTER - The Dungeon Bosses lair has multiple traps.";
            break;
        case (d20 <= 6):
            ret = "HONOUR GUARD - The Dungeon Boss has a guard consisting of an [Equal] sized group of [Elite] Denizens.";
            break;
        case (d20 <= 8):
            ret = "BEAST MASTER - The Dungeon Boss has an [Equal] number of [Elite] Beasts as companions.";
            break;
        case (d20 <= 10):
            ret = "MONSTROUS GUARDS - The Dungeon Boss has a [Small] number of [Elite] Monsters as guards.";
            break;
        case (d20 <= 12):
            ret = "MINION SHIELD - The Dungeon Boss has a [Horde] of [Easy] Minions that will sacrifice themselves to protect their Boss.";
            break;
        case (d20 <= 14):
            ret = "MOUNTED - The Dungeon Boss is mounted on an [Elite] Monster or Beast that increases their mobility significantly either just by increased movement or special movement, like flying.";
            break;
        case (d20 <= 16):
            ret = "WAR MACHINE - The Dungeon Boss has a war machine, a mechanical or magical construct that increases their armour and has significant weapon attacks.";
            break;
        case (d20 <= 18):
            ret = "SEAT OF POWER - The Dungeon Bosses lair has an item or area that can heal and recharge the Dungeon Boss.";
            break;
        case (d20 == 19):
            ret = "PROTECTION RITUAL - The Dungeon Bosses lair has an area with powerful protective magic that only protects the Dungeon Boss.";
            break;
        case (d20 == 20):
            ret = "TRUE FORM - The Dungeon Boss returns as an even more powerful version of itself when killed.";
            break;
    }
    return ret;
}