<?php
print_r($_FILES);
$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["File1"]["name"]);
$extension = end($temp);
print "<BR>extension=[$extension] ";
if ((($_FILES["File1"]["type"] == "image/gif")
|| ($_FILES["File1"]["type"] == "image/jpeg")
|| ($_FILES["File1"]["type"] == "image/jpg")
|| ($_FILES["File1"]["type"] == "image/pjpeg")
|| ($_FILES["File1"]["type"] == "image/x-png")
|| ($_FILES["File1"]["type"] == "image/png"))
&& ($_FILES["File1"]["size"] < 2000000)
&& in_array($extension, $allowedExts))
  {
  if ($_FILES["File1"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["File1"]["error"] . "<br>";
    }
  else
    {
    echo "Upload: " . $_FILES["File1"]["name"] . "<br>";
    echo "Type: " . $_FILES["File1"]["type"] . "<br>";
    echo "Size: " . ($_FILES["File1"]["size"] / 1024) . " kB<br>";
    echo "Temp file: " . $_FILES["File1"]["tmp_name"] . "<br>";

    if (file_exists("upload/" . $_FILES["File1"]["name"]))
      {
      echo $_FILES["File1"]["name"] . " already exists. ";
      }
    else
      {
      move_uploaded_file($_FILES["File1"]["tmp_name"],
      "upload/" . $_FILES["File1"]["name"]);
      echo "Stored in: " . "upload/" . $_FILES["File1"]["name"];
      }
    }
  }
else
  {
  echo "Invalid file";
  }
?>