document.addEventListener('DOMContentLoaded', () => {
    const audio = document.getElementById('audio');
    alert("lol");
    audio.play().catch(error => {
        console.error("Error playing audio:", error);
    });
});