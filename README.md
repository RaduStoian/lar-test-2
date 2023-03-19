# Tech Test requirements
Create a landing page where a user can add a piece of text and upload an image. 
This should save the text they entered to a database and also store a link to the file in the database. 
When the landing page is completed it should then share a link that the user can go to which will show them their text and their image with the data coming from the database.

The time taken to do this is not important.
The styling of the pages is not important, they just need to be usable.
You will need to be able to talk through your code.

Please send a link to a git repo either on github, gitlab or bitbucket so that we can review the work.



# Setup
composer install
npm install
npm run watch -> to compile the frontend Vue.js files
php artisan storage:link -> to link to storage folder where the images are stored
php artisan optimize
php artisan serve -> get url and visit site

.env file should be in the repo. Change that to whatever is needed for your local env.











