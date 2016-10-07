<html>
<head>
    <?php include './header.php'; ?>
    <title>WWRG Torrent Search</title>
</head>
<body>
<div class="container">
    <div class="search-sect">
        <a href="/">
            <img src="/images/wide-logo.png" align="center"/>
        </a>
    </div>
    <div class="search-sect">
        <form action="/search.php" method="post">
            <input placeholder="I want to download..." autocomplete="off" name="q" type="text"
                   class="hover-bottom big-search"/>
        </form>
    </div>
    <div class="years search-sect">
        <ul>
            <li><a href="/search.php?c=movies">Movies</a></li>
            <li><a href="/search.php?c=tv">TV</a></li>
            <li><a href="/search.php?c=games">Games</a></li>
            <li><a href="/search.php?c=books">Books</a></li>
            <li><a href="/search.php?c=music">Music</a></li>
        </ul>
    </div>

</div>
</body>
</html>