<?php mesmerize_get_header(); 
$a = get_field('cau_hoi_trac_nghiem');
$randomResult = randomGen(0,count($a) - 1  ,20);
; //generates 20 unique random numbers?>
<div class="content post-page">
    <div class="gridContainer">
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

<script>
    jQuery(document).ready(function($){
        $('input[type=radio]').change(function(){
            $(this).closest('.sections').addClass('ans');
            var val = $(this).val();
            var val2 = $(this).closest('.ans').find('input[type=hidden]');
            if(val == val2.val()){
                $(this).closest('.sections').addClass('true');
            }else{
                $(this).closest('.sections').addClass('false');
            }
        })

        $('.bt button').click(function(){
            let a = $('.sections.ans');
            console.log(a);
            if(a.length != 20){
                alert('Bạn còn câu chưa trả lời!');
            }else{
                let trues = $('.sections.ans.true'),
                falses = $('.sections.ans.false'),
                point = 10 / 20,
                score = trues.length * point ;
                let classification = ['Giỏi' , 'Khá' , 'Trung Bình' , 'Yếu'];
                console.log(point);
                console.log(score);

                $('.result-table .true-ans').text(trues.length);
                $('.result-table .false-ans').text(falses.length);
                $('.result-table .scores').text(score);


            }
        })
    })
</script>

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
                        <div class="bt btn">
                            <a href="#">Thi Lại</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>


<style type="text/css">
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
        font-size : 16px;
        font-weight: 400;
        display: inline-block;
        max-width: 25%;
        width: 25%;
        padding-right: 15px;
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
        text-align: right;
        font-size: 14px;
    }
    .rsss .title h3 {
        text-align: center;
        display: block;
        margin-bottom: 20px;
    }
</style>