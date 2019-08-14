<h2>Small CMS</h2>

With this CMS you can make posts with title, summary, content, pics and date.
In templates you can change the look of the site.

To make it work you also have to set up a connection to database in config.php and to make two tables as folows:
<ul>
    <li>Table: Articles<br>
        <code>CREATE TABLE articles</code><br>
        <code>(</code><br>
        &ensp<code>id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,</code><br>
        &ensp<code>publicationDate date NOT NULL,</code><br>
        &ensp<code>title           varchar(255) NOT NULL,</code><br>
        &ensp<code>summary         text NOT NULL,</code><br>
        &ensp<code>content         mediumtext NOT NULL</code><br>   
        <code>);</code><br>
    </li>
    <li>Table: Users<br>
        <code>CREATE TABLE users</code><br>
        <code>(</code><br>
        &ensp<code>id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,</code><br>
        &ensp<code>created_at date NOT NULL,</code><br>
        &ensp<code>username           varchar(255) NOT NULL,</code><br>
        &ensp<code>password         text NOT NULL</code><br>
        <code>);</code><br>
    </li>
</ul>