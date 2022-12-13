<?php    
ob_start();
session_start();   
$style="updateMember.css";
$page_name = " - جميع الاخبار";
include "init.php";
if(isset($_SESSION['admin_ssn'])){ 
$role_data = getData_with_id('role',$_SESSION['role']); // $_SESSION['role'] => role id

$roles= explode("/",$role_data['authentications']) ; 

require './layout/topNav.php';
?>

    <style>
        .columns {
            float: unset !important;
            display: block;
            margin:20px auto !important;

        }
    </style>
<div id="layoutSidenav">     
    <?php 
      require './layout/sidNav.php';
      if(in_array("all_news",$roles)){
          ?>
        <div id="layoutSidenav_content">
      <div class="container-fluid ">
        <div class="allContent">

                        <div class="tableOfHosters table-responsive">
                            <a href="add_news.php">  <button style="padding: 7px 25px;" type="button" name="add" class="btn btn-success ml-4 mt-5">اضافة خبر جديد<i class='bx bxs-user-plus'></i></button></a>
                            <main>
              
                    <div class="container-fluid">
                        <h1 class="mt-4">بنك الدم</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item">لوحة التحكم</li>
                            <li class="breadcrumb-item active">جميع الاخبار</li>
                        </ol>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                    جميع الاخبار

                                    
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div id="toolbar" class="select">
                                        <select style="display: none;" class="form-control">
                                        </select>
                                    </div>
                                    <table class="table table-bordered text-center" data-show-export="true"
                                    data-toolbar="#toolbar" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>رقم الخبر</th>
                                            <th>عنوان الخبر</th>             
                                            <th>وصف الخبر</th>             
                                            <th>صورة الخبر</th>             
                                            <th>تعديل الخبر</th>             
                                            <th>حذف الخبر</th>             
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>رقم الخبر</th>
                                            <th>عنوان الخبر</th>             
                                            <th>وصف الخبر</th>             
                                            <th>صورة الخبر</th>             
                                            <th>تعديل الخبر</th>             
                                            <th>حذف الخبر</th>    
                                        </tr>            
                                    </tfoot>
                                        <tbody>
                                           <?php 
                                           $news = getAllData("blog");
                                           foreach($news as $news_data){
                                            echo"<tr>";
                                                echo "<td>".  $news_data['id']  	."</td>";
                                                echo "<td>".  $news_data['title']      	."</td>";
                                                echo "<td><p style='display: -webkit-box;-webkit-box-orient: vertical;-webkit-line-clamp:5;overflow: hidden;'>".  $news_data['content']."</p></td>";
                                                echo "<td>".  "<img width='150' height='150' src='img/news/".$news_data['img']."' alt='news_images'>"."</td>";
                                                echo "<td>
                                                <a href='update_news.php?id=".$news_data['id']."'
                                                class='btn editbtn btn-primary m-2'>تعديل<i class='bx bxs-edit m-1 '></i></a> " . "</td>";
                                                echo "<td>
                                                <a href='delete.php?from=news&id=".$news_data['id']."'
                                                class='btn deletebtn btn-danger m-2'>حذف<i class='bx bxs-user-minus m-1'></i></a> " . "</td>";
                                                echo "</td>";?>
                                            </tr>
                                            <?php }?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </main>

          </div>
        </div>
      </div>
    </div>
    <?php
}else{
    echo "
    <script>
    toastr.success('ليس من صلاحياتك الوصول لهذه الصفحه')
    </script>";
    header("Refresh:1;url=admin_dash.php");
}

?>
    
</div>

<?php
require_once "./includes/template/footer.php";
}else{
    header("Location:index.php");
}
ob_end_flush();