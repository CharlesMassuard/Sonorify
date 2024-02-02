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
    if(mouseX < window.innerWidth - 120) {
      circle.style.left = (window.scrollX + mouseX) + 'px';
    } 
    if(mouseY < window.innerHeight - 120) {
      circle.style.top = (window.scrollY + mouseY) + 'px';
    }
}