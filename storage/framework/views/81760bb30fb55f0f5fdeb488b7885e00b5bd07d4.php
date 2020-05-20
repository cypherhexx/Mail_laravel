<?php $__env->startSection('title'); ?> <?php echo e($title); ?> :: ##parent-placeholder-3c6de1b7dd91465d437ef415f94f36afc1fbc8a8## <?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
##parent-placeholder-bf62280f159b1468fff0c96540f3989d41279669##



<?php $__env->stopSection(); ?>



<?php $__env->startSection('main'); ?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice - #123</title>

    <style type="text/css">

        .invoice>div:not(.invoice-footer) {
    margin-bottom: 43px;
}
.invoice-price .invoice-price-right {
    padding: 3px;
}
        @page  {
            margin: 0px;
        }
        body {
            margin: 0px;
        }
        * {
            font-family: Verdana, Arial, sans-serif;
        }
        a {
            color: #000000;
            text-decoration: none;
        }
        table {
            font-size: x-small;
        }
        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }
        .invoice table {
            margin: 15px;
        }
        .invoice h3 {
            margin-left: 15px;
        }
        .information {
            background-color: #FFFFFF;
            color: #FFF;
        }
        .information .logo {
            margin: 5px;
        }
        .information table {
            padding: 10px;
            border: none !important;
        }
        .ajooweb {
            background-color: #00BCD4;
            color: #FFF;
        }
         .ajooweb table {
            padding: 10px;
        }
         
          table.minimalistBlack {
  border: 3px solid #a9a7a8;
  width: 100%;
  text-align: left;
  border-collapse: collapse;
}
table.minimalistBlack td, table.minimalistBlack th {
  border: 1px solid #d2d2d2;
  padding: 5px 4px;
}
table.minimalistBlack tbody td {
  font-size: 13px;
}
table.minimalistBlack thead {
  background: #FFFFFF;
  background: -moz-linear-gradient(top, #dbdbdb 0%, #d3d3d3 66%, #CFCFCF 100%);
  background: -webkit-linear-gradient(top, #dbdbdb 0%, #d3d3d3 66%, #CFCFCF 100%);
  background: linear-gradient(to bottom, #dbdbdb 0%, #d3d3d3 66%, #CFCFCF 100%);
  border-bottom: 3px solid #dbdbdb;
}
table.minimalistBlack thead th {
  font-size: 15px;
  font-weight: bold;
  color: #000000;
  text-align: left;
  background: #FFFFFF;
}
table.minimalistBlack tfoot {
  font-size: 14px;
  font-weight: bold;
  color: #000000;
  border-top: 3px solid #000000;
}
table.minimalistBlack tfoot td {
  font-size: 14px;
}
.bor{
  border: none;
}
    </style>
   <div class="invoice-company">
         <span class="pull-right hidden-print">                   
             <a href="javascript:;" onclick="window.print()" class="btn btn-sm btn-success m-b-10"><i class="fa fa-print m-r-5"></i> <?php echo e(trans('report.print')); ?></a>
         </span>
     </div>

  <br><br>
    <div class="ajooweb" >
    <table width="100%">
        <tr>
            <td align="center" style="width: 50%; ">

                 <img src="<?php echo e(url('img/cache/original/atmor.png')); ?>" width="170" height="30" alt="ajooweb" style="outline: none;border: 0;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;line-height: 100%;max-width: 65px;height: auto !important;border-radius: 100px !important;">
             
            </td>
        </tr>
    </table>
    </div>
</head>
<body>
<div class="information">
    <table width="100%"  >
        <tr>
<td align="left" style="width: 40%;">
<pre class ="bor">
<h3><?php echo e($app->company_name); ?></h3>
<?php echo e($app->company_address); ?>

<?php echo e($app->email_address); ?>                               
</pre>
</td>
<td align="right" style="width: 40%;">
<pre class ="bor">


<h3>INVOICE NO:<?php echo e($datas['invoice_id']); ?></h3>

<?php echo e($datas['name']); ?> <?php echo e($datas['lastname']); ?>

<?php echo e($datas['address']); ?>

<?php echo e($datas['mail_address']); ?>

<?php echo e($datas['mobile']); ?> 


</pre>
</td>
</tr>
</table>

</div>
<div class="alert bg-default alert-styled-left">
  <span class="text-semibold">Congrats!!</span> You have successfully Purchased <strong><?php echo e($datas['package']); ?></strong> package. Payment done via <strong><?php echo e($datas['payment_method']); ?>.</strong>
</div>
<div>
<table class="minimalistBlack">
<thead>
<tr>
<th align="center">Description</th>
<th align="center">Quantity</th>
<th align="center">Amount</th>
</tr>
</thead>
<tbody>
<tr>
<td align="left">Purchased package -<?php echo e($datas['package']); ?></td>
<td align="right">1</td>
<td align="right"><?php echo e($currency_sy); ?> <?php echo e($datas['amount']); ?>.00</td>
</tr>
<tr>
<td></td>
<td align="right">Subtotal</td>
<td align="right"><?php echo e($currency_sy); ?> 0.00</td>
</tr>
<tr>
<td></td>
<td align="right">Sales Tax</td>
<td align="right"><?php echo e($currency_sy); ?> 0.00</td>
</tr>
<tr>
<td></td>
<td align="right">Total</td>
<td align="right"><?php echo e($currency_sy); ?> <?php echo e($datas['amount']); ?>.00</td>
</tr>
</tbody>
</table>
</div>

</body>
<footer>

    
    <div class="ajooweb" >
    <table width="100%">
        <tr>
             <td align="center" style="width: 100%;height: 50px;font-size: 18px;">
               Copyright @ <?php echo e(Date('Y')); ?> <?php echo e($app->company_name); ?>. All Rights Reserved
            </td>
          
        </tr>

    </table>
    </div>
</footer>
</html>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?> ##parent-placeholder-16728d18790deb58b3b8c1df74f06e536b532695##

<script src="http://binarymlm.searchneasy.com/assets/globals/reg/apps.min.js" type="text/javascript"></script>

    <script>

        $(document).ready(function() {

            App.init(); 
        });


    </script>

    <?php $__env->stopSection(); ?>

<?php echo $__env->make('app.user.layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>