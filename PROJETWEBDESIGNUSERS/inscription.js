document.addEventListener('DOMContentLoaded', function () {
    const signupForm = document.getElementById('form-signup');
    const signinForm = document.getElementById('form-signin');
    const signupToggle = document.getElementById('toggle-signup');
    const signinToggle = document.getElementById('toggle-signin');

    // Par défaut, le formulaire d'inscription est visible, et celui de connexion est caché
    signinForm.style.display = 'none';

    // Lorsque tu cliques sur "Inscription"
    signupToggle.addEventListener('click', function () {
        signinForm.style.display = 'none';  // Masque le formulaire de connexion
        signupForm.style.display = 'block'; // Affiche le formulaire d'inscription
        signupToggle.classList.add('active');
        signinToggle.classList.remove('active');
    });

    // Lorsque tu cliques sur "Connexion"
    signinToggle.addEventListener('click', function () {
        signupForm.style.display = 'none';  // Masque le formulaire d'inscription
        signinForm.style.display = 'block'; // Affiche le formulaire de connexion
        signinToggle.classList.add('active');
        signupToggle.classList.remove('active');
    });
});

// inscription.js

document.addEventListener('DOMContentLoaded', () => {
    const signupForm = document.querySelector('.sign-up-container form');

    signupForm.addEventListener('submit', function(event) {
        event.preventDefault(); // Empêche le rechargement de la page
        
        const nom = this.nom.value;
        const prenom = this.prenom.value;
        const email = this.email.value;

        // Stocker les informations dans localStorage
        localStorage.setItem('nom', nom);
        localStorage.setItem('prenom', prenom);
        localStorage.setItem('email', email);

        // Optionnel : rediriger vers la page de l'espace utilisateur
        window.location.href = 'monespace.html';
    });
});
