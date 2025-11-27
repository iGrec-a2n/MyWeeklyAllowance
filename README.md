# MyWeeklyAllowance

L’application MyWeeklyAllowance permet aux parents de gérer un “porte-monnaie virtuel” pour leurs ados. 

## Features

- créer un compte pour un ado,
- déposer de l’argent,
- enregistrer des dépenses,
- fixer une allocation hebdomadaire automatique.

## Setup

1. Install dependencies:
```bash
composer install
```

2. Run tests:
```bash
composer test-all           // Pour lancer tous les test
composer test --chemin_vers_/nom_du_test   // Pour lancer un test au choix
```

## Interface CLI

L'exécution suivante lance une interface en ligne de commande permettant de créer des comptes, de déposer de l'argent, d'enregistrer des dépenses et d'appliquer les allocations hebdomadaires :

```bash
php bin/allowance            # interface interactive
composer mwa-cli             # wrapper (sur certains environnements composer may not provide a TTY)
```

Le script ne persiste pas les données : elles sont conservées uniquement durant la session courante.

## Mode non-interactif (automatisation / CI)

Le binaire supporte également un mode non-interactif via des flags, pratique pour les scripts ou l'intégration continue :

```bash
# créer un compte
php bin/allowance --create --name "John" --email john@example.com

# déposer de l'argent
php bin/allowance --deposit --email john@example.com --amount 50

# enregistrer une dépense
php bin/allowance --expense --email john@example.com --amount 10 --description "Lunch"

# définir une allocation hebdomadaire
php bin/allowance --set-allocation --email john@example.com --amount 20

# appliquer les allocations pour tous (dans la session en cours)
php bin/allowance --apply-allocations --all

# lister les comptes créés dans cette session
php bin/allowance --list
```

Vous pouvez chaîner plusieurs commandes dans la même invocation ; elles seront exécutées dans l'ordre.

## Crédits

- **[Yann Abouakou N'DAH](https://github.com/iGrec-a2n)** : création des tests unitaires (`tests/`), définition des comportements attendus et mise en place initiale du CLI de l'application en se basant sur le code fourni.
- **[Lissanou Modestin HOUNGA](https://github.com/Lm-hg)** : implémentation du code applicatif à partir des tests de Yann, intégration du CLI (`bin/allowance`) et mise en place de la génération de la couverture de code (PHPUnit + Xdebug/phpdbg).


## Development

Nous avons travaillé en TDD : les tests de Yann ont guidé l'implémentation par Modestin.
