<script type="text/javascript">
function submitForm(event) {
    var target = event.target;
    var buttonId = target.id;
    var myForm = document.getElementById('find-form');
    myForm.action.value = buttonId;
    myForm.submit();
    return false;
}
</script>
<?php
 echo <<<EOT
 <form id="find-form" method="get" action="index.php">
    <fieldset>
        <label for="title">Title: </label><input type="text" name="title" id="title" placeholder="enter title" />
   </fieldset>
    <fieldset>
        <button type="button" id="findByTitle" name="findByTitle" onclick="submitForm(event);return false;">Find</button>
        <input name="action" id="action" hidden="hidden" value="add"/>
    </fieldset>
</form>
EOT;
