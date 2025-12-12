const logoutLink = document.getElementById('logout-link');

logoutLink.addEventListener('click', () => {
  document.getElementById('logout-form').submit();
});

