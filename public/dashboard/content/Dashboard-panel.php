<?php 
session_start();
include '../../resources/links/links-dashboard.php';
$name  = $_SESSION['user_name'];
$email  = $_SESSION['user_mail'];
$idUser = $_SESSION['user_id'];
// echo $name. '<br>'.$email .' <br>'. $idUser;
if(!isset($name) && !isset($email)  && !isset($idUser)){
    header('Location: ../../web/index.php');}
?>

<div class="d-flex">
     <!-- content sidebar menu to show -->
    <?php include 'Sidebar-panel.php';?>

    <div class="w-100"> 
        <!-- content navbar profile to show -->
        <?php include 'Navbar-panel.php';?>
        <div id="content">
            <!-- content to show -->
            <?php include '../Homepage.php';?> 
        </div>
    </div>
    
</div>
<?php 
include '../../resources/layouts/footerd.php'; 
?>

<script>
// const ctx = document.getElementById('myChart').getContext('2');
// const myChart  = new Chart (ctx,{
//         type: 'line',
//         data:{
//             label:['col1', 'col2', 'col3'],
//             datasets: [{
//                 label: 'Numeros de datos',
//                 data: [10, 9, 15],
//                 background:[
//                     'rgb(255, 99, 132)',
//                     'rgb(255, 99, 132)',
//                     'rgb(255, 99, 132)',
//                 ]
//             }]
//         },

//     });



// const ctx = document.getElementById('myChart').getContext('2');
// var myLineChart = new Chart(ctx, {
//     type: 'line',
//     data: data,
//     options: options
// });
// const labels = Utils.months({count: 7});
// const data = {
//   labels: labels,
//   datasets: [{
//     label: 'My First Dataset',
//     data: [65, 59, 80, 81, 56, 55, 40],
//     fill: false,
//     borderColor: 'rgb(75, 192, 192)',
//     tension: 0.1
//   }]
// };

</script>



<style>
body{
    overflow: hidden;
    background:#efefef;

}
.white{
    color:#fff;
}
.display-logo{
    display:inline-block;
    padding:1rem;
}
.menu span{
    display:inline-block;
    margin-left:10px;
}
.menu ion-icon{
    font-size: 24px;
}
.btn{
    border:0;
}
.bg-primary{
    background:#190c3a !important;
}
a{
    text-decoration:none;
}
a:hover{
    text-decoration:none;
    color:#9da0ff;
}
#sidebar-container{
    min-height: 100vh;
}
#sidebar-container .logo{
    padding: .875rem 1.25rem;
    color: white;
    font-weight: bold;
}
#sidebar-container .menu{
    width:18rem;
}
.btn-search{
    right:5px;
}

#content{
    overflow-y:auto;
    height: 100vh;
    padding-button:5rem;
}
.line{
    border-right: 1px solid gray;
}
</style>

