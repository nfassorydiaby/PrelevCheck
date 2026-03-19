# 🔍 PrelevCheck

> **Tu colles un nom de prélèvement → tu sais immédiatement ce que c'est.**

PrelevCheck est un outil web qui permet d'identifier instantanément l'origine d'un prélèvement bancaire inconnu. Fini le stress face à un libellé cryptique sur ton relevé de compte.

---

## ✨ Fonctionnalités

- 🔎 **Recherche instantanée** — colle le nom brut du prélèvement, obtiens une réponse en < 3s
- 🧠 **Identification intelligente** — normalisation + cache + base de données + IA en fallback
- 📊 **Niveau de confiance** — faible / moyen / élevé pour chaque résultat
- 🌐 **Pages SEO dynamiques** — `/prelevement/nom-du-prelevement` pour chaque entrée connue
- 💾 **Apprentissage continu** — chaque recherche enrichit la base

---

## 🏗️ Stack technique

| Couche | Techno |
|--------|--------|
| Backend | Symfony 7 (PHP 8.3) |
| Frontend | Twig |
| Base de données | PostgreSQL 16 |
| Cache | Redis 7 |
| IA fallback | OpenAI API |
| Infra | Docker |

---

## 🚀 Lancer le projet en local

### Prérequis

- Docker & Docker Compose
- Git

### Installation

```bash
# 1. Cloner le repo
git clone https://github.com/nfassorydiaby/PrelevCheck.git
cd PrelevCheck

# 2. Configurer l'environnement
cp .env.example .env
# → Renseigner OPENAI_API_KEY dans .env

# 3. Lancer les containers
docker compose up -d

# 4. Installer les dépendances
docker compose exec app composer install

# 5. Créer la base de données
docker compose exec app php bin/console doctrine:migrations:migrate
```

L'application est accessible sur **http://localhost:8080**

---

## 🗄️ Services disponibles

| Service | URL | Description |
|---------|-----|-------------|
| App | http://localhost:8080 | Application principale |
| Adminer | http://localhost:8081 | Interface PostgreSQL |

---

## 📁 Structure du projet

```
PrelevCheck/
├── config/          # Configuration Symfony
├── docker/          # Dockerfiles & configs Nginx
│   ├── nginx/
│   └── php/
├── migrations/      # Migrations Doctrine
├── public/          # Point d'entrée web
├── src/
│   ├── Controller/
│   ├── Entity/
│   ├── Repository/
│   └── Service/     # Logique métier (lookup, cache, IA)
├── templates/       # Vues Twig
├── docker-compose.yml
└── .env.example
```

---

## 🔄 Flow de recherche

```
Input utilisateur
      ↓
 Normalisation
      ↓
  Cache Redis  ──→ HIT → Réponse immédiate
      ↓ MISS
 Base de données ──→ HIT → Réponse + mise en cache
      ↓ MISS
   Search API   ──→ HIT → Parsing + stockage
      ↓ MISS
  IA (OpenAI)   ──→ Réponse + stockage
```

---


## ⚠️ Disclaimer

Les résultats sont donnés à titre indicatif. PrelevCheck ne garantit pas l'exactitude des informations fournies. En cas de doute sur un prélèvement, contactez votre banque.

---

## 📄 Licence

MIT