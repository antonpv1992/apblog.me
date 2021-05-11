<?php


namespace tools\core\mappers;


use tools\core\base\Mapper;

class PostMapper extends Mapper
{
    /**
     * @return array
     */
    public function topByPopular()
    {
        $posts = $this->storage->scheme('post');
        if($posts !== null){
            usort($posts, function($x, $y){
                return $y['likes'] <=> $x['likes'];
            });
            if(count($posts) > 5){
                array_splice($posts, 5, count($posts) - 4);
            }
            return $this->mapFieldsToPost($posts);
        }
    }

    /**
     * @return array
     */
    public function topByLiked()
    {
        $posts = $this->storage->scheme('post');
        if($posts !== null){
            $likedArray = [];
            for($i = 0, $j = 0; $i < count($posts) && $j < 5; $i++) {
                if(!$posts[$i]['liked']){
                    continue;
                }
                array_push($likedArray, $posts[$i]);
                $j++;
            }
            return $this->mapFieldsToPost($likedArray);
        }
    }

    public function getPosts()
    {
        $posts = $this->storage->scheme('post');
        //debug($posts);
        if($posts !== null){
            //echo 1;
            return $this->mapFieldsToPost($posts);
        }
    }

    /**
     * @param $data
     * @param bool $flag
     * @return \app\models\Post
     */
    public function mapFieldToPost($data, $flag = true)
    {
        return \app\models\Post::rowFromData($data, $flag);
    }

    /**
     * @param $data
     * @param bool $flag
     * @return array
     */
    public function mapFieldsToPost($data, $flag = true)
    {
        return \app\models\Post::rowsFromData($data, $flag);
    }
}