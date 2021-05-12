<?php


namespace app\models;


class User extends AppModel
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
        $this->fields['login'] = $data['login'];
        $this->fields['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $this->fields['email'] = $data['email'];
        $this->fields['name'] = $data['name'];
        $this->fields['surname'] = $data['surname'];
        $this->fields['birthday'] = $data['birthday'];
        if(isset($data['man'])){
            $this->fields['sex'] = 'man';
        } else if(isset($data['woman'])){
            $this->fields['sex'] = 'woman';
        } else {
            $this->fields['sex'] = null;
        }
        $this->fields['country'] = $data['country'];
        $this->fields['city'] = $data['city'];
        $this->fields['phone'] = $data['phone'];
        $this->fields['author'] = isset($data['author']) ? $data['author'] : 0;
        $this->fields['likes'] = isset($data['likes']) ? $data['likes'] : 0;
        $this->fields['avatar'] = isset($data['avatar']) ? file_get_contents($data['avatar']) : file_get_contents("https://memchik.ru/images/mems/5ccaed65eab15.jpg");
    }

    /**
     * @return mixed|string
     */
    public function getLogin()
    {
        return isset($this->fields['login']) ? $this->fields['login'] : '';
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
    public function getLikes()
    {
        return isset($this->fields['likes']) ? $this->fields['likes'] : '';
    }

    /**
     * @return mixed|string
     */
    public function getPassword()
    {
        return isset($this->fields['password']) ? $this->fields['password'] : '';
    }

    /**
     * @return mixed|string
     */
    public function getEmail()
    {
        return isset($this->fields['email']) ? $this->fields['email'] : '';
    }

    /**
     * @return mixed|string
     */
    public function getName()
    {
        return isset($this->fields['name']) ? $this->fields['name'] : '';
    }

    /**
     * @return mixed|string
     */
    public function getSurname()
    {
        return isset($this->fields['surname']) ? $this->fields['surname'] : '';
    }

    /**
     * @return mixed|string
     */
    public function getBirthday()
    {
        return isset($this->fields['birthday']) ? $this->fields['birthday'] : '';
    }

    /**
     * @return mixed|string
     */
    public function getSex()
    {
        return isset($this->fields['sex']) ? $this->fields['sex'] : '';
    }

    /**
     * @return mixed|string
     */
    public function getCountry()
    {
        return isset($this->fields['country']) ? $this->fields['country'] : '';
    }

    /**
     * @return mixed|string
     */
    public function getCity()
    {
        return isset($this->fields['city']) ? $this->fields['city'] : '';
    }

    /**
     * @return mixed|string
     */
    public function getPhone()
    {
        return isset($this->fields['phone']) ? $this->fields['phone'] : '';
    }

    /**
     * @return mixed|string
     */
    public function getAuthor()
    {
        return isset($this->fields['author']) ? $this->fields['author'] : '';
    }

    /**
     * @return mixed|string
     */
    public function getID()
    {
        return isset($this->fields['id']) ? $this->fields['id'] : '';
    }

    /**
     * @return mixed|string
     */
    public function getSite()
    {
        return isset($this->fields['site']) ? $this->fields['site'] : '';
    }

    /**
     * @return mixed|string
     */
    public function getTelegram()
    {
        return isset($this->fields['telegram']) ? $this->fields['telegram'] : '';
    }

    /**
     * @return mixed|string
     */
    public function getViber()
    {
        return isset($this->fields['viber']) ? $this->fields['viber'] : '';
    }

    /**
     * @return mixed|string
     */
    public function getWhatsapp()
    {
        return isset($this->fields['whatsapp']) ? $this->fields['whatsapp'] : '';
    }

    /**
     * @return mixed|string
     */
    public function getSignal()
    {
        return isset($this->fields['signal']) ? $this->fields['signal'] : '';
    }

    /**
     * @return mixed|string
     */
    public function getZoom()
    {
        return isset($this->fields['zoom']) ? $this->fields['zoom'] : '';
    }

    /**
     * @return mixed|string
     */
    public function getSkype()
    {
        return isset($this->fields['skype']) ? $this->fields['skype'] : '';
    }

    /**
     * @return mixed|string
     */
    public function getFacebook()
    {
        return isset($this->fields['facebook']) ? $this->fields['facebook'] : '';
    }

    /**
     * @return mixed|string
     */
    public function getTwitter()
    {
        return isset($this->fields['twitter']) ? $this->fields['twitter'] : '';
    }

    /**
     * @return mixed|string
     */
    public function getVk()
    {
        return isset($this->fields['vk']) ? $this->fields['vk'] : '';
    }

    /**
     * @return mixed|string
     */
    public function getOk()
    {
        return isset($this->fields['ok']) ? $this->fields['ok'] : '';
    }

    /**
     * @return mixed|string
     */
    public function getInstagram()
    {
        return isset($this->fields['instagram']) ? $this->fields['instagram'] : '';
    }

    /**
     * @return mixed|string
     */
    public function getYoutube()
    {
        return isset($this->fields['youtube']) ? $this->fields['youtube'] : '';
    }
}