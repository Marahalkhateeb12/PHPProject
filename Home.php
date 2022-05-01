<?php include 'header.php'; ?>
<div class="container">
    <div>
    <img src="images/homee.jfif" style="padding-top:80px;  padding-left:380px">
</div>
<div style="padding-left:380px">
    <h4>Welcome to our store..Now you can Add, View Items</h4>
    <button class="btn1" id="b1" onclick="add()">Add Item</button>
    <button class="btn1" onclick="view()" >View All Items</button>
</div>
</div>
<script>
    function add(){
        location.href="AddItem.php";
    }
    function view(){
        location.href="ViewAllItems.php";
    }
</script>
<?php include 'footer.php'; ?>