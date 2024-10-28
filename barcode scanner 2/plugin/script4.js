function headpat() {
    const img = document.getElementById('image');
    const src = img.src;
    img.classList.add('animate');
    newsrc = src.replace(/1\.png$/, '2.png');
    img.src = newsrc;

    img.addEventListener('animationend', () => {
        img.classList.remove('animate');
        img.src = newsrc.replace(/2\.png$/, '1.png');
    }, { once: true });
}