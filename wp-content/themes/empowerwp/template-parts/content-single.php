<?php 
$a = get_field('cau_hoi_trac_nghiem');
$randomResult = randomGen(0,count($a) - 1  ,20);


?>

<div class="content post-page">
    <div class="gridContainers">
        <div class="row">
            <div class="col-xs-12">
                <div class="post-item post-item-single">
                    <section>
                        <?php 
                            $j = [];
                            $answer = [];
                            for($i = 0 ; $i < count($randomResult) ; $i++ ){
                                $j = $randomResult[$i]; ?>
                                <div class="sections">
                                    <div class="qes">
                                        <h3><?php echo ($a[$j]['cau_hoi']) ;?></h3>
                                    </div>
                                    <div class="ans">
                                        <?php 
                                            $answer = $a[$j]['dap_an'];
                                            // echo '<pre>';
                                            // print_r($a);
                                            // echo '</pre>';
                                            $x = 0;
                                            foreach ($answer as $key) {
                                                echo '<label for="rs' . $i . '-'. $x. '">';
                                                echo '<input class="field-rs" type="radio" id="rs' .$i . '-'. $x . '" name="rs' . $i . '" value="' . $x. '">'
                                                . $key['dap_an_'] . '<br>';
                                                echo '</label>';
                                                $x++;
                                            }
                                            echo '<input type="hidden" name="rzs_' . $i . '" value="'.$a[$j]['dap_an_dung'] .'">';
                                        ?>
                                        
                                    </div>
                                </div>
                        <?php } ?>   
                    </section>
                    <div class="bt">
                        <button type="submit">Nộp Bài</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="wrap-result-table">
<div class="content post-page result-table">
    <div class="gridContainer">
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <div class="rsss">
                    <div class="title">
                        <h3>================Kết Quả Thi================</h3>
                    </div>
                    <div class="content">
                        <div class="table">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Câu trả lời đúng</th>
                                        <th>Câu trả lời sai</th>
                                        <th>Điểm số</th>
                                        <th>Xếp loại</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="true-ans"></td>
                                        <td class="false-ans"></td>
                                        <td class="scores"></td>
                                        <td class="classification"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="bt btn re-tesst">
                            <a class="watch-ans" href="#">Xem đáp án</a>
                            <a href="http://localhost:8080/wp/Wordpress/">Về trang chủ</a>
                            <a href="#" onClick="window.location.reload();">Thi Lại</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


<style type="text/css">
     /*.container.top-content  .left {
        border-right: 2px solid red;
        box-shadow: 10px 0 5px -2px red;
     }*/
    .sticky-sidebar .container.top-content  .left {
        position: fixed;
        top: 150px;
        width: 23%;
        border-right: 2px solid red;
        box-shadow: 10px 0 10px -2px red;
        z-index: 999;
        max-width: 300px;

    }

    .sticky-sidebar .container.top-content .main {
        margin-left: 25%;
        width: 100% !important;
    }
    .sticky-sidebar .result-table{
        /*display: none;*/
    }

    .wrap-result-table.active , .wrap-result-table.active:after {
        display: block;
    }
    .wrap-result-table {
        position: fixed;
        width: 100%;
        height: 100%;
        z-index: 9999;
        overflow: hidden;
        display: none;
        top: 0;
        left: 0;
    }

    .wrap-result-table:after {
        background: #000;
        content: "";
        width: 100%;
        height: 100%;
        position: absolute;
        z-index: 99;
        top: 0;
        left: 0;
        opacity: .7;
        display: none;
    }

    
    html.not-scroll{
        overflow: hidden;
    }
    .content.post-page.result-table {
        position: absolute;
        z-index: 999;
        width: 80%;
        max-width: 1200px;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        padding: 50px 0 !important;
        
    }

    table th, table td {
        padding-left: 5px !important;
        color: #000;
    }

    table th {
        background-color: #c6c6c6;
        color: #000;
    }
    .content.post-page {
        position: relative;
        z-index: 9;
    }
    .result-table.active{
        display: block;
    }
    .bt {
        display: block;
        text-align: right;
    }
    .post-item.post-item-single .sections {
        margin-bottom: 20px;
        display: block;
    }

    .post-item.post-item-single section {
        padding: 50px 50px 30px;
    }

    .post-item.post-item-single form .ans {
        display: flex;
        justify-content: space-between;
    }

    .post-item.post-item-single form .ans:before , .post-item.post-item-single form .ans:after {
        display: none;
    }
    .ans input{
        width: 20px;
        height: 20px;
        position: relative;
        top: -1px;
        margin-right: 5px;
    }
    .ans label{
        font-size: 16px;
        font-weight: 400;
        display: inline-block;
        max-width: 100%;
        width: 100%;
        padding-right: 15px;
        margin-bottom: 10px;
    }
    .ans {
        display: flex;
        flex-direction: column;
    }

    .qes h3{
        color: #000;
        font-size: 28px;
        font-weight: 400;
    }
    .qes {
        display: block;
        margin-bottom: 10px;
    }


    button[type="submit"] {
        display: inline-block;
        padding: 20px 50px;
        border-radius: 12px;
        background: #00abfa;
        color: #FFF;
        font-size: 18px;
        font-weight: bold;
    }

    button[type="submit"]:hover {
        background: #0097dc;
    }
    input:focus:not(.button):not([type=submit]), select:focus:not(.button):not([type=submit]), textarea:focus:not(.button):not([type=submit]){
        outline: 0;
        background-color: #fff;
        border-color: 0;
        box-shadow: none;
    }
    .rsss .content .btn{
        display: flex;
        justify-content: space-between;
    }
    .rsss .title h3 {
        text-align: center;
        display: block;
        margin-bottom: 20px;
    }
    @media screen and (max-width: 767px){
        .sticky-sidebar .container.top-content  .left {
            top: 100px;
            width: 23%;
            z-index: 999;
            background: #fff;
            padding: 10px 0 0 0;
            border: 1px solid red;
            box-shadow: 6px 5px 6px -2px red;
        }

        .sticky-sidebar .container.top-content .main {
            margin-left: 0%;
            width: 100% !important;

        }
        .sticky-sidebar .container.top-content .left .cate,
        .sticky-sidebar .container.top-content .left .link-all{
            display: none;
        }
        .post-item.post-item-single section {
            padding: 0;
            text-align: justify;
        }
        .qes h3 {
            font-size: 16px;
            font-weight: bold;
        }

        .ans label {
            font-size: 14px;
        }
    }
</style>