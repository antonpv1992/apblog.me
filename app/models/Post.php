<?php

namespace app\models;

use tools\core\Db;
use tools\core\mappers\PostMapper;

class Post extends AppModel
{

    /**
     * method for loading data from the database
     * @param array $data data array
     */
    protected function load(array $data): void
    {
        foreach($data as $key => $value){
            $this->fields[$key] = $value;
        }
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
        if(isset($data['alias'])){
            $this->fields['alias'] = $data['alias'];
        } else {
            $alias = $data['title'];
            $posts = new PostMapper(DB::instance());
            do{
                $alias = aliasCollision(generateAlias($alias));
            }while($posts->isPostExists($alias));
            $this->fields['alias'] = $alias;
        }
        $this->fields['image'] = isset($data['image']) ? file_get_contents($data['image']) : file_get_contents('https://picsum.photos/755/306');
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
}