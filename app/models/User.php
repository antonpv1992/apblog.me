<?php

namespace app\models;

use tools\core\Db;
use tools\core\mappers\UserMapper;

class User extends AppModel
{

    /** @var UserMapper storage mapper */
    private UserMapper $uMapper;

    /**
     * method for loading data from the database
     * @param array $data data array
     */
    protected function load(array $data): void
    {
        foreach ($data as $key => $value) {
            $this->fields[$key] = $value;
        }
        $this->uMapper = new UserMapper(Db::instance());
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
        if (isset($data['man'])) {
            $this->fields['sex'] = 'man';
        } elseif(isset($data['woman'])) {
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
        $this->uMapper = new UserMapper(Db::instance());
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

    /**
     * method that returns top 5 authors
     * @return array array of authors
     */
    public function getTopAuthors(): array
    {
        return $this->uMapper->getUsers('user.login, user.likes, user.avatar', "user.author=1", "user.likes DESC", 5);
    }

    /**
     * method for updating the avatar on the logged in user page
     * @param mixed $image picture to update
     * @param int $uid user id
     */
    public function updateAvatar(mixed $image, int $uid): void
    {
        $blob = addslashes(file_get_contents(($image)));
        $this->uMapper->updateUserField("avatar='$blob'", "id=" . $uid);
    }

    /**
     * method that checks if such a column exists
     * @param string|int $key column name
     * @return bool true if the column exists
     */
    public function isCol(string|int $key): bool
    {
        return $this->uMapper->isCol($key) == 1;
    }

    /**
     * method for updating the required field in the database
     * @param string $key field name
     * @param string $value field value
     * @param int|string $uid user id
     */
    public function updateCurrentField(string $key, string $value, int|string $uid): void
    {
        $this->uMapper->updateUserField("$key='$value'", "id=" . $uid);
    }

    /**
     * method that checks whether the post exists by alias
     * @param string $alias post alias
     * @return bool true if post exists
     */
    public function aliasExists(string $alias): bool
    {
        return $this->uMapper->isUserExists($alias);
    }

    /**
     * method that returns users by login
     * @param string $login user login
     * @return User user
     */
    public function getByLogin(string $login): User
    {
        return $this->uMapper->getUsers("*", "user.login='$login'")[0];
    }

    /**
     * method that returns an array of users with login and mail
     * @return array array of users
     */
    public function getLoginAndEmail(): array
    {
        return $this->uMapper->getUsers("login, email");
    }

    /**
     * method for saving a user to the database
     * @return User user
     */
    public function saveUser(): User
    {
        $this->uMapper->save($this->getAllFields());
        return $this->uMapper->getUser("id, login, email, password", "login='" . $this->getLogin() . "'");;
    }

    /**
     * method for getting a user by login for a session
     * @param string $login user login
     * @return User user
     */
    public function getSingleUser(string $login): User
    {
        return $this->uMapper->getUser("id, login, email, password", "login='" . $login . "'");
    }

    /**
     * method for checking the existence of mail
     * @param string $email mail
     * @return bool true if mail exists
     */
    public function isEmail(string $email): bool
    {
        return $this->uMapper->isEmailExists($email);
    }

    /**
     * method to update the password
     * @param string $newPassword new generated password
     * @param string $email mail
     */
    public function updatePassword(string $newPassword, string $email): void
    {
        $this->uMapper->updateUserField("password='$newPassword'", "email='" . $email ."'");
    }
}