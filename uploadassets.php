
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

        .upd_ast{
            position: absolute;
            top:0;
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
                    $sql="SELECT * FROM `templates` WHERE id='1 '";

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
                                <td style="position:relative;text-align:center;">
                                    <button id="upload_asset" onclick="uploadAssets()">upload</button>
                                    <div class="upd_ast">
                                        <h5>This are the required Assets to Upload</h5>
                                        <ul class="ulist"></ul>
                                    </div>
                                </td>
                                <td id="align" style="text-align:center;"></td>
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
    var creativeAssets = document.querySelector("#dynadata").children;
    var searchalign = document.querySelector(".search");
    var tdalign = document.querySelector("#align");

    console.log(searchalign.style.length)

    for (let i = 0; i < searchalign.style.length; i++) {
        if(searchalign.style[i] == "width" || searchalign.style[i] == "left" || searchalign.style[i] == "top"){
            console.log(searchalign.style[i])
            tdalign.innerHTML += searchalign.style[i] + "</br>";
        }
    }

    var ulist = document.querySelector(".ulist");

    for (let i = 0; i < creativeAssets.length; i++) {
        if(creativeAssets[i].id == "bg"){
            var list = `<li>Background Image</li>`
        }else{
            var list = `<li>${creativeAssets[i].id}</li>`
        }
        ulist.innerHTML += list;
    }
    console.log(ulist)
    function uploadAssets(){
        document.querySelector(".upd_ast").classList.add("active");
    }
</script>
</html>
