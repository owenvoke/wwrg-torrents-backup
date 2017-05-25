{include file='include/header.tpl'}
<div class="container text-center">
    <div class="page-header">
        <img src="/assets/images/logo.png" alt="WWRG Torrents Logo">
    </div>
    <div class="form-group">
        <form action="/search" method="get">
            <input placeholder="I want to download..." autocomplete="off" name="q"
                   type="text" class="hover-bottom big-search">
        </form>
    </div>
    <div class="years form-group wwrg-red">
        <ul>
            <li><a href="/search?c=movies">Movies</a></li>
            <li><a href="/search?c=tv">TV</a></li>
            <li><a href="/search?c=tv/hd">TV/HD</a></li>
            <li><a href="/search?c=games">Games</a></li>
            <li><a href="/search?c=books">Books</a></li>
            <li><a href="/search?c=music">Music</a></li>
        </ul>
    </div>
    <div class="text-center">
        <small>{$data->total_torrents} torrents and counting...</small>
    </div>
</div>
{include file='include/footer.tpl'}