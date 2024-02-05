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
    console.log(document.querySelector("#search"));
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
                console.log(data);
                console.log(JSON.parse(data));
                console.log(JSON.parse(data)['playlists']);

                if (JSON.parse(data)['playlists'] != undefined) {
                    for (res of JSON.parse(data)['playlists']) {
                        var a = document.createElement("a");
                        var nom = document.createElement("p");
                        var desc = document.createElement("p");
                        var img = document.createElement("img");
                        nom.innerHTML = res['nom_playlist'];
                        desc.innerHTML = res['description_playlist'];
                        img.setAttribute("src", "./ressources/images/playlist.png");
                        a.appendChild(img);
                        a.appendChild(nom);
                        a.appendChild(desc);
                        a.setAttribute("href", "playlist.php?id=" + res['id_playlist']);
                        document.querySelector("#search_result").appendChild(a);
                    }
                }
                console.log(JSON.parse(data)['groupes']);
                if (JSON.parse(data)['groupes'] != undefined) {
                    for (res of JSON.parse(data)['groupes']) {
                        var a = document.createElement("a");
                        var nom = document.createElement("p");
                        var desc = document.createElement("p");
                        nom.innerHTML = res['nom_groupe'];
                        desc.innerHTML = res['description_groupe'];
                        a.appendChild(nom);
                        a.appendChild(desc);
                        a.setAttribute("href", "groupe.php?id=" + res['id_groupe']);
                        document.querySelector("#search_result").appendChild(a);
                    }
                }
                console.log(JSON.parse(data)['albums']);
                if (JSON.parse(data)['albums'] != undefined) {
                    for (res of JSON.parse(data)['albums']) {
                        var a = document.createElement("a");
                        var nom = document.createElement("p");
                        var img = document.createElement("img");
                        img.setAttribute("src", "./ressources/images/"+ res['image_album']);
                        nom.innerHTML = res['titre'];
                        a.appendChild(img);
                        a.appendChild(nom);
                        a.setAttribute("href", "album.php?id=" + res['id_album']);
                        document.querySelector("#search_result").appendChild(a);
                    }
                }
                console.log(JSON.parse(data)['genres']);
                if (JSON.parse(data)['genres'] != undefined) {
                    for (res of JSON.parse(data)['genres']) {
                        var a = document.createElement("a");
                        var nom = document.createElement("p");
                        var desc = document.createElement("p");
                        nom.innerHTML = res['nom_genre'];
                        desc.innerHTML = res['description_genre'];
                        a.appendChild(nom);
                        a.appendChild(desc);
                        a.setAttribute("href", "genre.php?id=" + res['id_genre']);
                        document.querySelector("#search_result").appendChild(a);
                    }
                }
            })
            .catch((error) => {
                console.error('Error:', error);
            });
        }
    });
});