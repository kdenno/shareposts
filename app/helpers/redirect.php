<?php
function redirect($route) {
  header('location: '. URLROOT.'/'.$route);
}
?>