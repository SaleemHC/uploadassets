
<?php

include "connection.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Upload Assets</title>

    <style>
        .slt_tmp{
            width: 100%;
            display: flex;
            justify-content:center;
        }
        table{
            width: 80%; 
        }
        table,tr,td,th{
            border: 1px solid #000;
        }
        /*     margin-top: -60px;
    margin-left: -30px; */
    </style>
</head>
<body>
    <div class="upload_cnt">
        <h2 style="text-align:center;">Upload Assets</h2>
        <h3 style="text-align:center;">Selected Template Name</h3>
        <div class="slt_tmp">
            <table>
                <thead>
                    <tr>
                        <th>Ad Size</th>
                        <th>Previews</th>
                        <th>Upload Assets</th>
                        <th>Creative alignment</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $sql="SELECT * FROM `templates` WHERE id='1'";

                    $data=mysqli_query($conn,$sql);
                    if(mysqli_num_rows($data)>0){
                        while($row=mysqli_fetch_assoc($data)){
                            ?>
                            <tr>
                                <td style="text-align:center;"><?php echo $row['dim']; ?></td>
                                <td style="position:relative;width:180px;height:180px;">
                                    <div style="position:absolute;top:0;left:0;transform: scale(0.5);">
                                        <?php echo $row['master_code']; ?>
                                    </div>
                                </td>
                                <td style="text-align:center;">
                                    <button id="upload_asset" onclick="uploadAssets()">upload</button>
                                </td>
                                <td style="text-align:center;">alignment</td>
                            </tr>
                            <?php
                        }}               

                ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

<script>
    function uploadAssets(){
        document.querySelector(".upd_ast").classList.add("active");
    }
</script>
</html>
