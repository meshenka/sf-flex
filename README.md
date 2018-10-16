# Installation

A first test project with Symfony4 and Semver

## Requirements

* docker and docker-compose
* make
* git <https://git-scm.com/>

## Build project

```bash
cd [project]
make
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