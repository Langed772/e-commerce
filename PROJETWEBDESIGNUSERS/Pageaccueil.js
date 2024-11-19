document.addEventListener('DOMContentLoaded', function () {
    const categories = ['CATEGORIES', 'NOUVEAUTÉS', 'PROMOTION', 'OFFRES PARTENAIRES', 'À PROPOS'];
    const carouselItems = document.querySelectorAll('.carousel-item');
    let currentIndex = 0;
    const intervalTime = 3000;
  
    // Auto-switch carousel every 3 seconds
    setInterval(() => {
      carouselItems[currentIndex].classList.remove('active');
      currentIndex = (currentIndex + 1) % carouselItems.length;
      carouselItems[currentIndex].classList.add('active');
    }, intervalTime);
  
    // Add event listener to categories for navigation
    const navItems = document.querySelectorAll('#navbar span');
    navItems.forEach((item, index) => {
      item.addEventListener('click', () => {
        console.log(`Naviguer vers ${categories[index]}`);
      });
    });
  
    // Button click event
    const connectButton = document.getElementById('connect-button');
    connectButton.addEventListener('click', () => {
      console.log('Bouton CONNECTER-VOUS cliqué');
    });
  });

  document.addEventListener('DOMContentLoaded', function () {
    // Actions des boutons de la nav bar
    const searchButton = document.getElementById('search-button');
    const loginButton = document.getElementById('login-button');
    const cartButton = document.getElementById('cart-button');
  
    searchButton.addEventListener('click', () => {
      console.log('Recherche activée');
      // Implémentez ici l'activation de la barre de recherche
    });
  
    loginButton.addEventListener('click', () => {
      console.log('Connexion activée');
      // Implémentez ici la redirection ou la gestion de la connexion
    });
  
    cartButton.addEventListener('click', () => {
      console.log('Accéder au panier');
      // Implémentez ici l'accès au panier d'achats
    });
  });
  
 
  // Sélection des éléments de la page
  const searchButton = document.getElementById('search-button');
  const searchBar = document.getElementById('search-bar input');
  const productCards = document.querySelectorAll('.product-card');

  // Ajouter un événement pour la recherche en temps réel
  searchBar.addEventListener('input', function () {
    const searchTerm = searchBar.value.toLowerCase();
    productCards.forEach(card => {
      const productName = card.getAttribute('data-name').toLowerCase();
      if (productName.includes(searchTerm)) {
        card.style.display = 'block'; // Afficher le produit correspondant
      } else {
        card.style.display = 'none';  // Masquer les produits non correspondants
      }
    });
  });
  
  // Activer/désactiver la barre de recherche avec un bouton
  searchButton.addEventListener('click', function () {
    const searchBarContainer = document.getElementById('search-bar');
    searchBarContainer.classList.toggle('active'); // Affiche ou masque la barre de recherche
  });

  window.onload = function() {
    alert("Bienvenue sur BKJA Électroménagers !");
};