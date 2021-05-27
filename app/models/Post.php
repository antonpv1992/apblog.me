<?php

namespace app\models;

use tools\core\Db;
use tools\core\mappers\PostMapper;
use tools\core\mappers\UserMapper;
use tools\core\mappers\ActivityMapper;

class Post extends AppModel
{

    /** @var UserMapper storage mapper */
    private UserMapper $uMapper;

    /** @var PostMapper storage mapper */
    private PostMapper $pMapper;

    /** @var ActivityMapper storage mapper */
    private ActivityMapper $aMapper;

    /**
     * method for loading data from the database
     * @param array $data data array
     */
    protected function load(array $data): void
    {
        foreach ($data as $key => $value) {
            $this->fields[$key] = $value;
        }
        $this->uMapper = new UserMapper(Db::instance());
        $this->pMapper = new PostMapper(Db::instance());
        $this->aMapper = new ActivityMapper(Db::instance());
    }

    /**
     * method for saving data to database
     * @param array $data data array
     */
    protected function save(array $data): void
    {
        $this->fields['title'] = $data['title'];
        $this->fields['description'] = $data['description'];
        $this->fields['author'] = $data['author'];
        $this->fields['short_text'] = $data['short_text'];
        $this->fields['text'] = $data['text'];
        $this->fields['theme'] = $data['theme'];
        $this->fields['likes'] = $data['likes'];
        $this->fields['comments'] = $data['comments'];
        if (isset($data['alias'])) {
            $this->fields['alias'] = $data['alias'];
        } else {
            $alias = $data['title'];
            do {
                $alias = aliasCollision(generateAlias($alias));
            } while ($this->pMapper->isPostExists($alias));
            $this->fields['alias'] = $alias;
        }
        $this->fields['image'] = isset($data['image']) ? file_get_contents($data['image']) : file_get_contents('https://picsum.photos/755/306');
        $this->uMapper = new UserMapper(Db::instance());
        $this->pMapper = new PostMapper(Db::instance());
        $this->aMapper = new ActivityMapper(Db::instance());
    }

    /**
     * get the title of the class
     * @return string
     */
    public function getTitle(): string
    {
        return $this->fields['title'];
    }

    /**
     * get the description of the class
     * @return string
     */
    public function getDescription(): string
    {
        return $this->fields['description'];
    }

    /**
     * get the date of the class
     * @return string
     */
    public function getDate(): string
    {
        return $this->fields['date'];
    }

    /**
     * get the author of the class
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->fields['author'];
    }

    /**
     * get the image of the class
     * @return string
     */
    public function getImage(): string
    {
        return $this->fields['image'];
    }

    /**
     * get the short_text of the class
     * @return string
     */
    public function getShortText(): string
    {
        return $this->fields['short_text'];
    }

    /**
     * get the text of the class
     * @return string
     */
    public function getText(): string
    {
        return $this->fields['text'];
    }

    /**
     * get the alias of the class
     * @return string
     */
    public function getAlias(): string
    {
        return $this->fields['alias'];
    }

    /**
     * get the theme of the class
     * @return string
     */
    public function getTheme(): string
    {
        return $this->fields['theme'];
    }

    /**
     * get the likes of the class
     * @return int|string
     */
    public function getLikes(): int|string
    {
        return $this->fields['likes'];
    }

    /**
     * get the comments of the class
     * @return int|string
     */
    public function getComments(): int|string
    {
        return $this->fields['comments'];
    }

    /**
     * get the post id of the class
     * @return string
     */
    public function getId(): string
    {
        return $this->fields['id'] ?? '';
    }

    /**
     * get the avatar of the class
     * @return string
     */
    public function getAvatar(): string
    {
        return $this->fields['avatar'] ?? '';
    }

    /**
     * get the liked of the class
     * @return string|int
     */
    public function isLiked(): string|int
    {
        return $this->fields['liked'] ?? '';
    }

    /**
     * get the commented of the class
     * @return string|int
     */
    public function isCommented(): string|int
    {
        return $this->fields['commented'] ?? '';
    }

    /**
     * get the user id of the class
     * @return int|string
     */
    public function getUid(): int|string
    {
        return $this->fields['uid'] ?? '';
    }

