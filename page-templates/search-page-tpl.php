<?php

/* 
Template Name: Search Page Layout
*/

get_header();
$results = [];
if ( isset($_POST['submit_search_data'] ) ) {
    // $search_option = sanitize_text_field($_POST[ 'search_option' ]);
    $search_option = "student_id";
    $search_value = sanitize_text_field($_POST[ 'search' ]);

    global $wpdb;
    $table_name = $wpdb->prefix . "students_data";
    $query = "SELECT * FROM " . $table_name;

    if ( isset( $search_option ) && isset( $search_value ) && $search_option === "student_id" ) {
        $query = $query . " WHERE studentID1 = " . $search_value . " OR studentID2 = " . $search_value;
    }

    if ( isset( $search_option ) && isset( $search_value ) && $search_option === "student_classroom" ) {
        $query = $query . " WHERE classroom = " . $search_value;
    }

    $results = $wpdb->get_results($query);
}
?>

<style>
    h6, table {
        margin: 1rem 0
    }
    th, td {
        text-align: center;
    }
    th {
        font-family: monospace;
        font-size: 2em;
        color: blue;
    }
    table, td, th {
        border: 2px solid #bebe11 !important;
    }
    #container {
        padding: 0 8rem;
    }
    #display-table {
        width: 55%;
        margin: 0 auto;
    }
    #search-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin: 4rem 0;
    }
    #search-container button[type="submit"] {
        margin-top: 4rem;
    }
    .form-group {
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .form-group select {
        background-color: #fff;
    }
    .animated-search-form[type=search] {
      width: 30%;
      box-shadow: 0 0 3.125rem rgba(0, 0, 0, 0.18);
      border-radius: 0;
      background-position: 0.625rem 0.625rem;
      background-repeat: no-repeat;
      padding: 0.75rem 1.25rem 0.75rem 2rem;
      transition: width 0.4s ease-in-out;
      height: 60px
  }

  .animated-search-form[type=search]:focus {
      width: 50%;
      outline: none;
  }

  /* Arrow */
.select::after {
  content: '\25BC';
  position: absolute;
  top: 0;
  right: 0;
  padding: 0 1em;
  background: #cd2653;
  cursor: pointer;
  pointer-events: none;
  -webkit-transition: .25s all ease;
  -o-transition: .25s all ease;
  transition: .25s all ease;
}
/* Transition */
.select:hover::after {
  color: #f39c12;
}

  /* Reset Select */
select {
  -webkit-appearance: none;
  -moz-appearance: none;
  -ms-appearance: none;
  appearance: none;
  outline: 0;
  box-shadow: none;
  border: 0 !important;
  background: #2c3e50;
  background-image: none;
}
/* Remove IE arrow */
select::-ms-expand {
  display: none;
}
/* Custom Select */
.select {
  position: relative;
  display: flex;
  width: 20em;
  height: 3em;
  line-height: 3;
  background: #2c3e50;
  overflow: hidden;
  border-radius: .25em;
}
select {
  flex: 1;
  padding: 0 .5em;
  /*color: #fff;*/
  height: 60px;
  cursor: pointer;
}
.error {
    color: red;
    background-color: #fff;
    width: 100%;
    text-align: center;
    padding: 8px
}
.btn-info {
    background-color: blue !important;
}
</style>
<div id="container">
    <form action="" method="post" id="search-container">
        <h1>Search for Students</h1>
        <div class="form-group">
           <!--  <div class="select">
                <select name="search_option" id="search_options">
                <option value="student_id">Student ID</option>
                <option value="student_classroom">Student Classroom</option>
            </select>
            </div> -->
            <input type="hidden" name="search_secret" value="">
            <input type="search" name="search" placeholder="Search for Student ID.." class="animated-search-form form-control">
        </div>
        <button class="btn btn-info" type="submit" name="submit_search_data"> Search </button>
    </form>

    <!-- Display table -->
    <div id="display-table" class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
          <div class="card-body">
              <div class="table-responsive">
                <?php if (isset( $_POST[ 'submit_search_data' ] )) { ?>
                <h4 class="card-title ">Results (<?= count($results); ?>) </h4>
                <table class="table">
                  <thead class="text-primary">
                <tr>
                    <th>
                      Student ID
                  </th>
                  <th>
                      Student ID
                  </th>
                  <th>
                      Student Classroom
                  </th>
              </tr></thead>
              <tbody>
                <?php foreach ($results as $row) { ?>
                <tr>
                  <td>
                    <strong>
                        <?= $row->studentID1 ?>
                    </strong>
                </td>
                <td>
                    <strong>
                        <?= $row->studentID2 ?>
                    </strong>
                </td>
                <td>
                    <strong>
                        <?= $row->classroom ?>
                    </strong>
                </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } ?>
    <?php if( count( $results ) === 0 && isset( $_POST[ 'submit_search_data' ] ) ) echo "<h6 class='error'>The Student ID you entered is not in the list</h6>"; ?>
</div>
<br />

</div>
</div>

</div>
</div>
</div>
<?php
get_footer();
