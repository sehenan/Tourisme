
// cacher le formulaire 
function afficherFormulaire() {
    var formulaire = document.getElementById("formulaire");
    formulaire.style.display = "block";
    formulaire.style.zIndex = "1000";
    document.addEventListener("click", cacherFormulaireAuClicExterieur);
}

function cacherFormulaireAuClicExterieur(event) {
    var formulaire = document.getElementById("formulaire");
    var monCompteLink = document.querySelector("a");

    if (!formulaire.contains(event.target) && event.target !== monCompteLink) {
        formulaire.style.display = "none";
        document.removeEventListener("click", cacherFormulaireAuClicExterieur);
    }
}

// afficher l'image
function afficherImage(input) {
    var photoProfil = document.getElementById("photoProfil");
    var file = input.files[0];

    if (file) {
        var reader = new FileReader();
        reader.onload = function (e) {
            photoProfil.src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
}

// choisir l'image
function choisirImage() {
    document.getElementById("inputImage").click();
}


// la recherche sur le site
async function rechercheMot() {
    let keyword = document.getElementById('idRecherche').value.trim();
    const reponse = document.querySelector('.reponse');

    // Si le champ de recherche est vide, vider les résultats et cacher la section des résultats
    if (keyword === '') {
        reponse.innerHTML = '';
        reponse.style.display = 'none';
        return;
    }

    const req = await fetch(`search.php?idRecherche=${keyword}`);
    const json = await req.json();

    // Vider le contenu de la section des résultats
    reponse.innerHTML = '';

    if (json.length > 0) {
        json.forEach((post) => {
            // Créer des liens pour chaque résultat
            const link = document.createElement('a');
            link.href = post.slug; // Diriger l'utilisateur vers la partie correspondante du site
            link.textContent = post.nomUser;
            reponse.appendChild(link);
            reponse.appendChild(document.createElement('br'));
        });
        // Afficher la section des résultats
        reponse.style.display = 'block';
        reponse.style.color = 'white';
        reponse.style.backgroundColor = 'gray';
        // Diriger l'utilisateur vers la section des résultats sur la page
        window.location.href = '#resultats';
    } else {
        reponse.style.display = 'none';
    }
}

// Utiliser l'événement 'input' pour détecter les changements dans le champ de recherche
document.getElementById('idRecherche').addEventListener('input', rechercheMot);
