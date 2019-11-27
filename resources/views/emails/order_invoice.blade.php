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
                                <img src="{{ URL::asset('upload/'.getcong('site_logo')) }}" style="width:100%; max-width:200px;background-color:#394264;">
                            </td>
                            <?php  $order_date= $order_invoice[0]->created_on;			
                                   $date= date('j F, Y', strtotime($order_date));
                            ?>
                            <td>
                                Invoice #: {{$order_invoice[0]->order_id}}<br>
                                Created: {{$date}}<br>
                                
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
                               
                                <span style="font-size:14px; font-weight:bold">Name : {{$order_invoice[0]->billing_name}} {{$order_invoice[0]->billing_lname}}<br></span>
                                <span style="font-size:14px; font-weight:bold">Mobile : {{$order_invoice[0]->billing_tel}}<br></span>
                                <span style="font-size:14px; font-weight:bold">Email : {{$order_invoice[0]->billing_email}}<br></span>
                                <span style="font-size:14px; font-weight:bold">Address : {{$order_invoice[0]->address}}<br></span><span style="font-size:14px; font-weight:bold">Postal Code: {{$order_invoice[0]->billing_zip}}<br></span><span style="font-size:14px; font-weight:bold">City: {{ $order_invoice[0]->billing_city }}<br></span><span style="font-size:14px; font-weight:bold">State: {{ $order_invoice[0]->state }}</span>
                            </td> 
                            
                            @if(!empty($order_invoice[0]->ship_to_fname && $order_invoice[0]->ship_to_lname && $order_invoice[0]->ship_to_mobile && $order_invoice[0]->ship_to_email && $order_invoice[0]->ship_to_address && $order_invoice[0]->ship_to_city && $order_invoice[0]->ship_to_state && $order_invoice[0]->ship_to_pincode))
                            <td>
                                <h3 class="title">Shipping Address</h3>
                                 <span style="font-size:14px; font-weight:bold">Name : {{$order_invoice[0]->ship_to_fname}} {{$order_invoice[0]->ship_to_lname}}<br></span>
                                 <span style="font-size:14px; font-weight:bold">Mobile : {{$order_invoice[0]->ship_to_mobile}}<br></span>
                                 <span style="font-size:14px; font-weight:bold">Email : {{$order_invoice[0]->ship_to_email}}<br></span>
                                 <span style="font-size:14px; font-weight:bold">Address : {{$order_invoice[0]->ship_to_address}}, <br/>{{$order_invoice[0]->ship_to_city}}, {{$order_invoice[0]->ship_to_state}}, <br/>Postal Code {{$order_invoice[0]->ship_to_pincode}}</span>
                            </td>
                            @else 
                            <td>
                                <h3 class="title">Shipping Address</h3>
                                  <span style="font-size:14px; font-weight:bold">Name : {{$order_invoice[0]->billing_name}} {{$order_invoice[0]->billing_lname}}<br></span>
                                <span style="font-size:14px; font-weight:bold">Mobile : {{$order_invoice[0]->billing_tel}}<br></span>
                                <span style="font-size:14px; font-weight:bold">Email : {{$order_invoice[0]->billing_email}}<br></span>
                                <span style="font-size:14px; font-weight:bold">Address : {{$order_invoice[0]->address}}<br></span><span style="font-size:14px; font-weight:bold">Postal Code: {{$order_invoice[0]->billing_zip}} <br></span><span style="font-size:14px; font-weight:bold">City: {{ $order_invoice[0]->billing_city }}<br></span><span style="font-size:14px; font-weight:bold">State: {{ $order_invoice[0]->state }}</span>
                            </td>
                            @endif
                            
                        </tr>
                    </table>
                </td>
            </tr>
            
            
            
            
            <tr class="heading">
               
                <td>
                    Item
                </td>
                <td>
                    Price
                </td>
            </tr>
            <?php
                    $i=1;
                    $total=0;
                    foreach($order_invoice as $products)
                    {
                        $product_img=DB::table('products')->where('id',$products->product_id)->get();

                        $price1=$products->product_price;
                        $price2=$products->product_price;
                        $shipping_fees=$products->postcode_shipping_charges;
                        $total+=$products->product_price;
                                               
                                ?>
            <tr class="item">
               
                 <td>
                    {{$products->product_name}}
                </td>
                <td>
                    ${{$products->product_price}}
                </td>
            </tr>
            <?php $i++; } ?>
            
           <tr class="total">
                <td></td>                
                <td>
                   Discount: $<?php echo $discount=$products->discount;?>
                </td>
                
            </tr>
            
            <tr class="total">
                <td></td>                
                <td>
                   Total: $<?php echo $total-$discount;?>
                </td>
                
            </tr>
            
            <tr>
                <td></td>
                
                <td>
                    <b>Shipping Fees: $<?php echo $shipping_fees;?></b>
                </td>
            </tr>
            	<tr>
                                                                         
                    <td></td>
                    <td><b>2% handling fees: $ @if(!empty($discount)){{ $handling_charge=($shipping_fees+$total)*2/100}}  @else {{ $handling_charge=($shipping_fees+$total)*2/100}} @endif</b></td>
                </tr>  
            <tr>
                <td></td>
                
                <td>
                   <b>Grand Total : $<?php echo $handling_charge+$total+$shipping_fees-$discount;?></b>
                </td>
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
        
         <h4><a href="javascript:;" onclick="window.print()">Print</a></h4> 
       
    </div>
</body>
</html>

