<?php
include 'header.php';
?><div class="btn-group" role="group" aria-label="Button group with nested dropdown">
<div class="btn-group" role="group">
  <button id="aaaa" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
    Dropdown
  </button>
  <ul class="dropdown-menu" aria-labelledby="aaaa">
    <li><a class="dropdown-item" href="#">Dropdown link</a></li>
    <li><a class="dropdown-item" href="#">Dropdown link</a></li>
  </ul>
</div>
</div>
<?php
include 'footer.php'

?>