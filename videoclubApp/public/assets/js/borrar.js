const aDestroys = document.querySelectorAll('.link-destroy');
const form = document.getElementById('form-delete');
const destroyModal = document.getElementById('destroyModal');

destroyModal.addEventListener('show.bs.modal', function (event) {
  const button = event.relatedTarget;
  const href = button.dataset.href;
  form.action = href;
});