function createRatingSystem(ratingElement) {
    var stars = ratingElement.querySelectorAll('#ajout_note');
    stars.forEach(function(star, index) {
        star.addEventListener('mouseover', function() {
            for (var i = 0; i <= index; i++) {
                stars[i].classList.add('hover');
            }
        });
    
        star.addEventListener('mouseout', function() {
            for (var i = 0; i <= index; i++) {
                stars[i].classList.remove('hover');
            }
        });
    });
}

document.querySelectorAll('#note').forEach(createRatingSystem);