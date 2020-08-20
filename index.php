<?php
require 'header.php';
?>
	<div class="bgColor">
    <form id="uploadForm" action="uploadFile.php" method="post"
        enctype="multipart/form-data">
        <div id="uploadFormLayer">
            <input name="userImage" id="userImage" type="file"
                class="inputFile">
            <br> 
            <input type="submit"
                name="upload" value="Submit" class="btnSubmit">
        </div>
    </form>
  </div>
    <br>
    <div class="container">
      <div class="thumbnail">
        <img src="" id="result_img" class="img" style="display: none;" />
      </div>
    </div>

<?php require 'footer.php'; ?>