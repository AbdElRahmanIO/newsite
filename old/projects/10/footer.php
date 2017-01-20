<?php include 'header.php'; ?>



<!--

صفحة تسجيل عضوية عادية

-->
<?php 
    $section_id=$this->general_model->get_row('site_sections','section_id',['section'=>'add_malab']);
    $type_malab=$this->general_model->get_row('users_permissions','*',['type_id'=>$type_id,'section_id'=>$section_id]);
?>  
<section class="user-reg-page">
    <div class="container">
        <div class="row">
            <div id="result"></div>
            <div class="col-md-12 user-reg">
                <h5>
                    <i class="fa fa-user-plus"></i> تسجيل جديد
                </h5>
                <div class="regcont regeditr">
                    <div class="row">
                        
                        <div class="col-sm-12">
                        </div><!--post-->

                    </div><!--row-->
                </div><!--cont-->
            </div><!--bloc-->

        </div><!--row-->
    </div><!--container-->
</section><!--blocks--> 
      
      
      
      







<?php include 'footer.php'; ?>

