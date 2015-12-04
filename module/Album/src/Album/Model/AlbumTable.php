<?php

namespace Album\Model;

use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\TableGateway;

class AlbumTable {
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll() {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function fetchAllByUser($user_id) {

        $resultSet = $this->tableGateway->select(function (Select $select) use ($user_id) {
            $select->where(array('user_id' => $user_id));
        });

        return $resultSet;
    }

    public function getAlbum($id, $user_id) {
        $id = (int)$id;
        $user_id = (int)$user_id;

        $rowset = $this->tableGateway->select(function (Select $select) use ($user_id, $id) {
            $select->where(array('user_id' => $user_id, 'id' => $id));
        });


        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function saveAlbum(Album $album, $user_id) {
        $data = array(
            'artist' => $album->artist,
            'title' => $album->title,
            'user_id' => $user_id,
        );

        $id = (int)$album->id;
        $user_id = (int) $user_id;

        if ($id == 0 && $user_id != 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getAlbum($id, $user_id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Album id does not exist for this user');
            }
        }
    }

    public function deleteAlbum($id, $user_id) {
        $this->tableGateway->delete(array('id' => (int)$id, 'user_id' => (int) $user_id));
    }
}