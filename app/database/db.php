<?php 
session_start();
require('connect.php');

function display($value)
{
    echo "<pre>",print_r($value, true), "</pre>";
    die();
}

function executeQuery($sql, $data){
    global $conn;
    $stmt = $conn->prepare($sql);
    $values = array_values($data);
    $types = str_repeat('s', count($values));
    $stmt->bind_param($types, ...$values);
    $stmt->execute();
    return $stmt;
}

function selectAll($table, $conditions = [])
{
    global $conn;
    $sql = "SELECT * FROM $table";

    if(empty($conditions))
    {
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $records;
    }
    else
    {
        // return records that match conditions
        // $sql = "SELECT * FROM $table WHERE username='raid' AND admin=1";
        $i = 0;
        foreach ($conditions as $key => $value) {
            if($i === 0){
                $sql = $sql . " WHERE $key=?";
            }
            else{
                $sql = $sql . " AND $key=?";
            }
            $i++;
        }
        $stmt = executeQuery($sql, $conditions);
        $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $records;
    }
}

function selectOne($table, $conditions)
{
    global $conn;
    $sql = "SELECT * FROM $table";

    $i = 0;
    foreach ($conditions as $key => $value) {
        if($i === 0){
            $sql = $sql . " WHERE $key=?";
        }
        else{
            $sql = $sql . " AND $key=?";
        }
        $i++;
    }
    // $sql = "SELECT * FROM $table WHERE username='raid' AND admin=1 LIMIT 1";
    $sql = $sql . " LIMIT 1";

    $stmt = executeQuery($sql, $conditions);
    $records = $stmt->get_result()->fetch_assoc();
    return $records;
}

function create($table, $data)
{
    global $conn;
    // $sql = insert into users set username=?, admin=?, email=?, password=?
    $sql = "INSERT INTO $table SET ";
    $i = 0;
    foreach ($data as $key => $value) {
        if($i === 0){
            $sql = $sql . "$key=?";
        }
        else{
            $sql = $sql . ", $key=?";
        }
        $i++;
    }
    $stmt = executeQuery($sql, $data);
    $id = $stmt->insert_id;
    return $id;
}

function update($table, $id, $data)
{
    global $conn;
    // $sql = "update users set username=?, admin=?, email=?, password=? where id=?"
    $sql = "UPDATE $table SET ";
    $i = 0;
    foreach ($data as $key => $value) {
        if($i === 0){
            $sql = $sql . "$key=?";
        }
        else{
            $sql = $sql . ", $key=?";
        }
        $i++;
    }

    $sql = $sql . " WHERE id=?";
    $data['id'] = $id;
    $stmt = executeQuery($sql, $data);
    return $stmt->affected_rows;
}

function delete($table, $id)
{
    global $conn;
    $sql = "DELETE FROM $table WHERE id=?";
    $stmt = executeQuery($sql, ['id' => $id]);
    return $stmt->affected_rows;
}

function getUserPost($table_name, $usr, $p_id)
{
    global $conn;
    $sql = "SELECT p.*, u.username FROM $table_name AS p JOIN users AS u ON p.user_id=u.id WHERE p.user_id=? AND p.id=?";

    $stmt = executeQuery($sql, ['user_id' => $usr, 'id' => $p_id]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}

function searchActivitiesPosts($term, $startt, $limite)
{
    global $conn;
    $match = '%' . $term . '%';
    $sql = "SELECT p.* FROM activities AS p WHERE p.act_title LIKE ? OR p.act_desc LIKE ? LIMIT $startt, $limite";

    $stmt = executeQuery($sql, ['act_title' => $match, 'act_desc' => $match]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}

function latest_events($table)
{
    global $conn;
    $sql = "SELECT * FROM $table ORDER BY id DESC LIMIT 2";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;

}
?>