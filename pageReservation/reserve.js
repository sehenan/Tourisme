// nav

// afficher le formulaire
function afficherFormulaire() {
    var formulaire = document.getElementById("formulaire");
    formulaire.style.display = "block";
    document.addEventListener("click", cacherFormulaireAuClicExterieur);
}

function cacherFormulaireAuClicExterieur(e) {
    var formulaire = document.getElementById("formulaire");
    var monCompteLink = document.querySelector("a");

    if (!formulaire.contains(e.target) && e.target !== monCompteLink) {
        formulaire.style.display = "none";
        document.removeEventListener("click", cacherFormulaireAuClicExterieur);
    }
}

// le recherche
document.getElementById('search-input').addEventListener('input', function () {
    // Récupérez la valeur de recherche depuis #search-input
    var searchTerm = this.value;

    // Ajoutez la logique de recherche ici, par exemple, affichez les résultats
    console.log('Recherche en cours : ' + searchTerm);
});

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

//annimations sur l'image
const cadre1 = document.querySelector('cadre1')
const image = document.querySelector('.cadre1 img');
image.addEventListener('mouseover', () => {
    image.style.transform = 'scale(1.6)';
})
image.addEventListener('mouseout', () => {
    image.style.transform = 'scale(1)';
});
image.style.transition = 'transform 0.3s ease-in-out';

// integration de l'api

function checkout() {
    const amount = document.getElementById('amount').value;
    const currency = document.getElementById('currency').value;
    // const customer_name = document.getElementById('nom').value;
    // const customer_surname = document.getElementById('prenom').value;
    // const time = document.getElementById('duree').value;
    // const date = document.getElementById('date').value;

    // const customer_email = document.getElementById('customerEmail').value;
    // const customer_phone_number = document.getElementById('customerPhoneNumber').value;
    // const customer_address = document.getElementById('customerAddress').value;
    // const customer_city = document.getElementById('customerCity').value;
    // const customer_country = document.getElementById('customerCountry').value;
    // const customer_state = document.getElementById('customerState').value;
    // const customer_zip_code = document.getElementById('customerZipCode').value;

    CinetPay.setConfig({
        apikey: '207319883265cdf98055a9a7.79773116',
        site_id: 5868567,
        notify_url: 'https://api-checkout.cinetpay.com/v2/payment/check',
        mode: 'PRODUCTION',
    });
    CinetPay.waitResponse(function (data) {
        // En cas d'échec
        if (data.status == "REFUSED") {
            if (alert("Votre paiement a échoué")) {
                window.location.reload();
            }
        }
        // En cas de succès
        else if (data.status == "ACCEPTED") {
            if (alert("Votre paiement a été effectué avec succès")) {
                // correct, on delivre le service
                window.location.reload();
            }
        }
    });
    CinetPay.getCheckout({
        transaction_id: Math.floor(Math.random() * 100000000).toString(), // YOUR TRANSACTION ID
        amount: amount,
        currency: currency,
        channels: 'ALL',
        description: 'Test de paiement',
        // customer_name: customer_name,
        // customer_surname: customer_surname,
        // date: date,
        // time: time,
        // customer_email: customer_email,
        // customer_phone_number: customer_phone_number,
        // customer_address: customer_address,
        // customer_city: customer_city,
        // customer_email: customer_email,
        // customer_phone_number: customer_phone_number,
        // customer_address: customer_address,
        // customer_city: customer_city,
        // customer_country: customer_country,
        // customer_state: customer_state,
        // customer_zip_code: customer_zip_code
    });
    CinetPay.waitResponse(function (data) {
        if (data.status == "REFUSED") {
            if (alert("Votre paiement a échoué")) {
                window.location.reload();
            }
        } else if (data.status == "ACCEPTED") {
            if (alert("Votre paiement a été effectué avec succès")) {
                window.location.reload();
            }
        }
    });
    CinetPay.onError(function (data) {
        console.log(data);
    });
}
