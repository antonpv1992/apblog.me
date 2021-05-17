<?php

namespace tools\core\mappers;

use app\models\Post;
use tools\core\base\Mapper;

class PostMapper extends Mapper
{

    /** @var string table name */
    protected string $table = 'post';

    /** @var string key name */
    protected string $key = 'id';

    /**
     * method for getting all posts
     * @return array data
     */
    public function getAll(): array
    {
        return $this->fieldsToPost($this->storage->query("SELECT * from $this->table"));
    }

    /**
     * method for getting one post
     * @param string $value search value
     * @param string $field value field
     * @return Post object
     */
    public function getOne(string $value, string $field = ''): Post
    {
        return $this->fieldToPost($this->findOne($value, $field));
    }

    /**
     * method for getting posts and data from two more tables that are associated with a post
     * @param string $fields required fields
     * @param bool|string $userId user id
     * @param bool|string $condition search term
     * @param bool|string $order sorting order
     * @param bool|string $limit record limit
     * @return array data
     */
    public function getArticles(string $fields, bool|string $userId = false, bool|string $condition = false, bool|string $order = false, bool|string $limit = false): array
    {
        $userId = $userId !== false ? " LEFT JOIN activity ON post.id = activity.post AND $userId = activity.user" : ""; //" LEFT JOIN activity ON post.id = activity.post AND $userId = activity.user"
        $condition = $condition !== false ? " WHERE " . $condition : "";
        $limit = $limit !== false ? " LIMIT " . $limit : "";
        $order = $order !== false ? " ORDER BY " . $order : "";
        return $this->fieldsToPost($this->query("SELECT $fields FROM $this->table INNER JOIN user ON post.author = user.id $userId $condition $order $limit"));
    }

    /**
     * method that checks whether such a post exists by alias
     * @param string $alias current alias for check
     * @return bool true if post found
     */
    public function isPostExists(string $alias): bool
    {
        return $this->storage->exists("SELECT alias FROM $this->table WHERE alias = ?", [$alias]);
    }

    /**
     * method for converting data from db to model data
     * @param array $data data array
     * @param bool $flag flag for loading / unloading data from database or fields
     * @return Post object
     */
    public function fieldToPost(array $data, bool $flag = true): Post
    {
        return Post::rowFromData($data, $flag);
    }

    /**
     * method for converting data from db to array data of models
     * @param array $data data array
     * @param bool $flag flag for loading / unloading data from database or fields
     * @return array array of objects
     */
    public function fieldsToPost(array $data, bool $flag = true): array
    {
        return Post::rowsFromData($data, $flag);
    }
}