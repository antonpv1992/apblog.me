<?php


namespace app\models;


class Post extends AppModel
{
    /**
     * @param $data
     */
    protected function load($data)
    {
        foreach($data as $key => $value){
            $this->fields[$key] = $value;
        }
    }

    /**
     * @param $data
     */
    protected function save($data)
    {
        $this->fields['title'] = $data['title'];
        $this->fields['description'] = $data['description'];
        $this->fields['author'] = $data['author'];
        $this->fields['short_text'] = $data['short_text'];
        $this->fields['text'] = $data['text'];
        $this->fields['theme'] = $data['theme'];
        $this->fields['likes'] = $data['likes'];
        $this->fields['comments'] = $data['comments'];
        $this->fields['image'] = isset($data['image']) ? file_get_contents($data['image']) : file_get_contents('https://picsum.photos/755/306');
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->fields['title'];
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->fields['description'];
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->fields['date'];
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->fields['author'];
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->fields['image'];
    }

    /**
     * @return mixed
     */
    public function getShortText()
    {
        return $this->fields['short_text'];
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->fields['text'];
    }

    /**
     * @return mixed
     */
    public function getAlias()
    {
        return $this->fields['alias'];
    }

    /**
     * @return mixed
     */
    public function getTheme()
    {
        return $this->fields['theme'];
    }

    /**
     * @return mixed
     */
    public function getLikes()
    {
        return $this->fields['likes'];
    }

    /**
     * @return mixed
     */
    public function getComments()
    {
        return $this->fields['comments'];
    }

    /**
     * @return mixed|string
     */
    public function getId()
    {
        return isset($this->fields['id']) ? $this->fields['id'] : '';
    }

    /**
     * @return mixed|string
     */
    public function getAvatar()
    {
        return isset($this->fields['avatar']) ? $this->fields['avatar'] : '';
    }

    /**
     * @return mixed|string
     */
    public function isLiked()
    {
        return isset($this->fields['liked']) ? $this->fields['liked'] : '';
    }

    /**
     * @return mixed|string
     */
    public function isCommented()
    {
        return isset($this->fields['commented']) ? $this->fields['commented'] : '';
    }

    /**
     * @return mixed|string
     */
    public function getUid()
    {
        return isset($this->fields['uid']) ? $this->fields['uid'] : '';
    }
}