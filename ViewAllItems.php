<?php
include 'header.php';
?>
<!-- <table id="items" class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Item Name</th>

            <th>Item Details</th>
            <th>Item Insert Date</th>
            <th>Item Is Active</th>
            <th>Item Image</th>
        </tr>
    </thead>
    <tbody> -->
        <div class="c">
        <?php
        $myfile = fopen("filename.txt", "r") or die("Unable to open file!");
// Output one line until end-of-file
        $i = 1;
        while (!feof($myfile)) {
            $line = explode("#$#", fgets($myfile));
            if (count($line) > 1) {
             echo "<div class='col-md-4 mt-2' >
             <div class='card '>
             <div class='card-body'>
             <img class='card-img-top' src='uploads/$line[0]' style='width:200px; height:200px; '  >
             </div>
             <div class='card-body'>
               <h4 class='mb-2'>".$line[1]."</h4>
               <p class='card-text'>Price :".$line[2]."</p>
               <p class='card-text'>Details :".$line[3]."</p>
               <p class='card-text'>Is Active :".$line[4]."</p>
              
               </div>
             </div>
             </div>
           ";
                // echo "<tr><td>$i</td><td>$line[1]</td><td>$line[2]</td><td>$line[3]</td><td>$line[4]</td><td><img src='uploads/$line[0]' style='width:100px;hight:100px;' /></td></tr>";
                $i++;
            }
        }
        fclose($myfile);
        ?>
        </div>
    <!-- </tbody>
</table> -->
<?php include 'footer.php'; ?>
        