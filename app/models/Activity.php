<?php


namespace app\models;


class Activity extends AppModel
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
        $this->fields['user'] = $data['user'];
        $this->fields['post'] = $data['post'];
        $this->fields['liked'] = isset($data['liked']) ? $data['liked'] : false;
        $this->fields['commented'] = isset($data['commented']) ? $data['commented'] : false;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->fields['user'];
    }

    /**
     * @return mixed
     */
    public function getPost()
    {
        return $this->fields['post'];
    }

    /**
     * @return mixed
     */
    public function isLiked()
    {
        return $this->fields['liked'];
    }

    /**
     * @return mixed
     */
    public function isCommented()
    {
        return $this->fields['commented'];
    }
}