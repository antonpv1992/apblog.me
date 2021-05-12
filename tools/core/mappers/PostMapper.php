<?php


namespace tools\core\mappers;


use tools\core\base\Mapper;

class PostMapper extends Mapper
{
    /** @var string  */
    protected $table = 'post';

    /** @var string  */
    protected $key = 'id';

    /**
     * @return array
     */
    public function getAll()
    {
        return $this->fieldsToPost($this->storage->query("SELECT * from $this->table"));
    }

    /**
     * @param $value
     * @param string $field
     * @return \app\models\Post
     */
    public function getOne($value, $field = '')
    {
        return $this->fieldToPost($this->findOne($value, $field));
    }

    /**
     * @param $fields
     * @param false $userId
     * @param false $condition
     * @param false $order
     * @param false $limit
     * @return array
     */
    public function getArticles($fields, $userId = false, $condition = false, $order = false, $limit = false)
    {
        $userId = $userId !== false ? " LEFT JOIN activity ON post.id = activity.post AND $userId = activity.user" : ""; //" LEFT JOIN activity ON post.id = activity.post AND $userId = activity.user"
        $condition = $condition !== false ? " WHERE " . $condition : "";
        $limit = $limit !== false ? " LIMIT " . $limit : "";
        $order = $order !== false ? " ORDER BY " . $order : "";
        return $this->fieldsToPost($this->query("SELECT $fields FROM $this->table INNER JOIN user ON post.author = user.id $userId $condition $order $limit"));
    }

    /**
     * @param $data
     * @param bool $flag
     * @return \app\models\Post
     */
    public function fieldToPost($data, $flag = true)
    {
        return \app\models\Post::rowFromData($data, $flag);
    }

    /**
     * @param $data
     * @param bool $flag
     * @return array
     */
    public function fieldsToPost($data, $flag = true)
    {
        return \app\models\Post::rowsFromData($data, $flag);
    }
}