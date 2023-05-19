# Petite Scholars System

## Setup

First, clone a fresh copy of the repository.

```bash

git clone git@github.com:jantinnerezo/petitescholars-system.git

```

Create an **.env** file by copying contents from **.env.example**.

```bash

cp .env.example .env

```

Install project packages and dependencies.

```bash

composer install

```

Migrate database.

```bash

php artisan migrate

```

Run database seeder.

```bash

php artisan db:seed

```

Generate application key.

```bash

php artisan key:generate

```
