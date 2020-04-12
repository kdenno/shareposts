<?php
session_start();
function createSession($data) {
  foreach($data as $key => $value){
    $_SESSION[$key] = $value;
  }
  return true;

}
function destroySession($data){
  foreach($data as $key){
    unset($_SESSION[$key]);
  }
  session_destroy();
  return true;
}
