<?php

namespace app\models;

class Contact extends AppModel
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
        $this->fields['user'] = $data['user'];
        $this->fields['site'] = $data['site'] ?? '';
        $this->fields['telegram'] = $data['telegram'] ?? '';
        $this->fields['viber'] = $data['viber'] ?? '';
        $this->fields['whatsapp'] = $data['whatsapp'] ?? '';
        $this->fields['signall'] = $data['signall'] ?? '';
        $this->fields['zoom'] = $data['zoom'] ?? '';
        $this->fields['skype'] = $data['skype'] ?? '';
        $this->fields['facebook'] = $data['facebook'] ?? '';
        $this->fields['twitter'] = $data['twitter'] ?? '';
        $this->fields['vk'] = $data['vk'] ?? '';
        $this->fields['ok'] = $data['ok'] ?? '';
        $this->fields['instagram'] = $data['instagram'] ?? '';
        $this->fields['youtube'] = $data['youtube'] ?? '';
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
     * get the site of the class
     * @return string
     */
    public function getSite(): string
    {
        return $this->fields['site'];
    }

    /**
     * get the telegram of the class
     * @return string
     */
    public function getTelegram(): string
    {
        return $this->fields['telegram'];
    }

    /**
     * get the viber of the class
     * @return string
     */
    public function getViber(): string
    {
        return $this->fields['viber'];
    }

    /**
     * @return string
     */
    public function getWhatsapp(): string
    {
        return $this->fields['whatsapp'];
    }

    /**
     * get the signal of the class
     * @return string
     */
    public function getSignal(): string
    {
        return $this->fields['signall'];
    }

    /**
     * get the zoom of the class
     * @return string
     */
    public function getZoom(): string
    {
        return $this->fields['zoom'];
    }

    /**
     * get the skype of the class
     * @return string
     */
    public function getSkype(): string
    {
        return $this->fields['skype'];
    }

    /**
     * get the facebook of the class
     * @return string
     */
    public function getFacebook(): string
    {
        return $this->fields['facebook'];
    }

    /**
     * get the twitter of the class
     * @return string
     */
    public function getTwitter(): string
    {
        return $this->fields['twitter'];
    }

    /**
     * get the vk of the class
     * @return string
     */
    public function getVk(): string
    {
        return $this->fields['vk'];
    }

    /**
     * get the ok of the class
     * @return string
     */
    public function getOk(): string
    {
        return $this->fields['ok'];
    }

    /**
     * get the instagram of the class
     * @return string
     */
    public function getInstagram(): string
    {
        return $this->fields['instagram'];
    }

    /**
     * get the youtube of the class
     * @return string
     */
    public function getYoutube(): string
    {
        return $this->fields['youtube'];
    }
}