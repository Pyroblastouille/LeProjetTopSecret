function toggleUI() {
    let ui = document.getElementsByClassName('content')[0];
    console.log(ui.hidden);
    if (ui.hidden) {
        ui.removeAttribute('hidden');
    } else {
        ui.hidden = true;
    }
}

function getContent(url) {
    fetch(url).then(resp => resp.text()).then(function(content) {
        let contentClass = document.getElementsByClassName('content')[0];
        contentClass.innerHTML = content;
    });
}

function mute() {
    let audios = document.getElementsByClassName('son');
    for (let i = 0; i < audios.length; i++) {
        const el = audios[i];

        if (el.paused) {
            el.play();
        } else {
            el.pause();
        }
    }
    fetch('../_func/mute.php');
}