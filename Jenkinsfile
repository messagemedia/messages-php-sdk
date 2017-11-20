node {
     stage 'Checkout'
        checkout scm 

    stage 'Prepare'
        bat 'composer install --no-interaction --prefer-dist'

    stage 'Test'
        bat 'vendor/bin/phpunit.bat'
}