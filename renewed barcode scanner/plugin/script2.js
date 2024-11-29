function close(event) {
    const div = document.getElementById('window');
    const div2 = document.getElementById('window2');
    const div3 = document.getElementById('window3');

    const click = div.contains(event.target);
    const click2 = div2.contains(event.target);
    const click3 = div3.contains(event.target);

    if (!click) {
        div.style.display = 'none';
    }
    if (!click2) {
        div2.style.display = 'none';
    }
    if (!click3) {
        div3.style.display = 'none';
    }

    if (!click && !click2 && !click3) {
        document.removeEventListener('click', close);
    }
}

function show(itemname, itemprice, itemid) {
    const div = document.getElementById('window');
    const name = document.getElementById('itemname');
    const price = document.getElementById('itemprice');
    const id = document.getElementById('itemid');

    name.value = itemname;
    price.value = itemprice;
    id.value = itemid;

    div.style.display = 'block';
    setTimeout(() => {
        document.addEventListener('click', close);
    }, 10);
}

function showadd() {
    const div = document.getElementById('window2');
    div.style.display = 'block';
    setTimeout(() => {
        document.addEventListener('click', close);
    }, 10);
}

function showsearch() {
    const div = document.getElementById('window3');
    div.style.display = 'block';
    setTimeout(() => {
        document.addEventListener('click', close);
    }, 10);
}

function index() {
    window.location.href = 'index.php';
}