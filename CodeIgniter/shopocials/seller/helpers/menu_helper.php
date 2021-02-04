<?php
function printMenu($a) {

  if (!is_array($a)) {
    return;
  }

  foreach($a as $m) {
      if($m['parent_category'] > 0){
          echo '<li><a tabindex="-1" href="#">'. $m['category'] .'</a></li>';
      }

      if(is_array($m['child'])){
        printMenu($m['child']);
      }
  }
}