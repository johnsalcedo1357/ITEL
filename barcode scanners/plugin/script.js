document.addEventListener('DOMContentLoaded', () => {
    const audio = document.getElementById('audio');
    document.body.addEventListener('click', () => {
        audio.play().catch((error) => {
            console.log('Playback prevented:', error); // Handle any autoplay issues
        });
    }, { once: true });
});
