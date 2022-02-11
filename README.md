<img src="public/images/intellect_logo.png">
<h2>About the project</h2>
<p>
Intellect book service is subscription based website for reading e-books and listening to audiobooks,
users of the website can enjoy reading and listening to books online for small subscription fee, users can also read reviews left by other users of the website as well as leaving their own, once the user signup they can enjoy 30 days trial of the website after it end the user can choose one of the three subscription plan put on the main page.
</p>
<h2>What is the website built with</h2>
<ul>
<li>
Front-end
<ul>
<li>HTML/CSS/<a href="https://getbootstrap.com/" target="_blank">Bootstrap</a></li>
<li>JavaScript( <a href="https://vuejs.org/" target="_blank">Vue.js</a> )</li>
<li><a href="https://github.com/futurepress/epub.js/" target="_blank">epub.js</a>( JavaScript library for reading and in on a website )</li>
<li><a href="https://howlerjs.com/" target="_blank">Howler.js</a>( JavaScript library for playing audio on a website)</li>

</ul>
</li>
<li>
Back-end
<ul>
<li>PHP( <a href="https://laravel.com/" target="_blank">Laravel</a> )</li>
<li>Laravel packages used in this project ( <a href="https://laravel.com/docs/8.x/fortify" target="_blank">Laravel fortify</a>, <a href="https://laravel.com/docs/8.x/socialite">Laravel Socialite</a> )</li>
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



