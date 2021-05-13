<?php


namespace app\models;


class Contact extends AppModel
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
        $this->fields['site'] = isset($data['site']) ? $data['site'] : '';
        $this->fields['telegram'] = isset($data['telegram']) ? $data['telegram'] : '';
        $this->fields['viber'] = isset($data['viber']) ? $data['viber'] : '';
        $this->fields['whatsapp'] = isset($data['whatsapp']) ? $data['whatsapp'] : '';
        $this->fields['signall'] = isset($data['signall']) ? $data['signall'] : '';
        $this->fields['zoom'] = isset($data['zoom']) ? $data['zoom'] : '';
        $this->fields['skype'] = isset($data['skype']) ? $data['skype'] : '';
        $this->fields['facebook'] = isset($data['facebook']) ? $data['facebook'] : '';
        $this->fields['twitter'] = isset($data['twitter']) ? $data['twitter'] : '';
        $this->fields['vk'] = isset($data['vk']) ? $data['vk'] : '';
        $this->fields['ok'] = isset($data['ok']) ? $data['ok'] : '';
        $this->fields['instagram'] = isset($data['instagram']) ? $data['instagram'] : '';
        $this->fields['youtube'] = isset($data['youtube']) ? $data['youtube'] : '';
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
    public function getSite()
    {
        return $this->fields['site'];
    }

    /**
     * @return mixed
     */
    public function getTelegram()
    {
        return $this->fields['telegram'];
    }

    /**
     * @return mixed
     */
    public function getViber()
    {
        return $this->fields['viber'];
    }

    /**
     * @return mixed
     */
    public function getWhatsapp()
    {
        return $this->fields['whatsapp'];
    }

    /**
     * @return mixed
     */
    public function getSignal()
    {
        return $this->fields['signall'];
    }

    /**
     * @return mixed
     */
    public function getZoom()
    {
        return $this->fields['zoom'];
    }

    /**
     * @return mixed
     */
    public function getSkype()
    {
        return $this->fields['skype'];
    }

    /**
     * @return mixed
     */
    public function getFacebook()
    {
        return $this->fields['facebook'];
    }

    /**
     * @return mixed
     */
    public function getTwitter()
    {
        return $this->fields['twitter'];
    }

    /**
     * @return mixed
     */
    public function getVk()
    {
        return $this->fields['vk'];
    }

    /**
     * @return mixed
     */
    public function getOk()
    {
        return $this->fields['ok'];
    }

    /**
     * @return mixed
     */
    public function getInstagram()
    {
        return $this->fields['instagram'];
    }

    /**
     * @return mixed
     */
    public function getYoutube()
    {
        return $this->fields['youtube'];
    }
}