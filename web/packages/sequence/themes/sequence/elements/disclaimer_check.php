<?php
  //we don't trust how c5 handles cookis so we're doing some extra checking here
  if (strstr($_SERVER['HTTP_REFERER'], 'www.titlecardcapital.com') == false || empty($_SERVER['HTTP_REFERER']) ) {
    header('Location: /disclaimer');
    exit;
  }
  // Get cookie 'helper'.
  $ch = \Core::make('cookie');
  $cookie = $ch->get('disc');
  if($cookie != 'yes'){
    header('Location: /disclaimer');
    exit;
  }
