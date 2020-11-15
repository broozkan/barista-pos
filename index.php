<?php
$max = 0;
foreach (new DirectoryIterator('.') as $fileInfo) {
  if ($fileInfo->isDot()) continue;

  $current = pathinfo($fileInfo->getFilename())['filename'];
  if (!is_numeric($current)) continue;
  if ($current > $max) $max = $current;
}

header("Location: /".$max."");
die();
?>
