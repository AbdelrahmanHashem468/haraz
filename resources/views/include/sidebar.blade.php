<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

        
        
        <nav class="navbar navbar-expand fixed-top navbar-dark  maincolor rtldir"> <a href="#menu-toggle" id="menu-toggle" class="navbar-brand"><span class="navbar-toggler-icon"></span></a> <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample02" aria-controls="navbarsExample02" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
            <div class="collapse navbar-collapse" id="navbarsExample02">
                <ul class="navbar-nav mr-auto rtl ">
                    <li class="nav-item active rtl"> <a class="nav-link" href="../customers">العملاء <span class="sr-only">(current)</span></a> </li>
                    <li class="nav-item active rtl"> <a class="nav-link" href="../clients">الموردين <span class="sr-only">(current)</span></a> </li>
                    <li class="nav-item active rtl"> <a class="nav-link" href="../shoppingcart">العربة</a> </li>
                    <li class="nav-item active rtl"> <a class="nav-link" href="#">الحسابات</a> </li>
                </ul>
                <form class="form-inline my-2 my-md-0"> </form>
            </div>
        </nav>

        
        <div id="wrapper" class="toggled no-print">
            <!-- Sidebar -->
            <div id="sidebar-wrapper">
                <ul class="sidebar-nav">
                    <li class="sidebar-brand"> <a href="#"> المنتجات </a> </li>
                    <li> <a href="../product/0">العطارة</a> </li>
                    <li> <a href="../product/1">الأعشاب</a> </li>
                    <li> <a href="../product/2">البقوليات</a> </li>
                    <li> <a href="../product/3">الحلواني</a> </li>
                    <li> <a href="../product/4">المستحضرات</a> </li>
                    <a href="../ordercart" class="btn btn-primary active add2" role="button"  aria-pressed="true">عمل طلب</a>
                    <a href="../productform" class="btn btn-primary active add2" role="button"  aria-pressed="true"> اضافة منتج جديد</a>
                </ul>
            </div> <!-- /#sidebar-wrapper -->
            <!-- Page Content -->
        </div> <!-- /#wrapper -->
        <!-- Bootstrap core JavaScript -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script> <!-- Menu Toggle Script -->
        <script>
            $(function(){
            $("#menu-toggle").click(function(e) {
                e.preventDefault();
                $("#wrapper").toggleClass("toggled");
            });

            $(window).resize(function(e) {
                if($(window).width()<=768){
                $("#wrapper").removeClass("toggled");
                }else{
                $("#wrapper").addClass("toggled");
                }
            });
            });
            
        </script>
        </html>