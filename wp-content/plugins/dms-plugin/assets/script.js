const tabs = document.querySelectorAll('.tab');
const contents = document.querySelectorAll('.tab-content');

tabs.forEach((tab, index) => {
  tab.addEventListener('click', () => {
    contents.forEach((content) => {
      content.classList.remove('active');
    });
    tabs.forEach((tab) => {
      tab.classList.remove('active');
    });
    contents[index].classList.add('active');
    tabs[index].classList.add('active');
  });
});

function hideAlert() {
  document.getElementById('alert').style.display = 'none';
}
setTimeout(hideAlert, 3000);
