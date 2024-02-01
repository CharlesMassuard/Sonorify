// CERCLE SUIT POINTEUR SOURIS
let circle = document.getElementById('circle');
let mouseX = 0, mouseY = 0;

window.addEventListener('mousemove', function(e) {
    mouseX = e.clientX;
    mouseY = e.clientY;
    updateCirclePosition();
});

window.addEventListener('scroll', updateCirclePosition);

function updateCirclePosition() {
    circle.style.left = (window.scrollX + mouseX) + 'px';
    circle.style.top = (window.scrollY + mouseY) + 'px';
}

// MENU EN HAUT
window.addEventListener('scroll', function() {
  let searchContainer = document.getElementById('search');
  let header = document.querySelector('header');
  let searchContainerTop = searchContainer.getBoundingClientRect().top;

  if (window.pageYOffset > searchContainerTop) {
      header.style.backgroundColor = 'rgba(0, 0, 0, 1)';
      header.style.borderBottom = '1px solid rgba(61, 61, 61, 0.8)';
  } else {
      header.style.backgroundColor = 'rgba(0, 0, 0, 0)';
      header.style.borderBottom = '1px solid rgba(61, 61, 61, 0)';
  }
});