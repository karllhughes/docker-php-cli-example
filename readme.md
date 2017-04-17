# Sample Command Line PHP/Docker Application

[ ![Codeship Status for karllhughes/docker-php-cli-example](https://app.codeship.com/projects/95ab9250-05a3-0135-8091-7a325a44f9f4/status?branch=master)](https://app.codeship.com/projects/213574)

This is a simple Laravel command line application demonstrating using Docker and Docker Compose for PHP application development, continuous integration, and deployment through the [Codeship Pro platform](https://codeship.com/features/pro).

## Commands
For convenience, I have wrapped a number of common docker commands in `npm` scripts. For more details, see the `package.json` file.

- `npm run -s app:up` Starts up the application and database using Docker Compose.
- `npm run -s app:restart` Restarts the application making any code changes take effect.
- `npm run -s app:down` Brings down the application and database.
- `npm run -s app:test` Runs the test suite.\*
- `npm run -s artisan -- ARTISAN:COMMAND` Wrapper to run artisan commands.\*
- `npm run -s artisan -- item:update` Update the next item's `checked_at` date.
- `npm run -s composer:install` Install PHP packages via composer.
- `npm run -s composer:update` Update PHP packages via composer.
- `npm run -s composer:dump` Wrapper for composer `dump-autoload` command.

\* Note: The app must be running in order to run this command.

## Local development
In order to run this project locally for development, uncomment these lines in the `docker-compose` file that mount the code as a volume:

```yaml
  app:
    build: .
    links:
      - database
    env_file:
      - .env
    command: cron -f
    # Uncomment these lines:
    volumes:
     - ./:/app
```

This will ensure that any updates you make take effect immediately in the application container.

Run the composer install command:

```bash
$ npm run -s composer:install
```

Now, copy `.env.example` to `.env` and customize with your own variables and keys.

Next, run the npm command to bring up the docker containers:

```bash
$ npm run -s app:up
```

If it's your first time running this app, set up the database:

```bash
$ npm run -s db:create      # Creates the database
$ npm run -s db:migrate     # Runs the migrations
$ npm run -s db:seed        # Seeds the database
```

Now you can run the app's primary artisan command:

```bash
$ npm run -s artisan -- item:update
```

To bring the containers down when you're finished:

```bash
$ npm run -s app:down
```

## Testing Locally

### Testing within containers

Once the app is set up and running, you can run the acceptance test:

```bash
$ npm run -s app:test
```

This runs phpunit from within the running application container.

### Testing and deploying with Jet

If you have [Codeship's Jet installed](https://documentation.codeship.com/pro/getting-started/installation/), you can run tests from Jet as well.

First, bring the application down (if it's running):

```bash
$ npm run -s app:down
```

Generate an AES encryption key:

```bash
$ jet generate
```

Encrypt your .env files:

```bash
$ jet encrypt .env .env.encrypted && jet encrypt deployer/.env deployer/.env.encrypted
```

Build the containers, run the tests, and deploy the latest on the master branch:

```bash
$ jet steps
```
 
## Continuous integration with Codeship

This project was built to use [Codeship's Docker continuous integration platform](https://codeship.com/features/pro).

1. Copy your [Codeship AES key](https://documentation.codeship.com/pro/getting-started/encryption/#getting-the-key) into a file called `codeship.aes` at the root of this project.

2. Make sure your `deployer/.env` file is filled out with your server information and private rsa key (with no line breaks).

2. Encrypt your .env files: `$ jet encrypt .env .env.encrypted && jet encrypt deployer/.env deployer/.env.encrypted`

3. Push your code to a repository that is attached to a Codeship Pro CI instance.

This should run your tests and deploy your code to the server specified in `deployer/.env`

## License

This is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
