<header>
    <div id="top-bar">
        <div id="logo-container">
            <a href="/home">
                <h1> basket passion </h1>
            </a>
        </div>

        <div id="links-container">
            <div class="link"> <a href="/news"> actualités  </a> </div>
            <div class="link"> <a href="/store"> magasin </a> </div>
            <div class="link"> <a href="/blog"> blog  </a> </div>
            <div class="link"> <a href="/event"> evenements  </a> </div>
            <span> | </span>
            <?php if (!Authentication::isAuth()['auth'] ) : ?>
                <div class="link" id="Sign-up"> <a href="/sign-up"> <div> s'enregister </div> </a> </div>
                <div class="link" id="Sign-in"> <a href="/sign-in"> <div> se connecter </div> </a> </div>
            <?php else: ?>
                <a id="user-content" href="/me">
                    <p> Mon compte </p>
                    <img src="/img/user-icon.svg">
                </a>
            <?php endif; ?>
            <div id="search-bar-toggler"> <ion-icon name="search"></ion-icon> </div>
        </div>

        <div id="burger-menu">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>

    <div id="search-bar">
        <form action="/search" method="get">
            <div class="container">
                <label> users
                    <input name="users-checkbox" type="checkbox"/>
                </label>

                <label> products
                    <input name="products-checkbox" type="checkbox"/>
                </label>

                <label> events
                    <input name="events-checkbox" type="checkbox"/>
                </label>

                <div class="search-input">
                    <input type="text" name="search" placeholder="Search in the site"/>
                    <button type="submit"> <ion-icon name="search"></ion-icon> </button>
                </div>
            </div>
        </form>
    </div>
</header>
<div id="responsive-header">
    <div>
        <form action="/search" method="get">
            <div class="search-input">
                <input type="text" name="search" placeholder="Search in the site"/>
                <button type="submit"> <ion-icon name="search"></ion-icon> </button>
            </div>
            <div class="search-options">
                <label> users
                    <input name="users-checkbox" type="checkbox"/>
                </label>

                <label> products
                    <input name="products-checkbox" type="checkbox"/>
                </label>

                <label> events
                    <input name="events-checkbox" type="checkbox"/>
                </label>
            </div>
        </form>

        <nav>
            <div class="link"> <a href="/home"> actualités  </a> </div>
            <div class="link"> <a href="/store"> magasin </a> </div>
            <div class="link"> <a href="/blog"> blog  </a> </div>
            <div class="link"> <a href="/event"> evenements  </a> </div>
        </nav>

        <div>
            <?php if (!Authentication::isAuth()['auth'] ) : ?>
                <div class="link" id="Sign-up"> <a href="/sign-up"> <div> s'enregister </div> </a> </div>
                <div class="link" id="Sign-in"> <a href="/sign-in"> <div> se connecter </div> </a> </div>
            <?php else: ?>

                <a id="user-content" href="/me">
                    <p> Mon compte </p>
                    <img src="/img/user-icon.svg">
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>
