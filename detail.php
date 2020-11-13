<?php 
  require('inc/header.php');
  require('inc/functions.php');

  $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
  $check_array = check_if_id_exist($id);
  if ($check_array[0] == 0) {
    $error_message = 'Error! There is no entry with the given id.';
  } else {
    $entry = get_individual_entry($id);
  }
?>
<section>
    <?php 
      if ($error_message) {
        echo "<p>".$error_message."</p>";
      } else {
        ?>
        <div class="container">
          <div class="entry-list single">
              <article>
                  <h1><?= $entry['title'] ?></h1>
                  <time datetime="<?= $entry['date'] ?>"><?php echo date("F d,Y", strtotime($entry['date'])); ?></time>
                  <div class="entry">
                      <h3>Time Spent: </h3>
                      <p><?= $entry['time_spent'] ?></p>
                  </div>
                  <div class="entry">
                      <h3>What I Learned:</h3>
                      <p><?= $entry['learned'] ?></p>
                  </div>
                  <div class="entry">
                      <h3>Resources to Remember:</h3>
                      <p><?= $entry['resources'] ?></p>
                  </div>
                  <div class="entry">
                      <h3>Tags:</h3>
                      <p><?= $entry['tags'] ?></p>
                  </div>
              </article>
          </div>
        </div>
        <div class="edit">
            <p><a href="edit.php?id=<?= $id; ?>">Edit Entry</a></p>
        </div>
    <?    
      }
    ?>
</section>

<?php
  require('inc/footer.php');
?>