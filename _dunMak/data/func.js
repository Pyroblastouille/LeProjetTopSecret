console.log("func.js loaded");
function rollDice(sides) {
    return random(1, sides);
}
function random(min, max) {
    return Math.round(Math.random() * (max - min) + min);
}