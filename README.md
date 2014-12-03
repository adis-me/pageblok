# PAGEBLOK CMS

CMS for **Web Developers** developed as a package in the Laravel Framework.


# Asset Management

**This needs improvements**
But in current situation **Bower** and **Gulp** are used. Gulp is installed in the root of the project. And bower is installed in the directory **Assets**.
TODO: Create Command to publish to package folder.

# Themes

## Installing gulp

    npm install --save-dev gulp gulp-util gulp-less gulp-uglify gulp-concat gulp-autoprefixer gulp-minify-css gulp-imagemin gulp-rev gulp-gzip gulp-phpunit

### Publish assets

    php artisan asset:publish --bench="adis-me/pageblok"

## Running database migrations

    // confide migrations
    php artisan migrate
    // then package migrations
    php artisan migrate --package="terbium/db-config"
    php artisan migrate --bench="pageblok/pageblok"

## Running database seeds

    php artisan db:seed --class="Pageblok\\Core\\Databases\\Seeds\\DatabaseSeeder"

## Running testcases

    ../../../vendor/bin/phpunit

## TODO:

Menu items: Link type must be before link url, when page selected load all the pages that can be linked
Create a information page for develop when no pages are defined, on production show a friendly error message


### CMS
- Create backend:
    - User login
    - User logout
    - Create, edit Pages
    - Create, edit Block
- Menu manager:
Improvements:
- Create menu table, this could be cacheable
- User Management
- Create command to publish package
- Page management
    - Add when the page is published
- Block management
- SEO Goodies that are properties
- Think about Plugins?
- Installation

Issues
When you go to the backend you will see error message that you are not logged in


### Tests

- Use Mockery instead of the database for testing
- Test (admin) views