<?php 

  function get_entry_list() {
    include 'connection.php';
    try {
      $results = $db->query("SELECT id, title, date, time_spent, learned, resources, tags FROM entries ORDER BY date");
      return $results->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      echo "Error!: " . $e->getMessage() . "<br />";
      return array();
    }
  }

  function get_individual_entry($id) {
    include 'connection.php';
    try {
      $results = $db->prepare("SELECT id, title, date, time_spent, learned, resources, tags FROM entries WHERE id = ?");
      $results -> bindValue(1, $id, PDO::PARAM_INT);
      $results -> execute();
    } catch (Exception $e) {
      echo "Error!: " . $e->getMessage() . "<br />";
      return false;
    }
    return $results->fetch();
  }

  function check_if_id_exist($id) {
    include 'connection.php';
    try {
      $result = $db->prepare("SELECT COUNT(id) FROM entries WHERE id = ?");
      $result -> bindValue(1, $id, PDO::PARAM_INT);
      $result -> execute();
    } catch (Exception $e) {
      echo "Error!: " . $e->getMessage() . "<br />";
      return false;
    }
    return $result->fetch();
  }

  function update_entry($title, $date, $time_spent, $learned, $resources, $tags, $id) {
    include 'connection.php';

    $sql = 'UPDATE entries SET title = ?, date = ?, time_spent = ?, learned = ?, resources = ?, tags = ? WHERE id = ?';

    try {
      $results = $db->prepare($sql);
      $results -> bindValue(1, $title, PDO::PARAM_STR);
      $results -> bindValue(2, $date, PDO::PARAM_STR);
      $results -> bindValue(3, $time_spent, PDO::PARAM_STR);
      $results -> bindValue(4, $learned, PDO::PARAM_STR);
      $results -> bindValue(5, $resources, PDO::PARAM_STR);
      $results -> bindValue(6, $tags, PDO::PARAM_STR);
      $results -> bindValue(7, $id, PDO::PARAM_INT);

      $results->execute();
    } catch (Exception $e) {
      echo "Error!: " . $e->getMessage() . "<br />";
      return false;
    }
    return true;
  }

  function add_entry($title, $date, $time_spent, $learned, $resources, $tags) {
    include 'connection.php';

    $sql = 'INSERT INTO entries (title, date, time_spent, learned, resources, tags) VALUES (?, ?, ?, ?, ?,?)';

    try {
      $results = $db->prepare($sql);
      $results -> bindValue(1, $title, PDO::PARAM_STR);
      $results -> bindValue(2, $date, PDO::PARAM_STR);
      $results -> bindValue(3, $time_spent, PDO::PARAM_STR);
      $results -> bindValue(4, $learned, PDO::PARAM_STR);
      $results -> bindValue(5, $resources, PDO::PARAM_STR);
      $results -> bindValue(6, $tags, PDO::PARAM_STR);

      $results->execute();
    } catch (Exception $e) {
      echo "Error!: " . $e->getMessage() . "<br />";
      return false;
    }
    return true;
  }

  function delete_entry($id) {
    include 'connection.php';
  
    $sql = 'DELETE FROM entries WHERE id = ?';
  
    try {
      $results = $db->prepare($sql);
      $results -> bindValue(1, $id, PDO::PARAM_INT);
      $results->execute();
    } catch (Exception $e) {
      echo "Error!: " . $e->getMessage() . "<br />";
      return false;
    }
    return true;
  }