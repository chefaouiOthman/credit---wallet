# Credit Wallet API

API REST de gestion de portefeuille de crédits avec JWT.

## Installation

composer install
cp .env.example .env
php artisan key:generate
php artisan jwt:secret
php artisan migrate
php artisan serve

## Routes

| Méthode | Route                              | Description      | Auth  |
|---------|------------------------------------|------------------|-------|
| POST    | /api/auth/register                 | Inscription      | Non   |
| POST    | /api/auth/login                    | Connexion        | Non   |
| GET     | /api/auth/me                       | Profil           | Oui   |
| POST    | /api/auth/logout                   | Déconnexion      | Oui   |
| GET     | /api/wallet                        | Consulter solde  | Oui   |
| POST    | /api/wallet/spend                  | Dépenser points  | Oui   |
| POST    | /api/admin/wallet/{user}/credit    | Créditer         | Admin |
| POST    | /api/admin/wallet/{user}/debit     | Débiter          | Admin |

## Tests Postman

https://chefaoui-othman-6948397.postman.co/workspace/OTHMAN-CHEFAOUI's-Workspace~0c06294f-df88-4f5f-8dbe-4e4517feba0b/collection/52498310-5347b4a1-5493-45e9-9840-fdcd26f5ab72?action=share&creator=52498310
