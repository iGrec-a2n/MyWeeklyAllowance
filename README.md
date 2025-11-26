# MyWeeklyAllowance

A pocket money management module for teenagers, allowing parents to manage virtual wallets for their children.

## Features

- Create an account for a teenager
- Deposit money
- Record expenses
- Set an automatic weekly allocation

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
composer mwa-cli
```

Le script ne persiste pas les données : elles sont conservées uniquement durant la session courante.

## Development

This project follows Test-Driven Development (TDD) principles. Tests are written first, then the implementation follows.

