<?php
$page = 'home';
require 'header.php';
?>
<h2>Single File Upload </h2>
  <div class="bgColor">
    <form id="uploadForm" action="uploadFile.php" method="post"
    enctype="multipart/form-data">
    <div id="uploadFormLayer">
      <label for="userImage" id="label" class="btn btn-primary">Choose File
        <input name="userImage" id="userImage" accept="image/*" type="file"
        class="inputFile d-none hide" >
      </label>
      <span class="filename"></span>
      <input type="submit"
      name="upload" value="Submit" class="btnSubmit">
    </div>
  </form>
</div>

<h2>Multiple File Upload </h2>
  <div class="bgColor">
    <form id="multipleUploadForm" action="multipleUploadForm.php" method="post"
    enctype="multipart/form-data">
    <div id="uploadFormLayer">
      <label for="images" id="labels" class="btn btn-primary">Choose File
        <input name="images[]" id="images" accept="image/*" multiple="" type="file"
        class="inputFile d-none hide" >
      </label>
      <span class="filenames"></span>
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