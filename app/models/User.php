<?php

namespace app\models;

class User extends AppModel
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
        $this->fields['login'] = $data['login'];
        $this->fields['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $this->fields['email'] = $data['email'];
        $this->fields['name'] = $data['name'];
        $this->fields['surname'] = $data['surname'];
        $this->fields['birthday'] = $data['birthday'] !== '' ? $data['birthday']: null;
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
        $this->fields['author'] = $data['author'] ?? 0;
        $this->fields['likes'] = $data['likes'] ?? 0;
        $this->fields['avatar'] = isset($data['avatar']) ? file_get_contents($data['avatar']) : file_get_contents("https://memchik.ru/images/mems/5ccaed65eab15.jpg");
    }

    /**
     * get the login of the class
     * @return string
     */
    public function getLogin(): string
    {
        return $this->fields['login'] ?? '';
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
     * get likes of the class
     * @return int|string
     */
    public function getLikes(): int|string
    {
        return $this->fields['likes'] ?? '';
    }

    /**
     * get the password of the class
     * @return string
     */
    public function getPassword(): string
    {
        return $this->fields['password'] ?? '';
    }

    /**
     * get the email of the class
     * @return string
     */
    public function getEmail(): string
    {
        return $this->fields['email'] ?? '';
    }

    /**
     * get the name of the class
     * @return string
     */
    public function getName(): string
    {
        return $this->fields['name'] ?? '';
    }

    /**
     * get the surname of the class
     * @return string
     */
    public function getSurname(): string
    {
        return $this->fields['surname'] ?? '';
    }

    /**
     * get the birthday of the class
     * @return string
     */
    public function getBirthday(): string
    {
        return $this->fields['birthday'] ?? '';
    }

    /**
     * get the sex of the class
     * @return string
     */
    public function getSex(): string
    {
        return $this->fields['sex'] ?? '';
    }

    /**
     * get the country of the class
     * @return string
     */
    public function getCountry(): string
    {
        return $this->fields['country'] ?? '';
    }

    /**
     * get the city of the class
     * @return string
     */
    public function getCity(): string
    {
        return $this->fields['city'] ?? '';
    }

    /**
     * get the phone of the class
     * @return string
     */
    public function getPhone(): string
    {
        return $this->fields['phone'] ?? '';
    }

    /**
     * get the author of the class
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->fields['author'] ?? '';
    }

    /**
     * get the id of the class
     * @return int|string
     */
    public function getID(): int|string
    {
        return $this->fields['id'] ?? '';
    }

    /**
     * get the site of the class
     * @return string
     */
    public function getSite(): string
    {
        return $this->fields['site'] ?? '';
    }

    /**
     * get the telegram of the class
     * @return string
     */
    public function getTelegram(): string
    {
        return $this->fields['telegram'] ?? '';
    }

    /**
     * get the viber of the class
     * @return string
     */
    public function getViber(): string
    {
        return $this->fields['viber'] ?? '';
    }

    /**
     * get the whatsapp of the class
     * @return string
     */
    public function getWhatsapp(): string
    {
        return $this->fields['whatsapp'] ?? '';
    }

    /**
     * get the signal of the class
     * @return string
     */
    public function getSignal(): string
    {
        return $this->fields['signall'] ?? '';
    }

    /**
     * get the zoom of the class
     * @return string
     */
    public function getZoom(): string
    {
        return $this->fields['zoom'] ?? '';
    }

    /**
     * get the skype of the class
     * @return string
     */
    public function getSkype(): string
    {
        return $this->fields['skype'] ?? '';
    }

    /**
     * get the facebook of the class
     * @return string
     */
    public function getFacebook(): string
    {
        return $this->fields['facebook'] ?? '';
    }

    /**
     * get the twitter of the class
     * @return string
     */
    public function getTwitter(): string
    {
        return $this->fields['twitter'] ?? '';
    }

    /**
     * get the vk of the class
     * @return string
     */
    public function getVk()
    {
        return $this->fields['vk'] ?? '';
    }

    /**
     * get the ok of the class
     * @return string
     */
    public function getOk(): string
    {
        return $this->fields['ok'] ?? '';
    }

    /**
     * get the instagram of the class
     * @return string
     */
    public function getInstagram(): string
    {
        return $this->fields['instagram'] ?? '';
    }

    /**
     * get the youtube of the class
     * @return string
     */
    public function getYoutube(): string
    {
        return $this->fields['youtube'] ?? '';
    }
}