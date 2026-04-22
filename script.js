let currentFontSize = 16;
function changeFontSize(action) {
    currentFontSize += (action === 'increase') ? 2 : -2;
    document.body.style.fontSize = currentFontSize + 'px';
}

function readText(id) {
    const text = document.getElementById(id).innerText;
    const msg = new SpeechSynthesisUtterance(text);
    msg.lang = 'en-US';
    window.speechSynthesis.speak(msg);
}

document.getElementById('clubSearch').addEventListener('input', function(e) {
    const term = e.target.value.toLowerCase();
    document.querySelectorAll('.club-card').forEach(card => {
        const name = card.querySelector('h2').innerText.toLowerCase();
        card.style.display = name.includes(term) ? 'block' : 'none';
    });
});