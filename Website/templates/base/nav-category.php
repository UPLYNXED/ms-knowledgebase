<nav class="nav-category">
    <ul id="category-0">
        <li>
            <div class="category">
                <a href="#">
                    Back-end aaaa
                </a>
                <button class="btn" type="button" data-toggle="collapse" data-target="#back-end-sub" aria-expanded="false" aria-controls="back-end-sub">
                </button>
            </div>
            <ul class="collapse" id="back-end-sub">
                <li>
                    <div class="category">
                        <a href="#">
                            Database
                        </a>
                    </div>
                </li>
            </ul>
        </li>
        <li>
            <div class="category">
                <a href="#">
                    Front-end
                </a>
                <button class="btn" type="button" data-toggle="collapse" data-target="#front-end-sub" aria-expanded="true" aria-controls="front-end-sub">
                </button>
            </div>
            <ul class="collapse show" id="front-end-sub">
                <li>
                    <div class="category">
                        <a href="#">
                            Buttons
                        </a>
                    </div>
                </li>
                <li>
                    <div class="category">
                        <a href="#">
                            Social Media
                        </a>
                        <button class="btn" type="button" data-toggle="collapse" data-target="#front-end-social-media-sub" aria-expanded="true" aria-controls="front-end-social-media-sub">
                        </button>
                    </div>
                    <ul class="collapse show" id="front-end-social-media-sub">
                        <li>
                            <div class="category">
                                <a href="#">
                                    Feeds
                                </a>
                            </div>
                        </li>
                        <li>
                            <div class="category active">
                                <a href="#">
                                    Sharing
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
    </ul>
</nav>

<script>
    get_template('nav-category-item-sub');
    load_data_template('nav-category-item', '#category-0', options.website.url + 'assets/php/data.php', {'data': 'categories'}, 'append');
</script>
