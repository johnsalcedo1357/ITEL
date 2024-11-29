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
        document.addEventListener('click', handleClickOutside);
    }, 10);
}

function handleClickOutside(event) {
    const div = document.getElementById('window');
    const click = div.contains(event.target);
    if (!click) {
        div.style.display = 'none';
        document.removeEventListener('click', handleClickOutside);
    }
}