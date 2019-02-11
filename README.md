
# Symfony 4 Flex Demo App

[![Build Status](https://dev.azure.com/sylvaingogel/sylvaingogel/_apis/build/status/meshenka.sf-flex?branchName=master)](https://dev.azure.com/sylvaingogel/sylvaingogel/_build/latest?definitionId=1&branchName=master) [![Conventional Commits](https://img.shields.io/badge/Conventional%20Commits-1.0.0-yellow.svg)](https://conventionalcommits.org)

A first test project with Symfony4 and Semver:

* A "Last Seen" Microservice allowing to register user activity and query if a user is online or last seen
* REST Style API
* Secured with stateless JWT validation

## Requirements

* docker and docker-compose <https://docs.docker.com/compose/>
* make
* git <https://git-scm.com/>

## Build project

```bash
cd [project]
# display make help (autodocumented)
make
# install the all thing docker containers, composer, yarn etc
make install
```

## Semver

The project use Sementic Versionning, your commit messages must comply to semver formatting
(this is enforced with commitlint)

CHANGELOG and release is managed with standard-version which leverage semver commits format
to produce correct Versionning

When you are read to create a new version, merge your code and Run

```bash
yarn release
```

It will take care of the following

* bump version
* update CHANGELOG
* commit package.json and CHANGELOG.md
* tag a new release

@see <https://github.com/conventional-changelog/standard-version>

## Run for developpers

The full stack is dockerized @see <file:./docker-compose.yml>

```bash
make start # start project, after initial make install
```

## What did i learn

* Symfony Flex
* Using XML Mapping for doctrine
* Dockerize the infrastructure
* Setup data fixture with faker + alice
* Configure Symfony for non standard Namespaces
* PHP Stan <https://github.com/phpstan/phpstan>
* Autowiring + Autoconfigure + Type Hints
* Azure Pipeline CI integration