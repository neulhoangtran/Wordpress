<?php mesmerize_get_header(); ?>
<div class="content post-page">
    <div class="gridContainer">
        <div class="row">
            <div class="col-xs-12">
                <div class="post-item post-item-single">
                <?php 

                $a = get_field('cau_hoi_trac_nghiem');
                echo '<pre>';
                print_r($a);

                ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
