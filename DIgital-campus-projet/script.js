document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault();  // Empêche l'envoi du formulaire pour validation

    // Récupérer les valeurs des champs
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    
    // Valider les champs (vous pouvez ajouter plus de vérifications ici)
    if (username === '' || password === '') {
        document.getElementById('error-message').textContent = 'Veuillez remplir tous les champs.';
    } else {
        // Simuler la vérification des identifiants
        // Remplacez ces valeurs par une vérification côté serveur dans un projet réel
        const validUsername = 'admin';
        const validPassword = 'motdepasse';

        if (username === validUsername && password === validPassword) {
            window.location.href = 'index.html';  // Rediriger vers la page d'accueil si la connexion est réussie
        } else {
            document.getElementById('error-message').textContent = 'Nom d\'utilisateur ou mot de passe incorrect.';
        }
    }
});
