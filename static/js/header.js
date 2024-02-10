var detailsSection = document.getElementById('detailsSection');

window.addEventListener('scroll', function() {
    let searchContainer = document.getElementById('search');
    let header = document.getElementById('trueHeader');
    let searchContainerTop = searchContainer.getBoundingClientRect().top;
    header.style.transition = 'background-color 0.2s ease, border-bottom 0.3s ease';
  
    if (window.pageYOffset > searchContainerTop) {
        header.style.borderBottom = '1px solid rgba(61, 61, 61, 0.8)';
    } else {
        if(detailsSection.style.display === 'none' || detailsSection.style.display === ''){
            header.style.borderBottom = '1px solid rgba(61, 61, 61, 0)';
        }
    }
  });

// BARRE DE RECHERCHE
var searchBar = document.getElementById('search');
document.addEventListener('DOMContentLoaded', function() {
    var stock = [];
    searchBar.addEventListener('input', function(e) {
        if (e.target.value == "" || e.target.value.length < 3 ) {
            searchBar.style.borderRadius = "10px";
            let searchResult = document.querySelector("#search_result");
            while (searchResult.firstChild) {
                searchResult.removeChild(searchResult.firstChild);
            }
            return;
        } else {
            searchBar.style.borderRadius = "10px 10px 0px 0px ";
            fetch('rechercheData.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'data=' + encodeURIComponent(e.target.value),
            })
            .then(response => response.text())
            .then(data => {            
                stock = data;
                let searchResult = document.querySelector("#search_result");
                while (searchResult.firstChild) {
                    searchResult.removeChild(searchResult.firstChild);
                }

                if (JSON.parse(data)['playlists'] != undefined) {
                    for (res of JSON.parse(data)['playlists']) {
                        var a = document.createElement("a");
                        a.classList.add("search__result__item");
                        var div = document.createElement("div");
                        var textDiv = document.createElement("div");
                        var nom = document.createElement("p");
                        var details = document.createElement("p");
                        var img = document.createElement("img");
                        nom.innerHTML = res['nom_playlist'];
                        details.innerHTML = "Playlsit";
                        img.setAttribute("src", "./ressources/images/playlist.png");
                        nom.style.fontWeight = "bold";
                        nom.style.textAlign = "left";
                        textDiv.appendChild(nom);
                        textDiv.appendChild(details);
                        div.appendChild(img);
                        div.appendChild(textDiv);
                        a.appendChild(div);
                        a.setAttribute("href", "playlist.php?id=" + res['id_playlist']);
                        document.querySelector("#search_result").appendChild(a);
                        
                        div.style.display = "flex";
                        div.style.alignItems = "center"; // Aligner verticalement au centre
                        div.style.width = "100%";
                        img.style.marginRight = "10px"; 
                    }
                }
                if (JSON.parse(data)['groupes'] != undefined) {
                    for (res of JSON.parse(data)['groupes']) {
                        var a = document.createElement("a");
                        a.classList.add("search__result__item");
                        var div = document.createElement("div");
                        var textDiv = document.createElement("div");
                        var nom = document.createElement("p");
                        var details = document.createElement("p");
                        var img = document.createElement("img");
                        nom.innerHTML = res['nom_groupe'];
                        nom.style.fontWeight = "bold";
                        nom.style.textAlign = "left";
                        details.innerHTML = "Artiste";
                        img.setAttribute("src", "./ressources/images/"+ res['image_groupe']);
                        img.style.width = "35px";
                        img.style.height = "auto";
                        textDiv.appendChild(nom);
                        textDiv.appendChild(details);
                        div.appendChild(img);
                        div.appendChild(textDiv);
                        a.appendChild(div);
                        a.setAttribute("href", "groupe.php?id=" + res['id_groupe']);
                        document.querySelector("#search_result").appendChild(a);

                        div.style.display = "flex";
                        div.style.alignItems = "center"; // Aligner verticalement au centre
                        div.style.width = "100%";
                        img.style.marginRight = "10px";
                    }
                }
                if (JSON.parse(data)['albums'] != undefined) {
                    for (res of JSON.parse(data)['albums']) {
                        var a = document.createElement("a");
                        a.classList.add("search__result__item");
                        var div = document.createElement("div");
                        var textDiv = document.createElement("div");
                        var nom = document.createElement("p");
                        var details = document.createElement("p");
                        var img = document.createElement("img");
                        img.setAttribute("src", "./ressources/images/"+ res['image_album']);
                        nom.innerHTML = res['titre'];
                        nom.style.fontWeight = "bold";
                        nom.style.textAlign = "left";
                        details.innerHTML = "Album • "+ res['nom_groupe'];
                        textDiv.appendChild(nom);
                        textDiv.appendChild(details);
                        div.appendChild(img);
                        div.appendChild(textDiv);
                        a.appendChild(div);
                        a.setAttribute("href", "album.php?id=" + res['id_album']);
                        document.querySelector("#search_result").appendChild(a);
                        
                        div.style.display = "flex";
                        div.style.alignItems = "center"; // Aligner verticalement au centre
                        div.style.width = "100%";
                        img.style.marginRight = "10px";
                    }
                }
                if (JSON.parse(data)['genres'] != undefined) {
                    for (res of JSON.parse(data)['genres']) {
                        var a = document.createElement("a");
                        a.classList.add("search__result__item");
                        var div = document.createElement("div");
                        var textDiv = document.createElement("div");
                        var nom = document.createElement("p");
                        var img = document.createElement("img");
                        var details = document.createElement("p");
                        img.setAttribute("src", "./ressources/images/"+ res['image_genre']);
                        nom.innerHTML = res['nom_genre'];
                        nom.style.fontWeight = "bold";
                        nom.style.textAlign = "left";
                        img.innerHTML = res['image_genre'];
                        details.innerHTML = "Genre";
                        textDiv.appendChild(nom);
                        textDiv.appendChild(details);
                        div.appendChild(img);
                        div.appendChild(textDiv);
                        a.appendChild(div);
                        a.setAttribute("href", "genre.php?id=" + res['id_genre']);
                        document.querySelector("#search_result").appendChild(a);
                        
                        div.style.display = "flex";
                        div.style.alignItems = "center"; // Aligner verticalement au centre
                        div.style.width = "100%";
                        img.style.marginRight = "10px";
                    }
                }
                if (JSON.parse(data)['musiques'] != undefined) {
                    for (res of JSON.parse(data)['musiques']) {
                        var a = document.createElement("a");
                        a.classList.add("search__result__item");
                        var div = document.createElement("div");
                        var textDiv = document.createElement("div");
                        var nom = document.createElement("p");
                        var details = document.createElement("p");
                        var img = document.createElement("img");
                        img.setAttribute("src", "./ressources/images/"+ res['image_album']);
                        nom.innerHTML = res['nom_musique'];
                        nom.style.fontWeight = "bold";
                        nom.style.textAlign = "left";
                        details.innerHTML = "Titre • "+ res['nom_groupe'];
                        textDiv.appendChild(nom);
                        textDiv.appendChild(details);
                        div.appendChild(img);
                        div.appendChild(textDiv);
                        a.appendChild(div);
                        a.setAttribute("href", "jouerMusique.php?id_musique=" + res['id_musique']);
                        a.setAttribute("id", "PlayMusique");
                        document.querySelector("#search_result").appendChild(a);
                    
                        // Apply CSS styles
                        div.style.display = "flex";
                        div.style.alignItems = "center"; // Aligner verticalement au centre
                        div.style.width = "100%";
                        img.style.marginRight = "10px"; // Ajouter une marge à l'image
                    }
                }
            })
            .catch((error) => {
                console.error('Error:', error);
            });
        }
    });
});