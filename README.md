# Secret Santa Express 🎁

Bienvenue sur **Secret Santa Express**, une application Laravel permettant d'organiser des tirages au sort de Secret
Santa de manière sécurisée et simple.

## 🚀 Fonctionnalités

- **Création de salons privés** avec mot de passe
- **Ajout de participants** avec email
- **Tirage au sort automatique**
- **Envoi de notifications** aux participants
- **Interface intuitive** et facile à utiliser

## 🛠️ Installation

### Prérequis

- PHP 8.2+
- Composer
- Node.js & npm
- Docker & Docker Compose

### Étapes d'installation

1. **Cloner le projet**
   ```bash
   git clone https://github.com/antoinegreuzard/secret-santa.git
   cd secret-santa
   ```

2. **Copier le fichier d'environnement**
   ```bash
   cp .env.example .env
   ```

3. **Installer les dépendances PHP et Node**
   ```bash
   composer install
   npm install && npm run build
   ```

4. **Générer la clé d'application**
   ```bash
   php artisan key:generate
   ```

5. **Démarrer les services Docker** (Base de données, Mailhog...)
   ```bash
   docker-compose up -d --build
   ```

6. **Exécuter les migrations et seeders**
   ```bash
   php artisan migrate --seed
   ```

7. **Lancer le serveur local**
   ```bash
   php artisan serve
   ```

L'application est accessible sur `http://localhost:8000`.

---

## 🧪 Tests

### Lancer les tests unitaires et fonctionnels

```bash
php artisan test
```

### Tester via Docker

```bash
docker exec laravel_app php artisan test
```

---

## ⚙️ CI/CD avec GitHub Actions

Le projet est entièrement automatisé avec **GitHub Actions** pour :

- **Installation** des dépendances PHP et Node
- **Build des assets** avec npm
- **Tests unitaires et fonctionnels** avec Laravel
- **Déploiement en container Docker**

### 📂 Structure des Workflows

- `install.yml` : Installation des dépendances
- `build.yml` : Compilation des assets
- `test.yml` : Exécution des tests
- `deploy.yml` : Déploiement de l'application avec Docker

---

## 📌 API Endpoints

| Méthode | Endpoint        | Description              |
|---------|-----------------|--------------------------|
| `POST`  | `/rooms`        | Créer un salon           |
| `POST`  | `/participants` | Ajouter un participant   |
| `POST`  | `/draw`         | Lancer le tirage au sort |

Exemple d'ajout de participant :

```json
{
  "name": "Alice",
  "email": "alice@example.com",
  "room_id": 1
}
```

---

## 🤝 Contribution

1. **Forker le projet**
2. **Créer une branche** (`feature/amélioration`)
3. **Soumettre une pull request** ✅

Merci pour votre contribution ! 🎄
