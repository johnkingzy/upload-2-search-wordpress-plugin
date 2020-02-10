<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://github.com
 * @since      1.0.0
 *
 * @package    Upload_2_Search
 * @subpackage Upload_2_Search/admin/partials
 */
global $wpdb;

// Table name
$tablename = $wpdb->prefix . "students_data";

if (isset($_POST['data_import'])) {
  $data = json_decode(stripslashes($_POST['results']), true);
  $dataLength = count($data);
  $totalInserted = 0;
  for ($i = 0; $i < $dataLength; $i++) {
    $row = $data[$i];
    // Insert Record
    $wpdb->insert($tablename, array(
      'studentID1' => $row['id1'],
      'studentID2' => $row['id2'],
      'classroom' => $row['classroom'],
    ));

    if ($wpdb->insert_id > 0) {
      $totalInserted++;
    }
  }

  echo "<h3 style='color: green;'>Total record Inserted : " . $totalInserted . "</h3>";
  die();
}
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<section class="d-flex align-items-center justify-content-center h-vh">
  <div class="container">
    <div class="row">
      <div class="col-6 mx-auto">
        <h5>Upload file</h5>
        <form id="fileUploadForm" class="d-flex">
          <div class="custom-file my-1 mr-2">
            <input
              type="file"
              class="custom-file-input"
              id="customFile"
              required
            />
            <label class="custom-file-label" for="customFile"
              >Choose file...</label
            >
          </div>
          <button type="submit" class="btn btn-primary my-1">
            Upload
          </button>
        </form>
      </div>
    </div>
  </div>
</section>