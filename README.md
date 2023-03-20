# Tech Test requirements
Create a landing page where a user can add a piece of text and upload an image. 
This should save the text they entered to a database and also store a link to the file in the database. 
When the landing page is completed it should then share a link that the user can go to which will show them their text and their image with the data coming from the database.

The time taken to do this is not important.
The styling of the pages is not important, they just need to be usable.
You will need to be able to talk through your code.

Please send a link to a git repo either on github, gitlab or bitbucket so that we can review the work.



# Setup
clone the repo locally 

`composer install` \
`npm install` \
`php artisan migrate`- to add the table in DB (make sure your DB is properly connected at this point)\
`npm run watch` - to compile the frontend Vue.js files \
`php artisan storage:link`- to link to storage folder where the images are stored\
`php artisan optimize`\
`php artisan serve`- get url and visit site locally ( unless you have other local setup )\
`php artisan key:generate` - might be needed too

.env file should be in the repo. Change that to whatever is needed for your local env.


# Context Overview
I've started from a laravel + vue template repo I made a few days ago specifically for the purpose of making quick projects. This way I don't have to start from scratch every single time. If you see unknown files in there feel free to ask me about it.

I'm using Vue.js on top of Laravel for it's web routing + all the goodies that come from using a modern JS framework.

# Files Overview

##### Backend Files

`config/app.php` -  Added an Image Intervention class useful for working with images\
`database\migrations\2023_03_19_183840_add_posts_table.php` - migration used to make the posts table\
`app\Models\Post.php` - Post model\
`app\Http\Controllers\PostController.php` - Post Controller where all the logic takes place\
`routes\api.php` - api file where the api routes are defines

##### Frontend Files

`app\Http\Controllers\ViewsController.php` - View controller which essentially just serves the app view\
`resources\views\app.blade.php` - view file -> which just connects to the vue.js main script file.\
`resources\js\routes.js` - web routing file - this is where the routing is done, not with the default Laravel routing\
`resources\js\components` - this is where all the frontend vue files are at.












