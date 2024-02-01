document.addEventListener('DOMContentLoaded', function() {
    console.log(document.querySelector("#search"));
    var stock = [];
    document.querySelector("#search").addEventListener('input', function(e) {
        if (e.target.value == "" || e.target.value.length < 3 ) {
            let searchResult = document.querySelector("#search_result");
            while (searchResult.firstChild) {
                searchResult.removeChild(searchResult.firstChild);
            }
            return;
        } else {
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
                        nom.innerHTML = res['nom_playlist'];
                        desc.innerHTML = res['description_playlist'];
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
                        var desc = document.createElement("p");
                        nom.innerHTML = res['nom_album'];
                        desc.innerHTML = res['description_album'];
                        a.appendChild(nom);
                        a.appendChild(desc);
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