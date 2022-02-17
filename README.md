<p align="center"><img src="public/images/intellect_logo.png"></p>
<h2>About the project</h2>
<p>
Intellect book service is subscription based website for reading e-books and listening to audiobooks,
users of the website can enjoy reading and listening to books online for small subscription fee, users can also read reviews left by other users of the website as well as leaving their own, once the user signup they can enjoy 30 days trial of the website after it end the user can choose one of the three subscription plan put on the main page.
</p>
<a href="https://drive.google.com/drive/folders/1qq9uE8xNG7voJgaiypAV9mGFFhlzICpx?usp=sharing"><p>Screenshots</p></a>
<a href="https://youtu.be/Prb3SaLUGO0">video tour of the website</a>
<h2>What is this website built with</h2>
<ul>
<li>
Front-end
<ul>
<li>HTML/CSS/<a href="https://getbootstrap.com/">Bootstrap</a></li>
<li>JavaScript( <a href="https://vuejs.org/">Vue.js</a> )</li>
<li><a href="https://github.com/futurepress/epub.js/">epub.js</a>( JavaScript library for reading and in on a website )</li>
<li><a href="https://howlerjs.com/">Howler.js</a>( JavaScript library for playing audio on a website)</li>

</ul>
</li>
<li>
Back-end
<ul>
<li>PHP( <a href="https://laravel.com/">Laravel</a> )</li>
<li>Laravel packages used in this project ( <a href="https://laravel.com/docs/8.x/fortify">Laravel fortify</a>, <a href="https://laravel.com/docs/8.x/socialite">Laravel Socialite</a> )</li>
<li>MySql</li>
</ul>
</li>
</ul>


<h2>
How to set up the project after cloning it
</h2>
<ol>
<li>Make sure that you installed npm and composer</li>
<li>Open command line inside the project</li>
<li>type "composer install"</li>
<li>type "npm install"</li>
<li>type "cp .env.example .env"</li>
<li>type "php artisan key:generate"</li>
<li>Creat a database with the same name of the same name as "DB_DATABASE" field in .env file</li>
<li>type "php artisan migrate"</li>
<li>To run the project on your browser type "php artisan serve"</li>
</ol>
<h2>How to use the website</h2>
<ul>
<li>After opening the home page click the signup button which will take to signup page</li>
<li>You can sign up wit your username, email and password or with your google account</li>
<li>After signing up successfully you will have 30 days to use the website before it asks you to choose a subscription plane</li>
<li>After signing up the main page will open, and you will find two section one for e-books and another for audiobooks, a nav bar which contain a search bar, a user menu and side nav-bar triggered by click tha burger button beside the website logo.</li>
<li>If you clicked on either the e-books and audiobooks, it will take to another page to check the description of the book, the reviews, a button to read/listen to the book and another to added to your bookmark list.</li>
<li>If you clicked on the read button it will take to a page with the book in the center of it and the navigation tools on the left and the bottom of it, if you closed the page or went to another page your progress on the book will be saved.</li>
<li>If you clicked on the listen button it will take to a page with an audio player to listen to the audiobook you clicked on, if you closed the page or went to another one your progress on the audiobook will be saved.</li>
<li>You can use the user menu to go to your bookmark list, got to your settings or log out.</li>

</ul>
<h2>Notes</h2>
<ul>
<li>I didn't implement a way to add a payment method, so if you are planning to use this project in commercial use you will have to implement one.</li>
<li>While programming tha audio player I had a problem with it that the play button will play the audio from the beginning after it has been paused(this problem only occurred in chrome it work fine in firefox, some user online refer that this is a problem with the server settings and has nothing to do with howlerjs library ), I haven't found a solution to this problem yet.</li>
</ul>
<h2>
Licence
</h2>
<p>
Intellect book service website is open-sourced software licensed under the <a href="https://opensource.org/licenses/MIT">MIT licence</a>.
</p>


