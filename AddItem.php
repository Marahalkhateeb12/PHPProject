<?php
include 'header.php';
// define variables and set to empty values
$error = $file_name = $item_name = $details = $date = $is_active = $checked = "";
$insert = 0;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_FILES["imageUpload"]["tmp_name"] != '') {
        $target_dir = "uploads/";
        $file_name = basename($_FILES["imageUpload"]["name"]);
        $target_file = $target_dir . basename($_FILES["imageUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["imageUpload"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $error = "File is not an image.";
            $uploadOk = 0;
        }
      

// Check file size
        if ($_FILES["imageUpload"]["size"] > 500000) {
            $error = "File is too large.";
            $uploadOk = 0;
        }

// Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            $error = "Only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

// Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $error = "Sorry, your file was not uploaded. Cause $error";
// if everything is ok, try to upload file
        } else {

            $insert = 1;
        }
        $item_name = $_POST["item_name"];
        if ($item_name == "") {
            $insert = 0;
            $error .= "<br>Please Enter Item Name.";
        }
        $price = $_POST["price"];
        if ($item_name == "") {
            $insert = 0;
            $error .= "<br>Please Enter Price.";
        }
        $details = $_POST["details"];
        if ($details == "") {
            $insert = 0;
            $error .= "<br>Please Enter Item Details.";
        }
        $date = $_POST["date"];
        if ($date == "") {
            $insert = 0;
            $error .= "<br>Please Enter Item Insert Date.";
        }
        $is_active = isset($_POST["is_active"]) && $_POST["is_active"] == "Active" ? "Active" : "Not Active";
        $checked = isset($_POST["is_active"]) && $_POST["is_active"] == "Active" ? "checked='checked'" : "";

        if ($insert != 0) {
            if (move_uploaded_file($_FILES["imageUpload"]["tmp_name"], $target_file)) {
                $stringToAppend = $file_name . "#$#" . $item_name  . "#$#" . $price . "#$#" . $details . "#$#" . $is_active . "#$#" . $date . "\n";
                file_put_contents('filename.txt', $stringToAppend, FILE_APPEND);
                $error = "<label class='alert alert-success'>Added Item successfully completed</label>";
                $file_name = $item_name = $details = $date = $is_active = $checked = "";
            }
        } 
        
    } else {
        $insert = 0;
        $error .= "<br>Please Upload Item Image.";
    }
}
?>

<h3>Add New Item</h3>
<form action="AddItem.php" method="post"  enctype="multipart/form-data">
   
    <div class="mb-3 mt-3">
        <label for="item_name">Item Name:</label>
        <input type="text" class="form-control" id="item_name" name="item_name" value="<?php echo $item_name; ?>">
    </div>
    <div class="mb-3 mt-3">
        <label for="item_name">Price:</label>
        <input type="number" class="form-control" id="price" name="price" value="<?php echo $price; ?>">
    </div>
    <div class="mb-3">
        <label for="details">Details:</label>
        <textarea class="form-control" rows="5" id="details" name="details"><?php echo $details; ?></textarea> 
    </div>
    <div class="mb-3">
        <label for="date">Insert Date:</label>
        <input type="date" class="form-control" id="date" placeholder="Enter Date" name="date"  value="<?php echo date("Y-m-d"); ?>">
    </div>
    <div class="form-check mb-3">
        <label class="form-check-label">
            <input class="form-check-input" type="checkbox" name="is_active" value="Active" <?php echo $checked; ?>> Is Active
        </label>
    </div>
    <div class="mb-3">
        <label for="imageUpload" class="form-label">
            Click to upload Image...
        </label>
        <input class="form-control" type="file" name="imageUpload" accept=".jpg,.png,.gif,.jpeg">
    </div>
    <?php echo $error; ?><br>
    <button type="submit" name="submit" class="btn btn-default">Insert Item</button>
</form>
<table id="items" class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Item Name</th>
            <th>Price</th>
            <th>Item Details</th>
            <th>Item Insert Date</th>
            <th>Item Is Active</th>
            <th>Item Image</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $myfile = fopen("filename.txt", "r") or die("Unable to open file!");
// Output one line until end-of-file
        $i = 1;
        while (!feof($myfile)) {
            $line = explode("#$#", fgets($myfile));
            if (count($line) > 1) {
                echo "<tr><td>$i</td><td>$line[1]</td><td>$line[2]</td><td>$line[3]</td><td>$line[4]</td><td>$line[5]</td><td><img src='uploads/$line[0]' style='width:100px;hight:100px;' /></td></tr>";
                $i++;
            }
        }
        fclose($myfile);
        ?>
    </tbody>
</table>
<?php include 'footer.php'; ?>
        