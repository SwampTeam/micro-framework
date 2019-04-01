<?php

namespace Model;

use Database\DBConnection;


class ParkPlace implements CrudInterface
{
    private $id;
    private $type = 'normal';
    private $number;
    private $occupied = false;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return ParkPlace
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return ParkPlace
     */
    public function setType(string $type): ParkPlace
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param mixed $number
     * @return ParkPlace
     */
    public function setNumber($number)
    {
        $this->number = $number;
        return $this;
    }

    /**
     * @return bool
     */
    public function isOccupied(): bool
    {
        return $this->occupied;
    }

    /**
     * @param bool $occupied
     * @return ParkPlace
     */
    public function setOccupied(bool $occupied): ParkPlace
    {
        $this->occupied = $occupied;
        return $this;
    }

    public function create(array $fieldValues): int
    {
        if ($this->id) {
            $this->update($this->id, $fieldValues);
            return $this->id;
        }
        $connection = DBConnection::getConnection();
        $stmt = $connection->prepare('
          INSERT INTO parkplace (type, number, occupied)
          VALUE (:type, :number, :occupied)
          ');

        foreach (['type', 'number', 'occupied'] as $placeholder) {
            if (!isset($fieldValues[$placeholder])) {
                $stmt->bindParam($placeholder, $this->{$placeholder});
                continue;
            }
            $stmt->bindParam($placeholder, $fieldValues[$placeholder]);
        }
        if (!$stmt->execute()) {
            throw new \LogicException($stmt->errorInfo()[2]);
        }
        return $connection->lastInsertId();
    }

    public static function read(int $id)
    {
        $connection = DBConnection::getConnection();
        $stmt = $connection->prepare('SELECT * FROM parkplace WHERE id = :id');
        $stmt->bindParam('id', $id);
        if (!$stmt->execute()) {
            throw new \LogicException($stmt->errorInfo()[2]);
        }
        return $stmt->fetch(\PDO::FETCH_CLASS, static::class);
    }

    /**
     * @return array
     * @throws \LogicException in case of execution failure
     */
    public static function findAll(): array
    {
        $connection = DBConnection::getConnection();
        $stmt = $connection->prepare('SELECT * FROM parkplace');
        if (!$stmt->execute()) {
            throw new \LogicException($stmt->errorInfo()[2]);
        }
        return $stmt->fetchAll(\PDO::FETCH_CLASS, static::class);
    }

    public function update(int $id, array $fieldValues): bool
    {
        $connection = DBConnection::getConnection();
        $stmt = $connection->prepare('
          UPDATE parkplace SET type = :type, number = :number, occupied = :occupied
          WHERE id = :id
          ');
        $stmt->bindParam('id', $id);

        foreach (['type', 'number', 'occupied'] as $placeholder) {
            if (!isset($fieldValues[$placeholder])) {
                $stmt->bindParam($placeholder, $this->{$placeholder});
                continue;
            }
            $stmt->bindParam($placeholder, $fieldValues[$placeholder]);
        }

        return $stmt->execute();
    }

    public function delete(int $id): bool
    {
        $connection = DBConnection::getConnection();
        $stmt = $connection->prepare('
          DELETE FROM parkplace
          WHERE id = :id
          ');
        return $stmt->execute(['id' => $id]);
    }

    public function homepageAction()
    {
        include __DIR__ . '/../../public/read.php';
    }

    public function updateAction()
    {
        if (empty($_GET['id'])) {
            include __DIR__ . '/../../public/404.html';
            return;
        }
        $parkPlace = ParkPlace::read($_GET['id']);
        if (empty($parkPlace)) {
            include __DIR__ . '/../../public/404.html';
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_POST['occupied'] = ($_POST['occupied'] ?? null) === 'on' ? 1 : 0;
            $parkPlace->update($parkPlace->getId(), $_POST);
            header('Location: ./');
            return;
        }

        include __DIR__ . '/../../public/update.php';
    }

    public function deleteAction()
    {
        if (empty($_GET['id'])) {
            include __DIR__ . '/../../public/404.html';
            return;
        }
        $parkPlace = ParkPlace::read($_GET['id']);
        if (empty($parkPlace)) {
            include __DIR__ . '/../../public/404.html';
            return;
        }
        $parkPlace->delete($parkPlace->getId());
        header('Location: ./');
        return;
    }

    public function createAction()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = [];
            if (empty($_POST['number'])) {
                $errors['number'] = 'Number could not be blank';
            }
            if (strlen($_POST['number']) > 10) {
                $errors['number'] = 'Number cannot be longer than 10 characters';
            }
            if (!in_array($_POST['type'], ['normal', 'woman', 'fire'])) {
                $errors['type'] = 'Type can only be normal, woman or fire';
            }

            if (empty($errors)) {
                $_POST['occupied'] = ($_POST['occupied'] ?? null) === 'on' ? 1 : 0;
                $parkPlace = new ParkPlace();
                $parkPlace->setType($_POST['type'])
                    ->setOccupied($_POST['occupied'])
                    ->setNumber($_POST['number']);
                $parkPlace->create([]);

                header('Location: ./');
                return;
            }
        }
        include __DIR__ . '/../../public/create.php';
    }

}