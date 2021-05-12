<?php include_once '../app/views/Components/header.php'; ?>
    <main class="main">
        <article class="main__post post">
            <div class="post__box">
                <header class="post__header">
                    <section class="post__header-title">
                        <h2 class="post__title">
                            <a class="post__title-link" href="" ><?=$post->getTitle()?></a>
                        </h2>
                        <p class="post__title-description">
                            <?=$post->getDescription()?>
                        </p>
                    </section>
                    <section class="post__meta">
                        <time class="post__meta-published" datetime="<?=explode(' ', $post->getDate())[0]?>"><?=implode( '.' ,array_reverse(explode('-', explode(' ', $post->getDate())[0])))?></time>
                        <a class="post__meta-author" href="/profile/<?=strtolower($post->getAuthor())?>">
                            <span class="post__meta-name"><?=$post->getAuthor()?></span>
                            <img class="post__meta-image" src="data:image/png;base64,<?=base64_encode($post->getAvatar());?>" alt="Картинка">
                        </a>
                    </section>
                </header>
                <a class="post__image-link" href="/post/<?=$post->getAlias()?>">
                    <img class="post__image" src="data:image/png;base64,<?=base64_encode($post->getImage());?>" alt="Картинка">
                </a>
                <p class="post__descripton"><?=$post->getText()?></p>
                <footer class="post__footer post__footer-border">
                    <ul class="post__stats">
                        <li class="post__stats-item">
                            <a class="post__stats-link" href="/posts/<?=strtolower($post->getTheme())?>"><i class="fas fa-circle <?=strtolower($post->getTheme())?>-icon"></i><?=strtolower($post->getTheme())?></a>
                        </li>
                        <li class="post__stats-item">
                            <a class="post__stats-link <?=isset($_SESSION['user']) ? 'post__stats-heart' : ''?>"><i class="fas fa-heart <?=$post->isLiked() ? 'post__stats-like' : ''?>" <?=isset($_SESSION['user']) ? "data-like=" . $post->getId() . "-" . $post->getUid() : "" ?>></i><?=$post->getLikes()?></a>
                        </li>
                        <li class="post__stats-item">
                            <a class="post__stats-link"><i class="fas fa-comments <?=$post->isCommented() ? 'post__stats-comment' : ''?>"></i><?=$post->getComments()?></a>
                        </li>
                    </ul>
                </footer>
            </div>
        </article>
    </main>
<?php include_once '../app/views/Components/footer.php'; ?>