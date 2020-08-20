<?php
require 'header.php';
?>

  <div class="bgColor">
    <form id="uploadForm" action="uploadFile.php" method="post"
    enctype="multipart/form-data">
    <div id="uploadFormLayer">
      <label for="userImage" id="label" class="btn btn-primary">Choose File
        <input name="userImage" id="userImage" type="file"
        class="inputFile d-none hide" >
      </label>
      <span class="filename"></span>
      <input type="submit"
      name="upload" value="Submit" class="btnSubmit">
    </div>
  </form>
</div>
<br>
<div class="row">
  <img src="" id="result_img" class="img" style="display: none;" />
</div>
<div class="report"></div>

<?php require 'footer.php'; ?>