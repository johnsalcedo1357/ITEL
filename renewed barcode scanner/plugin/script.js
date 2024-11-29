const div = document.getElementById('div');
const div3 = document.getElementById('div3');
const search = document.getElementById('search');
const add = document.getElementById('add');
function showsearch() {
    div.classList.add('fade');
    div.addEventListener('animationend', () => {
        div.style.display = 'none';
        search.style.display = 'block';
    }, { once: true });
}
function showadd() {
    div.classList.add('fade');
    div.addEventListener('animationend', () => {
        div.style.display = 'none';
        add.style.display = 'block';
    }, { once: true });
}
div3.addEventListener('click', (e) => {
    window.location.href = 'show.php';
});
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
        search.style.display = 'none';
        add.style.display = 'none';
        div.classList.remove('fade');
        div.style.display = 'flex';
    }
});