var circle = document.getElementById('circle');

document.addEventListener('mousemove', function(e) {
  circle.style.left = e.pageX + 'px';
  circle.style.top = e.pageY + 'px';
});