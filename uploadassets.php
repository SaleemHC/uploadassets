
<?php

include "connection.php";

error_reporting(E_ERROR | E_PARSE);
date_default_timezone_set('Asia/Kolkata'); // india time setting 
$time = date('Y-m-d H:i:s');


$autofcat="";
  $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
  $charCount = strlen($characters);
  for($i=0;$i<6;$i++){
    $autofcat.= substr($characters,rand(0,$charCount),1);
  }

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

        .upd_ast{
            position: absolute;
            /* top:0; */
            display: none;
            border: 1px solid #000;
            padding: 8px;
            background: #fff;
        }

        .upd_ast.active{
            display: block;
        }

        ul{
            text-align: left;
            list-style: none;
            padding: 0;
        }

        /*     margin-top: -60px;
    margin-left: -30px; */
    </style>
</head>
<body>
    <div class="upload_cnt">
        <h2 style="text-align:center;">Upload Assets</h2>
        <h3 style="text-align:center;">Selected Template Name</h3>
        <form method="POST">
                <input id="htmlcode" type="hidden" name="htmlcode" />
                <input id="landing_url" type="hidden" name="landing_url" />
                <input id="imperession_trk" type="hidden" name="imperession_trk" />
                <button onclick="proceed()" name="submit">proceed</button>
                <button onclick="update()" name="update">Update</button>
            </form>
        <div class="slt_tmp">
            <table>
                <thead>
                    <tr>
                        <th>Ad Size</th>
                        <th>Previews</th>
                        <th>Upload Assets</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $sql="SELECT * FROM `templates` WHERE id='1'";

                    $data=mysqli_query($conn,$sql);
                    if(mysqli_num_rows($data)>0){
                        while($row=mysqli_fetch_assoc($data)){
                            $dim = $row['dim'];
                            $tmp_name = $row['template_name'];
                            $script = $row['script_tags'];
                            ?>
                            <tr>
                                <td style="text-align:center;"><?php echo $row['dim']; ?></td>
                                <td style="position:relative;width:180px;height:180px;">
                                    <div id="aspectRatio" style="position:absolute;top:0;left:0">
                                        <?php echo $row['master_code']; ?>
                                    </div>
                                </td>
                                <td style="position:relative;text-align:center;">
                                    <button id="upload_asset" onclick="uploadAssets()">upload</button>
                                    <div class="upd_ast">
                                        <h5>This are the required Assets to Upload</h5>
                                        <ul class="ulist"></ul>
                                    </div>
                                </td>
                            </tr>
                            <?php
                        }}  
                        
                ?>
                </tbody>
            </table>
            
        </div>
        <div class="slt_tmp">
        <table>
                <thead>
                    <tr>
                    <th>Creative alignment</th>
                        <th>Landing URL / Imperession Tracker</th>
                    </tr>
                </thead>
                <tbody>
                        <tr>
                        <td id="searchalign" style="text-align:center;">
                                    <label>Placeholder: </label><input id="placeholder-input" type="text" /> <br>
                                    <label>Placeholder Color : </label><input id="placeholder-color" type="color" /> <br>
                                    <label>Placeholder Font size : </label><input id="placeholder-size" type="text" /> <br>
                                    <label>Top: </label><input id="search-top" type="number" /><br>
                                    <label>Left: </label><input id="search-left" type="number" /> <br>
                                    <label>Width: </label><input id="placeholder-width" type="number" /> <br>
                                    <label>Height: </label><input id="placeholder-height" type="number" /> <br>
                                    <label>Background Colour: </label><input id="search-bg-color" type="color" /> <br>
                                </td>
                                <td id="lp_imp" style="text-align:center;">
                                    <label>Landing URL: </label><input id="lp_utl" type="text" /> <br>
                                    <label>ImperessionTracker : </label><input id="imp_trk" type="text" /> <br>
                                </td>
                        </tr>
                </tbody>
            </table>
        </div>
    </div>

    <?php

        if(isset($_POST['submit'])){
            $htmlcode = $_POST['htmlcode'];
            $landing_url = $_POST['landing_url'];
            $imperession_trk = $_POST['imperession_trk'];
            // echo $htmlcode;
            $sql1 = "INSERT INTO creativecode (name,campaign,type,cdata,client,dimension,filter,status,content,clicks,impressions) VALUES ('$tmp_name','searchtile','static','popular','plumsearch','$dim','$autofcat','active','$htmlcode','$landing_url','$imperession_trk')";
            $data1=mysqli_query($conn,$sql1);
        }

        if(isset($_POST['update'])){
            $htmlcode = $_POST['htmlcode'];
            $sqlid = "SELECT id FROM creativecode ORDER BY id DESC LIMIT 1";
            $resultid = mysqli_query($conn,$sqlid);
            $row=mysqli_fetch_assoc($resultid);
            $id = $row['id'];
            $sql1 = "UPDATE creativecode SET updated_at='$time' WHERE id='$id'";
            $data1=mysqli_query($conn,$sql1);
        }


    ?>
</body>

<script>

    // Aspect Ratio
    let aspectRatio = document.querySelector("#aspectRatio");
    let dim = "<?php echo $dim; ?>"
    let width_bx;
    let height_bx;
    
    // Spliting width and height
    width_bx = dim.split("x")[0]
    height_bx = dim.split("x")[1]

    // aspect condition 
    if(width_bx > height_bx){
        var scale_vl = 180/Number(width_bx);
        aspectRatio.style.transform=`scale(${scale_vl})`;
    }else{
        var scale_vl = 180/Number(height_bx);
        aspectRatio.style.transform=`scale(${scale_vl})`;
    }
    
    function uploadAssets(){
        document.querySelector(".upd_ast").classList.toggle("active");
    }

    function proceed(){
        document.querySelector("#htmlcode").value = aspectRatio.innerHTML.trim();
        document.querySelector("#landing_url").value = document.getElementById("lp_utl").value;
        document.querySelector("#imperession_trk").value = document.getElementById("imp_trk").value;
        console.log(document.querySelector("#htmlcode").value)
    }

    function update(){
        document.querySelector("#htmlcode").value = aspectRatio.innerHTML.trim();
        console.log(document.querySelector("#htmlcode").value)
    }

</script>
<?php echo $script; ?>
</html>
