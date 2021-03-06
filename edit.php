<?php 
  require('inc/header.php');
  require('inc/functions.php');

  $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
  $title = $date = $time_spent = $learned = $resources = $tags = '';
  $check_array = check_if_id_exist($id);
  if ($check_array[0] == 0) {
    $error_message = 'Error! There is no entry with the given id.';
  } else {
    $entry = get_individual_entry($id);
  }

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
    $date = trim(filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRING));
    $time_spent = trim(filter_input(INPUT_POST, 'timeSpent', FILTER_SANITIZE_STRING));
    $learned = trim(filter_input(INPUT_POST, 'whatILearned', FILTER_SANITIZE_STRING));
    $resources = trim(filter_input(INPUT_POST, 'ResourcesToRemember', FILTER_SANITIZE_STRING));
    $tags = trim(filter_input(INPUT_POST, 'tags', FILTER_SANITIZE_STRING));
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
  
    if(empty($title) || empty($date) || empty($time_spent) || empty($learned)) {
      $error_message = 'Date, Title, What You Learnt, Time Spent can\'t be empty';
    } else {
      if (update_entry($title, $date, $time_spent, $learned, $resources, $tags, $id)) {
        header('location: index.php');
        exit;
      } else {
        $error_message = 'Could not add project';
      };
    }
  }
?>
  <section>     
      <div class="container">
      <?php 
      if ($error_message) {
        echo "<p>".$error_message."</p>";
      }
      ?>   
          <div class="edit-entry">
              <h2>Edit Entry</h2>
              <form method="post" action="edit.php">
                  <label for="title"> Title</label>
                  <input id="title" type="text" name="title" value="<?= $entry['title']; ?>"><br>
                  <label for="date">Date</label>
                  <input id="date" type="date" name="date" value="<?= $entry['date']; ?>"><br>
                  <label for="time-spent"> Time Spent</label>
                  <input id="time-spent" type="text" name="timeSpent" value="<?= $entry['time_spent']; ?>"><br>
                  <label for="what-i-learned">What I Learned</label>
                  <textarea id="what-i-learned" rows="5" name="whatILearned"><?= $entry['learned'] ?></textarea>
                  <label for="resources-to-remember">Resources to Remember</label>
                  <textarea id="resources-to-remember" rows="5" name="ResourcesToRemember"><?= $entry['resources'] ?></textarea>
                  <label for="tags">Tags</label>
                  <textarea id="tags" rows="5" name="tags"><?= $entry['tags'] ?></textarea>
                  <input type="hidden" name="id" value="<?= $id; ?>" />
                  <input type="submit" value="Publish Entry" class="button">
                  <a href="#" class="button button-secondary">Cancel</a>
              </form>
          </div>
      </div>
  </section>
<?php
  require('inc/footer.php');
?>
