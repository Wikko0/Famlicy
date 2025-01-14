function toggleMenu() {
    const menu = document.getElementById('dropdownMenu');
    menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
}

document.addEventListener('click', function (event) {
    const menu = document.getElementById('dropdownMenu');
    const userDetails = document.querySelector('.user-details');

    if (!userDetails.contains(event.target)) {
        menu.style.display = 'none';
    }
});

document.querySelector('.notification-icon').addEventListener('click', function() {
    var menu = document.getElementById('notification-dropdown');
    menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
});
