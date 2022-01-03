# NotaResto

Travaux pratique sur la création d'une application de notation de restaurant

## Environnement de développement

### Pré-requis:

* PHP 7.4
* Composer
* Docker
* Docker-compose
* Nodejs et npm

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
symfony console d:d:c
symfony console d:m:m
symfony console d:f:l
```

### Lancer les test unitaires

```bash
./phpunit.sh
```

## Problème connu

Dans le ficheir .env.test il faut redéfinir DATATBASE_URL avec les valeurs du conteneur. Phpunit ne semble pas pouvoir récupérer la valeur réécrite DATABASE_URL émise depuis le conteneur comme pour le .env 