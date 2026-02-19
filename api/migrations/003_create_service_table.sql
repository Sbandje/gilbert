-- Table service
CREATE TABLE IF NOT EXISTS service (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255) NOT NULL UNIQUE,
    description TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Ajouter la clé étrangère dans la table produits
ALTER TABLE produits
ADD COLUMN IF NOT EXISTS service_id INT,
ADD CONSTRAINT fk_produits_service 
FOREIGN KEY (service_id) REFERENCES service(id) ON DELETE SET NULL;

-- Index pour la recherche par service
CREATE INDEX idx_produits_service ON produits (service_id);
