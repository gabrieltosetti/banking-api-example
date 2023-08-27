## Requirements
- Docker installed and running.

## Before Install
The backend needs to do APIs calls to Exchange Rate services so it is **mandatory** get a key (it's free) for, at least, the default service. You will only need 1 key (or more if you run out of usage limit):

1. [Currency Converter API](https://free.currencyconverterapi.com/) **(default, MUST HAVE A API KEY)**
1. [Fixer](https://fixer.io/documentation)
1. [Amdoren](https://www.amdoren.com/currency-api/)

## Installation

- Clone the repository.
- Edit `.env` and paste the Exchange service API Key.

```
FIXER_API_KEY=
AMDOREN_API_KEY=
CURRENCY_CONVERTER_API_API_KEY=
```

- Build and start the containers

```bash
docker compose up -d
```

- Install all the dependencies

```bash
docker compose exec app composer install
```

- Migrate and seed the database

```bash
docker compose exec app php artisan migrate:fresh --seed
```

- Access `http://localhost:8080` and start chatting