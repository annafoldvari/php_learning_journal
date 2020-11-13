<?php 
  require('inc/header.php'); 
  require('inc/functions.php');

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = filter_input(INPUT_POST, 'delete', FILTER_SANITIZE_NUMBER_INT);

    if (delete_entry($id)) {
      $message = "Message Deleted";
    } else {
      $message = 'Could not delete project';
    };
  }
?>        
  <section>
      <div class="container">
        <?php 
          if ($message) {
            echo "<p>".$message."</p>";
          }
        ?> 
          <div class="entry-list">
            <?php
               $entries = get_entry_list();
               foreach($entries as $entry) {
                $written_date = date("F d,Y", strtotime($entry['date']));
                echo "<article>\n";
                echo  "<h2><a href='detail.php?id=".$entry['id']."'>".$entry['title']."</a></h2>\n";
                echo  "<time datetime='".$entry['date']."'>".$written_date."</time>\n";
                echo "<form method='post' action='index.php'>\n";
                echo "<input type='hidden' value='".$entry['id']."' name='delete' />\n";
                echo "<input type='submit' class='button--delete' value='Delete' />\n";
                echo "</form>";
                echo "</article>\n";
               }  
            ?>              
          </div>
      </div>
  </section>
<?php require('inc/footer.php'); ?>