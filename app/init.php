<?php
fSession::setPath(SESSION_PATH);
fSession::setLength("1 day");
fORMDatabase::attach(new fDatabase("mysql", DB_NAME, DB_USER, DB_PASS, DB_HOST));
Twig_Autoloader::register();
