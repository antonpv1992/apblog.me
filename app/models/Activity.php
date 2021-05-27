<?php
namespace app\models;

class Activity extends AppModel
{

    /**
     * method for loading data from the database
     * @param array $data data array
     */
    protected function load(array $data): void
    {
        foreach ($data as $key => $value) {
            $this->fields[$key] = $value;
        }
    }

    /**
     * method for saving data to database
     * @param array $data data array
     */
    protected function save(array $data): void
    {
        $this->fields['user'] = $data['user'];
        $this->fields['post'] = $data['post'];
        $this->fields['liked'] = $data['liked'] ?? false;
        $this->fields['commented'] = $data['commented'] ?? false;
    }

    /**
     * get the user of the class
     * @return string|int
     */
    public function getUser(): string|int
    {
        return $this->fields['user'];
    }

    /**
     * get the post of the class
     * @return string|int
     */
    public function getPost(): string|int
    {
        return $this->fields['post'];
    }

    /**
     * get the like of the class
     * @return string|int
     */
    public function isLiked(): string|int
    {
        return $this->fields['liked'];
    }

    /**
     * get the comment of the class
     * @return string|int
     */
    public function isCommented(): string|int
    {
        return $this->fields['commented'];
    }
}