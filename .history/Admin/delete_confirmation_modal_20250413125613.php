<div id="confirmModal" style="display:none; position:fixed; top:30%; left:40%; background:#fff; padding:20px; border:1px solid #ccc;">
  <p>Are you sure you want to delete this item?</p>
  <form method="POST" action="delete.php">
    <input type="hidden" name="item_id" id="deleteItemId">
    <button type="submit" name="confirm_delete">Yes, Delete</button>
    <button type="button" onclick="closeModal()">Cancel</button>
  </form>
</div>