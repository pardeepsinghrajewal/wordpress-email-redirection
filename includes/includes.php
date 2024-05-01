<?php

if(file_exists(plugin_dir_path(__FILE__).'backend/admin.php'))
{  
  include_once plugin_dir_path(__FILE__).'backend/admin.php';
}
if(file_exists(plugin_dir_path(__FILE__).'frontend/front-end.php'))
{  
  include_once plugin_dir_path(__FILE__).'frontend/front-end.php';
}

