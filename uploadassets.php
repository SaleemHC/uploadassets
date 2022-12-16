
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
                            $dim = $row['dim'];
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
                                <td id="searchalign" style="text-align:center;">
                                <label>Placeholder: </label><input id="place_id" type="text" /> <br>
                                <label>Top: </label><input id="top_id" type="number" /><br>
                                <label>Left: </label><input id="left_id" type="number" /> <br>
                                <label>Width: </label><input id="width_id" type="number" /> <br>
                                <label>Height: </label><input id="height_id" type="number" /> <br>
                                <label>Background Colour: </label><input id="bgcolor_id" type="color" /> <br>
                                <label>Text Colour: </label><input id="color_id" type="color" /> <br>
                                </td>
                            </tr>
                            <?php
                        }}  
                        
                ?>
                </tbody>
            </table>
            <form method="POST">
                <input id="htmlcode" type="hidden" name="htmlcode" />
                <button onclick="proceed()" name="submit">proceed</button>
                <button name="update">Update</button>
            </form>
        </div>
    </div>

    <?php

        if(isset($_POST['submit'])){
            $a = $_POST['htmlcode'];
            $sql1 = "INSERT INTO creativecode (name,campaign,type,cdata,client,dimension,filter,status,content,updated_at,created_at) VALUES ('search','searchtile','static','popular','plumsearch','$dim','$autofcat','active','$a','0:0:0','$time')";
            $data1=mysqli_query($conn,$sql1);
        }

        // if(isset($_POST['update'])){
        //     $a = $_POST['htmlcode'];
        //     $sql1 = "INSERT INTO creativecode (name,campaign,type,cdata,client,dimension,filter,status,content,updated_at,created_at) VALUES ('search','searchtile','static','popular','plumsearch','$dim','jfgdfj','active','$a','0:0:0','$time')";
        //     $data1=mysqli_query($conn,$sql1);
        // }


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

    var creativeAssets = document.querySelector("#dynadata").children;
    var searchalign = document.querySelector(".search");
    var searchStyle = document.querySelector("#searchstyle");
    var searchalign = document.querySelector("#searchalign");
    var searchbox = document.querySelector("#searchbox");

    var ulist = document.querySelector(".ulist");
    let inputBox = searchalign.querySelectorAll("input");
    var placeholder = document.querySelector("#place_id");
    var tops = document.querySelector("#top_id");
    var lefts = document.querySelector("#left_id");
    var widths = document.querySelector("#width_id");
    var heights = document.querySelector("#height_id");
    var bgcolors = document.querySelector("#bgcolor_id");
    var colors = document.querySelector("#color_id");


    placeholder.addEventListener('keyup',() => {
        searchStyle.placeholder = placeholder.value; 
    })

    tops.addEventListener('keyup',() => {
        searchbox.style.top = tops.value + "px";
    })

    lefts.addEventListener('keyup',() => {
        searchbox.style.left = lefts.value + "px";
    })

    widths.addEventListener('keyup',() => {
        searchStyle.style.width = widths.value + "px";
    })

    heights.addEventListener('keyup',() => {
        searchStyle.style.height = heights.value + "px";
    })

    bgcolors.addEventListener('change',() => {
        searchStyle.style.backgroundColor = bgcolors.value;
        searchbox.style.backgroundColor = bgcolors.value;
    })

    colors.addEventListener('change',() => {
        searchStyle.style.color=colors.value
    })

    for (let i = 0; i < creativeAssets.length; i++) {
        var list = `<li>${creativeAssets[i].id}</li>`
        ulist.innerHTML += list;
    }
    
    function uploadAssets(){
        document.querySelector(".upd_ast").classList.toggle("active");
    }

    function proceed(){
        document.querySelector("#htmlcode").value = aspectRatio.innerHTML.trim();
        console.log(document.querySelector("#htmlcode").value)
    }

</script>
</html>
