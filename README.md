# Petite Scholars System

## Setup

First, clone a fresh copy of the repository.

```bash

git clone https://person_access_token@github.com/codec1120/petitescholars.git

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
