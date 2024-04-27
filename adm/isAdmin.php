      <?php
      function isAdmin(){
        session_start();

        if (isset($_SESSION['admin_id']) && !empty($_SESSION['admin_id'])) {
          $user_email = $_SESSION['admin_id'];
        } else {
          $user_email = '';
        }
        return $user_email;
      }
      ?>