    /**
     * method for adding / removing a like to a post
     * @param array $postArr post data
     */
    public function toggleLike(array $postArr): void
    {
        $like = 0;
        if ($postArr['res'] === '1') {
            $like = 1;
            $this->uMapper->update("likes = likes + 1", "id=" .  $postArr['author']);
            $this->pMapper->update("likes = likes + 1", "id=" .  $postArr['post']);
        } else {
            $this->uMapper->update("likes = likes - 1", "id=" .  $postArr['author']);
            $this->pMapper->update("likes = likes - 1", "id=" .  $postArr['post']);
        }
        if ($this->aMapper->isExists("post=" . $postArr['post'] . " AND user=" . $postArr['user'] . "")) {
            $this->aMapper->setActivity("liked=$like", "post=" . $postArr['post'] . " AND user=" . $postArr['user']);
        } else {
            $this->aMapper->addActivity(["post" => $postArr['post'],"user" => $postArr['user'] ,"liked" => 1]);
        }
    }

    /**
     * method that checks the existence of the post and the author
     * @return bool true if post exists
     */
    public function postAndAuthorExists(): bool
    {
        if (
            $this->uMapper->isExists("id='" . $_POST['user'] . "'")
            && $this->pMapper->isExists("id='" . $_POST['post'] . "'")
            && $this->uMapper->isExists("id='" . $_POST['author'] . "'")
        ) {
            return true;
        }
        return false;
    }

    /**
     * the method checks if at least one post is returned from the database
     * @param int $currentId current id
     * @param string $alias alias
     * @return bool true if post exists
     */
    public function postExists(int $currentId, string $alias): bool
    {
        if ($this->pMapper->getArticles("post.id, post.title, post.description, post.date, post.image, post.text, post.theme, post.likes, post.comments, post.alias, user.login as author, user.avatar, user.id as uid, activity.liked, activity.commented", $currentId, "post.alias='" . $alias . "'", "post.date DESC")) {
            return true;
        }
        return false;
    }

    /**
     * method that returns one post by alias
     * @param int $currentId current id
     * @param string $alias alias
     * @return Post one post
     */
    public function getSinglePost(int $currentId, string $alias): Post
    {
        return $this->pMapper->getArticles("post.id, post.title, post.description, post.date, post.image, post.text, post.theme, post.likes, post.comments, post.alias, user.login as author, user.avatar, user.id as uid, activity.liked, activity.commented", $currentId, "post.alias='" . $alias . "'", "post.date DESC")[0];
    }

    /**
     * method that returns the number of posts on the page (meaning the total number of posts from the database by condition)
     * @param string|bool $theme post selection condition
     * @return int|string total number of posts
     */
    public function postOnPages(string|bool $theme): int|string
    {
        return $theme !== false ? $this->pMapper->countRecords($theme) : $this->pMapper->countRecords();
    }

    /**
     * method that returns all posts by condition from the database
     * @param int $currentId current id
     * @param string|bool $theme post subject
     * @param int $start starting position (for pagination)
     * @param int $perpage posts per page (for pagination)
     * @return array array of posts
     */
    public function getAllPosts(int $currentId, string|bool $theme, int $start, int $perpage): array
    {
        return $this->pMapper->getArticles("post.id, post.title, post.description, post.date, post.image, post.short_text, post.theme, post.likes, post.comments, post.alias, user.login as author, user.avatar, user.id as uid, activity.liked, activity.commented", $currentId, $theme, "post.date DESC", "$start, $perpage");
    }

    /**
     * method that returns 5 most popular posts
     * @return array array of popular posts
     */
    public function getPopularPosts(): array
    {
        return $this->pMapper->getArticles("post.title, post.date, post.image, post.alias, user.login as author, user.avatar", false, false, "post.likes DESC", 5);
    }

    /**
     * the method returns 5 liked posts to a specific authorized user
     * @param int $currentId current id
     * @return array array of liked posts
     */
    public function getLikedPosts(int $currentId): array
    {
        return $this->pMapper->getArticles("post.title, post.date, post.image, post.alias, activity.liked", $currentId, "activity.liked = 1", "post.date DESC", 5);
    }
}