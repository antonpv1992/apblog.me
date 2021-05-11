<?php


namespace tools\core\mappers;


use tools\core\base\Mapper;

class UserMapper extends Mapper
{
    /**
     * @return array
     */
    public function topByRate()
    {
        $users = $this->storage->scheme('user');
        if($users !== null){
            usort($users, function($x, $y){
                return $y['likes'] <=> $x['likes'];
            });
            if(count($users) > 5){
                array_splice($users, 5, count($users) - 4);
            }
            return $this->mapFieldsToUser($users);
        }
    }

    /**
     * @param $data
     * @param bool $flag
     * @return \app\models\User
     */
    public function mapFieldToUser($data, $flag = true)
    {
        return \app\models\User::rowFromData($data, $flag);
    }

    /**
     * @param $data
     * @param bool $flag
     * @return array
     */
    public function mapFieldsToUser($data, $flag = true)
    {
        return \app\models\User::rowsFromData($data, $flag);
    }
}