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
