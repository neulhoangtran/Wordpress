<?php
/*
*Template Name: Quiz Result
 */
mesmerize_get_header(); ?>
<div class="content post-page">
    <div class="gridContainer">
        <div class="row">
            <div class="col-sm-8 col-md-9">
                <?php 
                $rs = [];
                $rss = [];
                foreach ($_POST as $key => $value) {
                    $rs[$key] = $value;
                }
               echo '<pre>';
                    var_dump($rs); echo '</pre>';
                ?>

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
                                        <td>1</td>
                                        <td>2</td>
                                        <td>3</td>
                                        <td>4</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="bt btn">
                            <a href="#">Về trang chủ</a>
                        </div>
                    </div>
                </div>
            </div>
			<?php get_sidebar(); ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>
