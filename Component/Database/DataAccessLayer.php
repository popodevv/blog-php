<?php

namespace Component\Database;

use Model\Message;
use Model\User;
use Model\Items;

//use Model\Items;


class DataAccessLayer
{
    private $host = '127.0.0.1'; // localhost
    private $db = 'blog';
    private $user = 'root';
    private $password = 'root';
    private $charset = 'utf8mb4';
    private $port = '8889';
    private $pdo;


    /**
     * DataAccessLayer constructor.
     * @throws DatabaseNotConnectedException
     */
    public function __construct()
    {
        $dsn = sprintf("mysql:host=%s;dbname=%s;charset=%s;port=%s",
            $this->host, $this->db, $this->charset, $this->port);

        try {
            // une exception peut être jetée
            $this->pdo = new \PDO($dsn, $this->user, $this->password);
        } catch (\PDOException $e) { // j'attrape l'exception de PDO
            // je jete une nouvelle exception personnalisée
            throw new DatabaseNotConnectedException("Erreur de connexion à la bdd");
        }

        // si exception, le code qui suit n'est pas exécuté
    }

    public function getPdo(): \PDO
    {
        return $this->pdo;
    }


    public function getAllUsers(): array
    {
        /** @var PDOStatement $stmt */
        $stmt = $this->pdo->prepare('SELECT * FROM user'); //requete
        $stmt->execute();

        $users = [];
        while ($row = $stmt->fetch()) { //envoie ligne par ligne
            $user = new User();
            $user->setId($row['id']);
            $user->setUsername($row['username']);
            $user->setPassword($row['password']);
            $users[] = $user;
        }

        return $users;
    }


    /**
     * @param string $id
     * @return User|null
     */
    public function getUserById($id): ?User
    {
        /** @var PDOStatement $stmt */
        $stmt = $this->pdo->prepare('SELECT * FROM user WHERE id = :id');
        $stmt->execute(['id' => $id]);

        $users = $stmt->fetchAll();
        if (isset($users[0])) {
            $userData = $users[0];
            $user = new User();
            $user->setId($userData['id']);
            $user->setUsername($userData['username']);
            $user->setPassword($userData['password']);
            return $user;
        } else {
            return null;
        }
    }

    /**
     * @param string $username
     * @return User|null
     */
    public function getUserByUsername(string $username): ?User
    {
        /** @var PDOStatement $stmt */
        $stmt = $this->pdo->prepare('SELECT * FROM user WHERE username = :username');
        $stmt->execute(['username' => $username]);

        $users = $stmt->fetchAll();
        if (isset($users[0])) {
            $userData = $users[0];
            $user = new User();
            $user->setId($userData['id']);
            $user->setUsername($userData['username']);
            $user->setPassword($userData['password']);
            return $user;
        } else {
            return null;
        }
    }

    /**
     * @param User $user
     */
    public function insertUser(User $user): void
    {
        /** @var \PDOStatement $stmt */
        $stmt = $this->pdo->prepare(
            'INSERT INTO user (username, password) VALUES (:username, :password)');
        $stmt->execute([
            'username' => $user->getUsername(),
            'password' => $user->getPassword()
        ]);
        $user->setId($this->pdo->lastInsertId());
    }

    /**
     * @param User $user
     */
    public function updateUser(User $user): void
    {
        /** @var \PDOStatement $stmt */
        $stmt = $this->pdo->prepare(
            'UPDATE user SET username = :username, password = :password WHERE id = :id');
        $stmt->execute([
            'username' => $user->getUsername(),
            'password' => $user->getPassword(),
            'id' => $user->getId()
        ]);
    }


    /**
     * @return array|Item[]
     */
    public function getAllItems()
    {
        /** @var PDOStatement $stmt */
        $stmt = $this->pdo->prepare('SELECT * FROM items');
        $stmt->execute();

        $items = [];
        while ($row = $stmt->fetch()) {
            $item = new Items();
            $item->setId($row['id']);
            $item->setTitle($row['title']);
            $item->setContent($row['content']);
            //$message->setDate($row['date']);
            //$message->setId(intval($row['user_id']));
            $items[] = $item;
        }

        return $items;
    }
    /**
     * @param Items $message
     */
    public function insertItem(Items $item): void
    {
        /** @var \PDOStatement $stmt */
        $stmt = $this->pdo->prepare(
            'INSERT INTO items (title, content) VALUES (:title, :content)');
        $stmt->execute([
            'title' => $item->getTitle(),
            'content' => $item->getContent(),
        ]);

    }

        /**
     * @param Items $message
     */
    public function deleteItem(Items $item): void
    {
        /** @var \PDOStatement $stmt */
        $stmt = $this->pdo->prepare('DELETE INTO items (title, content) VALUES (:title, :content)');
        $stmt->execute([
            'title' => $item->getTitle(),
            'content' => $item->getContent(),
        ]);

    }


  /**
     * @return array|Message[]
     */
    public function getAllMessage(): array
    {
        /** @var PDOStatement $stmt */
        $stmt = $this->pdo->prepare('SELECT * FROM message'); //requete
        $stmt->execute();

        $messages = [];
        while ($row = $stmt->fetch()) { //envoie ligne par ligne
            $message = new Message();
            $message->setId($row['id']);
            $message->setPseudo($row['pseudo']);
            $message->setMessage($row['message']);
            $messages[] = $message;
        }

        return $messages;
    }

    /**
     * @param Message $message
     */
    public function insertMessage(Message $message): void
    {
        /** @var \PDOStatement $stmt */
        $stmt = $this->pdo->prepare('INSERT INTO message (pseudo, message) VALUES (:pseudo, :message)');
        $stmt->execute([
            'pseudo' => $message->getPseudo(),
            'message' => $message->getMessage(),
        ]);

    }

    


}