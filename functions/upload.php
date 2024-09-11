<?php

if($_FILES){

                $validextensions = array("jpeg", "jpg", "png", "doc", "docx", "xslx", "xls", "pdf");
                $temporary = explode(".", $_FILES["file"]["name"]);
                $file_extension = end($temporary);
                      
                if (
                      (($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") 
                        || ($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "application/msword")
                        || ($_FILES["file"]["type"] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document") 
                        || ($_FILES["file"]["type"] == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet") 
                        || ($_FILES["file"]["type"] == "application/msexcel") || ($_FILES["file"]["type"] == "application/pdf")
                      ) 
                      && ($_FILES["file"]["size"] < 1000000)//Approx. 1mb files can be uploaded.
                      && in_array($file_extension, $validextensions)
                  ) {
            
                    if ($_FILES["file"]["error"] > 0) {
                        echo "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
                    } else {
                        
                       /* echo "<span>Your File Uploaded Succesfully...!!</span><br/>";
                        echo "<br/><b>File Name:</b> " . $_FILES["file"]["name"] . "<br>";
                        echo "<b>Type:</b> " . $_FILES["file"]["type"] . "<br>";
                        echo "<b>Size:</b> " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
                        echo "<b>Temp file:</b> " . $_FILES["file"]["tmp_name"] . "<br>";
                        */
            
                        if (file_exists("upload/" . $_FILES["file"]["name"])) {
                            echo $_FILES["file"]["name"] . " <b>already exists.</b> ";
                        } else {
                            $temporary = explode(".", $_FILES["file"]["name"]);
                            $file_extension = end($temporary);
                            $file_name ='uploaded by_'.$user->data()->full_name.'on_'.date('Y-m-d H:i:s');
                            
                            move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" .$file_name.'.'.$file_extension);
                            $imgFullpath = "http://".$_SERVER['SERVER_NAME'].dirname($_SERVER["REQUEST_URI"].'?').'/'. "upload/" . $_FILES["file"]["name"];
                   // echo "<b>Stored in:</b><a href = '$imgFullpath' target='_blank'> " .$imgFullpath.'<a>';
                          
                        }
                    
                    }
                } else {
                    //echo "File type or size not supported";
                    ?>
                    <script>alert('Uploaded File type or size not supported');</script>
                    <?php
                    exit;
                }
    }
?>