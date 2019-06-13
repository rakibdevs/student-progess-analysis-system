<?php
   $page="Library"; 
   require_once('include/header.php');
   require_once('connect.php');

 ?>


<div class="container-fluid"> 
 <div class="row">
    <div class="col-lg-8 book">
    <div class="panel-body ">
    <h4>Books</h4>
    <?php
    $query = $mysqli->query("select * from books");
			while($rows = $query->fetch_array()){
    ?>
    	<div class="col-lg-4 book-info">
            <div style="background:#f6f8fa;" class="courses-inner res-mg-b-30  ">
                <div class="file-body incon-ctn-view">
                    <i class="fa fa-file-pdf-o text-info"></i>
                </div>
                <div class="courses-title">
                  
                    <h6>
                       <?php 
                       echo $rows['book_name']; 
                       if ($rows['edition']!='') {
                         echo '- <i>'.$rows['edition'].'</i>'; 
                       }
                       ?>
                     </h6>
                     <i style="font-size:12px;">by <?php echo $rows['writer']; ?> </i>
                </div>
              
                <div class="product-buttons">
                    <a  href="read.php?book_id=<?php echo $rows['id']; ?>&&title=<?php echo $rows['book_name']; ?>"><button type="button">Read</button></a>
                    <a ><button type="button" style="background-color:green;" onclick="download('upload/books/<?php echo $rows['filename']; ?>','<?php echo $rows['filename']; ?>');" class="button-default cart-btn">Download</button></a>
                </div>
                


            </div>
        </div>
        <?php } ?>
       
    </div>
    </div>
    <div class="col-lg-4 ">
     <div class="panel-body">
      <h4>Course Material</h4>
      <ul class="content-list">
       <?php
       $query_r = $mysqli->query("select * from course_content order by content_id desc limit 10");
       while($row_r = $query_r->fetch_array()){
        $query_t =$mysqli->query("select * from teacher where id=$row_r[up_by] ");
        $row_t = $query_t->fetch_array();
        echo '<li> <i class="fa fa-hand-o-right">  </i> <a href="course_content.php?content_id='.$row_r['content_id'].'&&title='.$row_r['topic_name'].'"> '.$row_r['topic_name'].'</a> by 
<a style="font-size:12px;color:#d19354" href="teacher.php?id='.$row_t['id'].'&&name='.$row_t['full_name'].'"><i>'.$row_t['full_name'].'</i></a></li>';
       }
       ?>
     </ul>
    </div>	
    </div>
 </div>


</div>

<script type="text/javascript">
    function download(dataurl, filename) {
      var a = document.createElement("a");
      a.href = dataurl;
      a.setAttribute("download", filename);
      var b = document.createEvent("MouseEvents");
      b.initEvent("click", false, true);
      a.dispatchEvent(b);
      return false;
    }

    //download("data:text/html,HelloWorld!", "helloWorld.txt");
</script>


<?php require_once('include/footer.php'); ?>