<?php mesmerize_get_header(); 
$a = get_field('cau_hoi_trac_nghiem');
$randomResult = randomGen(0,count($a) - 1  ,20);
; //generates 20 unique random numbers?>
<div class="content post-page">
    <div class="gridContainer">
        <div class="row">
            <div class="col-xs-12">
                <div class="post-item post-item-single">
                <form action="http://localhost:8080/wp/Wordpress/result/" method="post">
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
                                                echo '<input type="radio" id="rs' .$i . '-'. $x . '" name="rs' . $i . '" value="' . $x. '">'
                                                . $key['dap_an_'] . '<br>';
                                                echo '</label>';
                                                $x++;
                                            }
                                            echo '<input type="hidden" name="rss-' . $i . '" value="'.$a[$j]['dap_an_dung'] .'">';
                                        ?>
                                        
                                    </div>
                                </div>
                        <?php } ?>   
                    </section>
                    <button type="submit">Nộp Bài</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="result">
<?php 
var_dump($_POST);
?>
</div>
<?php get_footer(); ?>