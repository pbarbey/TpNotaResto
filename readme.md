# NotaResto

Travaux pratique sur la création d'une application de notation de restaurant

## Environnement de développement

### Pré-requis:

* PHP 7.4
* Composer
* Docker
* Docker-compose

Vous pouvez vérifier les prés-requis (sauf docker et docker-compose) avec la commande (de la la CLI symfony):

```bash
symfony check:requirements
```

### Lancer l'environnement de développement

```bash
composer install
npm install
npm run build
docker-compose up -d
symfony serve -d
```