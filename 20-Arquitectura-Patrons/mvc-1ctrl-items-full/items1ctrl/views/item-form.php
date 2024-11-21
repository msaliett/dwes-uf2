<script type="text/javascript">
function submitForm(event) {
    var target = event.target;
    var buttonId = target.id;
    var myForm = document.getElementById('item-form');
    myForm.action.value = buttonId;
    myForm.submit();

}
</script>
<?php
   $item = $params['item']??null;  //?? is the 'null coalescing operator'.
   $action = $params['action']??"findItem";
   $result = $params['result']??null;
   if (is_null($item)) {
       $item = new Item(0, "");
   }
   $disable = (($action == "findItem")||($action == "itemForm"))?"disabled":"";
   if (!is_null($result)) {
       echo <<<EOT
       <div><p class="alert">$result</p></div>
       EOT;
   }   
   echo <<<EOT
   <form id="item-form" method="get" action="index.php">
    <fieldset>
        <label for="id">Id: </label><input type="text" name="id" id="id" placeholder="enter id" value="{$item->getId()}"/>
        <label for="title">Title: </label><input type="text" name="title" id="title" placeholder="enter title" value="{$item->getTitle()}"/>
        <label for="content">Content: </label><input type="text" name="content" id="content" placeholder="enter content" value="{$item->getContent()}"/>
   </fieldset>
    <fieldset>
        <button type="button" id="findItem" name="findItem" onclick="submitForm(event);return false;">Find</button>
        <button type="button" id="addItem" name="addItem" onclick="submitForm(event);return false;">Add</button>
        <button type="button" id="modifyItem" name="modifyItem" {$disable} onclick="submitForm(event);return false;">Modify</button>
        <button type="button" id="removeItem" name="removeItem" {$disable} onclick="submitForm(event);return false;">Remove</button>
        <input name="action" id="action" hidden="hidden" value="toChange"/>
        
    </fieldset>
</form>
EOT;
