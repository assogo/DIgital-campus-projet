USE elevage_poisson_db;

CREATE TABLE connexions_utilisateurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    utilisateur_id INT NOT NULL,
    adresse_ip VARCHAR(45) NOT NULL,
    agent_utilisateur TEXT NOT NULL,
    date_connexion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (utilisateur_id) REFERENCES utilisateurs(id)
);
