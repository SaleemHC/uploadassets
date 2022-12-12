<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Upload Assets</title>
    <style>
        body{
            text-align:center;
        }
        .slt_tmp{
            width: 100%;
            display: flex;
            justify-content:center;
        }

        table{
            width: 80%;
        }
        table,th,td{
            border: 1px solid #000;
            text-align: center;
        }
        th{
            padding: 10px 0;
        }
        td{
            padding: 10px 0;
            position: relative;
        }


        td .upd_ast{
            position: absolute;
            top: 0;
            border: 1px solid #000;
            display: none;
            background: #fff;
            padding: 0 12px;
        }

        td .upd_ast.active{
            display: block;
        }

        .prv_bx{
            width: 200px;
        }
        .prv{
            width: 150px;
            height: 150px;
            /* object-fit: cover; */
            border: 1px solid #000;
            margin: 0 auto;
            
        }
        .assets_req{
            text-align: left;
        }
        .assets_req ul{
            list-style: none;
            padding-left: 0;
        }
    </style>    
</head>
<body>
    <div class="upload_cnt">
        <h2>Upload Assets</h2>
        <h3>Selected Template Name</h3>
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
                    <tr>
                        <td>300x250</td>
                        <td>Preview</td>
                        <td>
                            <button id="upload_asset" onclick="uploadAssets()">upload</button>
                            <div class="upd_ast">
                                <h5>Upload Assets</h5>
                                <div class="assets_req">
                                    <ul>
                                        <li>background image</li>
                                        <li>copy</li>
                                        <li>cta</li>
                                    </ul>
                                </div>
                            </div>
                        </td>
                        <td>alignment</td>
                    </tr>
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
