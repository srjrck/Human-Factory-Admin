<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{getcong('site_name')}}</title>
    
    <style>
    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }
    
    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }
    
    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }
    
    .invoice-box table tr td:nth-child(2) {
        text-align: right;
    }
    
    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
    }
    
    .invoice-box table tr.information table td {
        padding-bottom: 40px;
    }
    
    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }
    
    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
    }
    
    .invoice-box table tr.item.last td {
        border-bottom: none;
    }
    
    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }
    
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }
        
        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }
    
    /** RTL **/
    .rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }
    
    .rtl table {
        text-align: right;
    }
    
    .rtl table tr td:nth-child(2) {
        text-align: left;
    }
    </style>
</head>

<body>
    <div class="invoice-box" id="print_invoice">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="{{ URL::asset('upload/'.getcong('site_logo')) }}" style="width:100%; max-width:300px;background-color:#394264;">
                            </td>
                            
                            <td>
                                <b>Order id: <?php echo $order_id?></b>                              
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                        
                            <td>
                                <h3 class="title">Billing Address</h3>
                                @if(!empty($customer_address))
                                    <span style="font-size:14px; font-weight:bold">Name : <?php echo $customer_name.' '.$customer_lname ?><br></span>
                                    <span style="font-size:14px; font-weight:bold">Mobile : <?php echo $customer_mobile ?><br></span>
                                    <span style="font-size:14px; font-weight:bold">Email : <?php echo $customer_email ?><br></span>
                                    <span style="font-size:14px; font-weight:bold">Address : <?php echo $customer_address ?>, <?php echo $customer_location ?>, <?php echo $customer_zipcode ?></span>
                                @else
                                    <span style="font-size:14px; font-weight:bold">Name : <?php echo $ship_fname.' '.$ship_lname ?><br></span>
                                    <span style="font-size:14px; font-weight:bold">Mobile : <?php echo $ship_mobile ?><br></span>
                                    <span style="font-size:14px; font-weight:bold">Email : <?php echo $ship_email ?><br></span>
                                    <span style="font-size:14px; font-weight:bold">Address : <?php echo $ship_address ?>, <?php echo $ship_location; ?>, <?php echo $ship_zipcode ?></span>
                                @endif
                            </td> 
                            
                            <td>
                                <h3 class="title">Shipping Address</h3>
                                @if(!empty($ship_fname && $ship_lname && $ship_mobile && $ship_email && $ship_address  && $ship_zipcode))
                                    <span style="font-size:14px; font-weight:bold">Name : <?php echo $ship_fname.' '.$ship_lname ?><br></span>
                                    <span style="font-size:14px; font-weight:bold">Mobile : <?php echo $ship_mobile ?><br></span>
                                    <span style="font-size:14px; font-weight:bold">Email : <?php echo $ship_email ?><br></span>
                                    <span style="font-size:14px; font-weight:bold">Address : <?php echo $ship_address ?>, <?php echo $ship_location; ?>, <?php echo $ship_zipcode ?></span>
                                @else 
                                    <span style="font-size:14px; font-weight:bold">Name : <?php echo $customer_name.' '.$customer_lname ?><br></span>
                                    <span style="font-size:14px; font-weight:bold">Mobile : <?php echo $customer_mobile ?><br></span>
                                    <span style="font-size:14px; font-weight:bold">Email : <?php echo $customer_email ?><br></span>
                                    <span style="font-size:14px; font-weight:bold">Address : <?php echo $customer_address ?>, <?php echo $customer_location ?>, <?php echo $customer_zipcode ?></span>
                                @endif
                            </td>
                        
                           
                        </tr>
                    </table>
                </td>
            </tr>
            
            
            
            
            <tr class="heading">
               <td>
                    Sr no
                </td>
                <td>
                    Product Name
                </td>
                <td>
                    Quantity
                </td>
                
                 <td>
                    Price
                </td>
                
            </tr>
             <?php                                
            $order_mail= DB::table('order')
               ->leftJoin('booking_details', 'order.order_id', '=', 'booking_details.order_id')
               ->leftJoin('users', 'booking_details.user_id', '=', 'users.id')
               ->where('order.order_id','=',$order_id)->get();
            
                $total=0;
                $i=1;
                foreach($order_mail as $products)
                {
                    $product_img=DB::table('products')->where('id',$products->product_id)->get();

                    $price1=$products->product_price;
                    $price2=$products->product_price;
                    $discount=$products->discount;
                    $shipping_fees=$products->postcode_shipping_charges;
                    $total+=$products->product_price;
                ?>
                    <tr class="item"> 
                        <td>{{$i}}</td>
                        <td>{{$products->product_name}}</td>
                        <td>
                            @if(isset($products->product_quantity))
                               {{$products->product_quantity}}
                            @else 
                               1
                            @endif 
                        </td>
                        <td><i class="fas fa-rupee-sign"></i>{{$products->product_price}}</td>
                    </tr>                    
                <?php $i++; } ?>
                    
                <tr>
                    <td></td>
                    <td></td>
                    <td>Item Total</td>
                    <td><i class="fas fa-rupee-sign"></i> {{$total}}</td>
                </tr>
                
                <tr>
                    <td></td>
                    <td></td>
                    <td>Discount</td>
                    <td><i class="fas fa-rupee-sign"></i> @if(!empty($discount)) {{$discount}} @else 0 @endif</td>
                </tr>
                
                <tr>
                    <td></td>
                    <td></td>
                    <td>Shipping Fees</td>
                    <td><i class="fas fa-rupee-sign"></i> {{$shipping_fees}}</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <?php $handlingcharges = DB::table('handlingcharges')->where('id',1)->pluck('charges'); ?>
                    <td>{{@$handlingcharges[0]}}% handling fees</td>
                    <td><i class="fas fa-rupee-sign"></i> @if(!empty($discount)){{ $handling_charge=($shipping_fees+$total-$discount)*@$handlingcharges[0]/100}}  @else {{ $handling_charge=($shipping_fees+$total)*@$handlingcharges[0]/100}} @endif</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>Grand Total</td>
                    <td><i class="fas fa-rupee-sign"></i> <?php echo $handling_charge+$total+$shipping_fees-$discount;?></td>
                </tr>
                
        </table>
          <hr>
          <table>
             <tr>
                 <td><strong>Thank You For Your Order! </strong></td>
               
            </tr>
            <tr>
                 <td>If you have any question.Please feel free Contact Us At-  {{getcong('contact_email')}} .</td>
               
            </tr>
             <tr>
                 <td>{{getcong('site_copyright')}} </td>
               
            </tr>
        </table>
        
    </div>
</body>
</html>

