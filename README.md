Symfony Standard Edition
========================

Installing

    Clone the repository
    Rename 'app/config/parameters.ini.dist' to 'app/config/parameters.ini'
    Run 'php bin/vendors install' to install all the required vendors
    Install the assets with 'php app/console assets:install web'
    Create the database with 'php app/console doctrine:database:create'
    Update schema with 'php app/console doctrine:schema:create'
    Load fixtures with 'php app/console doctrine:fixtures:load'

