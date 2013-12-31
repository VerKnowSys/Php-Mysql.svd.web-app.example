<?php

try {
  $curr_dir = getcwd(); # copy app root dir to var
  chdir(getcwd() . "/../../");
  # NOTE: from global definitions: databaseName = serviceName + "_" + stage;
  $serviceName = basename(getcwd()); # gather name of directory which is also service name
  chdir($curr_dir); # go back to app root dir
  $stage = "staging";

  $dbh = new PDO('mysql:socket=localhost:~/SoftwareData/Mysql/service.sock;dbname='.$serviceName."_".$stage,
    '', ''
  );

  $stmt = $dbh->prepare('select * from test1'); # test1 is a testing database created by init.sql file
  $stmt->execute();
  $results = $stmt->fetchAll();
  var_dump($results);

} catch (PDOException $e) {
  print "Error!: " . $e->getMessage() . "<br/>";
  die();
}

?>
